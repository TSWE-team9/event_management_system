<?php


//Zugangsdaten zur Datenbank
$host = '132.231.36.109';
$db = 'vms_db';
$user = 'dbuser';
$pw = 'dbuser123';

$conn = new mysqli($host, $user, $pw, $db,3306);

if($conn->connect_error){
    die('Connect Error (' . $conn->connect_errno . ') '
        . $conn->connect_error);
}

//Variablen
$Bid = $_SESSION['b_id'];
$Vid = $_SESSION['V_ID'];
$errors_anmeldung = array();
$errors_abmeldung = array();
$current_date = date("Y-m-d");

//Variablen aus Query zuweisen
$query = "SELECT Verfügbarkeit,Status,Teilnehmer_max,Teilnehmer_akt,Beginn,Frist, Titel FROM Veranstaltung WHERE V_ID = $Vid";
$res = $conn->prepare($query);
$res->execute();
$res->bind_result($verfügbarkeit, $status, $Tmax, $Takt, $beginn, $frist, $titel);
$res->fetch();
$res->close();

$query2 = "SELECT Vorname, Nachname FROM Teilnehmerkonto WHERE B_ID=$Bid";
$res2 = $conn->prepare($query2);
$res2->execute();
$res2->bind_result($vorname, $nachname);
$res2->fetch();
$res2->close();


//Zeitintervall berechnen
$datetime1 = strtotime($beginn);
$datetime2 = strtotime($current_date);

$secs = $datetime1 - $datetime2;// == <seconds between the two times>
$days = $secs / 86400;

//Veranstaltung anmelden Funktion
if (isset($_POST['anmelden'])) {


    //Fehlerueberpruefung
    if($verfügbarkeit == 2){
        array_push($errors_anmeldung, "Geschlossene Veranstaltung!");
    }
    if($status == 2){
        array_push($errors_anmeldung, "Veranstaltung hat bereits begonnen!");
    }
    if($status == 3){
        array_push($errors_anmeldung, "Veranstaltung ist abgelaufen!");
    }
    if($status == 4){
        array_push($errors_anmeldung, "Veranstaltung wurde storniert!");
    }
    if(($Tmax-$Takt)==0){
        array_push($errors_anmeldung, "Keine freien Plätze verfügbar");
    }
    if($days < $frist){
        array_push($errors_anmeldung, "Anmeldefrist abgelaufen!");
    }

    //Wenn keine Fehler: Teilnehmer hinzuf[gen und Teilnehmerzahl updaten
    if (count($errors_anmeldung) == 0) {

        $query_v = "INSERT INTO Teilnehmerliste_offen
  			  VALUES('$Vid','$Bid',current_date,'$nachname','$vorname')";
        mysqli_query($conn, $query_v);

        $query_add = "UPDATE Veranstaltung SET Teilnehmer_akt=Teilnehmer_akt+1 WHERE V_ID=$Vid";
        mysqli_query($conn, $query_add);

        // array_push($errors_anmeldung, "Anmeldung erfolgreich!");

        //Anmeldung per Mail versenden
        $empfaenger = get_mail_address($Bid);
        $betreff = "Anmeldung zur Veranstaltung ".$titel. " erfolgreich";
        $nachricht = "Sie haben sich erfolgreich zur Veranstaltung ".$titel. " angemeldet. Sie können sich ".$frist." Tage bis ".$beginn." abmelden.
                      Nähere Informationen finden Sie auch auf der Veranstaltungsseite im VMS.";

        send_email($empfaenger, $betreff, $nachricht);
        
        // Nachricht erfolgreiche Anmeldung
        echo 
        '<div class="overlay">
            <div class="popup">
                <h2 class="hdln">Anmeldung erfolgreich</h2>
                <a class="close" href="../Teilnehmer/angemeldeteVeranstaltungen/TeilnehmerVeranstaltungen.php">&times;</a>
                <div class="content">Sie haben sich erfolgreich zu dieser Veranstaltung angemeldet.</div>
            </div>
        </div>';

    }
}

//Funktion Abmeldung von Veranstaltung
if (isset($_POST['abmelden'])) {

    if($verfügbarkeit == 2){
        array_push($errors_abmeldung, "Abmeldung bei geschlossener Veranstaltung nicht möglich!");
    }
    if($status == 2){
        array_push($errors_abmeldung, "Veranstaltung hat bereits begonnen!");
    }
    if($status == 3){
        array_push($errors_abmeldung, "Veranstaltung ist abgelaufen!");
    }
    if($status == 4){
        array_push($errors_abmeldung, "Veranstaltung wurde storniert!");
    }
    if($days < $frist){
        array_push($errors_abmeldung, "Abmeldefrist abgelaufen!");
    }

    //Wenn keine Fehler: Teilnehmer hinzuf[gen und Teilnehmerzahl updaten
    if (count($errors_abmeldung) == 0) {

        $query_abmeldung = "DELETE FROM Teilnehmerliste_offen WHERE B_ID=$Bid AND V_ID=$Vid";
        mysqli_query($conn, $query_abmeldung);

        $query_sub = "UPDATE Veranstaltung SET Teilnehmer_akt=Teilnehmer_akt-1 WHERE V_ID=$Vid";
        mysqli_query($conn, $query_sub);
        // array_push($errors_abmeldung, "Abmeldung erfolgreich!");

        //Abmeldung per Mail versenden
        $empfaenger = get_mail_address($Bid);
        $betreff = "Abmeldung zur Veranstaltung ".$titel. " erfolgreich";
        $nachricht = "Sie haben sich erfolgreich von der Veranstaltung ".$titel. " abgemeldet.";

        send_email($empfaenger, $betreff, $nachricht);

        // Nachricht erfolgreiche Abmeldung
        echo 
        '<div class="overlay">
            <div class="popup">
                <h2 class="hdln">Abmeldung erfolgreich</h2>
                <a class="close" href="../Teilnehmer/Startseite/TeilnehmerStartseite.php">&times;</a>
                <div class="content">Sie haben sich erfolgreich von der Veranstaltung abgemeldet.</div>
            </div>
        </div>';

    }
}

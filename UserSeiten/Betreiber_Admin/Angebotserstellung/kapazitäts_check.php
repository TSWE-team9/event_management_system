<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kapazitätscheck</title>
    <link rel="stylesheet" type="text/css" href="../style/Formular.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/Fehlermeldung.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/Tabellen.css">
<!--    <link rel="stylesheet" type="text/css" href="../style/Bild/Buttons.css">-->
</head>

<body>

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

//Error Variablen, Query Variable
$error_occured1 = false;
$error_occured2 = false;
$error1 = "";
$error2 = "";

//Session Variablen:

//Speichert die verfügbaren Räume und ihre IDs in einem Array
$_SESSION["R_ID_Array"] = array();

//Platzhalter für das finale Datum des Beginns für die Reservierung
$_SESSION["Beginn_final"] = '2020-01-01';

//Platzhalter für den finalen Angebotsstatus (Default: 2 ("bearbeitet"))
$_SESSION["Angebotsstatus_final"] = 2;

//Variablenplatzhalter
$Beginn = "";

//Abspeichern der Daten aus dem Formular für Prüfung über Anfrage/Angebots_ID
if(isset($_POST["Kapazitätsprüfung1"])) {

//Abspeichern der aus dem Formular übergebenen Daten
    $angebot_id = $_POST["KapÜberprüfung"];

    //Session Variable für die Angebot_ID
    $_SESSION["BeAr_ID"] = $angebot_id;

    //Session Variable für die Art der Kap. Überprüfung (extern = 1, intern = 2)
    $_SESSION["Prüfungsart"] = 1;

//Überprüfen, ob angegebene BeAr_ID existiert und prüfen, ob Status "angefragt" ist (1)
    $check_query = "SELECT BeAr_ID FROM Anfrage_Angebot WHERE BeAr_ID = $angebot_id AND Status = 1";
    if ($conn->query($check_query)->num_rows == 0) {
        $error_occured2 = true;
        $error2 = "Angegebene Angebots_ID existiert nicht oder das Angebot wurde bereits angenommen/abgelehnt";
    }

//Abfrage und Speichern der Daten B_ID, Beginn, Dauer und Teilnehmerzahl für die Anfrage
    $data_query = "SELECT Veranstalter, Beginn, Teilnehmer_gepl, Dauer FROM Anfrage_Angebot WHERE BeAr_ID = $angebot_id";
    $res = $conn->prepare($data_query);
    $res->execute();
    $res->bind_result($_SESSION["Veranstalter"],$Beginn, $_SESSION["Teilnehmerzahl"], $_SESSION["Dauer_final"]);
    $res->fetch();
    $res->close();
}

//Abspeichern der Daten aus KapazitätenabfrageV2 für erneute Prüfung mit anderem Datum
if(isset($_POST["Kapazitätsprüfung2"])) {

    $Beginn = $_POST["Startdatum"];

    //Betreiber hat ursprüngliche Angaben des Veranstalters geändert, Status wird 3
    if($_SESSION["Prüfungsart"] == 1){
        $_SESSION["Angebotsstatus_final"] = 3;
    }

}

//Abspeichern der Daten aus KapazitätenabfrageV3 für interne Veranstaltungen
if(isset($_POST["Kapazitätsprüfung3"])) {

    $Beginn = $_POST["Startdatum"];
    $_SESSION["Dauer_final"] = $_POST["Dauer"];
    $_SESSION["Teilnehmerzahl"] = $_POST["Teilnehmerzahl"];

    //Session Variable setzen, es handelt sich um eine Überprüfung für eine interne Veranstaltung
    $_SESSION["Prüfungsart"] = 2;
}

//Ablehnen der Anfrage nach unerfolgreicher Kapazitätsabfrage und Buttonklick in KapazitätenabfrageV2
if(isset($_POST["Ablehnen"])){

    $anfrage_id = $_SESSION["BeAr_ID"];

    //Error setzen um nicht eine weitere Abfrage auszulösen in Zeile 152
    $error_occured1 = true;

    //Senden einer Mail an den Veranstalter
    include("../../send_email.php");
    $email = get_mail_address($_SESSION["Veranstalter"]);
    send_email($email, "Anfrage abgelehnt", "Wir mussten Ihre Anfrage ablehnen, da zu angefragten Zeitpunkt oder für ihre Anforderungen keinerlei Kapazitäten vorhanden sind. Sie können jederzeit eine weitere Anfrage erstellen.");

    $status = $conn->query("UPDATE Anfrage_Angebot SET Status = 5 WHERE BeAr_ID = $anfrage_id");

    if($status === FALSE){
        echo "<div class='overlay'>" ;
        echo  "<div class='popup'>";
        echo "<h2>Fehler</h2>" ;
        echo "<a class='close' href='Angebotserstellung.php'>&times;</a>" ;
        echo "<div class='content' >" , 'Die Anfrage konnte nicht abgelehnt werden ';
        echo "</div>";
        echo "</div>" ;
        echo "</div>" ;
    }
    //Ausgabe einer Bestätigung
    else {
        echo "<div class='overlay'>";
        echo "<div class='popup'>";
        echo "<h2>Bestätigung</h2>";
        echo "<a class='close' href='Angebotserstellung.php'>&times;</a>";
        echo "<div class='content' >", 'Die Anfrage wurde erfolgreich abgelehnt ';
        echo "</div>";
        echo "</div>";
        echo "</div>";

    }

}

//Abbrechen der Überprüfung (intern) nach unerfolgreicher KapazitätsabfrageV2
if(isset($_POST["Abbrechen"])){
    header("Location: InterneVeranstaltungen.php");
}



//Abfrage im Kalender, welche Räume zu den angegebenen Daten frei sind, nur wenn keine Fehler aufgetreten sind
    if ($error_occured1 == false && $error_occured2 == false) {

        $teilnehmerzahl = $_SESSION["Teilnehmerzahl"];
        $Dauer = $_SESSION["Dauer_final"];
        $query = "SELECT R.R_ID, R.Bezeichnung, R.Kapazitaet FROM Raum R
              WHERE R.Kapazitaet >= $teilnehmerzahl AND R.Status = 1
              AND NOT EXISTS(SELECT * FROM Kalender WHERE R.R_ID = Kalender.R_ID AND
                             Von <= '$Beginn' AND '$Beginn' <= Bis)

              AND NOT EXISTS(SELECT * FROM Kalender WHERE R.R_ID = Kalender.R_ID AND
                             Bis >= DATE_ADD('$Beginn', INTERVAL $Dauer-1 DAY) AND DATE_ADD('$Beginn', INTERVAL $Dauer-1 DAY) >= Von)";

        $res2 = $conn->query($query);

        if ($res2->num_rows == 0) {
            //Wenn keine freien Räume gefunden wurden Weiterleitung zu Formular V2"
            echo "<div class='overlay'>" ;
            echo  "<div class='popup'>";
            echo "<h2>Fehler</h2>" ;
            echo "<a class='close' href='KapazitätenabfrageV2.php'>&times;</a>" ;
            echo "<div class='content' >" , 'Es sind zu diesem Zeitpunkt keine freien Kapazitäten verfügbar. ';
            echo "</div>";
            echo "</div>" ;
            echo "</div>" ;

        } else {

            //Abspeichern der finalen Daten für Beginn und Ende
            $_SESSION["Beginn_final"] = $Beginn;

            //Ausgabe der verfügbaren Räume in einer Tabelle
            echo "<br><h1>" . "Folgende Räume sind im eingegebenen Zeitraum verfügbar:" . "</h1><br>";
            echo "<br><br>";
            echo "<table border=\"1\" class='container'>";
            echo "<th>R_ID</th><th>Bezeichnung</th><th>Kapazität</th>";
            while ($i = $res2->fetch_row()) {
                if ($i[0]) {
                    array_push($_SESSION["R_ID_Array"], $i[0]);
                }
                echo "<tr>";
                foreach ($i as $item) {
                    echo "<td>$item</td>";
                }
                echo "</tr>\n";
            }

            echo "</table>\n";
            echo "<br><br>";


            //Reservierungsformular Button zum Reservieren
            echo '<a href="Raumreservierung.php" type="button" class="Auslösen" style="margin-bottom: 2em">Reservierungsformular</a>';


        }

    }

    if ($error_occured1 == true) {
    echo "<br>" . $error1;
    }

    //Ausgabe einer Fehlermeldung der Abfrage zb falsche Angebot ID
    if ($error_occured2 == true) {

        echo "<div class='overlay'>" ;
	echo  "<div class='popup'>";
		echo "<h2>Fehler</h2>" ;
		echo "<a class='close' href='KapazitätenabfrageV1.php'>&times;</a>" ;
		echo "<div class='content'>" .$error2. "</div>";
	echo "</div>" ;
echo "</div>" ;
}



?>
</body>
</html>

<?php

//Verbindung zur Datenbank herstellen
$host = '132.231.36.109';
$db = 'vms_db';
$user = 'dbuser';
$pw = 'dbuser123';
$conn = new mysqli($host, $user, $pw, $db,3306);


//Überprüfen ob es einen Verbindungsfehler gab
if($conn->connect_error){
    die('Connect Error (' . $conn->connect_errno . ') '
        . $conn->connect_error);
}

//Error Variable
$error = "";
$error_occured = false;

if(isset($_POST["Stornieren"])) {

    //Abspeichern der V_ID
    $V_ID = $_POST["v_id"];

    //Abfragen der Verfügbarkeit, Titel der Veranstaltung
    $query = "SELECT Verfügbarkeit, Titel, Kategorie FROM Veranstaltung WHERE V_ID = $V_ID";
    $res = $conn->prepare($query);
    $res->execute();
    $res->bind_result($verfuegbarkeit, $titel, $kategorie);
    $res->fetch();
    $res->close();

    //DB UPDATE Stornierung
    $query1 = "UPDATE Veranstaltung SET Status = 4 WHERE V_ID = $V_ID";
    $res1 = $conn->query($query1);
    if($res1 === TRUE){


        if($kategorie == 1) {
            //Stornodatum in Anfrage_Angebot festhalten
            $query2 = "UPDATE Anfrage_Angebot SET Stornodatum = LOCALTIMESTAMP
                WHERE BeAr_ID = (SELECT Angebot_ID FROM Veranstaltung WHERE V_ID = $V_ID)";
            $res2 = $conn->query($query2);

            if($res2 == FALSE){
                $error = $error . "<br>" . "Fehler bei Stornodatum in der DB";
                $error_occured = true;
            }
        }

        //Bei offenen Veranstaltungen
        if($verfuegbarkeit == 1){

            //Angemeldete Teilnehmer per Mail benachrichtigen (nur offene Veranstaltungen)
            $query3 = "SELECT B_ID FROM Teilnehmerliste_offen WHERE V_ID = $V_ID";
            $res3 = $conn->query($query3);
            if($res3->num_rows > 0){

                $betreff = "Veranstaltungsstornierung";
                $nachricht = "Die Veranstaltung " . $titel . " wurde vom Veranstalter storniert und findet nicht statt. Es fallen keine Kosten für Sie an.";

                while($i = $res3->fetch_row()){
                    $empfaenger = get_mail_address($i[0]);
                    send_email($empfaenger, $betreff, $nachricht);
                }

                //Alle Einträge aus der Teilnehmerliste (offen) löschen
                $query4 = "DELETE FROM Teilnehmerliste_offen WHERE V_ID = $V_ID";
                $res4 = $conn->query($query4);
                if($res4 == FALSE){
                    $error = $error . "<br>" . "Fehler beim Löschen aus der Teilnehmerliste (offen)";   // Fehler bei leerer Liste TODO
                    $error_occured = true;
                }
            }

        }

        //Bei geschlossenen Veranstaltungen
        if($verfuegbarkeit == 2){

            //Alle Einträge aus der Teilnehmerliste (geschlossen) löschen
            $query5 = "DELETE FROM Teilnehmerliste_ges WHERE V_ID = $V_ID";
            $res5 = $conn->query($query5);

            if($res5 == FALSE){
                $error = $error . "<br>" . "Fehler beim Löschen aus der Teilnehmerliste (geschlossen)"; // Fehler kommt bei offender Veranstaltung TODO
                $error_occured = true;
            }
        }

        //Kalender updaten -> betroffenen Eintrag löschen
        $query6 = "DELETE FROM Kalender WHERE V_ID = $V_ID";
        $res6 = $conn->query($query6);

        if($res6 == FALSE){
            $error = $error . "<br>" . "Fehler beim Löschen aus dem Kalender";
            $error_occured = true;
        }

    } else{
        $error = "Fehler: Stornierung der Veranstaltung ist fehlgeschlagen";
        $error_occured = true;
    }

    //Ausgabe der Meldungen
    if($error_occured){
        echo "<div class='overlay'>" ;
        echo "<div class='popup'>";
        echo "<h2 class='hdln'>Fehler</h2>" ;
        echo "<a class='close' href='VeranstaltungsSeite.php'>&times;</a>" ;
        echo "<div class='content'>"  .$error. "</div>";
        echo "</div>" ;
        echo "</div>" ;
    }
    else {
        $href = "";
        if($_SESSION["rolle"] == 1){
            $href = "../Veranstalter/Startseite/VeranstalterStartseite.php";
        }
        if($_SESSION["rolle"] == 3){
            $href = "../Betreiber_Admin/Startseiten/StartseiteBetreiber.php";
        }
        if($_SESSION["rolle"] == 4){
            $href = "../Betreiber_Admin/Startseiten/AdminStartseite.php";
        }


        echo "<div class='overlay'>" ;
        echo "<div class='popup'>";
        echo "<h2 class='hdln'>Bestätigung</h2>" ;
        echo "<a class='close' href=".$href.">&times;</a>" ;
        echo "<div class='content'>Veranstaltung erfolgreich storniert</div>";
        echo "</div>" ;
        echo "</div>" ;
    }


}


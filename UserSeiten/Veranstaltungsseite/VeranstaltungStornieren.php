<?php
// session_start();
// include "../send_email.php";

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
    $query = "SELECT Verfügbarkeit, Titel FROM Veranstaltung WHERE V_ID = $V_ID";
    $res = $conn->prepare($query);
    $res->execute();
    $res->bind_result($verfuegbarkeit, $titel);
    $res->fetch();
    $res->close();

    //DB UPDATE Stornierung
    $query1 = "UPDATE Veranstaltung SET Status = 4 WHERE V_ID = $V_ID";
    $res1 = $conn->query($query1);
    if($res1 === TRUE){

        //Stornodatum in Anfrage_Angebot festhalten
        $query2 = "UPDATE Anfrage_Angebot SET Stornodatum = LOCALTIMESTAMP
                WHERE BeAr_ID = (SELECT Angebot_ID FROM Veranstaltung WHERE V_ID = $V_ID)";
        $res2 = $conn->query($query2);

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
                $res4 = $conn->query($query4);}

        }

        //Bei geschlossenen Veranstaltungen
        if($verfuegbarkeit == 2){

            //Alle Einträge aus der Teilnehmerliste (geschlossen) löschen
            $query5 = "DELETE FROM Teilnehmerliste_ges WHERE V_ID = $V_ID";
            $res5 = $conn->query($query5);
        }

        //Kalender updaten -> betroffenen Eintrag löschen
        $query6 = "DELETE FROM Kalender WHERE V_ID = $V_ID";
        $res6 = $conn->query($query6);

    } else{
        $error = "Fehler: Stornierung der Veranstaltung ist fehlgeschlagen";
        $error_occured = true;
    }

    //Error Block
    if($res2 == FALSE){
        $error = $error . "<br>" . "Fehler bei Stornodatum in der DB";
        $error_occured = true;
    }
    if($res3 == FALSE){
        $error = $error . "<br>" . "Fehler bei Benachrichtung (keine Teilnehmer oder Fehler bei Abfrage der B_ID)"; // Fehler bei leerer Liste TODO
        $error_occured = true;
    }
    if($res4 == FALSE){
        $error = $error . "<br>" . "Fehler beim Löschen aus der Teilnehmerliste (offen)";   // Fehler bei leerer Liste TODO
        $error_occured = true;
    }
    if($res5 == FALSE){
        $error = $error . "<br>" . "Fehler beim Löschen aus der Teilnehmerliste (geschlossen)"; // Fehler kommt bei offender Veranstaltung TODO
        $error_occured = true;
    }
    if($res6 == FALSE){
        $error = $error . "<br>" . "Fehler beim Löschen aus dem Kalender";
        $error_occured = true;
    }

    //TODO Ausgabe möglicher Fehlermeldungen PopUp und dann Weiterleitung
    if($error_occured){
        echo $error;
    }


}


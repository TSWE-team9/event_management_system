<?php
session_start();
include "../../send_email.php";

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

    //Stornodatum in Anfrage_Angebot festhalten
    $query2 = "UPDATE Anfrage_Angebot SET Stornodatum = LOCALTIMESTAMP
                WHERE BeAr_ID = (SELECT B_ID FROM Kalender WHERE V_ID = $V_ID)";
    $res2 = $conn->query($query2);


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
        }

        //Alle Einträge aus der Teilnehmerliste (offen) löschen

    }
    else{
        //Alle Einträge aus der Teilnehmerliste (geschlossen) löschen
    }


    //Kalender updaten -> betroffenen Eintrag löschen


    //Error Block


}


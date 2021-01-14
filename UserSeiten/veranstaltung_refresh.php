<?php

/*Beschreibung:

In diesem File wird eine Funktion definiert, die bei jedem Aufruf der Veranstaltungsübersicht (egal welcher Nutzer) überprüft,
ob der Status einer Veranstaltung sich geändert hat, also bspw. ob eine begonnene Veranstaltung nun abgelaufen ist oder
eine aktive Veranstaltung nun begonnen hat.

*/

function veranstaltung_refresh(){

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

    //Aktive Veranstaltungen, die bereits begonnen haben werden auf "begonnen" gesetzt
    $query1 = "SELECT V_ID FROM Veranstaltung WHERE Status = 1 AND date(LOCALTIMESTAMP) >= Beginn";
    $res1 = $conn->query($query1);
    if($res1->num_rows > 0){
        while($i = $res1->fetch_row()){
            $update_query1 = "UPDATE Veranstaltung SET Status = 2 WHERE V_ID = $i[0]";
            $conn->query($update_query1);
        }
    }

    //Begonnene Veranstaltungen, die bereits beendet/abgelaufen sind werden auf "abgelaufen" gesetzt
    $query2 = "SELECT V_ID FROM Veranstaltung WHERE Status = 2 AND date(LOCALTIMESTAMP) > DATE_ADD(Beginn, INTERVAL Dauer-1 DAY)";
    $res2 = $conn->query($query2);
    if($res2->num_rows > 0){
        while($i = $res2->fetch_row()){
            $update_query2 = "UPDATE Veranstaltung SET Status = 3 WHERE V_ID = $i[0]";
            $conn->query($update_query2);
        }
    }

}
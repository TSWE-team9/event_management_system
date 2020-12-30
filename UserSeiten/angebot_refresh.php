<?php

/*Beschreibung:

In diesem File wird eine Funktion definiert, die bei jedem Aufruf der Veranstaltungssseite bzw Anfrageseite des Veranstalters
bzw des Betreibers überprüft, ob ein eingegangenes Angebot bereits abgelaufen ist (Angebotsdatum älter als 7 Tage).
Sollte dieses abgelaufen sein, muss der Veranstalter kontaktiert werden, das Angebot abgelehnt werden sowie die Reservierung
aus dem Kalender gelöscht werden.

*/

function angebot_refresh(){
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

    $query = "SELECT BeAr_ID, Veranstalter FROM Anfrage_Angebot WHERE date(LOCALTIMESTAMP) - Angebotsdatum > 7 AND Status IN (2,3)";
    $res = $conn->query($query);
    if($res->num_rows > 0){

        while($i = $res->fetch_row()){
            //Angebot ablehnen
            $query2 = "UPDATE Anfrage_Angebot SET Status = 5 , R_ID = NULL WHERE BeAr_ID = $i[0]";
            $conn->query($query2);

            //Kalendereintrag freigeben
            $query3 = "DELETE FROM Kalender WHERE B_ID = $i[0]";
            $conn->query($query3);

            //TODO Veranstalter kontaktieren per Mail

        }

    }

}

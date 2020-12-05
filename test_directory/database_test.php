<?php

echo 'Das ist ein Test der MySQL Datenbank des Systems. ';
echo 'Es wird eine einfache Datenbankabfrage durchgeführt. ';
print "<br/>";

//Verbindung zur Datenbank auf dem Server herstellen
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=vms_db", "dbuser", "dbuser123");

$result = $pdo->query("select V_ID, V_name from veranstaltung");

foreach ($result as $row) {
    print $row["V_ID"]. " ";
    print $row["V_name"];
    print "<br/>";
}

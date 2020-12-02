<?php

echo 'Das ist ein Test der MySQL Datenbank des Systems.Es wird eine einfache Tabellenabfrage gemacht.';

//Verbindung zur Datenbank auf dem Server herstellen
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=vms_db", "dbuser", "dbuser123");

$result = $pdo->query("select * from veranstaltung");

foreach ($result as $row) {
    print $row["id"]. " ";
    print $row["name"];
    print "<br/>";
}

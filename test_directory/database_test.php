<?php

echo 'Das ist ein Test der MySQL Datenbank des Systems.Es wird eine einfache Tabellenabfrage gemacht.';
echo "<br>";

//Verbindung zur Datenbank auf dem Server herstellen
$host = '132.231.36.109';
$db   = 'vms_db';
$user = 'dbuser';
$pw = 'dbuser123';
$port = "3306";

$pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pw);


$result = $pdo->query("select R_ID, Bezeichnung from Raum");

foreach ($result as $row){
    echo $row["R_ID"] . " " . $row["Bezeichnung"];
    echo "<br>";
}


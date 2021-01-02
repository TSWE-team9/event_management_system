<?php
session_start();

// initializing variables
//$datum = $_SESSION["Beginn_final"];
//$dauer    = $_SESSION["Dauer_final"];
//$tanzahl = $_SESSION["Teilnehmerzahl"];
//$Rid = $_SESSION["R_ID"];
//$Rid = $_SESSION["R_ID"];

$datum = "2021-01-09";
$dauer    = 2;
$tanzahl = 20;
$Rid = 3;


// connect to the database
$db = mysqli_connect('132.231.36.109', 'dbuser', 'dbuser123', 'vms_db');


// REGISTER USER
if (isset($_POST['Hinzufügen'])) {
    // receive input values from form
    $titel = mysqli_real_escape_string($db, $_POST['Veranstaltungs-Titel']);
    $zeit = mysqli_real_escape_string($db, $_POST['Uhrzeit']);
    $zeitraum = mysqli_real_escape_string($db, $_POST['Zeitraum']);
    $tkosten = mysqli_real_escape_string($db, $_POST['Teilnahmekosten']);
    $art = mysqli_real_escape_string($db, $_POST['Auswahl']);
    $verfügbarkeit_v1 = mysqli_real_escape_string($db, $_POST['Verfügbarkeit']);
    $beschreibung = mysqli_real_escape_string($db, $_POST['Veranstaltungsbeschreibung']);

    if ($verfügbarkeit_v1 == "offen"){
        $verfügbarkeit = 1;
    } else {
        $verfügbarkeit = 2;
    }

    echo "<br>"."<br>"."<br>". $titel ."<br>". $beschreibung ."<br>". 48 ."<br>". 2 ."<br>". $art ."<br>". $verfügbarkeit ."<br>". 1 ."<br>".   $Rid ."<br>". $tanzahl ."<br>". 0 ."<br>". $datum ."<br>". $zeit ."<br>". $dauer ."<br>". $zeitraum ."<br>". $tkosten;

}

$query_v = "INSERT INTO Veranstaltung VALUES(Null, '$titel', '$beschreibung', 48, 2, '$art', $verfügbarkeit, 1, $Rid, $tanzahl, 0, '$datum', '$zeit', $dauer, $zeitraum, $tkosten)";
mysqli_query($db, $query_v);


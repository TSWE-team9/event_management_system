<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kapazitätscheck</title>
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


//if(isset($_POST["button"])){

    //Abspeichern der aus dem Formular übergebenen Daten
    //$beginn = $_POST["Veranstaltungsbeginn"];
    //$dauer = $_POST["Veranstaltungsdauer"];
    $beginn =  date("Y-m-d", strtotime('2020-12-22'));
    $ende = date("Y-m-d", strtotime('2020-12-23'));
    $dauer = 2;
    $teilnehmerzahl = 30;

    echo $beginn;
    echo $ende;


    //$teilnehmerzahl = $_POST["Teilnehmergrenze"];

    //Error Variable, Query Variable
    $error_occured = false;
    $query_status = "";

    //Überprüfung ob Regeln für Veranstaltungen eingehalten wurden (Dauer=max 7 Tage; Keine Veranstaltungen über Wochenende hinaus)
    //$unix_timestamp = strtotime($beginn);
    //$wochentag = date("w", '2020-12-22');
    $wochentag = "Tuesday";

    switch($wochentag) {
        case "Monday":
            if($dauer>7){
                $error_occured = true;
            }
            break;

        case "Tuesday":
            if($dauer>6){
                $error_occured = true;
            }
            break;

        case "Wednesday":
            if($dauer>5){
                $error_occured = true;
            }
            break;

        case "Thursday":
            if($dauer>4){
                $error_occured = true;
            }
            break;

        case "Friday":
            if($dauer>3){
                $error_occured = true;
            }
            break;

        case "Saturday":
            if($dauer>2){
                $error_occured = true;
            }
            break;

        case "Sunday":
            if($dauer>1){
                $error_occured = true;
            }
            break;
    }

    //Abfrage im Kalender, welche Räume zu den angegebenen Daten frei sind
    if($error_occured == false) {

    $query = "SELECT R.R_ID, R.Bezeichnung FROM Raum R
              WHERE R.Kapazitaet >= $teilnehmerzahl AND R.Status = 1
              AND NOT EXISTS(SELECT * FROM Kalender WHERE R.R_ID = Kalender.R_ID AND
                             Von <= '$beginn' AND '$beginn' <= Bis)

              AND NOT EXISTS(SELECT * FROM Kalender WHERE R.R_ID = Kalender.R_ID AND
                             Bis >= '$ende' AND '$ende' >= Von)";

    $res = $conn->query($query);

    if ($res->num_rows == 0) {
        $query_status = "Für den eingegebenen Zeitraum sind keine freien Räume verfügbar";
    } else {

        echo "<br>". "Folgende Räume sind im eingegebenen Zeitraum verfügbar:" . "<br>";
        echo"<br><br>";
        echo "<table border=\"1\">";
        echo "<th>R_ID</th><th>Bezeichnung</th>";
        while ($i = $res->fetch_row()) {
            echo "<tr>";
            foreach ($i as $item) {
                echo "<td>$item</td>";
            }
            echo "</tr>\n";
        }
        echo "</table>\n";
        echo"<br><br>";
    }
}





if($error_occured == true){
    echo "<br>" . "Fehler: Veranstaltungsdauer zu hoch bzw. Veranstaltung geht über Wochenende hinaus.";
}
else {
    echo "<br>" . $query_status;
}

?>

</body>
</html>

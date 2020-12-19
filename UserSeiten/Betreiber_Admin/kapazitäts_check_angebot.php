<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kapazitätscheck</title>
</head>

<body>

<?php
date_default_timezone_set('Europe/Berlin');

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

//Error Variable, Query Variable
$error_occured1 = false;
$error_occured2 = false;
$error = "";
$query_status = "";

if(isset($_POST["Kapazitätsprüfung"])) {

//Abspeichern der aus dem Formular übergebenen Daten
$angebot_id = $_POST["KapÜberprüfung"];

//Überprüfen, ob angegebene BeAr_ID existiert
$check_query = "SELECT BeAr_ID FROM Anfrage_Angebot WHERE BeAr_ID = $angebot_id";
if($conn->query($check_query)->num_rows == 0){
    $error_occured2 = true;
    $error = "Angegebene Angebots_ID existiert nicht";
}

//Abfrage und Speichern der Daten Beginn, Dauer und Teilnehmerzahl für die Anfrage
$data_query = "SELECT Beginn, Dauer, Teilnehmer_gepl, Beginn+Dauer-1 FROM Anfrage_Angebot WHERE BeAr_ID = $angebot_id";
$res = $conn->prepare($data_query);
$res->execute();
$res->bind_result($Beginn, $Dauer, $Teilnehmerzahl, $Ende);
$res->fetch();
$Beginn = date("Y-m-d", strtotime($Beginn));
$Ende = date("Y-m-d" , strtotime($Ende));
echo $Beginn;
echo "<br>";
echo $Ende;
echo $Dauer;
echo $Teilnehmerzahl;


$beginn = date("Y-m-d", strtotime('2020-12-22'));
//$ende = date("Y-m-d", strtotime('2020-12-23'));
//$dauer = 2;
//$teilnehmerzahl = 30;


//Überprüfung ob Regeln für Veranstaltungen eingehalten wurden (Dauer=max 7 Tage; Keine Veranstaltungen über Wochenende hinaus)
//$unix_timestamp = strtotime($beginn);
$wochentag = date("l", $beginn);
    echo $wochentag;

    switch ($wochentag) {
        case "Monday":
            if ($Dauer > 7) {
                $error_occured1 = true;
            }
            break;

        case "Tuesday":
            if ($Dauer > 6) {
                $error_occured1 = true;
            }
            break;

        case "Wednesday":
            if ($Dauer > 5) {
                $error_occured1 = true;
            }
            break;

        case "Thursday":
            if ($Dauer > 4) {
                $error_occured1 = true;
            }
            break;

        case "Friday":
            if ($Dauer > 3) {
                $error_occured1 = true;
            }
            break;

        case "Saturday":
            if ($Dauer > 2) {
                $error_occured1 = true;
            }
            break;

        case "Sunday":
            if ($Dauer > 1) {
                $error_occured1 = true;
            }
            break;
    }

//Abfrage im Kalender, welche Räume zu den angegebenen Daten frei sind
    if ($error_occured1 == false && $error_occured2 == false) {

        $query = "SELECT R.R_ID, R.Bezeichnung FROM Raum R
              WHERE R.Kapazitaet >= $Teilnehmerzahl AND R.Status = 1
              AND NOT EXISTS(SELECT * FROM Kalender WHERE R.R_ID = Kalender.R_ID AND
                             Von <= '$Beginn' AND '$Beginn' <= Bis)

              AND NOT EXISTS(SELECT * FROM Kalender WHERE R.R_ID = Kalender.R_ID AND
                             Bis >= '$Ende' AND '$Ende' >= Von)";

        $res = $conn->query($query);

        //if ($res->num_rows == 0) {
            //$query_status = "Für den eingegebenen Zeitraum sind keine freien Räume verfügbar";
        //} else {

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
    //}
}





if($error_occured1 == true){
    echo "<br>" . "Fehler: Veranstaltungsdauer zu hoch bzw. Veranstaltung geht über Wochenende hinaus.";
}
elseif($error_occured2 == true){
    echo "<br>" . $error;
}
else {
    echo "<br>" . $query_status;
}

?>

</body>
</html>

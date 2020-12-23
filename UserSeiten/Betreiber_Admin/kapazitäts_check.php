<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kapazitätscheck</title>
    <link rel="stylesheet" type="text/css" href="Raumformularstylesheet.css" media="screen" />
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

//Error Variablen, Query Variable
$error_occured1 = false;
$error_occured2 = false;
$error1 = "";
$error2 = "";
$query_status = "";

//Session Variablen:

//Speichert die verfügbaren Räume und ihre IDs in einem Array
$_SESSION["R_ID_Array"] = array();
//Platzhalter für das finale Datum von Beginn bei der Reservierung
$_SESSION["Beginn_final"] = '0000-00-00';
//Platzhalter für den finalen Angebotsstatus (Default: 2 ("bearbeitet"))
$_SESSION["Angebotsstatus_final"] = 2;

//Variablen für Kapazitätsprüfung definieren
$Beginn = "";

//Abspeichern der Daten aus dem Formular für Prüfung über Anfrage/Angebots_ID
if(isset($_POST["Kapazitätsprüfung1"])) {

//Abspeichern der aus dem Formular übergebenen Daten / Setzen von Session Variablen
    $angebot_id = $_POST["KapÜberprüfung"];
    $_SESSION["BeAr_ID"] = $angebot_id;
    $_SESSION["Prüfungsart"] = 1;

//Überprüfen, ob angegebene BeAr_ID existiert und prüfen, ob Status "angefragt" ist (1)
    $check_query = "SELECT BeAr_ID FROM Anfrage_Angebot WHERE BeAr_ID = $angebot_id AND Status = 1";
    if ($conn->query($check_query)->num_rows == 0) {
        $error_occured2 = true;
        $error2 = "Angegebene Angebots_ID existiert nicht oder das Angebot wurde bereits angenommen/abgelehnt";
    }

//Abfrage und Speichern der Daten Beginn, Dauer und Teilnehmerzahl für die Anfrage
    $data_query = "SELECT Beginn, Teilnehmer_gepl, Dauer FROM Anfrage_Angebot WHERE BeAr_ID = $angebot_id";
    $res = $conn->prepare($data_query);
    $res->execute();
    $res->bind_result($Beginn, $_SESSION["Teilnehmerzahl"], $_SESSION["Dauer_final"]);
    $res->fetch();
    $res->close();
}

//Abspeichern der Daten aus dem Formular für erneute Prüfung mit anderem Datum
if(isset($_POST["Kapazitätsprüfung2"])) {

    $Beginn = $_POST["Startdatum"];

    //Betreiber hat ursprüngliche Angaben des Veranstalters geändert
    if($_SESSION["Prüfungsart"] == 1){
        $_SESSION["Angebotsstatus_final"] = 3;
    }

}

//Abspeichern der Daten aus dem Formular für interne Veranstaltungen
if(isset($_POST["Kapazitätsprüfung3"])) {

    $Beginn = $_POST["Startdatum"];
    $_SESSION["Dauer_final"] = $_POST["Dauer"];
    $_SESSION["Teilnehmerzahl"] = $_POST["Teilnehmerzahl"];

    //Session Variable setzen
    $_SESSION["Prüfungsart"] = 2;
}

/*$today = date("Y-m-d");
echo $today;

//Prüfung, ob Datum 4 Wochen in Zukunft liegt und Enddatum hinter Startdatum liegt
if($Beginn <= $today + 28){
    $error_occured1 = true;
    $error = "Das Datum liegt nicht 4 Wochen in der Zukunft!";
}*/


//$beginn = date("Y-m-d", strtotime('2020-12-22'));
//$ende = date("Y-m-d", strtotime('2020-12-23'));
//$dauer = 2;
//$teilnehmerzahl = 30;


    /*Überprüfung ob Regeln für Veranstaltungen eingehalten wurden (Dauer=max 7 Tage; Keine Veranstaltungen über Wochenende hinaus)
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
        }*/


//Abfrage im Kalender, welche Räume zu den angegebenen Daten frei sind
    if ($error_occured1 == false && $error_occured2 == false) {

        $teilnehmerzahl = $_SESSION["Teilnehmerzahl"];
        $Dauer = $_SESSION["Dauer_final"];
        $query = "SELECT R.R_ID, R.Bezeichnung FROM Raum R
              WHERE R.Kapazitaet >= $teilnehmerzahl AND R.Status = 1
              AND NOT EXISTS(SELECT * FROM Kalender WHERE R.R_ID = Kalender.R_ID AND
                             Von <= '$Beginn' AND '$Beginn' <= Bis)

              AND NOT EXISTS(SELECT * FROM Kalender WHERE R.R_ID = Kalender.R_ID AND
                             Bis >= DATE_ADD('$Beginn', INTERVAL $Dauer-1 DAY) AND DATE_ADD('$Beginn', INTERVAL $Dauer-1 DAY) >= Von)";

        $res2 = $conn->query($query);

        if ($res2->num_rows == 0) {
            $query_status = "Für den eingegebenen Zeitraum sind keine freien Räume verfügbar";
            //Weiterleitung zu Formular V2"
            echo "<a href='KapazitätenabfrageV2.php'>Erneute Überprüfung mit anderen Daten</a>";

        } else {

            //Abspeichern der finalen Daten für Beginn und Ende
            $_SESSION["Beginn_final"] = $Beginn;

            //Ausgabe der verfügbaren Räume in einer Tabelle
            echo "<br>". "Folgende Räume sind im eingegebenen Zeitraum verfügbar:" . "<br>";
            echo"<br><br>";
            echo "<table border=\"1\">";
            echo "<th>R_ID</th><th>Bezeichnung</th>";
            while ($i = $res2->fetch_row()) {
                if($i[0]){
                    array_push($_SESSION["R_ID_Array"], $i[0]);
                }
                echo "<tr>";
                foreach ($i as $item) {
                    echo "<td>$item</td>";
                }
                echo "</tr>\n";
                }
            }
            echo "</table>\n";
            echo"<br><br>";


            //Reservierungsformular muss hier erscheinen
            echo "<a href='Raumreservierung.php'>Reservierungsformular</a>";



    }

if($error_occured1 == true){
    echo "<br>" . $error1;
}
elseif($error_occured2 == true){
    echo "<br>" . $error2;
}
else {
    echo "<br>" . $query_status;
}

?>

</body>
</html>

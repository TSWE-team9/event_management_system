<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raumdaten ändern</title>
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

//Ausgabe der existierenden Räume in einer Tabelle
$räume_query = "SELECT R_ID, Bezeichnung, Kapazitaet, Groesse, Preis, Status FROM Raum";
$result = $conn->query($räume_query);

if($result->num_rows >0){
    echo "<table border=\"1\">";
    echo "<th>R_ID</th><th>Bezeichnung</th><th>Kapazität</th><th>Größe</th><th>Preis</th><th>Status</th>";
    while($i = $result->fetch_row()){
        echo "<tr>";
        foreach ($i as $item){
            echo "<td>$item</td>";
        }
        echo "</tr>\n";
    }
    echo "</table>\n";
}

?>

<br>
<br>
<form>
    Hier kommt das Formular hin!!!
</form>



<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {

//Error Variable (zunächst false)
    $error = false;

//Abspeichern der zu ändernden Daten (man muss was eingeben? -> wäre einfacher)
    $R_ID = $_POST[""];
    $bezeichnung = $_POST[""];
    $kapazitaet = $_POST[""];
    $groesse = $_POST[""];
    $preis = number_format((float)$_POST["Preis"], 2, '.', '');
    $status = $_POST[""];

//Abfrage, ob Raum ID des zu ändernden Raums existiert
    $check_query = "SELECT R_ID FROM Raum WHERE R_ID = $R_ID";
    $res1 = $conn->query($check_query);

    if ($res1->num_rows == 0) {
        echo "Fehler: Angegebene Raum_ID existiert nicht";
        echo "<br>";
        $error = true;
    }

//Abfrage, ob durch die Änderung der Kapazität des Raumes Veranstaltungen (auch bearbeitete Angebote?) existieren,
//deren Teilnehmerzahl dann zu groß geworden ist ->trotzdem ändern lassen?? lt. Pflichtenheft ja aber das ist kompliziert
    $check_query2 = "SELECT V_ID, Titel, Veranstalter, Teilnehmer_max, Beginn FROM Veranstaltung WHERE Status = 1 AND Teilnehmer_max > $kapazitaet
                     UNION
                     SELECT BeAr_ID, 'Angebot bearbeitet', Veranstalter, Teilnehmer_gepl, Beginn FROM Anfrage_Angebot WHERE Status = 2 AND Teilnehmer_gepl > $kapazitaet";
    $res2 = $conn->query($check_query2);

    if($res2->num_rows > 0){
        echo "Es existieren folgende Veranstaltungen und Angebote, die durch die Änderung der Kapazität betroffen sind:";
        echo "<br>";

        echo "<table border=\"1\">";
        echo "<th>V_ID / Angebot_ID</th><th>Titel</th><th>Veranstalter ID</th><th>Max. Teilnehmerzahl</th><th>Beginn</th>";
        while($i = $res2->fetch_row()){
            echo "<tr>";
            foreach ($i as $item){
                echo "<td>$item</td>";
            }
            echo "</tr>\n";
        }
        echo "</table>\n";
    }


//Abfrage um bereits existierende Bezeichnung zu finden
    $check_query = "SELECT R_ID FROM Raum WHERE Bezeichnung = '$bezeichnung'";
    $res3 = $conn->query($check_query);

    if ($res3->num_rows > 0) {
        echo "Fehler: Raumbezeichnung existiert bereits.";
        echo "<br>";
        $error = true;
    }

//Sonderzeichen Check
    $check_sonderzeichen = preg_match('/^[-a-zA-ZÄÖÜäöüß0-9[:space:]]+$/', $bezeichnung);

    if ($check_sonderzeichen == 0) {
        echo "Fehler: Es dürfen nur Buchstaben, Zahlen und Bindestriche eingegeben werden!";
        echo "<br>";
        $error = true;
    }


//Update Befehl und Überprüfung (nur wenn kein Fehler), ob es funktioniert hat (evtl Ausgabe)
    if($error == false) {


        $update_query = "UPDATE Raum SET Bezeichnung = '$bezeichnung', Kapazitaet = $kapazitaet, Groesse = $groesse, Preis = $preis, Status = $status
                     WHERE R_ID = $R_ID";

        if ($conn->query($update_query) === TRUE) {
            echo "Die Raumdaten wurden erfolgreich geändert.";

        } else {
            echo "Es ist ein Fehler beim Einfügen in die Datenbank aufgetreten.";
            $conn->error;
            $error = true;
            echo "<br>";
        }
    }

}

?>

</body>
</html>

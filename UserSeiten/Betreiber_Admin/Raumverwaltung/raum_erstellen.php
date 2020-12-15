<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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

$error = false;
if($_SERVER["REQUEST_METHOD"] == "POST") {

    //Zuweisung der im Formular eingegebenen Daten
    $bezeichnung = $_POST["Raumbezeichnung"];
    $kapazitaet = $_POST["RaumKapazität"];
    $groesse = $_POST["RaumGröße"];
    $preis = number_format((float)$_POST["Preis"], 2, '.', '');
    $status = $_POST["Status"];


    //Abfrage um bereits existierende Bezeichnung zu finden
    $check_query = "SELECT R_ID FROM Raum WHERE Bezeichnung = '$bezeichnung'";
    $res = $conn->query($check_query);

    //Erlaubte Zeichen bei Bezeichnung prüfen
    $check_sonderzeichen = preg_match('/^[-a-zA-ZÄÖÜäöüß0-9[:space:]]+$/', $bezeichnung);

    if($check_sonderzeichen == 0){
        echo "Fehler: Es dürfen nur Buchstaben, Zahlen und Bindestriche eingegeben werden!";
        echo "<br>";
        $error = true;
    }

    elseif($res->num_rows > 0){
        echo "Fehler: Raumbezeichnung existiert bereits.";
        echo "<br>";
        $error = true;
    }

    //Wenn alles passt, dann wird der Raum hinzugefügt
    else {

    $insert_query = "INSERT INTO Raum VALUES (R_ID, '$bezeichnung', $kapazitaet, $groesse, $preis, $status)";

        if($conn->query($insert_query) === TRUE){
        echo "Der Raum wurde erfolgreich hinzugefügt.";

        }
        else {
        echo "Es ist ein Fehler beim Einfügen in die Datenbank aufgetreten.";
        $conn->error;
        $error = true;
        echo "<br>";
        }

    }
}
else{
    echo "Es ist ein Fehler beim Formular aufgetreten";
    $error = true;
}
$conn->close();

if($error == true){
    echo "<br>";
    echo "Bitte kehren Sie zurück zum Formular";
}
else{
    echo "<br>";
    echo "Kehren Sie zurück zur Raumverwaltung";
}


?>
<br>
<a href="StartseiteBetreiber.html">Zurück zur Startseite</a>
<br>
<a href="Raumformular.html">Zurück zum Formular</a>

</body>
</html>


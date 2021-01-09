<?php
session_start();

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

$status = "";
$error = false;

if(isset($_POST["Name des Buttons"])){

    //Abspeichern der angegebenen Daten
    $email = $_POST["email"];
    $passwort = $_POST["passwort"];
    $passwort = md5($passwort);
    $Geburtsdatum = $_POST["geburtsdatum"];
    $Rolle = $_POST["rolle"];

    //Default Daten für Betreiber
    $firma = "VMS Grup9";
    $strasse = "Innstrasse";
    $Haus_nr = 1;
    $PLZ = "94032";
    $Ort = "Passau";
    $Land = "Deutschland";

    //Überprüfung ob Email bereits vorhanden
    $check_query = "SELECT B_ID FROM Benutzerkonto WHERE E_mail = '$email'";
    $check = $conn->query($check_query);
    if($check->num_rows > 0){
        $status = "Unter dieser E-Mail ist bereits ein Account registriert!";
        $error = true;
    }

    //Insert Statements
    if($error == false) {

        $query = "INSERT INTO Benutzerkonto VALUES (B_ID, '$passwort', $Rolle, '$email', '$Geburtsdatum', 1)";
        $query2 = "INSERT INTO Betreiberkonto VALUES ((SELECT B_ID FROM Benutzerkonto WHERE E_mail = '$email'), '$firma', '$strasse', $Haus_nr, $PLZ, '$Ort', '$Land')";

        $res = $conn->query($query);
        if ($res === TRUE) {
            $res2 = $conn->query($query2);
            if ($res2 === TRUE) {
                $status = "Betreiberaccount erfolgreich erstellt";
            } else {
                $status = "Es ist ein Fehler aufgetreten";
            }
        } else {
            $status = "Es ist ein Fehler aufgetreten";
        }
    }

    //TODO Ausgabe der Statusmeldung

}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Landing Page</title>
    <meta charset="utf-8"/>
</head>
<body>

<!--TODO Formular mit Email, Geburtsdatum (+check), Passwort und Auswahl der Rolle (Admin (4) oder Betreiber (3))-->

</body>

</html>

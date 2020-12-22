<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raumreservierung</title>
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

//Variablen
$status = false;
$query_status = "";
$error = "";

//Abspeichern der ID des ausgewählten Raumes
if(isset($_SERVER["Name des Buttons"])){

    $R_ID = $_POST["Name des Felds?"];
    $status = true;

} else{
    $error = "Es ist ein Fehler beim Empfang der Daten aus dem Formular aufgetreten";
}

//Reservierungs/Belegungsvorgang nur wenn auch eine R_ID empfangen wurde
if($status){

    //Reservierung eines Raumes für eine Anfrage
    if($_SESSION["Prüfungsart"] == 1){
        echo "Reservierung";

        //Abspeichern der nötigen Daten für den INSERT in den Kalender
        $Beginn = $_SESSION["Beginn_final"];
        $Ende = $_SESSION["Ende_final"];
        $BeAr_ID = $_SESSION["BeAr_ID"];
        $R_status = 2;


        //Insert in den Kalender
        $insert_query = "INSERT INTO Kalender VALUES ('$Beginn', '$Ende', $R_ID, $R_status, NULL, $BeAr_ID)";
        $res = $conn->query($insert_query);
        if($res === TRUE){
            $query_status = "Reservierung von Raum " . $R_ID . " war erfolgreich. ";
            echo $query_status;

            //TODO Weiterleitung zu Angebot_erstellen.php

        }
        else{
            $query_status = "Es ist ein Fehler beim Eintragen in den Kalender aufgetreten";
            echo $query_status;
        }


    }

    //Belegung eines Raumes bei der Erstellung einer internen Veranstaltung
    elseif($_SESSION["Prüfungsart"] == 2){
        echo "Belegung";

        //Abspeichern der nötigen Daten für den INSERT in den Kalender
        $Beginn = $_SESSION["Beginn_final"];
        $Ende = $_SESSION["Ende_final"];
        $R_status = 1;

        //Insert
        $insert_query = "INSERT INTO Kalender VALUES ('$Beginn', '$Ende', $R_ID, $R_status, NULL, NULL)";
        $res = $conn->query($insert_query);
        if($res === TRUE){
            $query_status = "Belegung von Raum " . $R_ID . " war erfolgreich.";
            echo $query_status;

            //TODO Hier dann Weiterleitung zum Erstellen der Veranstaltung
        }
        else{
            $query_status = "Es ist ein Fehler beim Eintragen in den Kalender aufgetreten";
            echo $query_status;
        }
    }

    else{
        $query_status = "Die Datenbankabfrage konnte nicht durchgeführt werden, da ein Session Fehler aufgetreten ist";
    }
}

//Ausgabe möglicher Errors
echo $error;
?>

</body>

<!---Hier kommt das Formular hin, in dem ausgewählt wird, welcher der verfügbaren Räume reserviert bzw. belegt werden soll--->

</html>

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

$Bid = $_SESSION['b_id'];
$Vid = $_SESSION['V_id'];
$errors_anmeldung = array();
$current_date = date("Y-m-d");


$query = "SELECT Verfügbarkeit,Status,Teilnehmer_max,Teilnehmer_akt,Beginn,Frist FROM Veranstaltung WHERE V_ID = $Vid";
$res = $conn->prepare($query);
$res->execute();
$res->bind_result($verfügbarkeit, $status, $Tmax, $Takt, $beginn, $frist);
$res->fetch();
$res->close();


$datetime1 = strtotime($beginn);
$datetime2 = strtotime($current_date);

$secs = $datetime1 - $datetime2;// == <seconds between the two times>
$days = $secs / 86400;

if (isset($_POST['anmelden'])) {

    if($verfügbarkeit == 2){
        array_push($errors_anmeldung, "Geschlossene Veranstaltung!");
    }
    if($status == 2){
        array_push($errors_anmeldung, "Veranstaltung hat bereits begonnen!");
    }
    if($status == 3){
        array_push($errors_anmeldung, "Veranstaltung ist abgelaufen!");
    }
    if($status == 4){
        array_push($errors_anmeldung, "Veranstaltung wurde storniert!");
    }
    if(($Tmax-$Takt)==0){
        array_push($errors_anmeldung, "Keine freien Plätze verfügbar");
    }
    if($days < $frist){
        array_push($errors_anmeldung, "Anmeldefrist abgelaufen!");
    }


    if (count($errors_anmeldung) == 0) {

        $query_v = "INSERT INTO Teilnehmerliste_offen
  			  VALUES('$Vid','$Bid',current_date,'anmelden','anmelden')";
        mysqli_query($conn, $query_v);
        array_push($errors_anmeldung, "'$Vid','$Bid',current_date,'anmelden','anmelden'");
        //TODO: Sessionvariable für Vor/Nachname festlegen
    }
}

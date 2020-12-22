<?php
session_start();

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

$query = "SELECT Haus_nr FROM Teilnehmerkonto WHERE B_ID = 5";
$res = $conn->prepare($query);
$res->execute();
$res->bind_result($Hausnr);
$res->fetch();
$res->close();

echo $Hausnr;



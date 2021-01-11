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

$query = "SELECT V_ID FROM Veranstaltung WHERE Status = 3";
$res = $conn->prepare($query);
$res->execute();
$res->bind_result($V_ID);
while ($res->fetch()){
    echo $V_ID;
}
$res->close();



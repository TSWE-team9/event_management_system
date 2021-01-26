<?php

$host = '132.231.36.109';
$db = 'vms_db';
$user = 'dbuser';
$pw = 'dbuser123';

$conn = new mysqli($host, $user, $pw, $db,3306);

$_SESSION["R_Array"] = array();
$data_query = "SELECT Bezeichnung FROM Raum";
$res = $conn->query($data_query);

while ($i = $res->fetch_row()) {
    array_push($_SESSION["R_Array"], $i[0]);
}

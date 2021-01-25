<?php

$host = '132.231.36.109';
$db = 'vms_db';
$user = 'dbuser';
$pw = 'dbuser123';

$conn = new mysqli($host, $user, $pw, $db,3306);

$_SESSION["V_Array"] = array();
$_SESSION["F_Array"] = array();
$data_query = "SELECT B_ID,Firma FROM Veranstalterkonto";
$res = $conn->query($data_query);

while ($i = $res->fetch_row()) {
        array_push($_SESSION["V_Array"], $i[0]);
    array_push($_SESSION["F_Array"], $i[1]);
    }


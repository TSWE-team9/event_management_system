<?php

$host = '132.231.36.109';
$db = 'test_vms';
$user = 'dbuser';
$pw = 'dbuser123';

$conn = new mysqli($host, $user, $pw, $db,3306);

$_SESSION["V_Array"] = array();
$data_query = "SELECT Firma FROM Veranstalterkonto";
$res = $conn->query($data_query);

while ($i = $res->fetch_row()) {
        array_push($_SESSION["V_Array"], $i[0]);
    }
// REGISTER USER
if (isset($_POST['Hinzufügen'])) {
    $_SESSION["Veranstalter1"] = $_POST['Auswahl'];
    $_SESSION["Beginn1"] = $_POST['Startzeitraum'];
    $_SESSION["Ende1"] = $_POST['Endzeitraum'];

    echo "<br><br>"."test";
    header("Seminarstatistik.php");

}
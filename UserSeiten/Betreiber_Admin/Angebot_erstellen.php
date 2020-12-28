<?php
session_start();
?>

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

//Abspeichern der nötigen Daten für das UPDATE in Anfrage_Angebot
$BeAr_ID = $_SESSION["BeAr_ID"];
$R_ID = $_SESSION["R_ID"];
$Angebotsstatus = $_SESSION["Angebotsstatus_final"];
$Beginn = $_SESSION["Beginn_final"];



//Preis für den gewählten Raum berechnen
$query = "SELECT Preis FROM Raum WHERE R_ID = $R_ID";
$res = $conn->prepare($query);
$res->execute();
$res->bind_result($Angebotspreis);
$res->fetch();
$res->close();

//Raum in der Anfrage_Angebot abspeichern und Angebot fertigstellen
$update_query = "UPDATE Anfrage_Angebot SET R_ID = $R_ID, Beginn = '$Beginn', Status = $Angebotsstatus, Angebotsdatum = LOCALTIMESTAMP, Angebotspreis = $Angebotspreis*Dauer
                WHERE BeAr_ID = $BeAr_ID";

$res = $conn->query($update_query);
if($res === FALSE){
    $error = "Fehler: Datenbank UPDATE in Anfrage hat nicht funktioniert.";
}else {
    echo "Das Angebot für Raum ". $R_ID . " zum Preis von " . $Angebotspreis . " wurde erfolgreich erstellt.";}






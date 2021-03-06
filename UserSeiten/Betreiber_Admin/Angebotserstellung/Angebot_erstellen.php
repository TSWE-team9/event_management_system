<?php
session_start();
include "../../send_email.php";
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Raumreservierung</title>
        <link rel="stylesheet" type="text/css" href="../style/Formular.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../style/header.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../style/Fehlermeldung.css" media="screen" />
        <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
    </head>

    <body>
    <?php include '../Header/header.php'; ?>
    <script>document.getElementById("Reiter_Angebotserstellung").classList.add("active");  </script>
    </body>
</html>

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



//Preis für den gewählten Raum abfragen
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

//Fehlerfall der nicht eintreten sollte
if($res === FALSE){
    $error = " Datenbank UPDATE in Anfrage hat nicht funktioniert.";
    echo "<div class='overlay'>" ;
    echo  "<div class='popup'>";
    echo "<h2>Fehler</h2>" ;
    echo "<a class='close' href='Angebot_erstellen.php'> &times;</a>" ;
    echo "<div class='content' >"  .$error."</div>";
    echo "</div>" ;
    echo "</div>" ;
}

else {

    //Veranstalter_ID abfragen
    $query = "SELECT Veranstalter FROM Anfrage_Angebot WHERE BeAr_ID = $BeAr_ID";
    $res = $conn->prepare($query);
    $res->execute();
    $res->bind_result($B_ID);
    $res->fetch();
    $res->close();

    //E-Mail an Veranstalter senden
    $empfaenger = get_mail_address($B_ID);
    $betreff = "Neues Angebot für Ihre Anfrage";
    $nachricht = "Für Ihre Anfrage einer Veranstaltung am ". $Beginn." haben wir ein Angebot erstellt.
    Sie können sich dieses im Reiter Meine Veranstaltungen auf der VMS Seite anzeigen lassen.
    Das Angebot ist 7 Tage lang gültig und wird danach gelöscht.
    Ihr VMS Team";

    send_email($empfaenger, $betreff, $nachricht);

    //Bestätigungsmeldung ausgeben
    echo "<div class='overlay'>" ;
    echo  "<div class='popup'>";
    echo "<h2>Bestätigung</h2>" ;
    echo "<a class='close' href='Angebotserstellung.php'> &times;</a>" ;
    echo "<div class='content' >" ,  'Das Angebot für Raum '. $R_ID . ' wurde erfolgreich erstellt.' ,"</div>";
    echo "</div>" ;
    echo "</div>" ;


}





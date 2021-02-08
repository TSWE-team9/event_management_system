<?php
session_start();
include "../../../send_email.php";
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../../../CSS/Startseite.css" media="screen" />
        <link rel="stylesheet" href="../../../CSS/popup.css">
        <title>Angebot</title>
    </head>
    <body class="background3">
    </body>
    </html>
<?php

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

//Ändern des alten Angebots
if(isset($_POST["angebot_aendern"])) {

    //Abspeichern der BeAr_ID des abgelehnten alten Angebots
    $Angebot_ID = $_POST["angebot_id"];

    //Update Query des alten Angebots (Ablehnen)
    $query1 = "UPDATE Anfrage_Angebot SET Status = 5, R_ID = NULL WHERE BeAr_ID = $Angebot_ID";
    $res1 = $conn->query($query1);

    //Delete Query des reservierten alten Angebots im Kalender
    $query2 = "DELETE FROM Kalender WHERE B_ID = $Angebot_ID";
    $res2 = $conn->query($query2);

    //Abspeichern des neuen Startdatums
    $Beginn_neu = $_POST["new_date"];


//Erstellung eines neuen Angebots

//Abspeichern der B_ID des Veranstalters in einer lokalen Variable
    $veranstalter_id = $_SESSION["b_id"];

//Abfrage der notwendigen Daten des alten Angebots
    $query3 = "SELECT Teilnehmer_gepl, Dauer, Anmerkung FROM Anfrage_Angebot WHERE BeAr_ID = $Angebot_ID";
    $res3 = $conn->prepare($query3);
    $res3->execute();
    $res3->bind_result($Teilnehmer, $Dauer, $Anmerk);
    $res3->fetch();
    $res3->close();

//Einfügen der alten sowie neuen Daten in die DB
    $query4 = "INSERT INTO Anfrage_Angebot VALUES (BeAr_ID, NULL, $veranstalter_id, $Teilnehmer, '$Beginn_neu', $Dauer, 1, LOCALTIMESTAMP, NULL, NULL, '$Anmerk', NULL)"; // beim ersten NULL wird kein Datum mit übergeben

    $res4 = $conn->query($query4);
    if ($res4 === TRUE) {
        $query_status = "Die Anfrage wurde erfolgreich erstellt und wird nun vom Betreiber bearbeitet. Sie bekommen eine Bestätigungsmail zugeschickt.";

        //Versenden einer Bestätigungsmail an den Veranstalter
        $empfaenger = get_mail_address($veranstalter_id);
        $betreff = "Anfrage für Ihre Veranstaltung erhalten";
        $nachricht = "Danke für Ihr Interesse an unserem Veranstaltungshaus. Wir werden Ihre Anfrage bearbeiten und melden uns möglichst schnell bei Ihnen per Mail zurück.";
        send_email($empfaenger, $betreff, $nachricht);

        //Ausgabe einer Bestätigungsmeldung
        echo
            '<div class="overlay">
                <div class="popup">
                    <h2 class="hdln">Angebot geändert</h2>
                    <a class="close" href="../VeranstalterVeranstaltungen.php">&times;</a>
                    <div class="content">Ihre Anfrage wurde erfolgreich versendet.</div>
                </div>
            </div>';
    }

    if ($res1 === FALSE) {
        echo "Es ist ein Fehler bei der Update Query aufgetreten";
    } elseif ($res2 === FALSE) {
        echo "Es ist ein Fehler bei der Delete Query aufgetreten";
    } elseif ($res4 === FALSE) {
        echo "Beim Erstellen der neuen Anfrage ist ein Fehler aufgetreten";
    }
}
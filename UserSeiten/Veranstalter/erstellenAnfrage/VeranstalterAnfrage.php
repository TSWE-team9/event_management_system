<?php
session_start();
include "../../send_email.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="VeranstalterAnfrage.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/Fehlermeldung.css">
    <title>Anfrage erstellen</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>

<?php

//Verbindung zur DB herstellen
$host = '132.231.36.109';
$db = 'vms_db';
$user = 'dbuser';
$pw = 'dbuser123';

$conn = new mysqli($host, $user, $pw, $db,3306);

if($conn->connect_error){
    die('Connect Error (' . $conn->connect_errno . ') '
        . $conn->connect_error);
}

//Error Variable und Query Status
$error = false;
$query_status = "";

//Daten aus Formular abspeichern
if(isset($_POST["anfrage"])){

    $teilnehmerzahl = $_POST["teilnehmerzahl"];
    $beginn = $_POST["date"];
    $dauer = $_POST["dauer"];
    $anmerkungen = $_POST["anmerkungen"];

    //Abspeichern der B_ID des Veranstalters in einer lokalen Variable
    $veranstalter_id = $_SESSION["b_id"];


//Insert Query für das Anlegen in der DB
if($error == false) {

    $query = "INSERT INTO Anfrage_Angebot VALUES (BeAr_ID, NULL, $veranstalter_id, $teilnehmerzahl, '$beginn', $dauer, 1, NULL, NULL, NULL, '$anmerkungen', NULL)";

    $res = $conn->query($query);
    if ($res === TRUE) {
        $query_status = "Die Anfrage wurde erfolgreich erstellt und wird nun vom Betreiber bearbeitet.";
        //Versenden einer Bestätigungsmail an den Veranstalter
        $empfaenger = get_mail_address($veranstalter_id);
        $betreff = "Anfrage für Ihre Veranstaltung erhalten";
        $nachricht = "Danke für Ihr Interesse an unserem Veranstaltungshaus. Wir werden Ihre Anfrage bearbeiten und melden uns möglichst schnell bei Ihnen per Mail zurück.";
        send_email($empfaenger, $betreff, $nachricht);

        //Ausgabe des Status der Abfrage
        echo "<div class='overlay'>" ;
        echo  "<div class='popup'>";
        echo "<h2>Bestätigung</h2>" ;
        echo "<a class='close' href='VeranstalterAnfrage.php'>&times;</a>" ;
        echo "<div class='content'>"  .$query_status. "</div>";
        echo "</div>" ;
        echo "</div>" ;

    } else {
        $query_status = "Beim Erstellen der Anfrage ist ein Fehler aufgetreten";
        echo "<div class='overlay'>" ;
        echo  "<div class='popup'>";
        echo "<h2>Fehler</h2>" ;
        echo "<a class='close' href='VeranstalterAnfrage.php'>&times;</a>" ;
        echo "<div class='content'>"  .$query_status. "</div>";
        echo "</div>" ;
        echo "</div>" ;
    }
}
}


?>


<nav>
    <ul>
        <li><a href="../Startseite/VeranstalterStartseite.php">Startseite</a></li>
        <li><a class="active" href="VeranstalterAnfrage.php">Angebot einholen</a></li>
        <li><a href="#">Kontakt</a></li>
        <li><a href="#">Hilfe</a></li>
        <li><a href="../eigeneVeranstaltungen/VeranstalterVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li style="float: right;"> <a href="../../logout.php"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li style="float: right;"> <a href="../Datenänderung/VeranstalterDatenänderung.php"> <i class="fas fa-user-circle"></i> </a></li>

    </ul>
</nav>

<h1 style="text-align: center;, margin-top: 50px;">Anfrageformular für Veranstaltung</h1>
<p>Beschreibung Formular</p>

<!-- Anfrageformular -->
<div class="container">
    <form action="VeranstalterAnfrage.php" method="post">
        <div class="row">
            <div class="col-25">
                <label for="teilnehmerzahl">Teilnehmerzahl</label>
            </div>
            <div class="col-75">
                <input type="number" placeholder="geplante Teilnehmerzahl" name="teilnehmerzahl" min="1" max="10000" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="beginn">Veranstaltungsbeginn</label>
            </div>
            <div class="col-75">
                <input type="date" name="date" id="min_date" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="dauer">Veranstaltungsdauer</label>
            </div>
            <div class="col-75">
                <input onclick="setDays()" type="number" name="dauer" min="1" max="1" id="max_days" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="anmerkungen">Anmerkungen</label>
            </div>
            <div class="col-75">
                <textarea name="anmerkungen" id="subject" placeholder="Anmerkungen" cols="30" rows="10" maxlength="300"></textarea>
            </div>
        </div>
        <div class="row">
            <button class="btnanfrage" onmouseover="setDays()" type="submit" name="anfrage">Anfrage abschicken</button>
        </div>
    </form>
</div>

<script src="VeranstalterAnfrage.js"></script>
</body>
</html>
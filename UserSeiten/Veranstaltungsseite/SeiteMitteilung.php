<?php
session_start();
include "../send_email.php";

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

//Abspeichern der V_ID nach Buttonklick von der Veranstaltungsseite
if(isset($_POST["mitteilung"])){
    $_SESSION["V_ID"] = $_POST["veranstaltung_id"];
}

$V_ID = $_SESSION["V_ID"];

//Abfragen des Titels der Veranstaltung
$query = "SELECT Titel FROM Veranstaltung WHERE V_ID = $V_ID";
$res = $conn->prepare($query);
$res->execute();
$res->bind_result($titel);
$res->fetch();
$res->close();

//Abspeichern der Daten aus dem Mitteilungsformular, Versenden der Mitteilung
if(isset($_POST["mitteilung_senden"])){
    $V_ID = $_POST["v_id"];
    $nachricht = $_POST["nachricht"];


    //Angemeldete Teilnehmer per Mail benachrichtigen (nur offene Veranstaltungen)
    $query = "SELECT B_ID FROM Teilnehmerliste_offen WHERE V_ID = $V_ID";
    $res = $conn->query($query);
    if($res->num_rows > 0){

        $betreff = "Mitteilung vom Veranstalter der Veranstaltung: " . $titel;

        while($i = $res->fetch_row()){
            $empfaenger = get_mail_address($i[0]);
            send_email($empfaenger, $betreff, $nachricht);
        }
    }

    //TODO Fehlermeldung ausgeben
    else {
        echo "Fehler: Es wurden keine Nachrichten verschickt (Keine Teilnehmer bzw. Fehler bei der Abfrage)";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../CSS/modal.css">
    <link rel="stylesheet" type="text/css" href="../CSS/listen.css">
    <link rel="stylesheet" type="text/css" href="../CSS/veranstaltungen.css">
    <title>Veranstaltung</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body class="background2">
<nav>
    <ul>
        <li><a href="../Veranstalter/Startseite/VeranstalterStartseite.php">Startseite</a></li>
        <li><a href="../Veranstalter/erstellenAnfrage/VeranstalterAnfrage.php">Angebot einholen</a></li>
        <li><a href="#">Kontakt</a></li>
        <li><a href="#">Hilfe</a></li>
        <li><a class="active" href="../Veranstalter/eigeneVeranstaltungen/VeranstalterVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li style="float: right;"> <a href="../logout.php"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li style="float: right;"> <a href="../Veranstalter/Datenänderung/VeranstalterDatenänderung.php"> <i class="fas fa-user-circle"></i> </a></li>
    </ul>
</nav>

<div class="container-50-outer">
    <h1 class="hdln"><?php echo $titel; ?></h1>
    <p class="txt">Beschreibung</p>

    <form action="SeiteMitteilung.php" method="post">
        <textarea name="nachricht" placeholder="Schreiben Sie hier den Inhalt ihrer Mitteilung" cols="30" rows="10" maxlength="300" required></textarea>
        
        <!--Button um die Mitteilungsversendung zu bestätigen-->
        <button class="btn" style="float: right;" type="button" name ="mitteilung_senden" onclick="document.getElementById('id01').style.display='block'">Mitteilung versenden</button>
        <!--Modal wenn Veranstalter auf Ablehnen klickt-->
        <div id="id01" class="modal">
            <div class="modal_content">
                <div class="modal_container">
                    <h1>Mitteilung versenden</h1>
                    <p>Wollen Sie diese Mitteilung an alle Teilnemer der Veranstaltung versenden?</p>
                    <div class="modal_clearfix">
                        <input type="hidden" name="v_id" value="<?php echo $V_ID; ?>">
                        <button class="modal_btnconfirm" type="submit" name="mitteilung_senden" onclick="document.getElementById('id01').style.display='none'">Versenden</button>
                        <button class="modal_btnabort" type="button" onclick="document.getElementById('id01').style.display='none'">Abbrechen</button>
                    </div>
                </div>           
            </div>
        </div>
    </form>

    <!--Button um zur Veranstaltungsseite zurückzukehren-->
    <form action="VeranstaltungsSeite.php" method="post">
        <input type="hidden" name="veranstaltung_id" value="<?php echo $V_ID; ?>">
        <button type="submit" class="btn" name="veranstaltung">zurück zur Veranstaltung</button> 
    </form>

</div>

<script src="SeiteMitteilung.js"></script>

</body>
</html>
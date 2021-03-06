<?php
session_start();

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!--Importierung ausgelagerter CCS Dateien-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../../CSS/modal.css">
    <link rel="stylesheet" type="text/css" href="Angebotseite.css">
    <link rel="stylesheet" href="../../../CSS/popup.css">

    <title>Angebot</title>

    <!--Importierung einer externen JavaScript Bibliothek für Reitericons in der Reiterleiste-->
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
    <!--<script src="../script.js"></script>-->
</head>

<!--body der Seite mit Hintergrundbild 2-->
<body class="background2">

<!--Reiterleiste-->
<nav>
    <ul>
        <li><a href="../../Startseite/VeranstalterStartseite.php">Startseite</a></li>
        <li><a href="../../erstellenAnfrage/VeranstalterAnfrage.php">Angebot einholen</a></li>
        <li><a class="active" href="../VeranstalterVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li style="float: right;"> <a href="../../../logout.php"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li style="float: right;"> <a href="../../Datenänderung/VeranstalterDatenänderung.php"> <i class="fas fa-user-circle"></i> </a></li>

    </ul>
</nav>

<?php

//Aufruf der Angebotsseite nach Klick auf den Button
if(isset($_POST["Angebotsseite"])){

    //Abspeichern der übergebenen BeAr_ID
    $_SESSION["Angebot_ID"] = $_POST["angebot_id"];

}
else{
    echo "Es ist ein Fehler aufgetreten";
}

//Abfrage der Daten zu dieser Angebot_ID
$Angebot_ID = $_SESSION["Angebot_ID"];
$query1 = "SELECT Teilnehmer_gepl, Beginn, Dauer, Anmerkung, Angebotspreis, Status FROM Anfrage_Angebot WHERE BeAr_ID = $Angebot_ID";
$res1 = $conn->prepare($query1);
$res1->execute();
$res1->bind_result($Teilnehmer, $V_Beginn, $Dauer, $Anmerk, $Ang_Preis, $Status);
$res1->fetch();
$res1->close();

//Ablehnen des Angebots nack Klick auf Button Ablehnen
if(isset($_POST["angebot_ablehnen"])){

    //Abspeichern der BeAr_ID des abgelehnten Angebots
    $Angebot_ID = $_POST["angebot_id"];

    //Update Query des Angebots (Status und Raum)
    $query3 = "UPDATE Anfrage_Angebot SET Status = 5, R_ID = NULL WHERE BeAr_ID = $Angebot_ID";
    $res3 = $conn->query($query3);

    //Delete Query des reservierten Angebots im Kalender
    $query4 = "DELETE FROM Kalender WHERE B_ID = $Angebot_ID";
    $res4 = $conn->query($query4);

    if($res3 === FALSE){
        echo "Es ist ein Fehler bei der Update Query aufgetreten";
    }

    elseif($res4 === FALSE){
        echo "Es ist ein Fehler bei der Delete Query aufgetreten";
    }

    //Ausgabe einer Bestätigungsmeldung
    else{echo 
        '<div class="overlay">
            <div class="popup">
                <h2 class="hdln">Ablehnung erfolgreich</h2>
                <a class="close" href="../../Startseite/VeranstalterStartseite.php">&times;</a>
                <div class="content">Sie haben das Angebot abgelehnt.</div>
            </div>
        </div>';

    }
}

?>

<div class="container">
    <!--Details zum Angebot des Betreibers-->
    <div class="row">
        <div class="col-25">Teilnehmerzahl</div>
        <div class="col-75"><?php echo $Teilnehmer ?></div>
    </div>
    <div class="row">
        <div class="col-25">Veranstaltungsbeginn</div>
        <div class="col-75"><?php echo $V_Beginn ?></div>
    </div>
    <div class="row">
        <div class="col-25">Veranstaltungsdauer (in Tagen)</div>
        <div class="col-75"><?php echo $Dauer ?></div>
    </div>
    <div class="row">
        <div class="col-25">Anmerkungen</div>
        <div class="col-75"><?php echo $Anmerk ?></div>
    </div>
    <div class="row">
        <div class="col-25">Angebotspreis</div>
        <div class="col-75"><?php echo $Ang_Preis."€" ?></div>
    </div>
    <div class="row">
        <div class="col-25">Angebotsstatus</div>
        <div class="col-75">
            <?php

            //Wenn Angebot normal erstellt wurde
            if($Status == 2){
                echo "Das Angebot wurde für die angefragten Daten erstellt und ist 7 Tage gültig";
            }
            //Wenn Betreiber das angefragte Datum geändert hat
            if($Status == 3){
                echo "Das ursprüngliche Veranstaltungsdatum der Anfrage wurde vom Betreiber geändert";
            }?>
        </div>
    </div>
    <div class="row">
        <!--Button zur Annahme des Angebots-->
        <div class="col-33">
            <form action="VeranstaltungsErstellung.php" method="post">
                <input type="hidden" name="angebot_id" value="<?php echo $Angebot_ID; ?>">
                <button class="btn" type="submit" name="annahme">Angebot annehmen</button>
            </form>
        </div>

        <!--Button zur Ablehnung des Angebots, öffnet das Fenster zum Ablehnen des Angebots-->
        <div class="col-33">
            <button class="btn" type="button" id="ablehnen" onclick="document.getElementById('id01').style.display='block'">Angebot ablehnen</button>
        </div>
        <!--Fenster wenn Veranstalter auf Ablehnen klickt-->
        <div id="id01" class="modal">
            <form class="modal_content" action="Angebotseite.php" method="post">
                <div class="modal_container">
                    <h1>Angebot ablehnen</h1>
                    <p>Wollen Sie das Angebot wirklich ablehnen?</p>
                    <div class="modal_clearfix">
                        <input type="hidden" name="angebot_id" value="<?php echo $Angebot_ID; ?>">
                        <!--Button zur Bestätigung der Ablehnung-->
                        <button class="modal_btnconfirm" type="submit" name="angebot_ablehnen" onclick="document.getElementById('id01').style.display='none'">Ablehnen</button>
                        <!--Button zur Schließen des Fensters-->
                        <button class="modal_btnabort" type="button" onclick="document.getElementById('id01').style.display='none'">Abbrechen</button>
                    </div>
                </div>
            </form>
        </div>

        <!--Button zur Änderung des Datums; nur wenn Datum vom Betreiber geändert wurde-->
        <?php
        if($Status == 3){

        ?>
        <!--Fenster zum Ändern des Anfrage Datums-->
        <div class="col-33">
            <button class="btn" type="button" id="aendern" onclick="document.getElementById('id02').style.display='block'">Anfragedatum ändern</button>
        </div>
        <!--Fenster wenn Veranstalter auf Ändern klickt
            mit Eingabefeld für Datum-->
        <div id="id02" class="modal">
            <form class="modal_content" action="AngebotAendern.php" method="post">
                <div class="modal_container">
                    <h1>Anfragedatum ändern</h1>
                    <p>Geben Sie ein neues Beginn-Datum der Veranstaltung an.</p>
                    <p id="ltag"></p>
                    <div class="modal_clearfix" onmouseover="enableBtn()">
                        <input type="hidden" name="angebot_id" value="<?php echo $Angebot_ID; ?>">
                        <input type="hidden" name="dauer" id="dauer" value="<?php echo $Dauer; ?>">
                        <input type="date" name="new_date" id="new_date" required>
                        <!--Button zur Bestätigung des Anfrage Datums-->
                        <button class="modal_btnconfirm" type="submit"  id="btn_new_date" name="angebot_aendern" onclick="document.getElementById('id02').style.display='none'">Anfragedatum ändern</button>
                        <!--Button zur Schließen des Fensters-->
                        <button class="modal_btnabort" type="button" onclick="document.getElementById('id02').style.display='none'">Abbrechen</button>
                    </div>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</div>

<!--Importierung des ausgelagertes JavaScript Codes-->
<script src="Angebotseite.js"></script>

</body>
</html>
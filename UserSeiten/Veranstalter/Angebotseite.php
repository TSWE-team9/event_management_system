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
    <link rel="stylesheet" type="text/css" href="../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../listtabs.css">
    <link rel="stylesheet" type="text/css" href="./angebot.css">
    <link rel="stylesheet" type="text/css" href="../modal.css">
    <title>Meine Veranstaltungen</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>
<nav>
    <ul>
        <li><a href="VeranstalterStartseite.php">Startseite</a></li>
        <li><a href="VeranstalterAnfrage.php">Angebot einholen</a></li>
        <li><a href="#">Kontakt</a></li>
        <li><a href="#">Hilfe</a></li>
        <li><a class="active" href="VeranstalterVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li style="float: right;"> <a href="../logout.php"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li style="float: right;"> <a href="VeranstalterDatenänderung.php"> <i class="fas fa-user-circle"></i> </a></li>

    </ul>
</nav>

<?php
if(isset($_POST["Angebotsseite"])){

    //Abspeichern der übergebenen BeAr_ID
    $Angebot_ID = $_POST["angebot_id"];

    //Abfrage der Daten zu dieser Angebot_ID
    $query = "SELECT Teilnehmer_gepl, Beginn, Dauer, Anmerkung, Angebotspreis, Status FROM Anfrage_Angebot WHERE BeAr_ID = $Angebot_ID";
    $res = $conn->prepare($query);
    $res->execute();
    $res->bind_result($Teilnehmer, $V_Beginn, $Dauer, $Anmerk, $Ang_Preis, $Status);
    $res->fetch();
    $res->close();
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
            <?php if($Status == 2){
                echo "Das Angebot wurde für die angefragten Daten erstellt und ist 7 Tage gültig";
            }
            if($Status == 3){
                echo "Das ursprüngliche Veranstaltungsdatum der Anfrage wurde vom Betreiber geändert";
            }?>
        </div>
    </div>
    <div class="row">
        <!--Button zur Annahme des Angebots-->
        <div class="col-33">
            <form action="#" method="post">
                <input type="hidden" name="angebot_id" value="#angebots_id#">   
                <button class="btn" type="submit" name="annahme">Angebot Annehmen</button>
            </form>
        </div>

        <!--Button zur Ablehnung des Angebots-->
        <div class="col-33">
            <button class="btn" id="ablehnen" onclick="document.getElementById('id01').style.display='block'">Angebot ablehnen</button>
        </div>
        <!--Modal wenn Veranstalter auf Ablehnen klickt-->
        <div id="id01" class="modal">
            <form class="modal_content" action="#" method="post">
                <div class="modal_container">
                    <h1>Angebot ablehnen</h1>
                    <p>Wollen Sie das Angebot wircklich ablehnen?</p>
                    <div class="modal_clearfix">
                        <input type="hidden" name="angebot_id" value="#angebots_id#">
                        <button class="modal_btnconfirm" type="submit" name="angebot_ablehnen" onclick="document.getElementById('id01').style.display='none'">Ablehnen</button>   
                        <button class="modal_btnabort" onclick="document.getElementById('id01').style.display='none'">Abbrechen</button>
                    </div>
                </div>
            </form>
        </div>

        <!--Button zur Änderung des Datums; nur wenn Datum vom Betreiber geändert wurde-->
        <div class="col-33">
            <button class="btn" id="aendern" onclick="document.getElementById('id02').style.display='block'">Anfragedatum ändern</button>
        </div>
        <!--Modal wenn Veranstalter auf Ändern klickt-->
        <!--TODO Eingrenzung des Datum in Abhängigkeit von der Dauer-->
        <div id="id02" class="modal">
            <form class="modal_content" action="#" method="post">
                <div class="modal_container">
                    <h1>Anfragedatum ändern</h1>
                    <p>Geben Sie ein neues Beginn Datum der Veranstaltung an</p>
                    <div class="modal_clearfix">
                        <input type="hidden" name="anfrage_id" value="#anfrage_id#">
                        <input type="date" name="new_date" id="new_date" required>
                        <button class="modal_btnconfirm" type="submit" name="angebot_ablehnen" onclick="document.getElementById('id02').style.display='none'">Anfragedatum ändern</button>   
                        <button class="modal_btnabort" onclick="document.getElementById('id02').style.display='none'">Abbrechen</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    // Get the modal
    var modal1 = document.getElementById('id01');
    var modal2 = document.getElementById('id02');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal1) {
            modal1.style.display = "none";
        }
        if (event.target == modal2) {
            modal2.style.target == "none";
        }
    }

</script>

</body>
</html>
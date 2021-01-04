<?php
session_start();

//Header unterscheidung
switch ($_SESSION["rolle"]){
    case 0: //header Gast -> kein header
        break;
    case 1:  include 'headerVeranstalter.php';    //header Veranstalter
        break;
    case 2:  include 'headerTeilnehmer.php';      //header Teilnehmer
        break;
    case 3: //header Betreiber
        break;
    case 4: //header Admin
        break;

}

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

//Abspeichern der übergebenen V_ID
if(isset($_POST["veranstaltung"])){
    $_SESSION["V_ID"] = $_POST["veranstaltung_id"];
}

$V_ID = $_SESSION["V_ID"];

//Abfrage der benötigten Daten
$query = "SELECT Titel, Veranstalter, Beschreibung, Art, Verfügbarkeit, Status, Ort, Teilnehmer_max, Teilnehmer_akt,
       Beginn, DATE_ADD(Beginn, INTERVAL Dauer-1 DAY), Uhrzeit, DATE_SUB(Beginn, INTERVAL Frist DAY ), Kosten FROM Veranstaltung 
       WHERE V_ID = $V_ID";
$res = $conn->prepare($query);
$res->execute();
$res->bind_result($titel, $veranstalter, $beschreibung, $art, $verfügbarkeit, $status, $ort, $teilnehmer_max, $teilnehmer_akt,
                $beginn, $ende, $uhrzeit, $frist, $kosten);
$res->fetch();
$res->close();

//Abfrage Name des Veranstalters
$query2 = "SELECT Firma FROM Veranstalterkonto WHERE B_ID = $veranstalter";
$res2 = $conn->query($query2);
$i = $res2->fetch_row();

//Abfrage Name des Raums
$query3 = "SELECT Bezeichnung FROM Raum WHERE R_ID = $ort";
$res3 = $conn->query($query3);
$j = $res3->fetch_row();
?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CSS/Startseite.css">
    <link rel="stylesheet" type="text/css" href="../CSS/veranstaltungen.css">
    <link rel="stylesheet" type="text/css" href="../CSS/modal.css">
    <title>Veranstaltungsseite</title>
</head>

<body>

<div class="container-80">

    <div class="row">
        <h2 style="text-align: center;"><?php echo $titel; ?></h2>
    </div>

    <div class="row">
        <div class="col-info">
            <p class="info">Veranstalter</p>
        </div>
        <div class="col-desc">
            <p class="desc"><?php echo $i[0];?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-info">
            <p class="info">Veranstaltungsbeschreibung</p>
        </div>
        <div class="col-desc">
            <p class="desc"><?php echo $beschreibung; ?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-info">
            <p class="info">Veranstaltungsart</p>
        </div>
        <div class="col-desc">
            <p class="desc"><?php echo $art;?></p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-info">
            <p class="info">Verfügbarkeit</p>
        </div>
        <div class="col-desc">
            <!--if else ob offen oder geschlossen-->
            <?php if($verfügbarkeit == 1){?>
            <!--offen-->
            <p class="desc">Anmeldung für registrierte Nutzer möglich.</p>
            <?php } else {?>
            <!--geschlossen-->
            <p class="desc">Anmeldung nur über Veranstalter möglich.</p>
            <?php } ?>
        </div>
    </div>

    <div class="row">
        <div class="col-info">
            <p class="info">Veranstaltungs-Status</p>
        </div>
        <div class="col-desc">
            <p class="desc">
                <?php switch($status){
                    case 1: echo "aktiv";
                    break;
                    case 2: echo "begonnen";
                    break;
                    case 3: echo "abgelaufen";
                    break;
                    case 4: echo "storniert";
                    break;
                    case 5: echo "abgerechnet";
                    break;
                } ?>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-info">
            <p class="info">Veranstaltungsort</p>
        </div>
        <div class="col-desc">
            <p class="desc"><?php echo "Raum-Nr.: ". $ort . " - ". $j[0]; ?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-info">
            <p class="info">Teilnehmerzahl</p>
        </div>
        <div class="col-desc">
            <p class="desc"><?php echo $teilnehmer_akt . "/". $teilnehmer_max;?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-info">
            <p class="info">Veranstaltungszeitraum</p>
        </div>
        <div class="col-desc">
            <p class="desc"><?php echo $beginn . " bis " . $ende;?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-info">
            <p class="info">Veranstaltungsbeginn</p>
        </div>
        <div class="col-desc">
            <p class="desc"><?php echo $uhrzeit .  " Uhr";?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-info">
            <p class="info">Anmeldezeitraum</p>
        </div>
        <div class="col-desc">
            <p class="desc"><?php echo $frist;?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-info">
            <p class="info">Teilnahmekosten</p>
        </div>
        <div class="col-desc">
            <p class="desc"><?php echo $kosten . "€ pro Person";?></p>
        </div>
    </div>
 
</div>

//Anzeige Gast
<?php
if($_SESSION["rolle"]==0){
?>
<div class="container-80">
    <h1 class="center">Gast</h1>
    <p class="center">Anmeldung nur als registrierter Nutzer möglich.</p>
    <a class="center" href="../../LandingPage/index.php">zur Registrierung</a>
</div>
<?php }?>

<?php
if($_SESSION["rolle"]==2){
?>
<div class="container-80">
    <h1 class="center">Teilnehmer</h1>
    <!--if nicht angemeldet-->
    <!--Button zum Modal öffnen-->
    <button class="btn" id="aendern" onclick="document.getElementById('id01').style.display='block'">Anmelden</button>
    <!--Modal falls Anmeldezeitraum noch offen-->
    <div id="id01" class="modal">
        <form class="modal_content" action="#" method="post"> 
            <div class="modal_container">
                <h1>Veranstaltungsanmeldung</h1>
                <p>Wollen Sie sich verbindlich zu dieser Veranstaltung anmelden?</p>
                <div class="modal_clearfix">  
                    <input type="hidden" name="v_id" id="v_id" value="<?php echo $V_ID;?>">
                    <button class="modal_btnconfirm" type="submit"  id="anmelden" name="anmelden" onclick="document.getElementById('id01').style.display='none'">Anmelden</button>
                    <button class="modal_btnabort" onclick="document.getElementById('id01').style.display='none'">Abbrechen</button>
                </div>
            </div>
        </form>
    </div>
    <!--Modal falls Anmeldezeitraum abgelaufen-->
    <!--
        <div id="id01" class="modal">
        <div class="modal_content"> 
            <div class="modal_container">
                <h1>Veranstaltungsanmeldung</h1>
                <p>Der Anmeldezeitraum ist abgelaufen und eine Anmeldung ist nicht mehr möglich.</p>
                <div class="modal_clearfix">
                    <button class="modal_btnabort" onclick="document.getElementById('id01').style.display='none'">OK</button>
                </div>
            </div>
        </div>
    </div>
    -->   

    <!--else anmgemeldet-->
    <button class="btn" id="aendern" onclick="document.getElementById('id02').style.display='block'">Abmelden</button>
    <!--Modal falls Abmeldezeitraum noch nicht abgelaufen-->
    <!--
    <div id="id02" class="modal">
        <form class="modal_content" action="#" method="post"> 
            <div class="modal_container">
                <h1>Veranstaltungsabmeldung</h1>
                <p>Wollen Sie sich wircklich von dieser Veranstaltung abmelden?</p>
                <div class="modal_clearfix">  
                    <input type="hidden" name="v_id" id="v_id" value="<?php echo $V_ID;?>">
                    <button class="modal_btnconfirm" type="submit"  id="anmelden" name="anmelden" onclick="document.getElementById('id01').style.display='none'">Abmelden</button>
                    <button class="modal_btnabort" onclick="document.getElementById('id01').style.display='none'">Abbrechen</button>
                </div>
            </div>
        </form>
    </div>
    --> 
    <!--Modal falls Abmeldezeitraum abgelaufen-->
    <div id="id02" class="modal">
        <div class="modal_content"> 
            <div class="modal_container">
                <h1>Veranstaltungsanmeldung</h1>
                <p>Der Abmeldezeitraum ist abgelaufen und eine Abmeldung ist nicht mehr möglich.</p>
                <div class="modal_clearfix">
                    <button class="modal_btnabort" onclick="document.getElementById('id02').style.display='none'">OK</button>
                </div>
            </div>
        </div>
    </div> 
</div>
<?php }?>

<?php
if($_SESSION["rolle"]==1){
?>
<div class="container-80">
    <h1 class="center">Veranstalter</h1>
    <form action="#" method="post">
        <input type="hidden" name="v_id" id="v_id" value="<?php echo $V_ID;?>">
        <label for="t_liste"></label>
        <input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" name="t_liste" id=" t_liste" />
        <button class="btn">Teilnehmerliste übermitteln</button> 
    </form>
</div>
<?php }?>

<?php
if($_SESSION["rolle"]==3){
?>
    <!--Buttons für Betreiber-->
<?php }?>

<?php
if($_SESSION["rolle"]==4){
    ?>
    <!--Buttons für Admin (falls nicht benötigt einfach löschen)-->
<?php }?>

<script>
     // Get the modal
    var modal1 = document.getElementById('id01');
    var modal2 = document.getElementById('id02');
</script>
</body>
</html>
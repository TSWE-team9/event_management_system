<?php
session_start();
include "../../veranstaltung_refresh.php";
veranstaltung_refresh();

//Verbindung zur Datenbank herstellen
$host = '132.231.36.109';
$db = 'vms_db';
$user = 'dbuser';
$pw = 'dbuser123';
$conn = new mysqli($host, $user, $pw, $db,3306);

//Überprüfen ob es einen Verbindungsfehler gab
if($conn->connect_error) {
    die('Connect Error (' . $conn->connect_errno . ') '
        . $conn->connect_error);

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Abrechnung</title>

    <link rel="stylesheet" type="text/css" href="../header.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../Angebotserstellung/InterneVeranstaltungen.css" media="screen" />
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>

</head>

<body>
<nav>
    <ul class="header" style="margin-top: 0">
        <li class="headerel"><a href="../Raumverwaltung/StartseiteBetreiber.html" class ="headerel">Startseite</a></li>
        <li class="headerel"><a class= "active" href="../Angebotserstellung/Angebotserstellung.php">Angebotserstellung</a></li>
        <li class="headerel"><a href="#">Abrechnung</a></li>
        <li class="headerel"><a  href="../Raumverwaltung/Raumverwaltung.php">Raumverwaltung</a></li>
        <li class="headerel"><a href="#">Meine Veranstaltungen</a></li>
        <li class="headerel"><a href="#">Statistiken</a></li>
        <li class="headerel" style="float: right;"> <a href="#"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li class="headerel" style=float:right;"> <a href="#"  > <i class="fas fa-user-circle" ></i> </a></li>

    </ul>
</nav>
<!--Tab auf der linken Seite zum auswählen zwischen internen und externen Veranstaltungen -->
<div class="tab">
    <button class="tablinks" onclick="openList(event, 'interne')" id="defaultOpen">Interne Veranstaltungen</button>
    <button class="tablinks" onclick="openList(event, 'externe')">Externe Veranstaltungen</button>

</div>
<div id="interne" class="tabcontent">
    <h3 class="txt" >Interne Veranstaltungen</h3>

    <!--anzeigen der internen abgelaufenen/stornierten Veranstaltungen-->
    <?php
    $query1 = "SELECT V_ID, Angebot_ID, DATE_ADD(Beginn, INTERVAL Dauer-1 DAY), Titel, Status FROM Veranstaltung WHERE Status IN (3,4) AND Kategorie = 2";
    $res1 = $conn->query($query1);
    if($res1->num_rows > 0){
    while($i = $res1->fetch_row()){

    ?>
<form action="Abrechnung_Formular.php" method="post">
    <input type="hidden" name="Veranstaltung_id" value="<?php echo $i[0]; ?>">
    <input type="hidden" name="Bearbeitung_id" value="<?php echo $i[1]; ?>">
    <input type="hidden" name="Kategorie" value="2">
    <input type="hidden" name="Status" value="<?php echo $i[4]; ?>">
    <button type="submit" class="btnveranstaltung" name="Abrechnung"><div class="btnbeginn"><?php echo "Abgelaufen am: ".$i[2];?></div><div class="btntitel"><?php echo $i[3];?></div></button>
    </form>

</div>
<?php }} else { ?>
<!-- TODO Text wenn nichts existiert-->
<?php } ?>


<div id="externe" class="tabcontent">
<h3 class="txt">Externe Veranstaltungen</h3>

    <!--anzeigen der externen abgelaufenen/stornierten Veranstaltungen-->
    <?php
    $query2 = "SELECT V_ID, Angebot_ID, DATE_ADD(Beginn, INTERVAL Dauer-1 DAY), Titel, Status FROM Veranstaltung WHERE Status IN (3,4) AND Kategorie = 1";
    $res2 = $conn->query($query2);
    if($res2->num_rows > 0){
    while($i = $res2->fetch_row()){

    ?>
<form action="Abrechnung_Formular.php" method="post">
    <input type="hidden" name="Veranstaltung_id" value="<?php echo $i[0]; ?>">
    <input type="hidden" name="Bearbeitung_id" value="<?php echo $i[1]; ?>">
    <input type="hidden" name="Kategorie" value="1">
    <input type="hidden" name="Status" value="<?php echo $i[4]; ?>">
    <button type="submit" class="btnveranstaltung" name="Abrechnung"><div class="btnbeginn"><?php echo "Abgelaufen am: ".$i[2];?></div><div class="btntitel"><?php echo $i[3];?></div></button>
</form>

</div>
<?php }} else { ?>
    <!-- TODO Text wenn nichts existiert-->
<?php } ?>

<script src="../js/Tabs.js"></script>
</body>
</html>
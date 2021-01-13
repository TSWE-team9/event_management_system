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

//Aktualisieren der Angebote und Veranstaltungen (Status)
include "../../angebot_refresh.php";
include "../../veranstaltung_refresh.php";
angebot_refresh();
veranstaltung_refresh();

//Variablen
$V_ID = $_SESSION["b_id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../CSS/tabs.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/listen.css">
    <title>Meine Veranstaltungen</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body class="background1">
<?php include '../header.php';?>
<script>document.getElementById("reiter_veranstaltungen").classList.add("active");</script>

<br><br><br><br><br>
<!--Tabs auf der linken Seite zum auswählen der gewünschten Liste-->
<div class="tab">
  <button class="tablinks" onclick="openList(event, 'aktuelle')" id="defaultOpen">aktuelle Veranstaltungen</button>
  <button class="tablinks" onclick="openList(event, 'zukünftige')">zukünftige Veranstaltungen</button>
  <button class="tablinks" onclick="openList(event, 'abgeschlossene')">abgeschlossene Veranstaltungen</button>
  <button class="tablinks" onclick="openList(event, 'angebote')">Veranstaltungsangebote</button>
</div>

<!--Tab auf der rechten Seite mit Liste der aktuellen Veranstaltungen-->
<div id="aktuelle" class="tabcontent">
  <h3 class="hdln">aktuelle Veranstaltungen</h3>

    <?php
    //Abfrage aller begonnenen (Status = 2) Veranstaltungen des Veranstalters
    $query1 = "SELECT V_ID, Beginn, Titel FROM Veranstaltung WHERE Veranstalter = $V_ID AND Status = 2";
    $res1 = $conn->query($query1);
    if($res1->num_rows == 0){
        echo "<p class='txt'>Sie haben derzeit keine aktuellen Veranstaltungen</P>";
    }

    //Ausgabe der Abfrage in HTML
    else {
        while($i = $res1->fetch_row()){

    ?>
  <!--foreach Schleife Beginn-->
  <form action="../../Veranstaltungsseite/VeranstaltungsSeite.php" method="post">
    <input type="hidden" name="veranstaltung_id" value="<?php echo $i[0];?>">
    <button type="submit" class="btnveranstaltung" name="veranstaltung"><div class="btnbeginn"><?php echo "Beginn: ". $i[1]?></div><div class="btntitel"><?php echo $i[2]?></div></button>
  </form> 
  <?php }} ?>
    <!--foreach Schleife Ende-->
</div>

<!--Tab auf der rechten Seite mit Liste der zukünftigen Veranstaltungen-->
<div id="zukünftige" class="tabcontent">
  <h3 class="hdln">zukünftige Veranstaltungen</h3>

    <?php
    //Abfrage aller aktiven (Status = 1) Veranstaltungen des Veranstalters

    $query2 = "SELECT V_ID, Beginn, Titel FROM Veranstaltung WHERE Veranstalter = $V_ID AND Status = 1";
    $res2 = $conn->query($query2);
    if($res2->num_rows == 0){
        echo "<p class='txt'>Sie haben derzeit keine geplanten Veranstaltungen</P>";
    }
  
    //Ausgabe der Abfrage in HTML
    else{
    while($i = $res2->fetch_row()){
    ?>
  <!--foreach Schleife Beginn-->
  <form action="../../Veranstaltungsseite/VeranstaltungsSeite.php" method="post">
    <input type="hidden" name="veranstaltung_id" value="<?php echo $i[0];?>">
    <button type="submit" class="btnveranstaltung" name="veranstaltung"><div class="btnbeginn"><?php echo "Beginn: ". $i[1]?></div><div class="btntitel"><?php echo $i[2]?></div></button>
  </form> 
  <!--foreach Schleife Ende-->
    <?php }} ?>
</div>

<!--Tab auf der rechten Seite mit Liste der abgeschlossenen Veranstaltungen-->
<div id="abgeschlossene" class="tabcontent">
  <h3 class="hdln">abgeschlossene Veranstaltungen</h3>

    <?php
    //Abfrage aller abgelaufenen (Status = 3) Veranstaltungen des Veranstalters

    $query3 = "SELECT V_ID, Beginn, Titel FROM Veranstaltung WHERE Veranstalter = $V_ID AND Status = 3";
    $res3 = $conn->query($query3);
    if($res3->num_rows == 0){
        echo "<p class='txt'>Sie haben derzeit keine abgeschlossenen Veranstaltungen</P>";
    }

    //Ausgabe der Abfrage in HTML
    else{
    while($i = $res3->fetch_row()){
    ?>
  <!--foreach Schleife Beginn-->
  <form action="../../Veranstaltungsseite/VeranstaltungsSeite.php" method="post">
    <input type="hidden" name="veranstaltung_id" value="<?php echo $i[0];?>">
    <button type="submit" class="btnveranstaltung" name="veranstaltung"><div class="btnbeginn"><?php echo "Beginn: ". $i[1]?></div><div class="btntitel"><?php echo $i[2]?></div></button>
  </form>
    <?php }} ?>
  <!--foreach Schleife Ende-->
</div>

<!--Tab auf der rechten Seite mit Liste von Angeboten-->
<div id="angebote" class="tabcontent">
  <h3 class="hdln">Veranstaltungsangebote</h3>

    <?php
    //Abfrage aller bearbeiteten und geänderten Anfragen (Angeboten) des angemeldeten Veranstalters
    $query4 = "SELECT BeAr_ID, Beginn, Angebotsdatum FROM Anfrage_Angebot WHERE Veranstalter = $V_ID AND Status IN (2, 3)";
    $res4 = $conn->query($query4);
    if($res4->num_rows == 0){
        echo "<p class='txt'>Sie haben derzeit keine Angebote des Betreibers</P>";
    }

    //Ausgabe der Ergebnisse in HTML
    else{
    while($i = $res4->fetch_row()){
    ?>

  <form action="../eigeneVeranstaltungen/Angebot/Angebotseite.php" method="post">
    <input type="hidden" name="angebot_id" value="<?php echo $i[0];?>">
    <button type="submit" class="btnveranstaltung" name="Angebotsseite"><?php echo "Angebotsdatum: ". $i[2] . " / Geplanter Beginn: ". $i[1]?></button>
  </form>
    <?php }}?>
  <!--while Schleife Ende-->
</div>

<script src="VeranstalterVeranstaltungen.js"></script>

</body>
</html>
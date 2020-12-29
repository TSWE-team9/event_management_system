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

//Variablen
//$V_ID = $_SESSION["b_id"];
$V_ID = 4;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../listtabs.css">
    <link rel="stylesheet" type="text/css" href="listen.css">
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

<h1 style="text-align: center; margin-top: 40px;">Meine Veranstaltungen</h1>

<!--Tabs auf der linken Seite zum auswählen der gewünschten Liste-->
<div class="tab">
  <button class="tablinks" onclick="openList(event, 'aktuelle')" id="defaultOpen">aktuelle Veranstaltungen</button>
  <button class="tablinks" onclick="openList(event, 'zukünftige')">zukünftige Veranstaltungen</button>
  <button class="tablinks" onclick="openList(event, 'abgeschlossene')">abgeschlossene Veranstaltungen</button>
  <button class="tablinks" onclick="openList(event, 'angebote')">Veranstaltungsangebote</button>
</div>

<!--Tab auf der rechten Seite mit Liste der aktuellen Veranstaltungen-->
<div id="aktuelle" class="tabcontent">
  <h3 style="text-align: center;">aktuelle Veranstaltungen</h3>
  <!--SQL Abfrage-->
    <?php
    //Abfrage aller begonnenen (Status = 2) Veranstaltungen des Veranstalters
    $query1 = "SELECT V_ID, Beginn, Titel FROM Veranstaltung WHERE Veranstalter = $V_ID AND Status = 2";
    $res1 = $conn->query($query1);

    //Ausgabe der Abfrage in HTML
    while($i = $res1->fetch_row()){
    ?>
  <!--foreach Schleife Beginn-->
  <form action="../VeranstaltungsSeite.php" method="post">
    <input type="hidden" name="veranstaltung_id" value="<?php echo $i[0];?>">
    <button type="submit" class="btnveranstaltung"><div class="btnbeginn"><?php echo "Beginn: ". $i[1]?></div><div class="btntitel"><?php echo $i[2]?></div></button>
  </form> 
  <?php } ?>
    <!--foreach Schleife Ende-->
</div>

<!--Tab auf der rechten Seite mit Liste der zukünftigen Veranstaltungen-->
<div id="zukünftige" class="tabcontent">
  <h3 style="text-align: center;">zukünftige Veranstaltungen</h3>
  <!--SQL Abfrage-->
    <?php
    //Abfrage aller aktiven (Status = 1) Veranstaltungen des Veranstalters

    $query2 = "SELECT V_ID, Beginn, Titel FROM Veranstaltung WHERE Veranstalter = $V_ID AND Status = 1";
    $res2 = $conn->query($query2);

    //Ausgabe der Abfrage in HTML
    while($i = $res2->fetch_row()){
    ?>
  <!--foreach Schleife Beginn-->
  <form action="../VeranstaltungsSeite.php" method="post">
    <input type="hidden" name="veranstaltung_id" value="<?php echo $i[0];?>">
    <button type="submit" class="btnveranstaltung"><div class="btnbeginn"><?php echo "Beginn: ". $i[1]?></div><div class="btntitel"><?php echo $i[2]?></div></button>
  </form> 
  <!--foreach Schleife Ende-->
    <?php } ?>
</div>

<!--Tab auf der rechten Seite mit Liste der abgeschlossenen Veranstaltungen-->
<div id="abgeschlossene" class="tabcontent">
  <h3 style="text-align: center;">abgeschlossene Veranstaltungen</h3>
  <!--SQL Abfrage-->
    <?php
    //Abfrage aller abgelaufenen (Status = 3) Veranstaltungen des Veranstalters

    $query3 = "SELECT V_ID, Beginn, Titel FROM Veranstaltung WHERE Veranstalter = $V_ID AND Status = 3";
    $res3 = $conn->query($query3);

    //Ausgabe der Abfrage in HTML
    while($i = $res3->fetch_row()){
    ?>
  <!--foreach Schleife Beginn-->
  <form action="../VeranstaltungsSeite.php" method="post">
    <input type="hidden" name="veranstaltung_id" value="<?php echo $i[0];?>">
    <button type="submit" class="btnveranstaltung"><div class="btnbeginn"><?php echo "Beginn: ". $i[1]?></div><div class="btntitel"><?php echo $i[2]?></div></button>
  </form>
    <?php } ?>
  <!--foreach Schleife Ende-->
</div>

<!--Tab auf der rechten Seite mit Liste von Angeboten-->
<div id="angebote" class="tabcontent">
  <h3 style="text-align: center;">Veranstaltungsangebote</h3>
  <!--SQL Abfrage-->
    <?php
    //Abfrage aller bearbeiteten und geänderten Anfragen (Angeboten) des angemeldeten Veranstalters
    $query4 = "SELECT BeAr_ID, Beginn, Angebotsdatum FROM Anfrage_Angebot WHERE Veranstalter = $V_ID AND Status IN (2, 3)";
    $res4 = $conn->query($query4);

    //Ausgabe der Ergebnisse in HTML
    while($i = $res4->fetch_row()){
    ?>

  <form action="Angebotseite.php" method="post">
    <input type="hidden" name="angebot_id" value="<?php echo $i[0];?>">
    <button type="submit" class="btnveranstaltung" name="Angebotsseite"><?php echo "Angebotsdatum: ". $i[2] . " / Geplanter Beginn: ". $i[1]?></button>
  </form>
    <?php }?>
  <!--while Schleife Ende-->
</div>

<script>

    // function to display different tabs
    function openList(evt, listName) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the link that opened the tab
        document.getElementById(listName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();

</script>

</body>
</html>
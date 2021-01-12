<?php
$db = mysqli_connect('132.231.36.109', 'dbuser', 'dbuser123', 'vms_db');
session_start()
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>AbrechnungsFormular</title>
    <link rel="stylesheet" type="text/css" href="../style/header.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="InterneVeranstaltungen.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/Fehlermeldung.css" media="screen" />
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
<!--    <script src="../Abrechnung/Tabs.js"></script>-->
</head>
<body>
<nav >
    <?php include '../Header/header.php'; ?>
    <script>document.getElementById("Reiter_MeineVeranstaltungen").classList.add("active");  </script>
</nav>

<!--<h1 >Meine Veranstaltungen</h1>-->
<?php
//Refresh der Angebote (Status)
include "../../angebot_refresh.php";
angebot_refresh();

?>
<!--Tabs auf der linken Seite zum auswählen der gewünschten Liste-->
<div class="tab">
    <button class="tablinks" onclick="openList(event, 'aktuelle')" id="defaultOpen">Aktuelle Veranstaltungen</button>
    <button class="tablinks" onclick="openList(event, 'zukünftige')">Zukünftige Veranstaltungen</button>
    <button class="tablinks" onclick="openList(event, 'abgeschlossene')">Abgeschlossene Veranstaltungen</button>
</div>

<!--Tab auf der rechten Seite mit Liste der aktuellen Veranstaltungen-->
<div id="aktuelle" class="tabcontent">
    <h3 style="text-align: center;">Aktuelle Veranstaltungen</h3>
    <!--SQL Abfrage-->
    <?php
    //Abfrage aller begonnenen (Status = 2) Veranstaltungen des Betreibers
    $query1 = "SELECT V_ID, Beginn, Titel FROM Veranstaltung WHERE Kategorie=2 AND Status = 2";
    $res1 = $db->query($query1);

    if($res1->num_rows == 0){echo "<p class='txt' >Sie haben derzeit keine aktuellen Veranstaltungen</p>";}

    //Ausgabe der Abfrage in HTML
    while($i = $res1->fetch_row()){
        ?>

    <!--foreach Schleife Beginn-->
    <form action="../../Veranstaltungsseite/VeranstaltungsSeite.php" method="post">
        <input type="hidden" name="veranstaltung_id" value="<?php echo $i[0];?>">
        <button type="submit" class="btnveranstaltung" name="veranstaltung"><div class="btnbeginn"><?php echo $i[2];?></div><div class="btntitel"><?php echo $i[1];?></div></button>
    </form>
    <?php } ?>
    <!--foreach Schleife Ende-->
</div>

<!--Tab auf der rechten Seite mit Liste der zukünftigen Veranstaltungen-->
<div id="zukünftige" class="tabcontent">
    <h3 style="text-align: center;">Zukünftige Veranstaltungen</h3>
    <!--SQL Abfrage-->
    <?php
    //Abfrage aller aktiven (Status = 1) Veranstaltungen des Veranstalters
    $query2 = "SELECT V_ID, Beginn, Titel FROM Veranstaltung WHERE Kategorie=2 AND Status = 1";
    $res2 = $db->query($query2);
    if($res2->num_rows == 0){echo "<p class='txt'>Sie haben derzeit keine zukünftigen Veranstaltungen</P>";}
    //Ausgabe der Abfrage in HTML
    while($i = $res2->fetch_row()){
    ?>
    <!--foreach Schleife Beginn-->
    <form action="../../Veranstaltungsseite/VeranstaltungsSeite.php" method="post">
        <input type="hidden" name="veranstaltung_id" value="<?php echo $i[0];?>">
        <button type="submit" class="btnveranstaltung" name="veranstaltung"><div class="btnbeginn"><?php echo $i[2];?></div><div class="btntitel"><?php echo $i[1];?></div></button>
    </form>
    <?php } ?>
    <!--foreach Schleife Ende-->
</div>

<!--Tab auf der rechten Seite mit Liste der abgeschlossenen Veranstaltungen-->
<div id="abgeschlossene" class="tabcontent">
    <h3 style="text-align: center;">Abgeschlossene Veranstaltungen</h3>
    <!--SQL Abfrage-->
    <?php
    //Abfrage aller abgeschlossenen (Status = 3) Veranstaltungen des Veranstalters
    $query3 = "SELECT V_ID, Beginn, Titel FROM Veranstaltung WHERE Kategorie=2 AND Status = 3";
    $res3 = $db->query($query3);
    if($res3->num_rows == 0){ echo "<p class='txt'>Sie haben derzeit keine abgeschlossenen Veranstaltungen</P>";}

    //Ausgabe der Abfrage in HTML
    while($i = $res3->fetch_row()){
        ?>
    <!--foreach Schleife Beginn-->
    <form action="../../Veranstaltungsseite/VeranstaltungsSeite.php" method="post">
        <input type="hidden" name="veranstaltung_id" value="<?php echo $i[0];?>">
        <button type="submit" class="btnveranstaltung" name="veranstaltung"><div class="btnbeginn"><?php echo $i[2];?></div><div class="btntitel"><?php echo $i[1];?></div></button>
    </form>
    <?php } ?>
    <!--foreach Schleife Ende-->

</div>
<!-Button zum Anlegen einer neuen Veranstaltung -->
<div class="container">
<a href="KapazitätenabfrageV3.php" style="width:15%" class="Auslösen" type="button" >Veranstaltung hinzufügen &#10010;</a>

</div>

<script src="../js/Tabs.js"></script>

</body>
</html>

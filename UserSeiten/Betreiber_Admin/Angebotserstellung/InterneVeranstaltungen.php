<?php
$db = mysqli_connect('132.231.36.109', 'dbuser', 'dbuser123', 'vms_db');
session_start()
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Interne Veranstaltungen</title>
    <link rel="stylesheet" type="text/css" href="../header.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="InterneVeranstaltungen.css" media="screen" />
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>
<nav >
    <ul class="header" style="top: 0">
        <li class="headerel"><a href="../StartseiteBetreiber.html" class ="headerel">Startseite</a></li>
        <li class="headerel"><a  href="Angebotserstellung.php">Angebotserstellung</a></li>
        <li class="headerel"><a href="#">Abrechnung</a></li>
        <li class="headerel"><a  href="Raumverwaltung.php">Raumverwaltung</a></li>
        <li class="headerel"><a class= "active" href="#">Meine Veranstaltungen</a></li>
        <li class="headerel"><a href="#">Statistiken</a></li>
        <li class="headerel" style="float: right;"> <a href="#"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li class="headerel" style=float:right;"> <a href="#"  > <i class="fas fa-user-circle" ></i> </a></li>

    </ul>
</nav>

<!--<h1 >Meine Veranstaltungen</h1>-->
<?php
//TODO: Auskommentieren nach Merge; Refresh der Angebote (Status)
//include "../../UserSeiten/angebot_refresh.php";
//angebot_refresh();

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
    <form action="" method="post">
        <input type="hidden" name="veranstaltung_id" value="#veranstaltungs_id#">
        <button type="submit" class="btnveranstaltung"><div class="btnbeginn">#Veranstaltungsbeginn#</div><div class="btntitel">#Veranstaltungstitel#</div></button>
    </form>
    <?php } ?>
    <!--foreach Schleife Ende-->
</div>

<!--Tab auf der rechten Seite mit Liste der zukünftigen Veranstaltungen-->
<div id="zukünftige" class="tabcontent">
    <h3 style="text-align: center;">Zukünftige Veranstaltungen</h3>
    <!--SQL Abfrage-->
    <?php
    //Abfrage aller begonnenen (Status = 2) Veranstaltungen des Veranstalters
    $query2 = "SELECT V_ID, Beginn, Titel FROM Veranstaltung WHERE Kategorie=2 AND Status = 1";
    $res2 = $db->query($query2);
    if($res2->num_rows == 0){echo "<p class='txt'>Sie haben derzeit keine zukünfitigen Veranstaltungen</P>";}
    //Ausgabe der Abfrage in HTML
    while($i = $res2->fetch_row()){
    ?>
    <!--foreach Schleife Beginn-->
    <form action="" method="post">
        <input type="hidden" name="veranstaltung_id" value="#veranstaltungs_id#">
        <button type="submit" class="btnveranstaltung"><div class="btnbeginn"><?php echo $i[2];?></div><div class="btntitel"><?php echo $i[1];?></div></button>
    </form>
    <?php } ?>
    <!--foreach Schleife Ende-->
</div>

<!--Tab auf der rechten Seite mit Liste der abgeschlossenen Veranstaltungen-->
<div id="abgeschlossene" class="tabcontent">
    <h3 style="text-align: center;">Abgeschlossene Veranstaltungen</h3>
    <!--SQL Abfrage-->
    <?php
    //Abfrage aller begonnenen (Status = 2) Veranstaltungen des Veranstalters
    $query3 = "SELECT V_ID, Beginn, Titel FROM Veranstaltung WHERE Kategorie=2 AND Status = 3";
    $res3 = $db->query($query3);
    if($res3->num_rows == 0){ echo "<p class='txt'>Sie haben derzeit keine abgeschlossenen Veranstaltungen</P>";}

    //Ausgabe der Abfrage in HTML
    while($i = $res3->fetch_row()){
        ?>
    <!--foreach Schleife Beginn-->
    <form action="../VeranstaltungsSeite.php" method="post">
        <input type="hidden" name="veranstaltung_id" value="#veranstaltungs_id#">
        <button type="submit" class="btnveranstaltung"><div class="btnbeginn">#Veranstaltungsbeginn#</div><div class="btntitel">#Veranstaltungstitel#</div></button>
    </form>
    <?php } ?>
    <!--foreach Schleife Ende-->

</div>
<!-Button zum Anlegen einer neuen Veranstaltung -->
<div class="container">
<a href="KapazitätenabfrageV3.php" class="Auslösen" type="button" >Veranstaltung hinzufügen &#10010;</a>

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

!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../listtabs.css">
    <link rel="stylesheet" type="text/css" href="./listen.css">
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
  <!--foreach Schleife Beginn-->
  <form action="../VeranstaltungsSeite.php" method="post">
    <input type="hidden" name="veranstaltung_id" value="#veranstaltungs_id#">
    <button type="submit" class="btnveranstaltung"><div class="btnbeginn">#Veranstaltungsbeginn#</div><div class="btntitel">#Veranstaltungstitel#</div></button>
  </form> 
  <!--foreach Schleife Ende-->
</div>

<!--Tab auf der rechten Seite mit Liste der zukünftigen Veranstaltungen-->
<div id="zukünftige" class="tabcontent">
  <h3 style="text-align: center;">zukünftige Veranstaltungen</h3>
  <!--SQL Abfrage-->
  <!--foreach Schleife Beginn-->
  <form action="../VeranstaltungsSeite.php" method="post">
    <input type="hidden" name="veranstaltung_id" value="#veranstaltungs_id#">
    <button type="submit" class="btnveranstaltung"><div class="btnbeginn">#Veranstaltungsbeginn#</div><div class="btntitel">#Veranstaltungstitel#</div></button>
  </form> 
  <!--foreach Schleife Ende-->
</div>

<!--Tab auf der rechten Seite mit Liste der abgeschlossenen Veranstaltungen-->
<div id="abgeschlossene" class="tabcontent">
  <h3 style="text-align: center;">abgeschlossene Veranstaltungen</h3>
  <!--SQL Abfrage-->
  <!--foreach Schleife Beginn-->
  <form action="../VeranstaltungsSeite.php" method="post">
    <input type="hidden" name="veranstaltung_id" value="#veranstaltungs_id#">
    <button type="submit" class="btnveranstaltung"><div class="btnbeginn">#Veranstaltungsbeginn#</div><div class="btntitel">#Veranstaltungstitel#</div></button>
  </form> 
  <!--foreach Schleife Ende-->
</div>

<!--Tab auf der rechten Seite mit Liste von Angeboten-->
<div id="angebote" class="tabcontent">
  <h3 style="text-align: center;">Veranstaltungsangebote</h3>
  <!--SQL Abfrage-->
  <!--foreach Schleife Beginn-->
  <form action="Angebotseite.php" method="post">
    <input type="hidden" name="angebot_id" value="#angebots_id#">
    <button type="submit" class="btnveranstaltung">#Veranstaltungsbeginn#</button>
  </form> 
  <!--foreach Schleife Ende-->
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
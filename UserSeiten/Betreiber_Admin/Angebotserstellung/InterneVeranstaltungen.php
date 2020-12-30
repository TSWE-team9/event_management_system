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
    <!--foreach Schleife Beginn-->
    <form action="" method="post">
        <input type="hidden" name="veranstaltung_id" value="#veranstaltungs_id#">
        <button type="submit" class="btnveranstaltung"><div class="btnbeginn">#Veranstaltungsbeginn#</div><div class="btntitel">#Veranstaltungstitel#</div></button>
    </form>
    <!--foreach Schleife Ende-->
</div>

<!--Tab auf der rechten Seite mit Liste der zukünftigen Veranstaltungen-->
<div id="zukünftige" class="tabcontent">
    <h3 style="text-align: center;">Zukünftige Veranstaltungen</h3>
    <!--SQL Abfrage-->
    <!--foreach Schleife Beginn-->
    <form action="" method="post">
        <input type="hidden" name="veranstaltung_id" value="#veranstaltungs_id#">
        <button type="submit" class="btnveranstaltung"><div class="btnbeginn">#Veranstaltungsbeginn#</div><div class="btntitel">#Veranstaltungstitel#</div></button>
    </form>
    <!--foreach Schleife Ende-->
</div>

<!--Tab auf der rechten Seite mit Liste der abgeschlossenen Veranstaltungen-->
<div id="abgeschlossene" class="tabcontent">
    <h3 style="text-align: center;">Abgeschlossene Veranstaltungen</h3>
    <!--SQL Abfrage-->
    <!--foreach Schleife Beginn-->
    <form action="../VeranstaltungsSeite.php" method="post">
        <input type="hidden" name="veranstaltung_id" value="#veranstaltungs_id#">
        <button type="submit" class="btnveranstaltung"><div class="btnbeginn">#Veranstaltungsbeginn#</div><div class="btntitel">#Veranstaltungstitel#</div></button>
    </form>
    <!--foreach Schleife Ende-->

</div>
<!-Buttons zum Anlegen einer neuen Veranstaltung stornieren einer bestehenden Veranstaltung und einspielen der Teilnehmerliste-->
<div class="container">
<a href="KapazitätenabfrageV3.php" class="Auslösen" type="button" >Veranstaltung hinzufügen &#10010;</a>
<button type="submit"  name="Kapazitätsprüfung3" class="Auslösen"> Teilnehmerliste einspielen &#9997;</button>
    <a href="" class="Auslösen" type="button" >Veranstaltung stornieren &#10006;</a>
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

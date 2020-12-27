!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../listtabs.css">
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
  <h3>aktuelle Veranstaltungen</h3>
  <p>Liste</p> 
</div>

<!--Tab auf der rechten Seite mit Liste der zukünftigen Veranstaltungen-->
<div id="zukünftige" class="tabcontent">
  <h3>zukünftige Veranstaltungen</h3>
  <p>Liste</p> 
</div>

<!--Tab auf der rechten Seite mit Liste der abgeschlossenen Veranstaltungen-->
<div id="abgeschlossene" class="tabcontent">
  <h3>abgeschlossene Veranstaltungen</h3>
  <p>Liste</p> 
</div>

<!--Tab auf der rechten Seite mit Liste von Angeboten-->
<div id="angebote" class="tabcontent">
  <h3>Veranstaltungsangebote</h3>
  <p>Liste</p> 
</div>

<script>

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
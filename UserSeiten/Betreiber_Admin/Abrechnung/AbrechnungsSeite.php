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
        <li class="headerel"><a href="../StartseiteBetreiber.html" class ="headerel">Startseite</a></li>
        <li class="headerel"><a class= "active" href="Angebotserstellung.php">Angebotserstellung</a></li>
        <li class="headerel"><a href="#">Abrechnung</a></li>
        <li class="headerel"><a  href="Raumverwaltung.php">Raumverwaltung</a></li>
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
<!--anzeigen der internen abgelaufenen Veranstaltungen-->
<div id="interne" class="tabcontent">
    <h3 class="txt" >Interne Veranstaltungen</h3>
<form action="Abrechnung_Formular.php" method="post">
    <input type="hidden" name="Veranstaltung_id" value=" ">
    <input type="hidden" name="Bearbeitung_id" value=" ">
    <input type="hidden" name="Rechnungsdatum" value=" ">
    <input type="hidden" name="PreisproTeilnehmer" value=" ">
    <button type="submit" class="btnveranstaltung" name="veranstaltung_id"><div class="btnbeginn"></div><div class="btntitel"></div></button>
    </form>

</div>

<!--anzeigen der externen abgelaufenen Veranstaltungen-->
<div id="externe" class="tabcontent">
<h3 class="txt">Externe Veranstaltungen</h3>
<form action="Abrechnung_Formular.php" method="post">
    <input type="hidden" name="Veranstaltungs_id" value=" ">
    <input type="hidden" name="Bearbeitungs_id" value=" ">
    <input type="hidden" name="Rechnungsnummer" value=" ">
    <input type="hidden" name="Kunden_id" value=" ">
    <input type="hidden" name="Straße" value=" ">
    <input type="hidden" name="Plz" value=" ">
    <input type="hidden" name="Ort" value=" ">
    <input type="hidden" name="Land" value=" ">
    <input type="hidden" name="Rechnungsdatum" value=" ">
    <input type="hidden" name="PreisproTeilnehmer" value=" ">
    <button type="submit" class="btnveranstaltung" name="veranstaltung_id"><div class="btnid"></div><div class="btntitel"></div></button>
</form>

</div>
<script src="../js/Tabs.js"></script>
</body>
</html>
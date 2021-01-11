<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kapazitätenabfrage intern</title>
    <link rel="stylesheet" type="text/css" href="Kapazitätenstylesheet.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/header.css" media="screen" />
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>
<nav>
    <ul class="header">
        <li class="headerel"><a href="../StartseiteBetreiber.html" class ="headerel">Startseite</a></li>
        <li class="headerel"><a  class= "active" href="Angebotserstellung.php">Angebotserstellung</a></li>
        <li class="headerel"><a href="#">Abrechnung</a></li>
        <li class="headerel"><a href="Raumverwaltung.php">Raumverwaltung</a></li>
        <li class="headerel"><a href="#">Meine Veranstaltungen</a></li>
        <li class="headerel"><a href="#">Statistiken</a></li>
        <li class="headerel" style="float: right;"> <a href="#"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li class="headerel" style=float:right;"> <a href="#"  > <i class="fas fa-user-circle" ></i> </a></li>

    </ul>
</nav>

<div class="contact-us">
    <h1> Neue Überprüfung</h1>
    <!-- Fomular  mit Abfrage eines alternativen Start- und Enddatums um freie Kapazitäten zu überprüfen-->
    <h3>
        <em>&#x2a; </em> Bitte ein Startdatum und eine Dauer (maximal 7 Tage) angeben.<br>
        &nbsp;&nbsp;Startdatum muss mindesten einen Monat in der Zukunft liegen!
    </h3>

    <form action="kapazitäts_check.php" method="post">
        <label for="Startdatum">Startdatum <em>&#x2a;</em></label><input id="Startdatum" name="Startdatum" required="" type="date" min="0" maxlength="10"/>
        <label for="Dauer"> Dauer in Tagen <em>&#x2a;</em></label><input id="Dauer"  onclick="setDays()" name="Dauer" required="" type="number" min="1" max="7"/>
        <label for="Teilnehmerzahl">Teilnehmerzahl <em>&#x2a;</em></label><input id="Teilnehmerzahl" name="Teilnehmerzahl" required="" type="number" min="1"/>
        <!--Auswahlbuttons zum Abbrechen und Rückkehr zur Startseite oder Abfrage nach freien Raum Kapazitäten -->
        <!--  Startdatum muss mindestens einen Monat in der Zukunft liegen über Backend lösen?-->
        <button type="submit"  name="Kapazitätsprüfung3" class="Auslösen">Abfragen</button>
        <a href="#" class="Abbrechen" type="button" >Abbrechen</a>
    </form>
</body>
</html>
<script src="../js/Datum.js"></script>

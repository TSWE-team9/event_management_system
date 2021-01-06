
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kapazitätenabfrage für Anfrage</title>
    <link rel="stylesheet" type="text/css" href="Kapazitätenstylesheet.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/header.css" media="screen" />
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>

<nav>
    <ul class="header">
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

<div class="contact-us">
    <h1> Kapazitätenüberprüfung</h1>
    <!-- Fomular  mit Abfrage der gewünschten ID um freie Kapazitäten zu überprüfen-->
    <h3>
        <em>&#x2a; </em> Bitte gewünschte ID angeben  um eine Abfrage zu starten.
    </h3>

    <form action="kapazitäts_check.php" method="post">
        <label for="KapÜberprüfung">Angebots_ID <em>&#x2a;</em></label><input id="KapÜberprüfung" name="KapÜberprüfung" required="" type="number" min="0" maxlength="10"/>
        <!--Auswahlbuttons zum Abbrechen und Rückkehr zur Startseite oder Abfrage nach freien Raum Kapazitäten -->
        <button type="submit"  class="Auslösen"  name="Kapazitätsprüfung1">Abfragen</button>
        <a href="Angebotserstellung.php" class="Abbrechen" type="button" >Abbrechen</a>
    </form>
</body>
</html>

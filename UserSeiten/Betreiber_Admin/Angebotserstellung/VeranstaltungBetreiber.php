<?php include ("InterneVeranstaltungFunktion.php")?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Veranstaltung erstellen</title>
    <link rel="stylesheet" type="text/css" href="Kapazitätenstylesheet.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../header.css" media="screen" />
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>
<nav >
    <ul class="header" style="margin-bottom: 200px" >
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

<div class="contact-us" style="margin-top:8em ">
    <h1> Neue Veranstaltung</h1>
    <!-- Fomular Spalten -->
    <h3>
        <em>&#x2a; </em> Bitte alle Felder ausfüllen um eine neue Veranstaltung anzulegen.
    </h3>

    <form action="#" method="post" >
        <label for="Veranstaltungs-Titel">Veranstaltungs-Titel <em>&#x2a;</em></label><input id="Veranstaltungs-Titel" name="Veranstaltungs-Titel" required="" type="text"/>
        <label for="Uhrzeit">Uhrzeit des Veranstaltungsbeginns <em>&#x2a;</em></label><input id="Uhrzeit" name="Uhrzeit" type="time" min="08:00" max="18:00" />
        <label for="Zeitraum">An- und Abmeldezeitraum in Tagen <em>&#x2a;</em></label><input id="Zeitraum" name="Zeitraum" type="Number"  min="1" max="14"/>
        <label for="Teilnahmekosten">Teinahmekosten in Euro pro Teilnehmer<em>&#x2a;</em></label><input id="Teilnahmekosten" name="Teilnahmekosten" required="" type="Number"  min="0"/>
        <label for="Auswahl">Verabstaltungsart <em>&#x2a;</em></label>
        <div class="select-wrapper" style="margin-bottom: 3em">
        <select class="auswahl" name="Auswahl" id="Auswahl" style="background: none;">
            <option value="Veranstaltung">Veranstaltung</option>
            <option value="Seminar">Seminar</option>
            <option value="Vortrag">Vortrag</option>
            <option value="Optional">Optional</option>
        </select>
        </div>
        <fieldset id = "Verfügbarkeit"  style="margin-bottom: 24pt ">
            <label for = "Verfügbarkeit" > Verfügbarkeit <em>&#x2a;</em></label>
            <input type= "radio" id="offen" name="Verfügbarkeit" value="offen">
            <label for="offen"> offen</label>
            <input type="radio" id="geschlossen" name="Verfügbarkeit" value="geschlossen">
            <label for="geschlossen">geschlossen</label>
        </fieldset>
    <label for="Veranstaltungsbeschreibung">Veranstaltungsbeschreibung </label> <textarea  cols="40" rows="8" maxlength="300" id="Veranstaltungsbeschreibung" name="Veranstaltungsbeschreibung"> </textarea>
<!--       Buttons zum Anlegen der Veranstaltung oder Rückkehr zur Eigenen Veranstaltungsübersicht -->
        <button type="submit" class="Auslösen" name="Hinzufügen"> Erstellen</button>
        <a href="#" type="button" class="Abbrechen">Abrechen</a>


    </form>

</div>

</body>

</html>

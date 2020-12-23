<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KapazitätenabfrageAngebot2</title>
    <link rel="stylesheet" type="text/css" href="Raumformularstylesheet.css" media="screen" />
</head>
<body>

<div class="contact-us">
    <h1> Neue Überprüfung</h1>
    <!-- Fomular  mit Abfrage eines alternativen Start- und Enddatums um freie Kapazitäten zu überprüfen-->
    <h3>
        <em>&#x2a; </em> Bitte ein neues Startdatum angeben um einen Ersatztermin zu finden.<br>
        &nbsp;&nbsp;Startdatum muss mindesten einen Monat in der Zukunft liegen!
    </h3>

    <form action="kapazitäts_check.php" method="post">
        <label for="Startdatum">Startdatum <em>&#x2a;</em></label><input id="Startdatum" name="Startdatum" required="" type="date" min="0" maxlength="10"/>
        <!--Auswahlbuttons zum Abbrechen und Rückkehr zur Startseite oder Abfrage nach freien Raum Kapazitäten -->
        <!--  Startdatum muss mindestens einen Monat in der Zukunft liegen über Backend lösen?-->
        <button type="submit"  name="Kapazitätsprüfung2" class="Auslösen">Abfragen</button>
        <a href="#" class="Abbrechen" type="button" >Abbrechen</a>
    </form>
</body>
</html>
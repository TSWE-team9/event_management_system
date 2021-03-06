
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kapazitätenabfrage für Anfrage</title>
    <link rel="stylesheet" type="text/css" href="../style/Formular.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/header.css" media="screen" />
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include '../Header/header.php'; ?>
<script>document.getElementById("Reiter_Angebotserstellung").classList.add("active");  </script>

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

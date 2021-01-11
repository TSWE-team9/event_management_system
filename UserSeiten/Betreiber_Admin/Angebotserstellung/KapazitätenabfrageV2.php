<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kapazitätenabfrage Änderung</title>
    <link rel="stylesheet" type="text/css" href="Kapazitätenstylesheet.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/header.css" media="screen" />
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<nav>
    <ul class="header">
        <li class="headerel"><a href="../Startseiten/StartseiteBetreiber.html" class ="headerel">Startseite</a></li>
        <li class="headerel"><a class= "active" href="Angebotserstellung.php">Angebotserstellung</a></li>
        <li class="headerel"><a href="../Abrechnung">Abrechnung</a></li>
        <li class="headerel"><a  href="../Raumverwaltung/Raumverwaltung.php">Raumverwaltung</a></li>
        <li class="headerel"><a href="InterneVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li class="headerel"><a href="#">Statistiken</a></li>
        <li class="headerel" style="float: right;"> <a href="#"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li class="headerel" style=float:right;"> <a href="#"  > <i class="fas fa-user-circle" ></i> </a></li>


    </ul>
</nav>
<body>
<!--//Formular mit neuem eingabefenster für das Datum-->
<div class="contact-us">
    <h1> Neue Überprüfung</h1>
    <!-- Fomular  mit Abfrage eines alternativen Start- und Enddatums um freie Kapazitäten zu überprüfen-->
    <h3>
        &nbsp;&nbsp;&nbsp;Für den angegebenen Zeitraum konnte kein passender Raum gefunden werden.<br>
        <em>&#x2a; </em> Bitte ein neues Startdatum angeben um einen Ersatztermin zu finden.<br>
        &nbsp;&nbsp;Startdatum muss mindesten einen Monat in der Zukunft liegen!
    </h3>

    <form action="kapazitäts_check.php" method="post">
        <label for="Startdatum">Startdatum <em>&#x2a;</em></label><input id="Startdatum" name="Startdatum" required="" type="date" />
        <!--Auswahlbuttons zum Ablehnung der Anfrage oder Abfrage nach freien Raum Kapazitäten -->
        <button type='submit'  name='Kapazitätsprüfung2' class='Auslösen'>Abfragen</button>
        <?php

        if($_SESSION["Prüfungsart"] == 2){
            echo "<button type='submit'  name='Abbrechen' class='Abbrechen'>Überprüfung Abbrechen</button>";
        }
        elseif ($_SESSION["Prüfungsart"] == 1){
            echo "<button type='submit'  name='Ablehnen' class='Abbrechen'>Anfrage Ablehnen</button>";
        }
        ?>

    </form>
</body>
</html>
<script src="../js/Datum.js"></script>


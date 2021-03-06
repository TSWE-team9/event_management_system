<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kapazitätenabfrage Änderung</title>
    <link rel="stylesheet" type="text/css" href="../style/Formular.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/header.css" media="screen" />
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<?php include '../Header/header.php'; ?>
<script>document.getElementById("Reiter_Angebotserstellung").classList.add("active");  </script>

<body>
<!--//Formular mit neuem Eingabefenster für das Datum um eine ernuete Kpzitätenabfrage zu starten-->
<div class="contact-us">
    <h1> Neue Überprüfung</h1>
    <h3>
        &nbsp;&nbsp;&nbsp;Für den angegebenen Zeitraum konnte kein passender Raum gefunden werden.<br>
        <em>&#x2a; </em> Bitte ein neues Startdatum angeben um einen Ersatztermin zu finden.<br>
        &nbsp;&nbsp;Startdatum muss mindesten einen Monat in der Zukunft liegen!
    </h3>

    <form action="kapazitäts_check.php" method="post">
        <label for="Startdatum">Startdatum <em>&#x2a;</em></label><input id="Startdatum" name="Startdatum" required="" type="date" />
        <!--Button zur Abfrage nach freien Raum Kapazitäten -->
        <button type='submit'  name='Kapazitätsprüfung2' class='Auslösen'>Abfragen</button>
        <?php

        //Abbrechen Button wenn Betreiber eine Veranstaltung erstellt und dann abbricht
        if($_SESSION["Prüfungsart"] == 2){
            echo "<button type='submit'  name='Abbrechen' class='Abbrechen'>Überprüfung Abbrechen</button>";
        }
        //Ablehnen Button wenn Betreiber ein Angebot erstellt
        elseif ($_SESSION["Prüfungsart"] == 1){
            echo "<button type='submit'  name='Ablehnen' class='Abbrechen'>Anfrage Ablehnen</button>";
        }
        ?>

    </form>
</body>
</html>
<script src="../js/Datum.js"></script>


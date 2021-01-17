<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
    <link rel="stylesheet" type="text/css" href="../style/header.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/Kapazitätenstylesheet.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/TabellenRaum.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="seminarstatistik.css" media="screen" />
    <title>Seminarstatistik</title>
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include '../Header/header.php'; ?>
<script>document.getElementById("Reiter_Angebotserstellung").classList.add("active");  </script>
<div class="grid-container">
    <div class="grid-item"
<form>
    <div class="contact-us" >
        <h1> Seminarstatistik</h1>
        <!-- Fomular Spalten -->
        <h3>
            <em>&#x2a; </em> Bitte den gewünschten Veranstalter und Zeitraum auswählen um eine Abfrage zu starten .
        </h3>
<!--        Hier abfragen aller möglichen Veranstalter oder auch einfach auswahl aller Veranstalter-->
        <label for="Auswahl">Veranstalter <em>&#x2a;</em></label>
        <div class="select-wrapper" style="margin-bottom: 3em; width:auto;">
        <select class="auswahl" name="Auswahl" id="Auswahl" style="background: none;">
            <option value="Veranstalter"></option>
        </select>
        </div>
        <label for="Startzeitraum">Startzeitraum <em>&#x2a;</em></label><input id="Startzeitraum" name="Startzeitraum" required="" type="date"/>
        <label for="Endzeitraum">Endzeitraum <em>&#x2a;</em></label><input id="Endzeitraum" name="Endzeitraum" required="" type="date"/>
<!---->
<!--        <label for="Auswahl">Startzeitraum <em>&#x2a;</em></label>-->
<!--            <select class="auswahl" name="Auswahl" id="Auswahl" style="background: none;">-->
<!--                <option value="Januar">Januar</option>-->
<!--                <option value="Februar">Februar</option>-->
<!--                <option value="März">März</option>-->
<!--                <option value="April">April</option>-->
<!--                <option value="Mai">Mai</option>-->
<!--                <option value="Juni">Juni</option>-->
<!--                <option value="Juli">Juli</option>-->
<!--                <option value="August">August</option>-->
<!--                <option value="September">September</option>-->
<!--                <option value="Oktober">Oktober</option>-->
<!--                <option value="November">November</option>-->
<!--                <option value="Dezember">Dezember</option>-->
<!--            </select>-->
<!--        <div class="select-wrapper">-->
<!--                <label for="Auswahl">Endzeitraum <em>&#x2a;</em></label>-->
<!--                <select class="auswahl" name="Auswahl" id="Auswahl" style="background: none; margin-bottom: 1em; ">-->
<!--                    <option value="Januar">Januar</option>-->
<!--                    <option value="Februar">Februar</option>-->
<!--                    <option value="März">März</option>-->
<!--                    <option value="April">April</option>-->
<!--                    <option value="Mai">Mai</option>-->
<!--                    <option value="Juni">Juni</option>-->
<!--                    <option value="Juli">Juli</option>-->
<!--                    <option value="August">August</option>-->
<!--                    <option value="September">September</option>-->
<!--                    <option value="Oktober">Oktober</option>-->
<!--                    <option value="November">November</option>-->
<!--                    <option value="Dezember">Dezember</option>-->
<!--                </select>-->
<!--            <label for="Auswahl">Jahr <em>&#x2a;</em></label>-->
<!--            <select class="auswahl" name="Auswahl" id="Auswahl" style="background: none;">-->
<!--                <option value=""> 2020</option>-->
<!--                <option value=""> 2021</option>-->
<!--                <option value=""> 2022</option>-->
<!--            </select>-->
<!--        </div>-->
        <button type="submit" class="Auslösen" name="Hinzufügen" style="margin-top: 0"> Abfragen</button>
        </div>



</form>




</div>


    <div class="grid-item">
    <table class="container">
        <thead style="color: black; z-index: 6">
        <tr>
        <th>Veranstalter</th>
        <th>offen</th>
        <th>geschlossen</th>
        <th>durschnittlicher Preis</th>
        <th>Anzahl der bisherigen Veranstaltungen</th>
        <th>Gesamte Teilnehmer</th>
        </tr>
        </thead>

    <tbody>

<!--Einfügen der Daten in die Tabelle -->

<!--    Aufsummierung der offenen und geschlossenen Veranstaltungen -->
<!-- Durschnittlicher Preis der Veranstaltung eines Veranstalter -->
    <!-- Wie viele Veranstaltungen hat der Veranstalter bisher durchgefüht, also auch laufende Veranstaltungen, aber nicht die stonierten -->
    <!-- Wie viele Teilnehmer gab es insgesamt bei diesem Veranstalter-->

    </tbody>
    </table>
    </div>
</div>
</body>
</html>
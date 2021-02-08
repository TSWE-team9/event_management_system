<?php echo
'<nav>
    <ul>
        <li><a id="reiter_startseite" href="../Startseite/TeilnehmerStartseite.php">Startseite</a></li>
        <li><a id="reiter_angebot" href="../anzeigenAngebot/TeilnehmerAngebot.php">Veranstaltungsangebot</a></li>
        <li><a id="reiter_veranstaltungen" href="../angemeldeteVeranstaltungen/TeilnehmerVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li style="float: right;"> <a id="reiter_logout" href="../../logout.php"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li style="float: right;"> <a id="reiter_daten" href="../Datenänderung/TeilnehmerDatenänderung.php"> <i class="fas fa-user-circle"></i> </a></li>
    </ul>
</nav>';

/* Die Reiterleiste ist als eine ungeordnete Liste aufgebaut, die einzelnen Listenelemente enthalten dabei die einzelnen Reiter
    die Reiter sind dabei jeweils eine Weiterleitung zu:
    1. Startseite
    2. Veranstaltungsangebot
    3. Anzeige angemeldeter Veranstaltungen
    4. Datenänderung
    5. Logout Funktion
*/
?>

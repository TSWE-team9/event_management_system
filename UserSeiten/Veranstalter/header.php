<?php echo
'<nav>
    <ul>
        <li><a id="reiter_startseite" href="../Startseite/VeranstalterStartseite.php">Startseite</a></li>
        <li><a id="reiter_anfrage" href="../erstellenAnfrage/VeranstalterAnfrage.php">Angebot einholen</a></li>
        <li><a id="reiter_veranstaltungen" href="../eigeneVeranstaltungen/VeranstalterVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li style="float: right;"> <a id="reiter_logout" href="../../logout.php"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li style="float: right;"> <a id="reiter_daten" href="../Datenänderung/VeranstalterDatenänderung.php"> <i class="fas fa-user-circle"></i> </a></li>
    </ul>
</nav>';

/* Die Reiterleiste ist als eine ungeordnete Liste aufgebaut, die einzelnen Listenelemente enthalten dabei die einzelnen Reiter
    die Reiter sind dabei jeweils eine Weiterleitung zu:
    1. Startseite
    2. Anfrageseite
    3. Anzeige eigener Veranstaltungen
    4. Datenänderung
    5. Logout Funktion
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../CSS/listen.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/veranstaltungen.css">
    <title>Veranstaltung</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>
<nav>
    <ul>
        <li><a href="../Startseite/VeranstalterStartseite.php">Startseite</a></li>
        <li><a href="../erstellenAnfrage/VeranstalterAnfrage.php">Angebot einholen</a></li>
        <li><a href="#">Kontakt</a></li>
        <li><a href="#">Hilfe</a></li>
        <li><a class="active" href="../eigeneVeranstaltungen/VeranstalterVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li style="float: right;"> <a href="../../logout.php"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li style="float: right;"> <a href="../Datenänderung/VeranstalterDatenänderung.php"> <i class="fas fa-user-circle"></i> </a></li>
    </ul>
</nav>

<div class="container-50-outer">
    <h1 class="hdln">#Veranstaltungstitel#</h1><!--TODO-->

    <!--SQL Abfrage-->
    <!--if keine Teilnehmer-->
    <p class="txt">Zu dieser Veranstaltung sind noch keine Teilnehmer angemeldet.</p>
    <!--if Ende-->
    <!--else Teilnehmer angemeldet-->
    <p class="txt">Zu dieser Veranstaltung sind #teilnehmeranzahl# von maximal #maximale teilnehmeranzahl# angemeldet.</p>

    <div class="container-80-inner">
        <div class="row">
            <div class="col-50">Nachname</div>
            <div class="col-50">Vorname</div>
        </div>
        <!--foreach Schleife Beginn-->
        <div class="row">
            <div class="col-50">#nachname#</div><!--TODO-->
            <div class="col-50">#vorname#</div><!--TODO-->
        </div>
        <!--foreach Schleife Ende-->
    </div>

    <div style="width: 80%; margin: auto; margin-top: 20px">
        <form action="#" method="post">
            <input type="hidden" id="anzahl" value="#teilnehmeranzahl#"><!--TODO-->
            <!--foreach Schleife Beginn-->
            <input type="hidden" id="#counter#" value="#nachname# {leerzeichen} #vorname#"><!--TODO-->
            <!--foreach Schleife Ende-->
            <button class="btn" style="float: right;" type="button" onclick="tolleJavaScriptFunktion()">Teilnehmerliste ausgeben</button>
        </form>
        <!--else Ende-->

        <!--Button um zur Veranstaltungsseite zurückzukehren-->
        <form action="../../Veranstaltungsseite/VeranstaltungsSeite.php" method="post">
            <input type="hidden" name="veranstaltung_id" value="#v_id#"><!--TODO V_ID-->
            <button type="submit" class="btn" name="veranstaltung">zurück zur Veranstaltung</button> 
        </form>
    </div>
</div>

<script src="SeiteTeilnehmerliste.js"></script>

</body>
</html>
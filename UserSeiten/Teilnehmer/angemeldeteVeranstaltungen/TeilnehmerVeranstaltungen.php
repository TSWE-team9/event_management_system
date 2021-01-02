<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../CSS/listen.css">

    <title>Angemeldete Veranstaltungen</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>
<nav>
    <ul>
        <li><a href="../Startseite/TeilnehmerStartseite.php">Startseite</a></li>
        <li><a href="../anzeigenAngebot/TeilnehmerAngebot.php">Veranstaltungsangebot</a></li>
        <li><a href="#">Kontakt</a></li>
        <li><a href="#">Hilfe</a></li>
        <li><a class="active" href="TeilnehmerVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li style="float: right;"> <a href="../../logout.php"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li style="float: right;"> <a href="../Datenänderung/TeilnehmerDatenänderung.php"> <i class="fas fa-user-circle"></i> </a></li>

    </ul>
</nav>

<div class="container-50-outer">
    <h1 class="hdln">Angemeldete Veranstaltungen</h1>

    <!--TODO-->
    <!--SQL Abfrage-->
    <!--if else-->
    <!--if keine Veranstaltungen gefunden-->
    <p class="txt">Sie sind zur Zeit zu keinen Veranstaltungen angemeldet.</p>
    <!--else Veranstaltungen gefunden-->
    <!--foreach Schleife Beginn-->
    <form action="../../VeranstaltungsSeite.php" method="post">
        <input type="hidden" name="veranstaltung_id" value="#id#">
        <button type="submit" class="btnveranstaltung"><div class="btnbeginn">#beginn#</div><div class="btntitel">#titel#</div></button>
    </form> 
    <!--foreach Schleife Ende-->
</div>

</body>
</html>
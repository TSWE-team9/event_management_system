<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../CSS/listen.css">
    <title>Veranstaltungsangebot</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>
<nav>
    <ul>
        <li><a class="active" href="Veranstaltungsangebots.php">Veranstaltungsangebot</a></li>
        <li><a href="#">Kontakt</a></li>
        <li><a href="#">Hilfe</a></li>
        <li style="float: right;"> <a href="../../LandingPage/index.php">zur Anmeldung</a></li>

    </ul>
</nav>

<div class="container-50-outer">
    <h1 class="hdln">Aktuelles Angebot</h1>

    <!--TODO-->
    <!--SQL Abfrage-->
    <!--if else-->
    <!--if keine Veranstaltungen gefunden-->
    <p class="txt">Es werden zur Zeit keinen Veranstaltungen angeboten zu denen Sie sich anmelden können.</p>
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
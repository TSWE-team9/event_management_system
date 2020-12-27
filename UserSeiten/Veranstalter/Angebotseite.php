!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../listtabs.css">
    <link rel="stylesheet" type="text/css" href="./angebot.css">
    <title>Meine Veranstaltungen</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>
<nav>
    <ul>
        <li><a href="VeranstalterStartseite.php">Startseite</a></li>
        <li><a href="VeranstalterAnfrage.php">Angebot einholen</a></li>
        <li><a href="#">Kontakt</a></li>
        <li><a href="#">Hilfe</a></li>
        <li><a class="active" href="VeranstalterVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li style="float: right;"> <a href="../logout.php"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li style="float: right;"> <a href="VeranstalterDatenänderung.php"> <i class="fas fa-user-circle"></i> </a></li>

    </ul>
</nav>

<div class="container">
    <div class="row">
        <div class="col-25">Teilnehmerzahl</div>
        <div class="col-75">#Teilnehmerzahl#</div>
    </div>
    <div class="row">
        <div class="col-25">Veranstaltungsbeginn</div>
        <div class="col-75">#Datum#</div>
    </div>
    <div class="row">
        <div class="col-25">Veranstaltungsdauer</div>
        <div class="col-75">#Dauer#</div>
    </div>
    <div class="row">
            <div class="col-25">Anmerkungen</div>
            <div class="col-75">#Anmerkungen#</div>
    </div>
    <div class="row">
            <div class="col-25">Preis</div>
            <div class="col-75">#Preis#</div>
    </div>
    <div class="row">
        <div class="col-33">
            <button class="btnanfrage" type="submit" name="anfrage">Anfrage abschicken</button>
        </div>
    </div>
</div>

</body>
</html>
!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="./anfrage.css">
    <title>Title</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>
<nav>
    <ul>
        <li><a href="VeranstalterStartseite.php">Startseite</a></li>
        <li><a class="active" href="VeranstalterAnfrage.php">Angebot einholen</a></li>
        <li><a href="#">Kontakt</a></li>
        <li><a href="#">Hilfe</a></li>
        <li><a href="VeranstalterVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li style="float: right;"> <a href="../logout.php"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li style="float: right;"> <a href="VeranstalterDatenänderung.php"> <i class="fas fa-user-circle"></i> </a></li>

    </ul>
</nav>

<h1>Anfrageformular für Veranstaltung</h1>
<p>Beschreibung Formular</p>

<!-- Anfrageformular -->
<div class="container">
    <form action="#" method="post">
        <div class="row">
            <div class="col-25">
                <label for="teilnehmerzahl">Teilnehmerzahl</label>
            </div>
            <div class="col-75">
                <input type="text" placeholder="geplante Teilnehmerzahl" name="teilnehmerzahl" pattern="[0-9]{1,50}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="beginn">Veranstaltungsbeginn</label>
            </div>
            <div class="col-75">
                <input type="date" name="date" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="dauer">Veranstaltungsdauer</label>
            </div>
            <div class="col-75">
                <input type="number" name="dauer" min="1" max="7" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="anmerkungen">Anmerkungen</label>
            </div>
            <div class="col-75">
                <textarea name="subject" id="subject" placeholder="Anmerkungen" cols="30" rows="10" maxlength="300"></textarea>
            </div>
        </div>
        <div class="row">
            <button class="btnanfrage" type="submit" name="anfrage">Anfrage abschicken</button>
        </div>
    </form>
</div>

<!--<footer>
   <div>
       <a href="#">Impressum</a>
        <a href="#">AGB</a> <br>
   VMS
  < /div>
</footer>-->

<div class="footer">
    <div id="button"></div>
    <div id="container">
        <div id="cont">
            <!--         <div class="footer_center">-->
            <!--                <h3>VMS</h3>-->
            <!--             <a href="AGB">AGB </a>-->
            <a class ="impressum " href="#"> Impressum </a>
            <a class ="agb"   href="#">AGB</a>

            <!-- agb col-xs-12 col-sm-3 col-sm-pull-6 -->
        </div>

    </div>
</div>


</body>
</html>
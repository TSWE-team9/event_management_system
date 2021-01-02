<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../CSS/listen.css">
    
    <title>Startseite</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>
<nav>
    <ul>
        <li><a class="active" href="VeranstalterStartseite.php">Startseite</a></li>
        <li><a href="../erstellenAnfrage/VeranstalterAnfrage.php">Angebot einholen</a></li>
        <li><a href="#">Kontakt</a></li>
        <li><a href="#">Hilfe</a></li>
        <li><a href="../eigeneVeranstaltungen/VeranstalterVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li style="float: right;"> <a href="../../logout.php"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li style="float: right;"> <a href="../Datenänderung/VeranstalterDatenänderung.php"> <i class="fas fa-user-circle"></i> </a></li>

    </ul>
</nav>

<div class="container-50-outer">

    <div class="container-80-inner">
        <h2 class="hdln">laufende Veranstaltungen</h2>

        <!--TODO-->
        <!--SQL Abfrage-->
        <!--if else-->
        <!--if keine Veranstaltungen gefunden-->
        <p class="txt">Sie haben derzeit keine laufenden Veranstaltungen.</p>
        <!--else Veranstaltungen gefunden-->
        <!--foreach Schleife Beginn max 3 Veranstaltungen-->
        <form action="../../VeranstaltungsSeite.php" method="post">
            <input type="hidden" name="veranstaltung_id" value="#id#">
            <button type="submit" class="btnveranstaltung"><div class="btnbeginn">#beginn#</div><div class="btntitel">#titel#</div></button>
        </form> 
        <!--foreach Schleife Ende-->
    </div>

    <br><br><br>

    <div class="container-80-inner">
        <h2 class="hdln">Angebote</h2>

        <!--TODO-->
        <!--SQL Abfrage-->
        <!--if else-->
        <!--if keine Veranstaltungen gefunden-->
        <p class="txt">Sie haben derzeit keine Angebote des Betreibers.</p>
        <!--else Veranstaltungen gefunden-->
        <!--foreach Schleife Beginn max 3 Veranstaltungen-->
        <form action="../../VeranstaltungsSeite.php" method="post">
            <input type="hidden" name="veranstaltung_id" value="#id#">
            <button type="submit" class="btnveranstaltung"><div class="btnbeginn">#beginn#</div><div class="btntitel">#titel#</div></button>
        </form> 
        <!--foreach Schleife Ende-->
    </div>
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raumverwaltung</title>
    <link rel="stylesheet" type="text/css" href="../../CSS/Startseite.css" media="screen">
    <link rel="stylesheet" type="text/css" href="Raumverwaltung.css" media="screen" />
</head>
<body>
<nav>
<ul>
    <li><a class= "active" href="#">Startseite</a></li>
    <li><a href="#">Angebotserstellung</a></li>
    <li><a href="#">Abrechnung</a></li>
    <li><a href="#">Raumverwaltung</a></li>
    <li><a href="#">Meine Veranstaltungen</a></li>
    <li><a href="#">Statistiken</a></li>
    <li style="text-align: right"> <a href="#"> <i class="fas fa-sign-out-alt"></i> </a></li>
    <li > <a href="#"> <i class="fas fa-user-circle"></i> </a></li>

</ul>
</nav>
<div id="wrapper">
    <div id="content">

    </div>
</div>


 <h1> Raumverwaltung</h1>
<!--Tabelle mit allen Räumen und ihren Eigenschaften-->
<table class="container">
    <thead>
    <tr>
        <th><h2>RaumID</h2></th>
        <th><h2>Raumbezeichnung</h2></th>
        <th><h2>Raumkapazität</h2></th>
        <th><h2>Preis pro Tag</h2></th>
        <th><h2>Raumstatus</h2></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>PhpCode</td>
        <td>PhpCode</td>
        <td>PhpCode</td>
        <td>PhpCode</td>
        <td>PhpCode</td>
    </tr>
    </tbody>
</table>
<!--Buttons um Funktionen zur Raumverwaltung ausführen zu können-->
<a href="raumdaten_ändern.php" id="Hinzufügen" style="float: right" type="button" class="Button">Raum Hinzufügen &#10010</a>
<a href="raumdaten_ändern.php" id="Löschen"style="float: left" type="button" class="Button">Raum Löschen &#10006</a>
<a href="raumdaten_ändern.php"style="position: center" id="Ändern"type="button" class="Button">Raumdaten ändern &#9998</a>

<!--<button style="float: right"  type="submit" class="Button" formaction="raum_erstellen.php"> Raum Hinzufügen &#10010</button>-->
<!--<button style="float: left" type="submit" class="Button" formaction="Raumlöschen.php">Raum Löschen &#10006</button>-->
<!--<button  type="submit" class="Button" formaction="raumdaten_ändern.php">Raumdaten ändern &#9998</button>-->
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


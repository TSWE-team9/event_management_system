<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raumverwaltung</title>
 <link rel="stylesheet" type="text/css" href="Startseite.css" media="screen">!
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

<?php
//Zugangsdaten zur Datenbank
$host = '132.231.36.109';
$db = 'vms_db';
$user = 'dbuser';
$pw = 'dbuser123';

$conn = new mysqli($host, $user, $pw, $db,3306);

if($conn->connect_error){
    die('Connect Error (' . $conn->connect_errno . ') '
        . $conn->connect_error);
}

$res = $conn->query("SELECT R_ID, Bezeichnung, Kapazitaet, Preis, Status FROM Raum");

?>

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
    <?php
    while($i = $res->fetch_row()){
        echo "<tr>";
        foreach($i as $item){
            echo "<td>$item</td>";
        }
        echo"</tr>";
    }
    ?>
    </tbody>
</table>
<!--Buttons um Funktionen zur Raumverwaltung ausführen zu können-->
<button style="float: right"  type="submit" class="Button" formaction="raum_erstellen.php"> Raum Hinzufügen &#10010</button>
<button style="float: left" type="submit" class="Button" formaction="Raumlöschen.php">Raum Löschen &#10006</button>
<button  type="submit" class="Button" formaction="raumdaten_ändern.php">Raumdaten ändern &#9998</button>
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


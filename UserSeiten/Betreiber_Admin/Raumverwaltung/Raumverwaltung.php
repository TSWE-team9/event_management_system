<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raumverwaltung</title>
    <link rel="stylesheet" type="text/css" href="../style/header.css" media="screen">
    <link rel="stylesheet" type="text/css" href="TabellenRaum.css" media="screen">
    <link rel="stylesheet" type="text/css" href="Raumverwaltung.css" media="screen" />
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>

<nav>
    <ul class="header">
        <li class="headerel"><a href="../StartseiteBetreiber.html" class ="headerel">Startseite</a></li>
        <li class="headerel"><a class= "active" href="../Angebotserstellung/Angebotserstellung.php">Angebotserstellung</a></li>
        <li class="headerel"><a href="../Abrechnung/AbrechnungsSeite.php">Abrechnung</a></li>
        <li class="headerel"><a  href="../Raumverwaltung/Raumverwaltung.php">Raumverwaltung</a></li>
        <li class="headerel"><a href="../Angebotserstellung/InterneVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li class="headerel"><a href="#">Statistiken</a></li>
        <li class="headerel" style="float: right;"> <a href="#"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li class="headerel" style=float:right;"> <a href="#"  > <i class="fas fa-user-circle" ></i> </a></li>

    </ul>
</nav>
<!--<div id="wrapper">-->
<!--    <div id="content">-->
<!---->
<!--    </div>-->
<!--</div>-->

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

 <h1 > Raumverwaltung</h1>
<!--Tabelle mit allen Räumen und ihren Eigenschaften-->
<div class="wrapper">
<table class="container" style="margin: 0">
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
</div>
<!--Buttons um Funktionen zur Raumverwaltung ausführen zu können-->

<a href="Raumlöschen.php"  class="Klick" type="button" >Raum Löschen &#10006</a>
<a href="raumdaten_ändern.php" class="Klick" type="button" >Raumdaten ändern &#9998</a>
<a href="raum_erstellen.php"  class="Klick"  type="button" >Raum Hinzufügen &#10010</a>

</body>


</html>


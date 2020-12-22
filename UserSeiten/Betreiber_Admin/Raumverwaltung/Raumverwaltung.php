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
    <li><a  href="#">Startseite</a></li>
    <li><a href="#">Angebotserstellung</a></li>
    <li><a href="#">Abrechnung</a></li>
    <li><a class= "active" href="#">Raumverwaltung</a></li>
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
<a href="Raumlöschen.php"  id="Löschen" type="button" class="Button">Raum Löschen &#10006</a>
<a href="raumdaten_ändern.php" id="Ändern" type="button" class="Button">Raumdaten ändern &#9998</a>
<a href="raum_erstellen.php"  id="Hinzufügen"  type="button" class="Button">Raum Hinzufügen &#10010</a>

</body>


</html>


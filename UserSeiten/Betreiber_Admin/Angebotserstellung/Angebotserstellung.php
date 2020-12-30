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

//TODO: Auskommentieren nach Merge; Refresh der Angebote (Status)
//include "../../UserSeiten/angebot_refresh.php";
//angebot_refresh();

$query = "SELECT BeAr_ID, Veranstalter, Beginn, Dauer FROM Anfrage_Angebot WHERE Status = 1 ORDER BY Beginn";
$res = $conn->query($query);
if($res->num_rows == 0){
    echo "Bei der Abfrage der Anfragen ist ein Fehler aufgetreten";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kapazitätenabfrage für Anfrage</title>

    <link rel="stylesheet" type="text/css" href="../Angebotserstellung.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="Kapazitätenstylesheet.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../header.css" media="screen" />
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>

<nav>
    <ul class="header">
        <li class="headerel"><a href="../StartseiteBetreiber.html" class ="headerel">Startseite</a></li>
        <li class="headerel"><a class= "active" href="#">Angebotserstellung</a></li>
        <li class="headerel"><a href="#">Abrechnung</a></li>
        <li class="headerel"><a  href="../Raumverwaltung/Raumverwaltung.php">Raumverwaltung</a></li>
        <li class="headerel"><a href="#">Meine Veranstaltungen</a></li>
        <li class="headerel"><a href="#">Statistiken</a></li>
        <li class="headerel" style="float: right;"> <a href="#"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li class="headerel" style=float:right;"> <a href="#"  > <i class="fas fa-user-circle" ></i> </a></li>

    </ul>
</nav>

<table class="container">
    <thead>
    <tr>
        <th><h2>Angebots_ID</h2></th>
        <th><h2>Veranstalter_ID</h2></th>
        <th><h2>Gepl. Beginn</h2></th>
        <th><h2>Gepl. Dauer</h2></th>
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


<a href="KapazitätenabfrageV1.php" class="Auslösen" type="button" >Überprüfen</a>
</body>
</html>
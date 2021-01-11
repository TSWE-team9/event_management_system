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

//Refresh der Angebote (Status)
include "../../angebot_refresh.php";
angebot_refresh();

$query = "SELECT BeAr_ID, Veranstalter, Beginn, Dauer, Teilnehmer_gepl FROM Anfrage_Angebot WHERE Status = 1 ORDER BY Beginn";
$res = $conn->query($query);
if($res->num_rows == 0){
//    Fehlermeldung wenn die Abfrage nicht funktioniert 
    echo "<div class='overlay'>" ;
    echo  "<div class='popup'>";
    echo "<h2>Info</h2>" ;
    echo "<a class='close' href='../Startseiten/StartseiteBetreiber.html'>&times;</a>" ;
    echo "<div class='content' >" , 'Es existieren derzeit keine unbearbeiteten Anfragen ';
    echo "</div>";
    echo "</div>" ;
    echo "</div>" ;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kapazitätenabfrage für Anfrage</title>

    <link rel="stylesheet" type="text/css" href="../Angebotserstellung.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="Kapazitätenstylesheet.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/header.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/Fehlermeldung.css" media="screen" />
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>

<nav>
    <ul class="header">
        <li class="headerel"><a href="../Startseiten/StartseiteBetreiber.html" class ="headerel">Startseite</a></li>
        <li class="headerel"><a class= "active" href="Angebotserstellung.php">Angebotserstellung</a></li>
        <li class="headerel"><a href="../Abrechnung">Abrechnung</a></li>
        <li class="headerel"><a  href="../Raumverwaltung/Raumverwaltung.php">Raumverwaltung</a></li>
        <li class="headerel"><a href="InterneVeranstaltungen.php">Meine Veranstaltungen</a></li>
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
        <th><h2>Gepl. Teilnehmerzahl</h2></th>
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
<?php
session_start();

//Verbindung zur Datenbank herstellen
$host = '132.231.36.109';
$db = 'vms_db';
$user = 'dbuser';
$pw = 'dbuser123';
$conn = new mysqli($host, $user, $pw, $db,3306);

//Überprüfen ob es einen Verbindungsfehler gab
if($conn->connect_error){
    die('Connect Error (' . $conn->connect_errno . ') '
        . $conn->connect_error);
}

//Aktualisieren Veranstaltungen (Status)
include "../veranstaltung_refresh.php";
veranstaltung_refresh();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <!--Importierung ausgelagerter CCS Dateien-->
    <link rel="stylesheet" type="text/css" href="../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../CSS/listen.css">

    <title>Veranstaltungsangebot</title>

    <!--Importierung einer externen JavaScript Bibliothek für Reitericons in der Reiterleiste-->
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>

<!--body der Seite mit Hintergrundbild 2-->
<body class="background2">
<nav>
    <ul>
        <!--Reiterleiste der Seite
            Reiter für Veranstaltungsangebot (Neuladen der Seite) und Landing Page Weiterleitung-->
        <li><a class="active" href="Veranstaltungsangebot.php">Veranstaltungsangebot</a></li>
        <li style="float: right;"> <a href="../../LandingPage/index.php">zur Anmeldung</a></li>
    </ul>
</nav>

<div class="container-50-outer">
    <h1 class="hdln">Aktuelles Angebot</h1>

    <?php
    //Abfrage aller aktiven (Status = 1) Veranstaltungen
    $query1 = "SELECT V_ID, Beginn, Titel FROM Veranstaltung WHERE Status = 1 AND Verfügbarkeit = 1 AND Teilnehmer_akt != Teilnehmer_max ORDER BY Beginn";
    $res1 = $conn->query($query1);
    if($res1->num_rows == 0){
        echo "<p class='txt'>Es werden zur Zeit keine Veranstaltungen angeboten, zu denen Sie sich anmelden können</P>";
    }

    //Ausgabe der Abfrage in HTML
    else {
    while($i = $res1->fetch_row()){

    ?>

    <!--Anzeige aller gefundenen Veranstaltungen 
        Anzeige in Form von klickbaren Buttons, beim Anklicken des Buttons wird die v_id der geklickten Veranstaltung übergeben und die Veranstaltungsseite aufgerufen-->
    <form action="../Veranstaltungsseite/VeranstaltungsSeite.php" method="post">
        <input type="hidden" name="veranstaltung_id" value="<?php echo $i[0];?>">
        <button type="submit" class="btnveranstaltung" name="veranstaltung"><div class="btnbeginn"><?php echo "Beginn: ". $i[1]?></div><div class="btntitel"><?php echo $i[2]?></div></button>
    </form>
    <?php }} ?>
</div>

</body>
</html>
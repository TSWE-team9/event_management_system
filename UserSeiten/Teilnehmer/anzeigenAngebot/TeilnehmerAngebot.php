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

//Aktualisieren der Veranstaltungen (Status)
include "../../veranstaltung_refresh.php";
veranstaltung_refresh();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!--Importierung ausgelagerter CCS Dateien-->
    <link rel="stylesheet" type="text/css" href="../../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../CSS/listen.css">
    <title>Veranstaltungsangebot</title>

    <!--Importierung einer externen JavaScript Bibliothek für Reitericons in der Reiterleiste-->
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>

<!--body der Seite mit Hintergrundbild 3-->
<body class="background3">

<!--Importierung der ausgelagerten Reiterleiste und stylen des aktuellen Reiters mit der CSS Klasse 'active'-->
<?php include '../header.php';?>
<script>document.getElementById("reiter_angebot").classList.add("active");</script>

<div class="container-50-outer">
    <h1 class="hdln">Aktuelles Angebot</h1>

    <!--SQL Abfrage aller offenen Veranstaltungen die noch buchbar sind-->
    <?php
    $query = "SELECT V_ID, Beginn, Titel FROM Veranstaltung WHERE Status = 1 AND Verfügbarkeit = 1 AND Teilnehmer_akt != Teilnehmer_max ORDER BY Beginn";
    $res = $conn->query($query);

    //Wenn nichts gefunden
    if($res->num_rows == 0){
        echo "<p class='txt'>Es werden zur Zeit keinen Veranstaltungen angeboten zu denen Sie sich anmelden können.</p>";
    }
    else{
        while($i = $res->fetch_row()){

    ?>

    <!--Anzeige aller gefundenen Veranstaltungen 
        Anzeige in Form von klickbaren Buttons, beim Anklicken des Buttons wird die v_id der geklickten Veranstaltung übergeben und die Veranstaltungsseite aufgerufen-->
    <form action="../../Veranstaltungsseite/VeranstaltungsSeite.php" method="post">
        <input type="hidden" name="veranstaltung_id" value="<?php echo $i[0]; ?>">
        <button type="submit" class="btnveranstaltung" name="veranstaltung"><div class="btnbeginn"><?php echo "Beginn: " . $i[1]; ?></div><div class="btntitel"><?php echo $i[2]; ?></div></button>
    </form> 
    <?php }} ?>
</div>

</body>
</html>
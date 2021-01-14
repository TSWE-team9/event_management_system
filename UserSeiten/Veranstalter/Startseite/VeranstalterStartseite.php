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

//Aktualisieren der Angebote und Veranstaltungen (Status)
include "../../angebot_refresh.php";
include "../../veranstaltung_refresh.php";
angebot_refresh();
veranstaltung_refresh();

//Variablen
$B_ID = $_SESSION["b_id"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../CSS/listen.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/Footer.css">
    
    <title>Startseite</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body class="background2">
<?php include '../header.php';?>
<script>document.getElementById("reiter_startseite").classList.add("active");</script>
<br><br><br>

<div class="container-50-outer">

    <div class="container-80-inner">
        <h2 class="hdln">laufende Veranstaltungen</h2>

        <?php
        //Abfrage aller begonnenen (Status = 2) Veranstaltungen des Veranstalters
        $query1 = "SELECT V_ID, Beginn, Titel FROM Veranstaltung WHERE Veranstalter = $B_ID AND Status = 2";
        $res1 = $conn->query($query1);
        $counter = 0;
        if($res1->num_rows == 0){
            echo "<p class='txt'>Sie haben derzeit keine laufenden Veranstaltungen</P>";
        }

        //Ausgabe der Abfrage in HTML
        else {
        while($i = $res1->fetch_row()){
            if($counter == 4){
            break;
            }

        ?>

        <form action="../../Veranstaltungsseite/VeranstaltungsSeite.php" method="post">
            <input type="hidden" name="veranstaltung_id" value="<?php echo $i[0];?>">
            <button type="submit" class="btnveranstaltung" name="veranstaltung"><div class="btnbeginn"><?php echo "Beginn: ". $i[1]?></div><div class="btntitel"><?php echo $i[2]?></div></button>
        </form>
        <?php }} ?>
    </div>

    <br><br><br>

    <div class="container-80-inner">
        <h2 class="hdln">Angebote</h2>

        <?php
        //Abfrage aller bearbeiteten und geänderten Anfragen (Angeboten) des angemeldeten Veranstalters
        $query4 = "SELECT BeAr_ID, Beginn, Angebotsdatum FROM Anfrage_Angebot WHERE Veranstalter = $B_ID AND Status IN (2, 3)";
        $res4 = $conn->query($query4);
        $counter = 0;
        if($res4->num_rows == 0){
            echo "<p class='txt'>Sie haben derzeit keine Angebote des Betreibers</P>";
        }

        else{
        while($i = $res4->fetch_row()){
            if($counter == 4){
            break;
            }

        ?>
            <form action="../eigeneVeranstaltungen/Angebot/Angebotseite.php" method="post">
                <input type="hidden" name="angebot_id" value="<?php echo $i[0];?>">
                <button type="submit" class="btnveranstaltung" name="Angebotsseite"><?php echo "Angebotsdatum: ". $i[2] . " / Geplanter Beginn: ". $i[1]?></button>
            </form>
        <?php }}?>
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

            <a class ="impressum " href="../footer/Impressum.php"> Impressum </a>
            <a class ="agb"   href="../footer/AGB.php">AGB</a>
        <h3>Herzlich Willkommen im VMS der Gruppe 9 </h3>



    </div>
</div>


</body>
</html>
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
include "../../veranstaltung_refresh.php";
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
    
    <title>Startseite</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include 'header.php';?>
<script>document.getElementById("startseite").classList.add("active");</script>

<div class="container-50-outer">

    <div class="container-80-inner">
        <h2 class="hdln">laufende Veranstaltungen</h2>

        <?php
        $query1 = "SELECT V.V_ID, Beginn, Titel from Veranstaltung V JOIN Teilnehmerliste_offen T WHERE V.V_ID = T.V_ID 
                AND T.B_ID = $B_ID AND V.Status IN (2)";
        $res1 = $conn->query($query1);
        $counter = 0;
        if($res1->num_rows == 0){
            echo "<p class='txt'>Sie haben derzeit keine laufenden Veranstaltungen.</p>";
        }
        else{
        while($i = $res1->fetch_row()){
           $counter++;
           if($counter == 4){
               break;
           }

        ?>

        <form action="../../VeranstaltungsSeite.php" method="post">
            <input type="hidden" name="veranstaltung_id" value="<?php echo $i[0];?>">
            <button type="submit" class="btnveranstaltung"><div class="btnbeginn"><?php echo "Beginn: ". $i[1]?></div><div class="btntitel"><?php echo $i[2]?></div></button>
        </form>
        <?php }} ?>
    </div>

    <br><br><br>

    <div class="container-80-inner">
        <h2 class="hdln">anstehende Veranstaltungen</h2>

        <?php
        $query2 = "SELECT V.V_ID, Beginn, Titel from Veranstaltung V JOIN Teilnehmerliste_offen T WHERE V.V_ID = T.V_ID 
                AND T.B_ID = $B_ID AND V.Status IN (1)";
        $res2 = $conn->query($query2);
        $counter = 0;
        if($res2->num_rows == 0){
            echo "<p class='txt'>Sie haben derzeit keine anstehenden Veranstaltungen.</p>";
        }
        else{
        while($i = $res2->fetch_row()){
        $counter++;
        if($counter == 4){
            break;
        }

        ?>

        <form action="../../VeranstaltungsSeite.php" method="post">
            <input type="hidden" name="veranstaltung_id" value="<?php echo $i[0];?>">
            <button type="submit" class="btnveranstaltung"><div class="btnbeginn"><?php echo "Beginn: ". $i[1]?></div><div class="btntitel"><?php echo $i[2]?></div></button>
        </form>
        <?php }} ?>
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
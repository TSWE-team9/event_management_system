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

    <title>Angemeldete Veranstaltungen</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include '../header.php';?>
<script>document.getElementById("reiter_veranstaltungen").classList.add("active");</script>

<div class="container-50-outer">
    <h1 class="hdln">Angemeldete Veranstaltungen</h1>

    <?php
    $query1 = "SELECT V.V_ID, Beginn, Titel from Veranstaltung V JOIN Teilnehmerliste_offen T WHERE V.V_ID = T.V_ID 
                AND T.B_ID = $B_ID AND V.Status IN (1, 2)";
    $res1 = $conn->query($query1);
    if($res1->num_rows == 0){
        echo "<p class='txt'>Sie sind zur Zeit zu keinen Veranstaltungen angemeldet.</p>";
    }
    else{
        while($i = $res1->fetch_row()){

    ?>
    <form action="../../Veranstaltungsseite/VeranstaltungsSeite.php" method="post">
        <input type="hidden" name="veranstaltung_id" value="<?php echo $i[0];?>">
        <button type="submit" class="btnveranstaltung"><div class="btnbeginn"><?php echo "Beginn: ". $i[1]?></div><div class="btntitel"><?php echo $i[2]?></div></button>
    </form>
        <?php }} ?>
</div>

</body>
</html>
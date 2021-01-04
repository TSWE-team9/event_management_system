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
    <link rel="stylesheet" type="text/css" href="../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../CSS/listen.css">
    <title>Veranstaltungsangebot</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>
<nav>
    <ul>
        <li><a class="active" href="Veranstaltungsangebots.php">Veranstaltungsangebot</a></li>
        <li><a href="#">Kontakt</a></li>
        <li><a href="#">Hilfe</a></li>
        <li style="float: right;"> <a href="../../LandingPage/index.php">zur Anmeldung</a></li>

    </ul>
</nav>

<div class="container-50-outer">
    <h1 class="hdln">Aktuelles Angebot</h1>

    <?php
    //Abfrage aller aktiven (Status = 1) Veranstaltungen
    $query1 = "SELECT V_ID, Beginn, Titel FROM Veranstaltung WHERE Status = 1";
    $res1 = $conn->query($query1);
    if($res1->num_rows == 0){
        echo "<p class='txt'>Es werden zur Zeit keine Veranstaltungen angeboten, zu denen Sie sich anmelden können</P>";
    }

    //Ausgabe der Abfrage in HTML
    else {
    while($i = $res1->fetch_row()){

    ?>

    <form action="../VeranstaltungsSeite.php" method="post">
        <input type="hidden" name="veranstaltung_id" value="<?php echo $i[0];?>">
        <button type="submit" class="btnveranstaltung" name="veranstaltung"><div class="btnbeginn"><?php echo "Beginn: ". $i[1]?></div><div class="btntitel"><?php echo $i[2]?></div></button>
    </form>
    <?php }} ?>
</div>

</body>
</html>
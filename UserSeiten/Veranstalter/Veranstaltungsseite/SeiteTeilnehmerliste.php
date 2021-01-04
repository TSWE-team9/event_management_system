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

//Abspeichern der V_ID nach Buttonklick von der Veranstaltungsseite
if(isset($_POST["teilnehmerliste"])){
    $_SESSION["V_ID"] = $_POST["veranstaltung_id"];
}

$V_ID = $_SESSION["V_ID"];

//Abfragen des Titels der Veranstaltung
$query = "SELECT Titel, Teilnehmer_akt, Teilnehmer_max FROM Veranstaltung WHERE V_ID = $V_ID";
$res = $conn->prepare($query);
$res->execute();
$res->bind_result($titel, $teilnehmer_akt, $teilnehmer_max);
$res->fetch();
$res->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../CSS/listen.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/veranstaltungen.css">
    <title>Veranstaltung</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>
<nav>
    <ul>
        <li><a href="../Startseite/VeranstalterStartseite.php">Startseite</a></li>
        <li><a href="../erstellenAnfrage/VeranstalterAnfrage.php">Angebot einholen</a></li>
        <li><a href="#">Kontakt</a></li>
        <li><a href="#">Hilfe</a></li>
        <li><a class="active" href="../eigeneVeranstaltungen/VeranstalterVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li style="float: right;"> <a href="../../logout.php"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li style="float: right;"> <a href="../Datenänderung/VeranstalterDatenänderung.php"> <i class="fas fa-user-circle"></i> </a></li>
    </ul>
</nav>

<div class="container-50-outer">
    <h1 class="hdln"><?php echo $titel; ?></h1>

    <!--SQL Abfrage-->
    <?php
    $query1 = "SELECT Vorname, Nachname FROM Teilnehmerliste_offen WHERE V_ID = $V_ID
                UNION SELECT Vorname, Nachname FROM Teilnehmerliste_ges WHERE V_ID = $V_ID";

    $res1 = $conn->query($query1);

    if($res1->num_rows == 0){

    ?>
    <!--if keine Teilnehmer-->
    <p class="txt">Zu dieser Veranstaltung sind noch keine Teilnehmer angemeldet.</p>
    <!--else Teilnehmer angemeldet-->
    <?php }
    else{
    ?>
    <p class="txt">Zu dieser Veranstaltung sind <?php echo $teilnehmer_akt; ?> von maximal <?php echo $teilnehmer_max; ?> Teilnehmern angemeldet.</p>

    <div class="container-80-inner">
        <div class="row">
            <div class="col-50">Nachname</div>
            <div class="col-50">Vorname</div>
        </div>
        <?php

        //Ergebnis-Array für Vornamen und Nachnamen
        $teilnehmer_array_v = array();
        $teilnehmer_array_n = array();

        while($i = $res1->fetch_row()){

            //Hinzufügen der Werte zu den Arrays
            array_push($teilnehmer_array_v, $i[0]);
            array_push($teilnehmer_array_n, $i[1]);
        ?>
        <div class="row">
            <div class="col-50"><?php echo $i[1]; ?></div>
            <div class="col-50"><?php echo $i[0]; ?></div>
        </div>
        <!--while Schleife Ende-->
        <?php }?>
    </div>

    <!--TODO Zweite While Schleife und Ausgaben kannst du löschen, hab sie mal drin gelassen; siehe auch Arrays in Zeile 90/91-->

    <div style="width: 80%; margin: auto; margin-top: 20px">
        <form action="#" method="post">
            <input type="hidden" id="anzahl" value="<?php echo $teilnehmer_akt; ?>">
            <!--while Schleife Beginn-->
            <?php
            $counter = 0;
            while($j = $res1->fetch_row()){
            $counter++;
            ?>
            <input type="hidden" id="<?php echo $counter; ?>" value=<?php echo $j[0] . " " . $j[1]; ?>>
            <!--while Schleife Ende-->
            <?php }?>
            <button class="btn" style="float: right;" type="button" onclick="tolleJavaScriptFunktion()">Teilnehmerliste als PDF ausgeben</button>
        </form>
        <!--else Ende-->
        <?php }?>

        <!--Button um zur Veranstaltungsseite zurückzukehren-->
        <form action="../../Veranstaltungsseite/VeranstaltungsSeite.php" method="post">
            <input type="hidden" name="veranstaltung_id" value="<?php echo $V_ID; ?>">
            <button type="submit" class="btn" name="veranstaltung">zurück zur Veranstaltung</button> 
        </form>
    </div>
</div>

<script src="SeiteTeilnehmerliste.js"></script>

</body>
</html>
<?php
session_start();

// initializing variables
$datum = $_SESSION["Beginn_final"];
$dauer    = $_SESSION["Dauer_final"];
$tanzahl = $_SESSION["Teilnehmerzahl"];
$Rid = $_SESSION["R_ID"];
$Bid = $_SESSION["b_id"];



// connect to the database
$db = mysqli_connect('132.231.36.109', 'dbuser', 'dbuser123', 'vms_db');


// REGISTER USER
if (isset($_POST['Hinzufügen'])) {
    // receive input values from form
    $titel = mysqli_real_escape_string($db, $_POST['Veranstaltungs-Titel']);
    $zeit = mysqli_real_escape_string($db, $_POST['Uhrzeit']);
    $zeitraum = mysqli_real_escape_string($db, $_POST['Zeitraum']);
    $tkosten = mysqli_real_escape_string($db, $_POST['Teilnahmekosten']);
    $art = mysqli_real_escape_string($db, $_POST['Auswahl']);
    $verfügbarkeit_v1 = mysqli_real_escape_string($db, $_POST['Verfügbarkeit']);
    $beschreibung = mysqli_real_escape_string($db, $_POST['Veranstaltungsbeschreibung']);

    if ($verfügbarkeit_v1 == "offen"){
        $verfügbarkeit = 1;
    } else {
        $verfügbarkeit = 2;
    }

    //echo "<br>"."<br>"."<br>". $titel ."<br>". $beschreibung ."<br>". $Bid ."<br>". 2 ."<br>". $art ."<br>". $verfügbarkeit ."<br>". 1 ."<br>".   $Rid ."<br>". $tanzahl ."<br>". 0 ."<br>". $datum ."<br>". $zeit ."<br>". $dauer ."<br>". $zeitraum ."<br>". $tkosten;



$query_v = "INSERT INTO Veranstaltung VALUES(V_ID, NULL, '$titel', '$beschreibung', $Bid, 2, '$art', $verfügbarkeit, 1, $Rid, $tanzahl, 0, '$datum', '$zeit', $dauer, $zeitraum, $tkosten)";
$res2 = mysqli_query($db, $query_v);

if ($res2 === FALSE) {
    $error = "Es ist ein Fehler beim Einfügen in die Datenbank aufgetreten (Veranstaltung)";
    echo "<div class='overlay'>" ;
    echo  "<div class='popup'>";
    echo "<h2>Fehler</h2>" ;
    echo "<a class='close' href='InterneVeranstaltungen.php'> &times;</a>" ;
    echo "<div class='content' >"  .$error."</div>";
    echo "</div>" ;
    echo "</div>" ;
    $error_occured = true;
} else {
    //Endgültige Belegung des Raumes im Kalender
    $query3 = "UPDATE Kalender SET Status = 1, V_ID = (SELECT V_ID FROM Veranstaltung WHERE Titel='$titel' AND Beginn = '$datum' AND Veranstalter = $Bid) WHERE Von= '$datum' AND R_ID = $Rid";
    $res3 = $db->query($query3);
    $status = "Veranstaltung erfolgreich erstellt";
    echo "<div class='overlay'>" ;
    echo  "<div class='popup'>";
    echo "<h2>Bestätigung</h2>" ;
    echo "<a class='close' href='InterneVeranstaltungen.php'> &times;</a>" ;
    echo "<div class='content' >"  .$status."</div>";
    echo "</div>" ;
    echo "</div>" ;
}
}

if(isset($_POST["Abbrechen"])){

    $query4 = "DELETE FROM Kalender WHERE Von = '$datum' AND R_ID = $Rid";
    $res4 = $db->query($query4);
    if($res4 == TRUE){
        header("Location: InterneVeranstaltungen.php");
    }
}


<?php
session_start();
include "SeminarstatistikFunktion.php";

$host = '132.231.36.109';
$db = 'vms_db';
$user = 'dbuser';
$pw = 'dbuser123';

$conn = new mysqli($host, $user, $pw, $db,3306);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
    <link rel="stylesheet" type="text/css" href="../style/header.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/Formular.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/Tabellen.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="seminarstatistik.css" media="screen" />
    <title>Seminarstatistik</title>
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include '../Header/header.php'; ?>
<script>document.getElementById("Reiter_Angebotserstellung").classList.add("active");  </script>
<div class="grid-container">
    <div class="grid-item">
<form action="Seminarstatistik.php"  method="post">
    <div class="contact-us" >
        <h1> Seminarstatistik</h1>
        <!-- Fomular Spalten -->
        <h3>
            <em>&#x2a; </em> Bitte den gewünschten Veranstalter und Zeitraum auswählen um eine Abfrage zu starten .
        </h3>
<!--        Hier abfragen aller möglichen Veranstalter oder auch einfach auswahl aller Veranstalter-->
        <label for="Auswahl">Veranstalter <em>&#x2a;</em></label>
        <div class="select-wrapper" style="margin-bottom: 3em; width:auto;">
        <select class="auswahl" name="Auswahl" id="Auswahl" style="background: none;">
            <?php for($i = 0; $i<count($_SESSION["V_Array"]); $i++){?>
                <option value="<?php echo $_SESSION["V_Array"][$i];?>"><?php echo $_SESSION["V_Array"][$i]." ".$_SESSION["F_Array"][$i];?> </option>
            <?php }?>
        </select>
        </div>
        <label for="Startzeitraum">Startzeitraum <em>&#x2a;</em></label><input id="Startzeitraum" name="Startzeitraum" required="" type="date"/>
        <label for="Endzeitraum">Endzeitraum <em>&#x2a;</em></label><input id="Endzeitraum" name="Endzeitraum" required="" type="date"/>

        <button type="submit" class="Auslösen" name="Seminar" style="margin-top: 0"> Abfragen</button>
        </div>



</form>




</div>


    <div class="grid-item">
    <table class="container">
        <thead style="color: black; z-index: 6">
        <tr>
        <th>Veranstalter</th>
            <!--<th>offen</th>
            <th>geschlossen</th>-->
        <th>durchschnittliche Dauer</th>
        <th>Anzahl der bisherigen Veranstaltungen</th>
        <th>Gesamte Teilnehmer</th>
        </tr>
        </thead>

    <tbody>

<!--Einfügen der Daten in die Tabelle -->
<?php
if (isset($_POST['Seminar'])) {
    $firma1 = $_POST['Auswahl'];
    $start1 = $_POST['Startzeitraum'];
    $ende1 = $_POST['Endzeitraum'];
//    header("Seminarstatistik.php");


$data_query2 = "SELECT Veranstalter,ROUND(AVG(Dauer)), COUNT(Titel), SUM(Teilnehmer_akt) FROM Veranstaltung Where Veranstalter='$firma1' and Beginn between '$start1' and '$ende1' GROUP BY Veranstalter";
$res2 = $conn->prepare($data_query2);
$res2->execute();
$res2->bind_result($veranstalter,$dauer,$count, $summe );

while ($res2->fetch()){
    echo "<td>$veranstalter</td>"."<td>$dauer</td>"."<td>$count"."</td>"."<td>$summe"."</td>";
}

if(mysqli_num_rows($res2)==0){
//TODO: Fehlermeldung
}


$res2->close();
}?>
<!--    Aufsummierung der offenen und geschlossenen Veranstaltungen -->
<!-- Durschnittlicher Preis der Veranstaltung eines Veranstalter -->
    <!-- Wie viele Veranstaltungen hat der Veranstalter bisher durchgefüht, also auch laufende Veranstaltungen, aber nicht die stonierten -->
    <!-- Wie viele Teilnehmer gab es insgesamt bei diesem Veranstalter-->

    </tbody>
    </table>
    </div>
</div>
</body>
</html>
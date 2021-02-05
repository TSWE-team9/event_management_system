<?php
session_start();

//Status aller Veranstaltungen auf Aktualisierung prüfen
include "../../veranstaltung_refresh.php";
veranstaltung_refresh();

//Verbindung zur Datenbank herstellen
$host = '132.231.36.109';
$db = 'vms_db';
$user = 'dbuser';
$pw = 'dbuser123';
$conn = new mysqli($host, $user, $pw, $db,3306);

//Überprüfen ob es einen Verbindungsfehler gab
if($conn->connect_error) {
    die('Connect Error (' . $conn->connect_errno . ') '
        . $conn->connect_error);

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Abrechnung</title>

    <link rel="stylesheet" type="text/css" href="../style/header.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/Tabs.css" media="screen" />
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>

</head>

<body>
<?php include '../Header/header.php' ; ?>
<script>document.getElementById("Reiter_Abrechnung").classList.add("active");  </script>
<!--Tab auf der linken Seite zum auswählen zwischen internen und externen Veranstaltungen -->
<div class="tab">
    <button class="tablinks" onclick="openList(event, 'interne')" id="defaultOpen">Interne Veranstaltungen</button>
    <button class="tablinks" onclick="openList(event, 'externe')">Externe Veranstaltungen</button>

</div>
<div id="interne" class="tabcontent">
    <h3 class="txt" >Interne Veranstaltungen</h3>

    <!--anzeigen der internen abgelaufenen Veranstaltungen-->
    <?php
    $query1 = "SELECT V_ID, Angebot_ID, DATE_ADD(Beginn, INTERVAL Dauer-1 DAY), Titel, Status FROM Veranstaltung WHERE Status = 3 AND Kategorie = 2 AND Teilnehmer_akt != 0 ";
    $res1 = $conn->query($query1);
    if($res1->num_rows > 0){
    while($i = $res1->fetch_row()){

    ?>
<form action="Abrechnung_Formular.php" method="post">
    <input type="hidden" name="Veranstaltung_id" value="<?php echo $i[0]; ?>">
    <input type="hidden" name="Bearbeitung_id" value="<?php echo $i[1]; ?>">
    <input type="hidden" name="Kategorie" value="2">
    <input type="hidden" name="Status" value="<?php echo $i[4]; ?>">
    <button type="submit" class="btnveranstaltung" name="Abrechnung"><div class="btnbeginn"><?php echo "Abgelaufen am: ".$i[2];?></div><div class="btntitel"><?php echo $i[3];?></div></button>
    </form>
    <?php }} ?>
</div>


<div id="externe" class="tabcontent">
<h3 class="txt">Externe Veranstaltungen</h3>

    <!--anzeigen der externen abgelaufenen/stornierten Veranstaltungen-->
    <?php
    $query2 = "SELECT V_ID, Angebot_ID, DATE_ADD(Beginn, INTERVAL Dauer-1 DAY), Titel, Status FROM Veranstaltung WHERE Status IN (3,4) AND Kategorie = 1";
    $res2 = $conn->query($query2);
    if($res2->num_rows > 0){
    while($j = $res2->fetch_row()){

    ?>
<form action="Abrechnung_Formular.php" method="post">
    <input type="hidden" name="Veranstaltung_id" value="<?php echo $j[0]; ?>">
    <input type="hidden" name="Bearbeitung_id" value="<?php echo $j[1]; ?>">
    <input type="hidden" name="Kategorie" value="1">
    <input type="hidden" name="Status" value="<?php echo $j[4]; ?>">
    <button type="submit" class="btnveranstaltung" name="Abrechnung"><div class="btnbeginn"><?php echo "Abgelaufen am: ".$j[2];?></div><div class="btntitel"><?php echo $j[3];?></div></button>
</form>
    <?php }} ?>
</div>

<!--    <script src="../js/Tabs.js"></script> ; -->
<script>
    // function to display different tabs
    function openList(evt, listName) {
// Declare all variables
        var i, tabcontent, tablinks;

// Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

// Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

// Show the current tab, and add an "active" class to the link that opened the tab
        document.getElementById(listName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

</body>
</html>

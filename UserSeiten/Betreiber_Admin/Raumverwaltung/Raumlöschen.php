<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raumlöschen</title>
    <link rel="stylesheet" type="text/css" href="Raumlöschen.css" media="screen" />
</head>

<?php
//Zugangsdaten zur Datenbank
$host = '132.231.36.109';
$db = 'vms_db';
$user = 'dbuser';
$pw = 'dbuser123';

$conn = new mysqli($host, $user, $pw, $db,3306);

if($conn->connect_error){
    die('Connect Error (' . $conn->connect_errno . ') '
        . $conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"] == "POST") {

    //Error_occured Variable (zunächst false)
    $error = "";
    $error_occured = false;

    //Abspeichern der vom Formular übergebenen Daten
    $R_ID = $_POST["Raum-ID"];
    $bezeichnung = $_POST["Raumbezeichnung"];
    $status_inaktiv = false;


    //Abfrage, ob Raum ID mit Bezeichnung des zu löschenden Raums existiert
    $check_query = "SELECT R_ID FROM Raum WHERE R_ID = $R_ID AND Bezeichnung='$bezeichnung'";
    $res1 = $conn->query($check_query);

    if ($res1->num_rows == 0) {
        $error = "Fehler: Angegebene Raum_ID und/oder Bezeichnung existiert nicht";
        $error_occured = true;
    }

    //Abfrage, ob Raum bereits inaktiv
    $check_query2 = "SELECT R_ID FROM Raum WHERE R_ID=$R_ID AND Status=2";
    $res2 = $conn->query($check_query2);

    //Abfrage, ob in dem Raum begonnene (Status=2) oder aktive (Status=1) Veranstaltungen stattfinden
    $check_query3 = "SELECT V_ID FROM Veranstaltung WHERE Ort = $R_ID AND Status IN (1, 2)";
    $res3 = $conn->query($check_query3);
    //Abfrage, ob für den Raum bearbeitete (Status=2) oder geänderte (Status=3) Angebote oder Anfragen existieren
    $check_query4 = "SELECT BeAr_ID FROM Anfrage_Angebot WHERE R_ID = $R_ID AND Status IN (2, 3)";
    $res4 = $conn->query($check_query4);

    if($res2->num_rows>0){
        $status_inaktiv = true;
    }

    if($res3->num_rows>0){
        $error = "<br>" . "Fehler: In diesem Raum finden derzeit Veranstaltungen statt oder es sind Veranstaltungen geplant.";
        $error_occured = true;
    }

    if($res4->num_rows>0){
        $error = $error . "<br>" . "Fehler: Für diesen Raum existieren erstellte Angebote.";
        $error_occured = true;
    }

    //Nur wenn keine Fehler vorliegen ($error_occured) wird der gewählte Raum inaktiv gesetzt
    if($error_occured == false && $status_inaktiv == false){

        $update_query = "UPDATE Raum SET Status = 2 WHERE R_ID = $R_ID";
        if ($conn->query($update_query) === TRUE) {
            echo "<br>" . "Der Raum wurde erfolgreich gelöscht (inaktiv gesetzt).";

        } else {
            $error = "Es ist ein Fehler beim Einfügen in die Datenbank aufgetreten.";
            $conn->error;
            echo "<br>";
        }

    }

    if($status_inaktiv){
        echo "<br>" . "Der Raum ist bereits gelöscht (inaktiv) und kann nicht gelöscht werden!";

    }

    echo $error;

}


?>


    <body>

<div class="contact-us">
    <h1> Raum Löschen</h1>

    <h3>
        <em>&#x2a; </em> Bitte gewünschten Raum und Löschen auswählen.
    </h3>


        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <label for="Raum-ID">Raum-ID <em>&#x2a;</em></label><input id="Raum-ID" name="Raum-ID" required="" type="Number"/>
    <label for="Raumbezeichnung">Raumbezeichnung <em>&#x2a;</em></label><input id="Raumbezeichnung" name="Raumbezeichnung" required="" type="text"/>
    <!---<fieldset id = "Status">
        <label for = "Status"> Raumstatus <em>&#x2a;</em></label>
        <input type= "radio" id="aktiv" name="Status" value="aktiv">-->
<!--    <label for="aktiv"> aktiv</label>-->
    <!--<input type="radio" id="inaktiv" name="Status" value="inaktiv">
    <label for="inaktiv"> inaktiv</label>
    </fieldset>
    <label for="Raumstatus">Raumstatus<em>&#x2a;</em></label><input id="Raumstatus" name="Raumstatus" required="" type="Number"  />-->
<!--    <form action="select.html">-->
<!--    <label>Raumstatus:-->
<!--        <select name="Status" size="2">-->
<!--            <option>aktiv</option>-->
<!--            <option>inaktiv</option>-->
<!--        </select>-->
<!--    </label>-->
<!--    </form>-->



<!--    <button id="Löschen">Löschen</button>-->

            <button type="submit" class="Löschen" formaction="#">Löschen</button>
<!--            <method="post">-->
<!--            <input type="submit"  class="Löschen"  name="ausfuehren" value="Löschen"/>-->
<!--            </method>-->
            <a href="Raumverwaltung.php" type="button" class="Abbrechen">Abbrechen</a>


</form>


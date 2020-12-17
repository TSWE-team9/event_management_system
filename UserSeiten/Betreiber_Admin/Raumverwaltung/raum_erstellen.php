<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raum Hinzufügen</title>
    <link rel="stylesheet" type="text/css" href="Raumformularstylesheet.css" media="screen" />
</head>

<body>

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

//Error Variable zunächst false
$error = "";
$error_occured = false;
$query_status = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    //Zuweisung der im Formular eingegebenen Daten
    $bezeichnung = $_POST["Raumbezeichnung"];
    $kapazitaet = $_POST["RaumKapazität"];
    $groesse = $_POST["RaumGröße"];
    $preis = number_format((float)$_POST["Preis"], 2, '.', '');
    $status = $_POST["Status"];


    //Abfrage um bereits existierende Bezeichnung zu finden
    $check_query = "SELECT R_ID FROM Raum WHERE Bezeichnung = '$bezeichnung'";
    $res = $conn->query($check_query);

    //Erlaubte Zeichen bei Bezeichnung prüfen
    $check_sonderzeichen = preg_match('/^[-a-zA-ZÄÖÜäöüß0-9[:space:]]+$/', $bezeichnung);

    if($check_sonderzeichen == 0){
        $error = "Fehler: Es dürfen nur Buchstaben, Zahlen und Bindestriche eingegeben werden!";
        $error_occured = true;
    }

    if($res->num_rows > 0){
        $error = "Fehler: Raumbezeichnung existiert bereits.";
        $error_occured = true;
    }

    //Wenn alles passt, dann wird der Raum hinzugefügt
    if ($error_occured == false) {

    $insert_query = "INSERT INTO Raum VALUES (R_ID, '$bezeichnung', $kapazitaet, $groesse, $preis, $status)";

        if($conn->query($insert_query) === TRUE){
        $query_status = "Der Raum wurde erfolgreich hinzugefügt.";

        }
        else {
        $error = "Es ist ein Fehler beim Einfügen in die Datenbank aufgetreten.";
        $conn->error;
        }

    }
}

echo "<br><br>";

//Ausgabe der existierenden Räume in einer Tabelle
$räume_query = "SELECT R_ID, Bezeichnung, Kapazitaet, Groesse, Preis, Status FROM Raum";
$result = $conn->query($räume_query);

if($result->num_rows >0){
    echo "<table border=\"1\">";
    echo "<th>R_ID</th><th>Bezeichnung</th><th>Kapazität</th><th>Größe</th><th>Preis</th><th>Status</th>";
    while($i = $result->fetch_row()){
        echo "<tr>";
        foreach ($i as $item){
            echo "<td>$item</td>";
        }
        echo "</tr>\n";
    }
    echo "</table>\n";
}

echo "<br><br>";

$conn->close();

if($error_occured){
    echo $error;
} else {
    echo $query_status;
}

echo "<br><br>";

?>

<div class="contact-us">
    <h1> Raum Hinzufügen</h1>
    <!-- Fomular Spalten -->
    <h3>
        <em>&#x2a; </em> Bitte alle Felder ausfüllen um einen neuen Raum anzulegen.
    </h3>
    <!--    <label style="position: relative" > Verpflichtend </label>-->

    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <label for="Raumbezeichnung">Raumbezeichnung (nur Buchstaben / Leerzeichen und "-") <em>&#x2a;</em></label><input id="Raumbezeichnung" name="Raumbezeichnung" required="" type="text" maxlength="30"/>
        <label for="RaumKapazität">Raum Kapazität <em>&#x2a;</em></label><input id="RaumKapazität" name="RaumKapazität" required="" type="Number" min="0" />
        <label for="RaumGröße">Raumgröße in Quadratmetern <em>&#x2a;</em></label><input id="RaumGröße" name="RaumGröße" pattern="[0-9][0-9][0-9]" type="Number"  min="0" />
        <label for="Preis">Preis in Euro<em>&#x2a;</em></label><input id="Preis" name="Preis" required="" type="Number"  min="1" max="100000000"/>
        <fieldset id = "Status">
            <label for = "Status"> Raumstatus</label>
            <input type= "radio" id="aktiv" name="Status" value="1">
            <label for="aktiv"> aktiv</label>
            <input type="radio" id="inaktiv" name="Status" value="2">
            <label for="inaktiv"> inaktiv</label>
        </fieldset>
        <!--    <label for="Raumstatus">Raumstatus<em>&#x2a;</em></label><input id="Raumstatus" name="Raumstatus" required="" type="Number"  />-->
        <!--    <form action="select.html">-->
        <!--    <label>Raumstatus:-->
        <!--        <select name="Status" size="2">-->
        <!--            <option>aktiv</option>-->
        <!--            <option>inaktiv</option>-->
        <!--        </select>-->
        <!--    </label>-->
        <!--    </form>-->



        <button id="Hinzufügen">Hinzufügen</button>
        <a href="Raumverwaltung.php" type="button" class="Abbrechen">Abrechen</a>


    </form>

</div>


</body>
</html>


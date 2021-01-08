<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raum Hinzufügen</title>

    <link rel="stylesheet" type="text/css" href="Raumverwaltung.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="TabellenRaum.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../style/Fehlermeldung.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="Raumformularstylesheet.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/header.css" media="screen" />

    <!--    Einbinden von icons-->
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>

<body>

<nav>
    <ul class="header">
        <li class="headerel"><a href="../StartseiteBetreiber.html" class ="headerel">Startseite</a></li>
        <li class="headerel"><a  href="../Angebotserstellung/Angebotserstellung.php">Angebotserstellung</a></li>
        <li class="headerel"><a href="../Abrechnung/AbrechnungsSeite.php">Abrechnung</a></li>
        <li class="headerel"><a class= "active" href="../Raumverwaltung/Raumverwaltung.php">Raumverwaltung</a></li>
        <li class="headerel"><a href="../Angebotserstellung/InterneVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li class="headerel"><a href="#">Statistiken</a></li>
        <li class="headerel" style="float: right;"> <a href="#"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li class="headerel" style=float:right;"> <a href="#"  > <i class="fas fa-user-circle" ></i> </a></li>

    </ul>
</nav>
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
$q_status = false;

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
    if($res->num_rows > 0){
        $error = "Fehler: Raumbezeichnung existiert bereits.";
        $error_occured = true;
    }

    //Erlaubte Zeichen bei Bezeichnung prüfen
    $check_sonderzeichen = preg_match('/^[-a-zA-ZÄÖÜäöüß0-9[:space:]]+$/', $bezeichnung);

    if($check_sonderzeichen == 0){
        $error = "Fehler: Es dürfen nur Buchstaben, Zahlen und Bindestriche eingegeben werden!";
        $error_occured = true;
    }


    //Wenn alles passt, dann wird der Raum hinzugefügt
    if ($error_occured == false) {

    $insert_query = "INSERT INTO Raum VALUES (R_ID, '$bezeichnung', $kapazitaet, $groesse, $preis, $status)";

        if($conn->query($insert_query) === TRUE){
        $query_status = "Der Raum wurde erfolgreich hinzugefügt.";
        $status = true;

        }
        else {
        $error = "Es ist ein Fehler beim Einfügen in die Datenbank aufgetreten.";
        $error_occured = true;
        }

    }
}

echo "<br><br>";

//Ausgabe der existierenden Räume in einer Tabelle
$räume_query = "SELECT R_ID, Bezeichnung, Kapazitaet, Groesse, Preis, Status FROM Raum";
$result = $conn->query($räume_query);

if($result->num_rows >0){
    echo "<table class=' container' border=\"1\">";
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

//Ausgabe der Fehlermeldungen
if($error_occured){
    echo "<div class='overlay'>" ;
    echo  "<div class='popup'>";
    echo "<h2>Fehler</h2>" ;
    echo "<a class='close' href='raum_erstellen.php'>&times;</a>" ;
    echo "<div class='content'>".$error."</div>";
    echo "</div>" ;
    echo "</div>" ;

}
if($q_status){
    echo "<div class='overlay'>" ;
    echo  "<div class='popup'>";
    echo "<h2>Bestätigung</h2>" ;
    echo "<a class='close' href='Raumverwaltung.php'>&times;</a>" ;
    echo "<div class='content'>".$query_status."</div>";
    echo "</div>" ;
    echo "</div>" ;
}
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



        <button class="Löschen">Hinzufügen</button>
        <a href="Raumverwaltung.php" type="button" class="Abbrechen">Abrechen</a>


    </form>

</div>


</body>
</html>


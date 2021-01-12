<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raumdaten ändern</title>
    <link rel="stylesheet" type="text/css" href="Buttons.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="TabellenRaum.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="Raumverwaltung.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/header.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/Fehlermeldung.css" media="screen" />
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>

</head>

<body>
<!--header-->
<?php include '../Header/header.php'; ?>
<script>document.getElementById("Reiter_Raumverwaltung").classList.add("active");  </script>
<br>
<br>

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
//Error_occured Variable (zunächst false)
$error = "";
$error_occured = false;
$query_status = "";
$status = false;
$show_table = false;

if($_SERVER["REQUEST_METHOD"] == "POST") {

//Abspeichern der zu ändernden Daten
    $R_ID = $_POST["Raum-ID"];
    $bezeichnung = $_POST["Raumbezeichnung"];
    $kapazitaet = $_POST["RaumKapazität"];
    $groesse = $_POST["RaumGröße"];
    $preis = number_format((float)$_POST["Preis"], 2, '.', '');
    //$status = $_POST["Status"];

//Abfrage, ob Raum ID des zu ändernden Raums existiert
    $check_query = "SELECT R_ID FROM Raum WHERE R_ID = $R_ID";
    $res1 = $conn->query($check_query);

    if ($res1->num_rows == 0) {
        $error = "Fehler: Angegebene Raum_ID existiert nicht";
        $error_occured = true;
    }

//Abfrage, ob durch die Änderung der Kapazität des Raumes aktive Veranstaltungen oder Angebote existieren,
//deren Teilnehmerzahl dann zu groß geworden ist
    $check_query2 = "SELECT V_ID, Titel, Veranstalter, Teilnehmer_max, Beginn FROM Veranstaltung WHERE Ort = $R_ID AND Status = 1 AND Teilnehmer_max > $kapazitaet
                     UNION
                     SELECT BeAr_ID, 'Angebot bearbeitet', Veranstalter, Teilnehmer_gepl, Beginn FROM Anfrage_Angebot WHERE R_ID = $R_ID AND Teilnehmer_gepl > $kapazitaet AND Status IN (2, 3)";
    $res2 = $conn->query($check_query2);

    if($res2->num_rows > 0){
        $error = "Es existieren Veranstaltungen und Angebote, die durch die Änderung der Kapazität betroffen sind!";
        $error_occured = true;
        $show_table = true;
    }


//Abfrage um bereits existierende Bezeichnung zu finden
    $check_query = "SELECT R_ID FROM Raum WHERE R_ID != $R_ID AND Bezeichnung = '$bezeichnung' ";
    $res3 = $conn->query($check_query);

    if ($res3->num_rows > 0) {
        $error =  $error . "<br>" . "Fehler: Raumbezeichnung existiert bereits.";
        $error_occured = true;
    }

//Sonderzeichen Check
    $check_sonderzeichen = preg_match('/^[-a-zA-ZÄÖÜäöüß0-9[:space:]]+$/', $bezeichnung);

    if ($check_sonderzeichen == 0) {
        $error = $error . "<br>" . "Fehler: Es dürfen nur Buchstaben, Zahlen und Bindestriche eingegeben werden!";
        $error_occured = true;
    }


//Update Befehl und Überprüfung (nur wenn kein Fehler), ob es funktioniert hat
    if($error_occured == false) {


        $update_query = "UPDATE Raum SET Bezeichnung = '$bezeichnung', Kapazitaet = $kapazitaet, Groesse = $groesse, Preis = $preis
                     WHERE R_ID = $R_ID";

        if ($conn->query($update_query) === TRUE) {
            $query_status = "Die Raumdaten wurden erfolgreich geändert.";
            $status = true;

        } else {
            $error = "Es ist ein Fehler beim Einfügen in die Datenbank aufgetreten.";
            $error_occured = true;
            echo "<br>";
        }
    }

}

echo "<br><br>";

//Ausgabe der existierenden Räume in einer Tabelle
$räume_query = "SELECT R_ID, Bezeichnung, Kapazitaet, Groesse, Preis, Status FROM Raum";
$result = $conn->query($räume_query);
//greift aufraumverwaltung.php zu
if($result->num_rows >0){
echo "<table class='container' border=\"1\">";
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

//Fehlermeldung oder Erfolgsmeldung wird ausgegeben
if($error_occured){

    echo "<div class='overlay'>" ;
    echo  "<div class='popup'>";
    echo "<h2>Fehler</h2>" ;
    echo "<a class='close' href='raumdaten_ändern.php'>&times;</a>" ;
    echo "<div class='content'>" .$error. "</div>";
    echo "</div>" ;
    echo "</div>" ;

}
if($status) {

   echo "<div class='overlay'>";
   echo "<div class='popup'>";
    echo "<h2>Bestätigung</h2>";
   echo "<a class='close' href='Raumverwaltung.php'>&times;</a>";
   echo "<div class='content'>" . $query_status . "</div>";
   echo "</div>";
   echo "</div>";
}

echo "<br><br>";


//Anzeige der Tabelle der betroffenen Veranstaltungen
if($show_table){
    echo "<div class='mantel '>" ;
    echo "<table border=\"1\" class='container' style='padding-top:8em '>";
    echo "<th>V_ID / Angebot_ID</th><th>Titel</th><th>Veranstalter ID</th><th>Max. Teilnehmerzahl</th><th>Beginn</th>";
    while($i = $res2->fetch_row()){
        echo "<tr>";
        foreach ($i as $item){
            echo "<td>$item</td>";
        }
        echo "</tr>\n";
    }
    echo "</table>\n";
    echo "</div>";
}
?>

<br>

<div class="contact-us">
    <h1> Raumdaten ändern</h1>
    <!-- Fomular Spalten -->
    <h3>
        <em>&#x2a; </em> Bitte alle Felder ausfüllen um die Raumdaten zu ändern!
    </h3>
    <!--    <label style="position: relative" > Verpflichtend </label>-->

    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <label for="Raum-ID">Raum-ID <em>&#x2a;</em></label><input id="Raum-ID" name="Raum-ID" required="" type="Number"/>
        <label for="Raumbezeichnung">Raumbezeichnung (nur Buchstaben / Leerzeichen und "-") <em>&#x2a;</em></label><input id="Raumbezeichnung" name="Raumbezeichnung" required="" type="text" maxlength="30"/>
        <label for="RaumKapazität">Raum Kapazität <em>&#x2a;</em></label><input id="RaumKapazität" name="RaumKapazität" required="" type="Number" min="0" />
        <label for="RaumGröße">Raumgröße in Quadratmetern <em>&#x2a;</em></label><input id="RaumGröße" name="RaumGröße" pattern="[0-9][0-9][0-9]" type="Number"  min="0" />
        <label for="Preis">Preis in Euro<em>&#x2a;</em></label><input id="Preis" name="Preis" required="" type="Number"  min="1" max="100000000"/>


        <button class="Löschen"style="margin-top: 0; ">Ändern</button>
            <a href="Raumverwaltung.php" type="button" class="Abbrechen" style="margin-top: 0">Abrechen</a>

    </form>

</div>

</body>
</html>

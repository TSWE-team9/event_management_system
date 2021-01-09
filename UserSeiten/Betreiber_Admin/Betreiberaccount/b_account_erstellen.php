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

$status = "";
$error = false;

if(isset($_POST["erstellen"])){

    //Abspeichern der angegebenen Daten
    $email = $_POST["email"];
    $passwort = $_POST["passwort"];
    $passwort = md5($passwort);
    $Geburtsdatum = $_POST["geburtsdatum"];
    $Rolle = $_POST["rolle"];

    //Default Daten für Betreiber
    $firma = "VMS Grup9";
    $strasse = "Innstrasse";
    $Haus_nr = 1;
    $PLZ = "94032";
    $Ort = "Passau";
    $Land = "Deutschland";

    //Überprüfung ob Email bereits vorhanden
    $check_query = "SELECT B_ID FROM Benutzerkonto WHERE E_mail = '$email'";
    $check = $conn->query($check_query);
    if($check->num_rows > 0){
        $status = "Unter dieser E-Mail ist bereits ein Account registriert!";
        $error = true;
    }

    //Insert Statements
    if($error == false) {

        $query = "INSERT INTO Benutzerkonto VALUES (B_ID, '$passwort', $Rolle, '$email', '$Geburtsdatum', 1)";
        $query2 = "INSERT INTO Betreiberkonto VALUES ((SELECT B_ID FROM Benutzerkonto WHERE E_mail = '$email'), '$firma', '$strasse', $Haus_nr, $PLZ, '$Ort', '$Land')";

        $res = $conn->query($query);
        if ($res === TRUE) {
            $res2 = $conn->query($query2);
            if ($res2 === TRUE) {
                $status = "Betreiberaccount erfolgreich erstellt";
            } else {
                $status = "Es ist ein Fehler aufgetreten";
            }
        } else {
            $status = "Es ist ein Fehler aufgetreten";
        }
    }

    echo "<div class='overlay'>" ;
    echo  "<div class='popup'>";
    echo "<h2>Meldung</h2>" ;
    echo "<a class='close' href='b_account_erstellen.php'>&times;</a>" ;
    echo "<div class='content'>".$status."</div>";
    echo "</div>" ;
    echo "</div>" ;

}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Landing Page</title>
    <meta charset="utf-8"/>
    <title>BetreiberAccount</title>

    <link rel="stylesheet" type="text/css" href="../Raumverwaltung/Raumverwaltung.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/Fehlermeldung.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../Raumverwaltung/Raumformularstylesheet.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/header.css" media="screen" />
    <!--    Einbinden von icons-->
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>

<nav>
    <ul class="header">
        <li class="headerel"><a href="../Raumverwaltung/StartseiteBetreiber.html" class ="headerel">Startseite</a></li>
        <li class="headerel"><a  href="../Angebotserstellung/Angebotserstellung.php">Angebotserstellung</a></li>
        <li class="headerel"><a href="../Abrechnung/AbrechnungsSeite.php">Abrechnung</a></li>
        <li class="headerel"><a  href="../Raumverwaltung/Raumverwaltung.php">Raumverwaltung</a></li>
        <li class="headerel"><a href="../Angebotserstellung/InterneVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li class="headerel"><a href="#">Statistiken</a></li>
        <li class="headerel" style="float: right;"> <a href="#"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li class="headerel" style=float:right;"> <a class= "active" href="#"  > <i class="fas fa-user-circle" ></i> </a></li>

    </ul>
</nav>
<div class="contact-us" style="margin-top: 5em">
    <h1> Account erstellen</h1>
    <!-- Fomular Spalten -->
    <h3>
        <em>&#x2a; </em> Bitte alle Felder ausfüllen um einen neuen Account anzulegen.
    </h3>
    <form action="" method="post">
        <label for="email">E-Mail-Adresse</label>
        <input type="email" id="email" placeholder="E-Mail-Adresse" name="email" maxlength="50" required>

        <label for="passwort">Passwort</label>
        <input type="password" id="passwort" placeholder="Passwort" name="passwort_1" pattern=".{10,50}" required>

        <label for="passwort">Passwort wiederholen</label>
        <input type="password"  id="passwort" placeholder="Passwort" name="passwort_2" pattern=".{10,50}" required>

        <label for="geb_t">Geburtsdatum</label>
        <input type="date" name="geburtsdatum" id="geb_t" required>

        <fieldset id = "Rolle">
            <label for = "Rolle"> Rolle</label>
            <input type= "radio" id="Betreiber" name="Rolle" value="3">
            <label for="Betreiber"> Betreiber</label>
            <input type="radio" id="Admin" name="Rolle" value="4">
            <label for="Admin"> Administrator</label>
        </fieldset>
        <button class="Löschen" type="submit" name="erstellen">Erstellen</button>
        <a href="../Raumverwaltung/StartseiteBetreiber.html" type="button" class="Abbrechen">Abrechen</a>
    </form>
</div>
<script src="../../../LandingPage/index.js"></script>

</body>

</html>

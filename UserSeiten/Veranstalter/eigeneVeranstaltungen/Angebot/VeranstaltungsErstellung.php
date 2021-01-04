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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../erstellenAnfrage/VeranstalterAnfrage.css">
    <link rel="stylesheet" href="../../../CSS/modal.css">
    
    <title>Meine Veranstaltungen</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>
<nav>
    <ul>
        <li><a href="../../Startseite/VeranstalterStartseite.php">Startseite</a></li>
        <li><a href="../../erstellenAnfrage/VeranstalterAnfrage.php">Angebot einholen</a></li>
        <li><a href="#">Kontakt</a></li>
        <li><a href="#">Hilfe</a></li>
        <li><a class="active" href="../VeranstalterVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li style="float: right;"> <a href="../../../logout.php"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li style="float: right;"> <a href="../../Datenänderung/VeranstalterDatenänderung.php"> <i class="fas fa-user-circle"></i> </a></li>

    </ul>
</nav>

<br><br>
<h1 style="text-align: center;, margin-top: 150px;">Veranstaltung Erstellung</h1>
<p style="text-align:center;">Zusätzlich nötige Informationen zur Erstellung einer Veranstaltung</p>

<?php
$error = "";
$error_occured = false;

//Abspeichern der übergebenen Angebot_ID in einer Session Variable
if(isset($_POST["annahme"])) {
    $_SESSION["Angebot_ID"] = $_POST["angebot_id"];
}

//Empfangen der nötigen Informationen aus dem Formular
    if (isset($_POST["v_erstellen"])) {

        $Angebot_ID = $_SESSION["Angebot_ID"];

        $Titel = $_POST["v_titel"];
        $Beschreibung = $_POST["v_beschreibung"];
        $V_Art = $_POST["v_art"];
        $Verfuegbarkeit = $_POST["v_verfügbarkeit"];
        $Frist = $_POST["v_abmeldezeitraum"];
        $Kosten = $_POST["v_teilnehmerkosten"];
        $Uhrzeit = $_POST["v_uhrzeit"];

        //Abfragen der nötigen Informationen für die Veranstaltung aus dem Angebot
        $query1 = "SELECT Veranstalter, R_ID, Teilnehmer_gepl, Beginn, Dauer FROM Anfrage_Angebot WHERE BeAr_ID = $Angebot_ID";
        $res1 = $conn->prepare($query1);
        $res1->execute();
        $res1->bind_result($V_ID, $R_ID, $Teilnehmer, $Beginn, $Dauer);
        $res1->fetch();
        $res1->close();

        //Erstellen der Veranstaltung in der Datenbank
        $query2 = "INSERT INTO Veranstaltung VALUES (V_ID, '$Titel', '$Beschreibung', $V_ID, 1, '$V_Art', $Verfuegbarkeit, 1, $R_ID, $Teilnehmer, 0, '$Beginn', '$Uhrzeit', $Dauer, $Frist, $Kosten)";
        $res2 = $conn->query($query2);
        if ($res2 === FALSE) {
            $error = "Es ist ein Fehler beim Einfügen in die Datenbank aufgetreten (Veranstaltung)";
            $error_occured = true;
        } else {
            //Endgültige Belegung des Raumes im Kalender
            $query3 = "UPDATE Kalender SET Status = 1, V_ID = (SELECT V_ID FROM Veranstaltung WHERE Titel='$Titel' AND Beginn = '$Beginn' AND Veranstalter = $V_ID) WHERE B_ID = $Angebot_ID";
            $res3 = $conn->query($query3);
            if ($res3 === FALSE) {
                $error = $error . "<br>" . "Es ist ein Fehler beim Einfügen in die Datenbank aufgetreten (Kalender)";
                $error_occured = true;
            } else {
                //Update Query des Angebots
                $query4 = "UPDATE Anfrage_Angebot SET Status = 4, Buchungsdatum = LOCALTIMESTAMP WHERE BeAr_ID = $Angebot_ID";
                $res4 = $conn->query($query4);
                if ($res4 === FALSE) {
                    $error = $error . "<br>" . "Es ist ein Fehler bei der Update Query im Angebot aufgetreten";
                }
            }
        }
        //Falls ein Fehler aufgetreten ist, Ausgabe der Fehlermeldung
        if ($error_occured) {
            echo $error;
        } else {
            //Ausgabe einer Erfolgsmeldung und TODO:Weiterleitung & Email versenden
            echo "Alles hat funktioniert.";
        }

    }

?>
<!-- Erstellungsformular -->
<div class="container">
    <form action="VeranstaltungsErstellung.php" method="post">

        <div class="row">
            <div class="col-25">
                <label for="titel">Veranstaltungs-Titel</label>
            </div>
            <div class="col-75">
                <input type="text" name="v_titel" placeholder="Veranstaltungs-Titel" maxlength="100" required>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="beschreibung">Veranstaltungsbeschreibung</label>
            </div>
            <div class="col-75">
                <textarea name="v_beschreibung" placeholder="Beschreibung der Veranstaltung" cols="30" rows="10" maxlength="300" required></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="">Start-Uhrzeit</label>
            </div>
            <div class="col-75">
                <input type="time" name="v_uhrzeit" min="08:00" max="18:00" required>
                <small>Wählen Sie eine Uhrzeit zwischen 8:00 und 18:00 Uhr</small>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="art">Veranstaltungsart</label>
            </div>
            <div class="col-75">
                <select name="v_art" required>
                    <option value="Veranstaltung">Veranstaltung</option>
                    <option value="Seminar">Seminar</option>
                    <option value="Vortrag">Vortrag</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="verfügbarkeit">Verfügbarkeit</label>
            </div>
            <div class="col-75">
                <select name="v_verfügbarkeit" required>
                    <option value=1>offen</option>
                    <option value=2>geschlossen</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="abmeldezeitraum">An- bzw. Abmeldezeitraum</label>
            </div>
            <div class="col-75">
                <input type="number" name="v_abmeldezeitraum" min="1" max="14" required>
                <small>Frist in Tagen bis Veranstaltungsbeginn (wählbar: 1-14 Tage)</small>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="">Teilnehmerkosten</label>
            </div>
            <div class="col-75">
                <input type="number" name="v_teilnehmerkosten" min="0.00" max="10000.00" step="0.01" required>
                <small>Gesamtkosten pro Teilnehmern in Euro</small>
            </div>
        </div>

        <div class="row">
            <button class="btnanfrage" type="button" id="erstellen" name="erstellen" onclick="document.getElementById('id01').style.display='block'">Veranstaltung erstellen</button>
            <a href="../VeranstalterVeranstaltungen.php">zurück zu Veranstaltungen</a>
        </div>

        <!--Modal wenn Veranstalter auf erstellen klickt-->
        <div id="id01" class="modal">
            <div class="modal_content" action="Angebotseite.php" method="post">
                <div class="modal_container">
                    <h1>Veranstaltung erstellen</h1>
                    <p>Eine erfolgreiche Erstellung der Veranstaltung führt zu einem gültigen Vertrag und ist bei etwaiger Stornierung mit Kosten verbunden.</p>
                    <p>Wollen Sie diese Veranstaltung erstellen?</p>
                    <div class="modal_clearfix">
                        <input type="hidden" name="angebot_id" value="<?php echo $Angebot_ID; ?>"><!--TODO angebot id richtig? aus angebot übernommen-->
                        <button class="modal_btnconfirm" type="submit" name="v_erstellen" onclick="document.getElementById('id01').style.display='none'">Ablehnen</button>
                        <button class="modal_btnabort" type="button" onclick="document.getElementById('id01').style.display='none'">Abbrechen</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script class="VeranstaltungsErstellung.js"></script>

</body>
</html>
<?php
session_start();

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

//B_ID Array der internen Abrechnungen
$B_ID_array = array();

//Error Variablen
$error = "";
$error_occured = false;

//Abrechnungsvorgang
if(isset($_POST["Abrechnung"])){

    //Abspeichern der V_ID, BeAr_ID, Kategorie, Status der Veranstaltung beim Auswählen einer Veranstaltung auf der Abrechnungsseite
    $V_ID = $_POST["V_ID"];
    $BeAr_ID = $_POST["BeAr_ID"];
    $Kategorie = $_POST["Kategorie"];
    $Status = $_POST["Status"];

    //Bei externen Veranstaltungen (Abrechnung gegenüber einem Veranstalter)
    if($Kategorie == 1){

        //Stornierte Veranstaltungen werden je nach Stornodatum anders bepreist, Angebotspreis wird hier entsprechend geupdated
        if($Status == 4){

            //Reduktion des Preises um 50% bei Stornierung eine Woche vor Beginn oder früher
            $storno1 = "UPDATE Anfrage_Angebot SET Angebotspreis = Angebotspreis * 0.5
                        WHERE Beginn - Stornodatum >= 7 AND BeAr_ID = $BeAr_ID";

            //Reduktion des Preises um 25% bei Stornierung innerhalb einer Woche vor Beginn
            $storno2 = "UPDATE Anfrage_Angebot SET Angebotspreis = Angebotspreis * 0.75
                        WHERE Beginn - Stornodatum < 7 AND BeAr_ID = $BeAr_ID";

            $conn->query($storno1);
            $conn->query($storno2);

        }

        //Nötige Daten für die Abrechnung aus Anfrage/Angebot abfragen
        $query1 = "SELECT Veranstalter, Angebotspreis FROM Anfrage_Angebot WHERE BeAr_ID = $BeAr_ID";
        $res1 = $conn->prepare($query1);
        $res1->execute();
        $res1->bind_result($B_ID, $Preis);
        $res1->fetch();
        $res1->close();

        //Nötige Daten für die Abrechnung aus dem Veranstalterkonto abfragen
        $query2 = "SELECT Strasse, Haus_nr, PLZ, Ort, Land FROM Veranstalterkonto WHERE B_ID = $B_ID";
        $res2 = $conn->prepare($query2);
        $res2->execute();
        $res2->bind_result($Strasse, $Haus_Nr, $PLZ, $Ort, $Land);
        $res2->fetch();
        $res2->close();

        //Erstellen der Abrechnung an Veranstalter
        $query_abrechnung1 = "INSERT INTO Abrechnung VALUES (A_ID, $V_ID, $BeAr_ID, $B_ID, LOCALTIMESTAMP, $Preis, '$Strasse', $Haus_Nr, $PLZ, '$Ort', '$Land')";
        $res_abrechnung1 = $conn->query($query_abrechnung1);
        if($res_abrechnung1 === FALSE){
            $error = "Fehler bei der Erstellung der Abrechnung (extern) in der Datenbank";
            $error_occured = true;
        }

    }

    //Bei internen Veranstaltungen (Abrechnung gegenüber mehreren Teilnehmern)
    if($Kategorie == 2){

        //Nötige Daten für die Abrechnung aus Veranstaltung
        $query3 = "SELECT Kosten FROM Veranstaltung WHERE V_ID = $V_ID";
        $res3 = $conn->prepare($query3);
        $res3->execute();
        $res3->bind_result($Teilnehmer_Preis);
        $res3->fetch();
        $res3->close();

        //Nötige Daten für die Abrechnung aus den Teilnehmerkonten der angemeldeten Teilnehmer
        $query4 = "SELECT B_ID, Strasse, Haus_nr, PLZ, Ort, Land FROM Veranstalterkonto
                   JOIN Teilnehmerliste_offen T on Veranstalterkonto.B_ID = T.B_ID
                   WHERE T.V_ID = $V_ID";
        $res4 = $conn->query($query4);

        //Erstellen der Abrechnungseinträge für jeden Teilnehmer einer internen Veranstaltungen
        if($res4->num_rows > 0) {
            while ($i = $res4->fetch_row()) {

                //Speichern der Benutzer_IDs in ein Array für die spätere Versendung der Abrechnung per Mail
                array_push($B_ID_array, $i[0]);

                $query_abrechnung2 = "INSERT INTO Abrechnung VALUES (A_ID, $V_ID, NULL, $i[0], LOCALTIMESTAMP, $Teilnehmer_Preis, '$i[1]', $i[2], $i[3], '$i[4]', '$i[5]')";
                $res_abrechnung2 = $conn->query($query_abrechnung2);
                if($res_abrechnung2 === FALSE){
                    $error = "Fehler bei der Erstellung der Abrechnung (intern) in der Datenbank";
                    $error_occured = true;
                }
            }

        }
        else{
            $error = "Fehler bei Abfrage der Teilnehmer einer internen Veranstaltung";
            $error_occured = true;
        }

    }


    //Ausgabe möglicher Fehlermeldungen
    if($error_occured){
        echo $error;
    }



}

//TODO Nach dem Klicken auf den Button des Formulars Emails versenden sowie Veranstaltungsstatus auf abgerechnet setzen

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Abrechnung extern</title>
    <link rel="stylesheet" type="text/css" href="../Angebotserstellung/Kapazitätenstylesheet.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../header.css" media="screen" />
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>


<div class="contact-us">
    <img src="vmslogo.png" width="600px"  height="150px" style="margin-bottom: 2em;padding-left: 1em " >
    <h1>Rechnung </h1>
    <!-- Fomular  mit Angaben aller Rechnungsdaten-->
    <h3>
     Vielen Dank für ihre Buchung in unserem Seminarhaus. <br> Bitte überweisen sie den genannten Betrag innerhalb der nächsten 14 Tage. <br>
        Wir freuen uns Sie bald wieder bei uns begrüßen zu dürfen.
    </h3>

    <?php
    //Anzeige für externe Abrechnungen
    if($Kategorie == 1){

        //Abfrage der in der Abrechnung gespeicherten Daten
        $query = "SELECT A_ID, Kunde, Strasse, Haus_nr, PLZ, Ort, Land, Rechnungsdatum, Preis FROM Abrechnung WHERE V_ID = $V_ID";
        $res = $conn->query($query);
        if($res === FALSE){
            echo "FEHLER: Abfrage der Abrechnung scheint kein Ergebnis vorzuliegen";
        }
        else{
            while($i = $res->fetch_row()){
        ?>

    <form action="" method="post">
        <label for="Rechnungsnummer">Rechnungsnummer </label><output id="Rechnungsnummer" name="Rechnungsnummer"  type="number" > <?php echo $i[0]; ?></output>
        <label for="Veranstaltung_ID"> Veranstaltung_ID </label><output id="Veranstaltung_ID"  name="Veranstaltung_ID"  type="number" > <?php echo $V_ID; ?></output>
        <label for="Kunden_ID">Kunden_ID </label><output id="Kunden_ID"  name="Kunden_ID"  type="number" > <?php echo $i[1]; ?></output>
        <label for="Rechnungsadresse" style="font-style: "> Ihre Rechnungsadresse: </label>
        <label for="Straße">Straße und Hausnummer </label><output id="Straße"  name="Straße"  type="text" ><?php echo $i[2] . " " . $i[3]; ?> </output>
        <label for="Plz">Postleitzahl </label><output id="Plz"  name="Plz"  type="number" > <?php echo $i[4]; ?></output>
        <label for="Ort">Ort </label><output id="Ort"  name="Ort"  type="text" > <?php echo $i[5]; ?></output>
        <label for="Land">Land </label><output id="Land"  name="Land"  type="text"  ><?php echo $i[6]; ?> </output>
        <label for="Rechnungsdatum">Rechnungsdatum </label><output id="Rechnungsdatum"  name="Rechnungsdatum" type="date" > <?php echo $i[7]; ?></output>
        <label for="Preis">Preis </label><output id="Preis"  name="Preis" type="number" > <?php echo $i[8]; ?></output>
        <label for="Zusatz">Zusätzliche Anmerkung </label> <textarea  cols="40" rows="8" maxlength="300" id="Zusatz" name="Zusatz"> </textarea>
        <label for="Preis">Zahlung an: </label><output style="border-color: #f45702" > VMS Mittelerde IBAN:DE09121688720378475751 Gringotts Zaubererbank  </output>
<!--        Buttons zum Abbrechen und zurückkehren zur Übersicht und zum Senden der Rechnung  -->
        <button type="submit" class="Auslösen" name="Hinzufügen"> Senden</button>
        <a href="#" type="button" class="Abbrechen">Abrechen</a>

    </form>

    <?php }}} ?>

    <?php
    //Anzeige für interne Abrechnungen
    if($Kategorie == 2){

    ?>

    <form action="" method="post">

        <label for="Veranstaltung_ID"> Veranstaltung_ID </label><output id="Veranstaltung_ID"  name="Veranstaltung_ID"  type="number" > <?php echo $V_ID; ?></output>
        <label for="Rechnungsdatum">Rechnungsdatum </label><output id="Rechnungsdatum"  name="Rechnungsdatum" type="date" > <!--TODO Heutiges Datum --></output>
        <label for="Preis">Preis pro Teilnehmer </label><output id="Preis"  name="Preis" type="number" > <?php echo $Teilnehmer_Preis; ?></output>
        <label for="Zusatz">Zusätzliche Anmerkung </label> <textarea  cols="40" rows="8" maxlength="300" id="Zusatz" name="Zusatz"> </textarea>
        <label for="Preis">Zahlung an: </label><output style="border-color: #f45702" > VMS Mittelerde IBAN:DE09121688720378475751 Gringotts Zaubererbank  </output>
        <!--        Buttons zum Abbrechen und zurückkehren zur Übersicht und zum Senden der Rechnung  -->
        <button type="submit" class="Auslösen" name="Hinzufügen"> Senden</button>
        <a href="#" type="button" class="Abbrechen">Abrechen</a>

    </form>

    <?php }?>

</body>
</html>

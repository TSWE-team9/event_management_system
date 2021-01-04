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

    <form action="" method="post">
        <label for="Rechnungsnummer">Rechnungsnummer </label><output id="Rechnungsnummer" name="Rechnungsnummer"  type="number" > </output>
        <label for="Veranstaltung_ID"> Veranstaltung_ID </label><output id="Veranstaltung_ID"  name="Veranstaltung_ID"  type="number" > </output>
        <label for="Kunden_ID">Kunden_ID </label><output id="Kunden_ID"  name="Kunden_ID"  type="number" > </output>
        <label for="Rechnungsadresse" style="font-style: "> Ihre Rechnungsadresse: </label>
        <label for="Straße">Straße und Hausnummer </label><output id="Straße"  name="Straße"  type="text" > </output>
        <label for="Plz">Postleitzahl </label><output id="Plz"  name="Plz"  type="number" > </output>
        <label for="Ort">Ort </label><output id="Ort"  name="Ort"  type="text" > </output>
        <label for="Land">Land </label><output id="Land"  name="Land"  type="text"  > </output>
        <label for="Rechnungsdatum">Rechnungsdatum </label><output id="Rechnungsdatum"  name="Rechnungsdatum" type="date" > </output>
        <label for="Preis">Preis </label><output id="Preis"  name="Preis" type="number" > </output>
        <label for="Zusatz">Zusätliche Anmerkung </label> <textarea  cols="40" rows="8" maxlength="300" id="Zusatz" name="Zusatz"> </textarea>
        <label for="Preis">Zahlung an: </label><output style="border-color: #f45702" > VMS Mittelerde IBAN:DE09121688720378475751 Gringotts Zaubererbank  </output>
<!--        Buttons zum Abbrechen und zurückkehren zur Übersicht und zum Senden der Rechnung  -->
        <button type="submit" class="Auslösen" name="Hinzufügen"> Senden</button>
        <a href="#" type="button" class="Abbrechen">Abrechen</a>

    </form>
</body>
</html>

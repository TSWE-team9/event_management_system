<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="./anfrage.css">
    <link rel="stylesheet" href="../modal.css">
    <title>Meine Veranstaltungen</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>
<nav>
    <ul>
        <li><a href="VeranstalterStartseite.php">Startseite</a></li>
        <li><a href="VeranstalterAnfrage.php">Angebot einholen</a></li>
        <li><a href="#">Kontakt</a></li>
        <li><a href="#">Hilfe</a></li>
        <li><a class="active" href="VeranstalterVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li style="float: right;"> <a href="../logout.php"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li style="float: right;"> <a href="VeranstalterDatenänderung.php"> <i class="fas fa-user-circle"></i> </a></li>

    </ul>
</nav>

<br><br>
<h1 style="text-align: center;, margin-top: 150px;">Veranstaltung Ertstellung</h1>
<p style="text-align:center;">Zusätzlich nötige Informationen zur Erstellung einer veranstaltung</p>

<!-- Erstellungsformular -->
<div class="container">
    <form action="#" method="post">

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
                <label for="art">Veranstaltungsart</label>
            </div>
            <div class="col-75">
                <select name="v_art" required>
                    <option value=1>Veranstaltung</option>
                    <option value=2>Seminar</option>
                    <option value=3>Vortrag</option>
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
                <label for="abmeldezeitraum">Abmeldezeitraum</label>
            </div>
            <div class="col-75">
                <input type="number" name="v_abmeldezeitraum" required>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="">Teilnehmerkosten</label>
            </div>
            <div class="col-75">
                <input type="number" name="v_teilnehmerkosten" min="0.00" max="10000.00" step="0.01" required>
            </div>
        </div>

        <div class="row">
            <button class="btnanfrage" id="erstellen" onclick="document.getElementById('id02').style.display='block'">Veranstaltung erstellen</button>           
            <a href="Veranstalterveranstaltungen.php">zurück zu Veranstaltungen</a>
        </div>

    </form>
</div>

<script>

    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

</script>

</body>
</html>
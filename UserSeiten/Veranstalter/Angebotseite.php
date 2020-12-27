!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../listtabs.css">
    <link rel="stylesheet" type="text/css" href="./angebot.css">
    <link rel="stylesheet" type="text/css" href="../modal.css">
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

<div class="container">
    <!--Details zum Angebot des Betreibers-->
    <div class="row">
        <div class="col-25">Teilnehmerzahl</div>
        <div class="col-75">#Teilnehmerzahl#</div>
    </div>
    <div class="row">
        <div class="col-25">Veranstaltungsbeginn</div>
        <div class="col-75">#Datum#</div>
    </div>
    <div class="row">
        <div class="col-25">Veranstaltungsdauer</div>
        <div class="col-75">#Dauer#</div>
    </div>
    <div class="row">
        <div class="col-25">Anmerkungen</div>
        <div class="col-75">#Anmerkungen#</div>
    </div>
    <div class="row">
        <div class="col-25">Preis</div>
        <div class="col-75">#Preis#</div>
    </div>
    <div class="row">
        <!--Button zur Annhme des Angebots-->
        <div class="col-33">
            <form action="#" method="post">
            <input type="hidden" name="angebot_id" value="#angebots_id#">   
                <button class="btn" type="submit" name="annahme">Angebot Annehmen</button>
            </form>
        </div>

        <!--Button zur Ablehnung des Angebots-->
        <div class="col-33">
            <button class="btn" id="ablehnen" onclick="document.getElementById('id01').style.display='block'">Angebot ablehnen</button>
        </div>
        <!--Modal wenn Veranstalter auf Ablehnen klickt-->
        <div id="id01" class="modal">
            <form class="modal_content" action="#" method="post">
                <div class="modal_container">
                    <h1>Angebot ablehnen</h1>
                    <p>Wollen Sie das Angebot wircklich ablehnen?</p>
                    <div class="modal_clearfix">
                        <input type="hidden" name="angebot_id" value="#angebots_id#">
                        <button class="modal_btnconfirm" type="submit" name="angebot_ablehnen" onclick="document.getElementById('id01').style.display='none'">Ablehnen</button>   
                        <button class="modal_btnabort" onclick="document.getElementById('id01').style.display='none'">Abbrechen</button>
                    </div>
                </div>
            </form>
        </div>

        <!--Button zur Änderung des Datums; nur wenn Datum vom Betreiber geändert wurde-->
        <div class="col-33">
            <button class="btn" id="aendern" onclick="document.getElementById('id02').style.display='block'">Anfragedatum ändern</button>
        </div>
        <!--Modal wenn Veranstalter auf Ablehnen klickt-->
        <div id="id02" class="modal">
            <form class="modal_content" action="#" method="post">
                <div class="modal_container">
                    <h1>Anfragedatum ändern</h1>
                    <p>Geben Sie ein neues Beginn Datum der Veranstaltung an</p>
                    <div class="modal_clearfix">
                        <input type="hidden" name="anfrage_id" value="#anfrage_id#">
                        <input type="date" name="new_date" id="new_date" required>
                        <button class="modal_btnconfirm" type="submit" name="angebot_ablehnen" onclick="document.getElementById('id02').style.display='none'">Anfragedatum ändern</button>   
                        <button class="modal_btnabort" onclick="document.getElementById('id02').style.display='none'">Abbrechen</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    // Get the modal
    var modal1 = document.getElementById('id01');
    var modal2 = document.getElementById('id02');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal1) {
            modal1.style.display = "none";
        }
        if (event.target == modal2) {
            modal2.style.target == "none";
        }
    }

    // Get the modal
    var modal2 = document.getElementById('id02');

</script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../CSS/modal.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/listen.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/veranstaltungen.css">
    <title>Veranstaltung</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>
<nav>
    <ul>
        <li><a href="../Startseite/VeranstalterStartseite.php">Startseite</a></li>
        <li><a href="../erstellenAnfrage/VeranstalterAnfrage.php">Angebot einholen</a></li>
        <li><a href="#">Kontakt</a></li>
        <li><a href="#">Hilfe</a></li>
        <li><a class="active" href="../eigeneVeranstaltungen/VeranstalterVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li style="float: right;"> <a href="../../logout.php"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li style="float: right;"> <a href="../Datenänderung/VeranstalterDatenänderung.php"> <i class="fas fa-user-circle"></i> </a></li>
    </ul>
</nav>

<div class="container-50-outer">
    <h1 class="hdln">#Veranstaltungstitel#</h1><!--TODO-->
    <p class="txt">Beschreibung</p>

    <form action="#" method="post">
        <textarea name="nachricht" placeholder="schreiben Sie hier den Inhalt iher Mitteilung" cols="30" rows="10" maxlength="300" required></textarea>

        <button class="btn" style="float: right;" type="button" onclick="document.getElementById('id01').style.display='block'">Mitteilung versenden</button>
        <!--Modal wenn Veranstalter auf Ablehnen klickt-->
        <div id="id01" class="modal">
            <div class="modal_content">
                <div class="modal_container">
                    <h1>Mitteilung versenden</h1>
                    <p>Wollen Sie diese Mitteilung an alle Teilnemer der Veranstaltung versenden?</p>
                    <div class="modal_clearfix">
                        <input type="hidden" name="v_id" value="#v_id#"><!--TODO V_ID-->
                        <button class="modal_btnconfirm" type="submit" name="mitteilung_senden" onclick="document.getElementById('id01').style.display='none'">Versenden</button>
                        <button class="modal_btnabort" type="button" onclick="document.getElementById('id01').style.display='none'">Abbrechen</button>
                    </div>
                </div>           
            </div>
        </div>
    </form>

    <form action="../../Veranstaltungsseite/VeranstaltungsSeite.php" method="post">
        <input type="hidden" name="veranstaltung_id" value="#v_id#"><!--TODO V_ID-->
        <button type="submit" class="btn" name="veranstaltung">zurück zur Veranstaltung</button>
  </form>
  
</div>

<script src="SeiteMitteilung.js"></script>

</body>
</html>
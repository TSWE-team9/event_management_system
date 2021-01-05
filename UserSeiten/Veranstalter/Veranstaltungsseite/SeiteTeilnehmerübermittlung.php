<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../CSS/listen.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/modal.css">
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
    <h1 class="hdln">#Veranstaltungstitel#</h1>
    <p class="txt">Um eine Teilnehmerliste von einer Excel Datei zu importieren, wählen Sie zuerst die Datei aus und importieren diese dann. Alternativ können Sie die Teilnehmerliste manuell eingeben.</p>

    <div class="container-80-inner">
        <h2 class="hdln">Importierung aus Excel Datei</h2>
        <form action="#" method="post">
            <input type="hidden" name="v_id" id="v_id" value="#v_id#">
            <label for="t_liste">Wählen Sie eine Datei aus:</label>
            <input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" name="t_liste" id=" t_liste" />
            <button style="float: right;" type="button" class="btn" onclick="document.getElementById('id01').style.display='block'">Teilnehmerliste importieren</button> 

            <!--Modal wenn auf Importieren gedrückt wurde-->
            <div id="id01" class="modal">
                <div class="modal_content"> 
                    <div class="modal_container">
                        <h1>Teilnehmerübermittlung</h1>
                        <p>Falls bereits eine Teilnehmerliste übermittelt wurde, wird diese komplett mit der neuen Liste ersetzt.</p>
                        <p>Wollen Sie diese Teilnehmerliste übermitteln?</p>
                        <div class="modal_clearfix">
                            <button class="modal_btnconfirm" type="submit" name="liste-übergeben" onclick="document.getElementById('id01').style.display='none'">Übermitteln</button>
                            <button class="modal_btnabort" type="button" onclick="document.getElementById('id01').style.display='none'">Abbrechen</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!--Button um zur Veranstaltungsseite zurückzukehren-->
        <form action="../../Veranstaltungsseite/VeranstaltungsSeite.php" method="post">
            <input type="hidden" name="veranstaltung_id" value="<?php echo $V_ID; ?>">
            <button type="submit" class="btn" name="veranstaltung">zurück zur Veranstaltung</button> 
        </form>
    </div>

    <div class="container-80-inner">
        <h2 class="hdln">Manuelle Eingabe</h1>

        <div class="row">
            <div class="col-50">Nachname</div>
            <div class="col-50">Vorname</div>
        </div>
        <form action="#" method="post">
            <input type="hidden" name="v_id" id="v_id" value="#v_id#">
            <!--Schleife für max anzahl-->
            <div class="row">
                <div class="col-50"><input type="text" id="#nachname counter#" name="#nachname counter#"></div>
                <div class="col-50"><input type="text" id="#vorname counter#" name="#vorname counter#"></div>
            </div>
            <!--Schleife Ende-->
            <br>
            <button style="float: right;" type="button" class="btn" onclick="document.getElementById('id02').style.display='block'">Teilnehmerliste übermitteln</button>

            <!--Modal wenn auf Importieren gedrückt wurde-->
            <div id="id02" class="modal">
                <div class="modal_content"> 
                    <div class="modal_container">
                        <h1>Teilnehmerübermittlung</h1>
                        <p>Falls bereits eine Teilnehmerliste übermittelt wurde, wird diese komplett mit der neuen Liste ersetzt.</p>
                        <p>Wollen Sie diese Teilnehmerliste übermitteln?</p>
                        <div class="modal_clearfix">
                            <button class="modal_btnconfirm" type="submit"  id="anmelden" name="liste-übmitteln" onclick="document.getElementById('id02').style.display='none'">Übermitteln</button>
                            <button class="modal_btnabort" type="button" onclick="document.getElementById('id02').style.display='none'">Abbrechen</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!--Button um zur Veranstaltungsseite zurückzukehren-->
        <form action="../../Veranstaltungsseite/VeranstaltungsSeite.php" method="post">
            <input type="hidden" name="veranstaltung_id" value="<?php echo $V_ID; ?>">
            <button type="submit" class="btn" name="veranstaltung">zurück zur Veranstaltung</button> 
        </form>

    </div>

</div>

<script src="SeiteTeilnehmerübermittlung.js"></script>

</body>
</html>
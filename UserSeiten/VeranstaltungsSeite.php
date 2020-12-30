<?php

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="veranstaltungen.css">
    <title>Veranstaltungsseite</title>
</head>

<body>

<div class="container-80">

    <div class="row">
        <h2 style="text-align: center;">#Titel#</h2>
    </div>

    <div class="row">
        <div class="col-info">
            <p class="info">Veranstalter</p>
        </div>
        <div class="col-desc">
            <p class="desc">#name veranstalter#</p>
        </div>
    </div>

    <div class="row">
        <div class="col-info">
            <p class="info">Veranstaltungsbeschreibung</p>
        </div>
        <div class="col-desc">
            <p class="desc">#beschreibung#</p>
        </div>
    </div>

    <div class="row">
        <div class="col-info">
            <p class="info">Veranstaltungsart</p>
        </div>
        <div class="col-desc">
            <p class="desc">#art#</p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-info">
            <p class="info">Verfügbarkeit</p>
        </div>
        <div class="col-desc">
            <!--if else ob offen oder geschlossen-->
            <!--offen-->
            <p class="desc">Anmeldung für registrierte Nutzer möglich.</p>
            <!--geschlossen-->
            <p class="desc">Anmeldung nur über Veranstalter möglich.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-info">
            <p class="info">Veranstaltungs-Status</p>
        </div>
        <div class="col-desc">
            <p class="desc">#status#</p>
        </div>
    </div>

    <div class="row">
        <div class="col-info">
            <p class="info">Veranstaltungsort</p>
        </div>
        <div class="col-desc">
            <p class="desc">#ort#</p>
        </div>
    </div>

    <div class="row">
        <div class="col-info">
            <p class="info">Teilnehmerzahl</p>
        </div>
        <div class="col-desc">
            <p class="desc">#aktuelle/max Teilnehmeranzahl#</p>
        </div>
    </div>

    <div class="row">
        <div class="col-info">
            <p class="info">Veranstaltungszeitraum</p>
        </div>
        <div class="col-desc">
            <p class="desc">#beginn# - #ende#</p>
        </div>
    </div>

    <div class="row">
        <div class="col-info">
            <p class="info">Anmeldezeitraum</p>
        </div>
        <div class="col-desc">
            <p class="desc">#letztes #</p>
        </div>
    </div>

    <div class="row">
        <div class="col-info">
            <p class="info">Teilnahmekosten</p>
        </div>
        <div class="col-desc">
            <p class="desc">#kosten#</p>
        </div>
    </div>

</body>
</html>
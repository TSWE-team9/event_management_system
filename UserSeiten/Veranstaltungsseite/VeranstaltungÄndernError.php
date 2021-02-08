<!--Errors Anmeldung-->
<?php  if (count($errors_anmeldung) > 0) : ?>
    <div class="overlay">
        <div class="popup">
            <h2 class="hdln">Anmeldung fehlgeschlagen</h2>
            <a class="close" href="../Teilnehmer/anzeigenAngebot/TeilnehmerAngebot.php">&times;</a>
            <div class="content">
                <?php foreach ($errors_anmeldung as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach ?>
            </div>
        </div>
    </div>
<?php  endif ?>

<!--Errors Abmeldung-->
<?php  if (count($errors_abmeldung) > 0) : ?>
    <div class="overlay">
        <div class="popup">
            <h2 class="hdln">Abmeldung fehlgeschlagen</h2>
            <a class="close" href="../Teilnehmer/angemeldeteVeranstaltungen/TeilnehmerVeranstaltungen.php">&times;</a>
            <div class="content">
                <?php foreach ($errors_abmeldung as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach ?>
            </div>
        </div>
    </div>
<?php  endif ?>

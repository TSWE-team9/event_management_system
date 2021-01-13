
<?php  if (count($errors_anmeldung) > 0) : ?>
    <div class="overlay">
        <div class="popup">
            <h2 class="hdln">Anmeldung fehlgeschlagen</h2>
            <a class="close" href="../Teilnehmer/anzeigenAngebot/Teilnehmerangebot.php">&times;</a>
            <div class="content">
                <?php foreach ($errors_anmeldung as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach ?>
            </div>
        </div>
    </div>
<?php  endif ?>

<?php  if (count($errors_abmeldung) > 0) : ?>
    <div class="overlay">
        <div class="popup">
            <h2 class="hdln">Abmeldung fehlgeschlagen</h2>
            <a class="close" href="../Teilnehmer/angemeldeteVeranstaltungen/Teilnehmerveranstaltungen.php">&times;</a>
            <div class="content">
                <?php foreach ($errors_abmeldung as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach ?>
            </div>
        </div>
    </div>
<?php  endif ?>

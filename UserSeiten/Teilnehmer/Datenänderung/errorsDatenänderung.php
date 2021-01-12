<?php  if (count($errors_p) > 0) : ?>
    <div class="overlay">
        <div class="popup">
            <h2 class="hdln">Passwortänderung</h2>
            <a class="close" href="./TeilnehmerDatenänderung.php">&times;</a>
            <div class="content">
                <?php foreach ($errors_p as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach ?>
            </div>
        </div>
    </div>
<?php  endif ?>

<?php  if (count($errors_e) > 0) : ?>
    <div class="overlay">
        <div class="popup">
            <h2 class="hdln">E-Mail Änderung</h2>
            <a class="close" href="./TeilnehmerDatenänderung.php">&times;</a>
            <div class="content">
                <?php foreach ($errors_e as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach ?>
            </div>
        </div>
    </div>
<?php  endif ?>

<?php  if (count($errors_d) > 0) : ?>
    <div class="overlay">
        <div class="popup">
            <h2 class="hdln">Adressdaten Änderung</h2>
            <a class="close" href="./TeilnehmerDatenänderung.php">&times;</a>
            <div class="content">
                <?php foreach ($errors_d as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach ?>
            </div>
        </div>
    </div>
<?php  endif ?>

<?php  if (count($errors_del) > 0) : ?>
    <div class="overlay">
        <div class="popup">
            <h2 class="hdln">Kontolöschung fehlgeschlagen</h2>
            <a class="close" href="./TeilnehmerDatenänderung.php">&times;</a>
            <div class="content">
                <?php foreach ($errors_del as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach ?>
            </div>
        </div>
    </div>
<?php  endif ?>

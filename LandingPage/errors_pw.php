<?php  if (count($errors_pw) > 0) : ?>
    <div class="overlay">
        <div class="popup">
            <h2 class="hdln">Passwortänderung</h2>
            <a class="close" href="./index.php">&times;</a>
            <div class="content">
                <?php foreach ($errors_pw as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach ?>
            </div>
        </div>
    </div>
<?php  endif ?>
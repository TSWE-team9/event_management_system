<?php  if (count($errors_v) > 0) : ?>
    <div class="overlay">
        <div class="popup">
            <h2 class="hdln">Registrierung</h2>
            <a class="close" href="./index.php">&times;</a>
            <div class="content">
                <?php foreach ($errors_v as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach ?>
            </div>
        </div>
    </div>
<?php  endif ?>
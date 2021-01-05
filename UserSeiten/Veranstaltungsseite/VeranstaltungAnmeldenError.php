<?php  if (count($errors_anmeldung) > 0) : ?>
    <div class="error">
        <?php foreach ($errors_anmeldung as $error) : ?>
            <p><?php echo $error ?></p>
        <?php endforeach ?>
    </div>
<?php  endif ?>
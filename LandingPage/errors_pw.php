<?php  if (count($errors_pw) > 0) : ?>
    <div class="error">
        <?php foreach ($errors_pw as $error) : ?>
            <p><?php echo $error ?></p>
        <?php endforeach ?>
    </div>
<?php  endif ?>

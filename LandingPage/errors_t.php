<?php  if (count($errors_t) > 0) : ?>
    <div class="error">
        <?php foreach ($errors_t as $error) : ?>
            <p><?php echo $error ?></p>
        <?php endforeach ?>
    </div>
<?php  endif ?>
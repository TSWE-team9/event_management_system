<?php  if (count($errors_v) > 0) : ?>
    <div class="error">
        <?php foreach ($errors_v as $error) : ?>
            <p><?php echo $error ?></p>
        <?php endforeach ?>
    </div>
<?php  endif ?>
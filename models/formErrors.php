<?php 


if(count($errors) > 0): ?>
    <?php foreach($errors as $error):?>
        <p class="alert alert-danger"><?php echo $error; ?></p>
    <?php endforeach;?>
<?php endif; ?>
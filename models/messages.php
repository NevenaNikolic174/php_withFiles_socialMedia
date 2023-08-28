<?php if(isset($_SESSION['message'])): ?>
<div class="msg" style="margin: 0px auto; width: 50%; text-align:center;">
  <p class="<?php echo $_SESSION['type']; ?>">
    <?php echo $_SESSION['message'];?>
  </p>
</div>
  <?php
    unset($_SESSION['message']);
    unset($_SESSION['type']);
  ?>

<?php endif;?>
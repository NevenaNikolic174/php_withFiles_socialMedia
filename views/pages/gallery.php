<?php
    
    $images = selectAll('galerija');
  ?>

<h2 style="text-align: center; padding: 2rem;">Websites gallery</h2>
<div class="row row-cols-1 row-cols-md-3 g-4" style="margin: 10px 20px;">
  <?php foreach($images as $img): ?>
    <div class="col">
      <div class="card" style="border: none;">
      <img class="images" src="assets/images/<?php echo $img['putanja']; ?>" alt="<?php echo $img['alt']?>">
      </div>
    </div>
  <?php endforeach; ?>
</div>


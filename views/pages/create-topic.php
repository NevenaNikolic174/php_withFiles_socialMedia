<?php

include "models/topics.php";

adminOnly(); 
?>


<section class="vh-100 gradient-custom">
  <div class="py-5">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Add Topic</h2>
            <?php include "models/formErrors.php"; ?>
            <form action="index.php?page=create-topic" method="post" novalidate>
              <div class="form-group mb-4">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" class="form-control form-control-lg" name="name" value="<?php echo isset($name) ? $name : ''; ?>" />
              </div>
              <div class="form-group mb-4">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" class="form-control" name="description" rows="8"><?php echo isset($description) ? $description : ''; ?></textarea>
              </div>
              <div class="d-grid">
                <button class="btn btn-primary btn-lg" id="addTopic" type="submit" name="add-topic">Add Topic</button>
              </div>
            </form>
            <div id="rezultat"></div>
          </div>
          <div class="card-footer">
            <a href="index.php?page=index-topic" class="btn btn-secondary">Manage Topics</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



  
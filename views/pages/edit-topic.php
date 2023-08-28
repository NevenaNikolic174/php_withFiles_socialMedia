<?php
   
    include "models/topics.php";
  
    adminOnly(); 
   
?>


     
<section class="vh-100 gradient-custom">
    <div class="container">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-8 col-lg-6 col-xl-7">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="index.php?page=create-topic" class="btn btn-success">Add Topic</a>
                            <a href="index.php?page=index-topic" class="btn btn-success">Manage Topics</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Edit Topic</h2>
                        <?php include "models/formErrors.php"; ?>
                          <form action="index.php?page=edit-topic" method="post" novalidate>
                          <div class="mb-3">
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                          </div>
                          <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                          </div>
                          <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="8"><?php echo $description; ?></textarea>
                          </div>
                          <button class="btn btn-success btn-lg px-5" name="update-topic" type="submit">Update Topic</button>
                        </form>
                      </div>
                    </div>
                    <div id="rezultat"></div>
                  </div>
                </div>
              </div>
            </section>




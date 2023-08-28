<?php
adminOnly();
include "models/users.php";


?>


     
  <section class="vh-100 gradient-custom">
    <div class="container">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-8 col-lg-6 col-xl-7">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="index.php?page=create-user" class="btn btn-success">Add User</a>
                            <a href="index.php?page=index-user" class="btn btn-success">Manage Users</a>
                        </div>
                    </div>
                    <div class="card-body">
                      <h2 class="card-title text-center mb-4">Edit Users</h2>
                    
                      <?php include "models/formErrors.php"; ?>
                        <form action="index.php?page=edit-user" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $id ?>"/>
                        <div class="form-floating mb-4">
                          <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" />
                          <label for="username">Name</label>
                        </div>
                        <div class="form-floating mb-4">
                          <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" />
                          <label for="email">Email</label>
                        </div>
                        <div class="form-floating mb-4">
                          <input type="password" class="form-control" name="password" value="<?php echo $password; ?>" />
                          <label for="password">Password</label>
                        </div>
                        <div class="form-floating mb-4">
                          <input type="password" class="form-control" name="password_confirmation" value="<?php echo $passConfim; ?>" />
                          <label for="password_confirmation">Password confirmation</label>
                        </div>
                        <div class="form-check mb-4">
                          <?php if (isset($role) && $role == 1) : ?>
                            <input type="checkbox" name="role" class="form-check-input" checked />
                            <label class="form-check-label" for="role">Admin</label>
                            <?php else : ?>
                              <input type="checkbox" name="role" class="form-check-input" />
                              <label class="form-check-label" for="role">Admin</label>
                            <?php endif; ?>
                        </div>
                        <div class="d-grid">
                          <button class="btn btn-success btn-lg px-5" id="addTopic" name="update-user" type="submit">Update user</button>
                       
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </section>



<?php 
include "models/users.php";
adminOnly();
?>
<section class="vh-100 gradient-custom">
  <div class="container py-5">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-light">
          <div class="card-body">
            <h2 class="card-title text-center">Add User</h2>
            
            <?php include "models/formErrors.php"; ?>
              <form action="index.php?page=create-user" method="post" enctype="multipart/form-data" novalidate>
              <div class="form-group">
                <label for="username">Name</label>
                <input type="text" id="username" class="form-control" name="username"  value="<?php echo isset($username) ? $username : ''; ?>">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-control" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" name="password"  value="<?php echo isset($password) ? $password : ''; ?>">
              </div>
              <div class="form-group">
                <label for="password_confirmation">Password confirmation</label>
                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" value="<?php echo isset($passConfim) ? $passConfim : ''; ?>">
              </div>
              <div class="form-group form-check">
                <?php if (isset($role) && $role == 1): ?>
                  <input type="checkbox" class="form-check-input" id="admin" name="role" checked>
                  <label class="form-check-label" for="admin">Admin</label>
                <?php else: ?>
                  <input type="checkbox" class="form-check-input" id="admin" name="role">
                  <label class="form-check-label" for="admin">Admin</label>
                <?php endif; ?>
              </div>
              <div class="text-center">
                <button class="btn btn-primary btn-lg" name="add-admin" type="submit">Add User</button>
              </div>
            </form>
            <div id="rezultat"></div>
            <div class="card-footer">
                <a href="index.php?page=index-user" class="btn btn-secondary">Manage Users</a>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


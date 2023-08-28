<?php
   adminOnly();
   global $conn;

   $result = paginate('users', 1, PHP_INT_MAX);
   
   $users = $result['data'];
?>

<section class="vh-100 gradient-custom">
  <div class="container py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card" style="width: 500px;">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <a href="index.php?page=create-user" class="btn btn-success mb-3">Add User</a>
              <a href="index.php?page=index-user" class="btn btn-success mb-3">Manage Users</a>
            </div>
            <h2 class="card-title text-center mb-4">Manage Users</h2>

            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>SN</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($users as $key => $user): ?>
                  <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td>
                      <a href="index.php?page=edit-user&id=<?php echo $user['id'];?>" class="btn btn-primary btn-sm mr-2">Edit</a>
                      <a href="#" onclick="confirmDelete(<?php echo $user['id']; ?>);" class="btn btn-danger btn-sm">Delete</a>               
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
    function confirmDelete(userId) {
        var result = confirm('Da li ste sigurni da želite obrisati ovu stavku?');
        if (result) {
            window.location.href = 'models/users.php?delete_id=' + userId + '&confirm_delete=true';
        }
    }
</script>
<?php
adminOnly();
global $conn;

$result = paginate('topics', 1, PHP_INT_MAX); // Postavljamo limit na PHP_INT_MAX kako bismo dobili sve zapise
$topics = $result['data'];

?>

<section class="vh-100 gradient-custom">
  <div class="container py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card" style="width: 500px;">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <a href="index.php?page=create-topic" class="btn btn-success mb-3">Add Topic</a>
              <a href="index.php?page=index-topic" class="btn btn-success mb-3">Manage Topics</a>
            </div>
            <h2 class="card-title text-center mb-4">Manage Topics</h2>

          <table class="table">
            <thead>
              <tr>
                <th>SN</th>
                <th>Name</th>
                <th colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($topics as $key => $topic): ?>
            <tr>
              <td><?php echo $key + 1; ?></td>
              <td><?php echo $topic['name']; ?></td>
              <td>
           
                <a href="index.php?page=edit-topic&id=<?php echo $topic['id']; ?>" class="btn btn-primary btn-sm mr-2">Edit</a>
                <a href="#" onclick="confirmDelete(<?php echo $topic['id']; ?>);" class="btn btn-danger btn-sm">Delete</a>               
              </td>
            </tr>
          <?php endforeach; ?>

            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</section>


<script>
    function confirmDelete(topicId) {
        var result = confirm('Da li ste sigurni da želite obrisati ovu stavku?');
        if (result) {
            window.location.href = 'models/topics.php?del_id=' + topicId + '&confirm_delete=true';
        }
    }
</script>
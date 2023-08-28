<?php
adminOnly();
global $conn;

$result = paginate('posts', 1, PHP_INT_MAX); 

$posts = $result['data'];

if (isset($_GET['published']) && isset($_GET['p_id'])) {
    $published = $_GET['published'];
    $postId = $_GET['p_id'];

    $sql = "UPDATE posts SET published = :published WHERE id = :postId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':published', $published, PDO::PARAM_INT);
    $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
    $stmt->execute();

    echo '<script>window.location.href = "index.php?page=index-post";</script>';
    exit;
}

?>

<section class="vh-100 gradient-custom">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card" style="width: 40rem;">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
              <a href="index.php?page=create-post" class="btn btn-success">Add Post</a>
              <a href="index.php?page=index-post" class="btn btn-success">Manage Posts</a>
            </div>
            <h2 class="card-title mb-4">Manage Posts</h2>
            
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">SN</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col" colspan="3">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($posts as $key => $post) : ?>
                    <tr>
                      <td><?php echo ($key + 1); ?></td>
                      <td><?php echo $post['title']; ?></td>
                      <td><?php echo getUsernameById($post['user_id']); ?></td>
                      <td>
                        <a href="index.php?page=edit-post&id=<?php echo $post['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                      </td>
                      <td>
                        <a href="#" onclick="confirmDelete(<?php echo $post['id']; ?>);" class="btn btn-danger btn-sm">Delete</a>               
                      </td>
                      <?php if ($post['published']) : ?>
                        <td>
                          <a href="index.php?page=index-post&published=0&p_id=<?php echo $post['id'] ?>" class="btn btn-sm btn-warning">Unpublish</a>
                        </td>
                      <?php else : ?>
                        <td>
                          <a href="index.php?page=index-post&published=1&p_id=<?php echo $post['id'] ?>" class="btn btn-sm btn-success">Publish</a>
                        </td>
                      <?php endif; ?>
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
    function confirmDelete(postId) {
        var result = confirm('Da li ste sigurni da želite obrisati ovu stavku?');
        if (result) {
          window.location.href = 'models/posts.php?delete_id=' + postId + '&confirm_delete=true';
        }
    }
</script>
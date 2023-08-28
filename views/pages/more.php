<?php
include "models/posts.php";
include "models/messages.php";
if(!isset($_GET['id'])) {
  $_SESSION['message'] = "You have not selected any post. We return you to the home page.";
  $_SESSION['type'] = "alert alert-warning";
    echo '<script>window.location.href = "index.php?page=index";</script>';
  exit();
}

$post = selectOne('posts', ['id' => $_GET['id']]);

$topics = selectAll('topics');
$posts = selectAll('posts', ['published' => 1]);
 
?>
<section class="make_section layout_padding">
  <div class="container" style="margin: 5% auto;">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title"><?php echo $post['title'];?></h2>
            <img src="assets/images/<?php echo $post['image']; ?>" alt="" class="card-img-top mt-3"/>
            <p class="card-text mt-3"><?php echo ($post['content']);?></p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">Topics</h3>
            <ul class="list-group list-group-flush">
              <?php foreach($topics as $topic): ?>
                <li class="list-group-item">
                <a href="index.php?page=index&t_id=<?php echo $topic['id']; ?>&name=<?php echo $topic['name']; ?>" class="card-link"><?php echo $topic['name']; ?></a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="container">
    <div class="d-flex justify-content-center">
      <h2 class="my-4">Trending Posts</h2>
    </div>
    <div class="row">
      <?php foreach($posts as $post): ?>
        <div class="col-md-4 mb-4">
          <div class="card">
          <img src="assets/images/<?php echo $post['image']; ?>" class="card-img-top" alt="">
            <div class="card-body">
              <h5 class="card-title"><a href="index.php?page=more&id=<?php echo $post['id']?>" class="card-link"><?php echo $post['title']; ?></a></h5>
              <p class="card-text"><i class="fa fa-calendar me-2"></i><?php echo date('F j. Y.', strtotime($post['created_at'])); ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div> 
</section>
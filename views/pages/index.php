<?php


include "models/messages.php";

$db_host = 'localhost';
$db_name = 'id20728324_webio';
$db_user = 'id20728324_nevena';
$db_password = 'Lozinka123!';

$dsn = "mysql:host=$db_host;dbname=$db_name";
$conn = new PDO($dsn, $db_user, $db_password);

if (!isset($conn) || !$conn) {
    echo "Connection error.";
    exit();
}

if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    $loggedIn = true;
} else {
    $loggedIn = false;
}

if (isset($_POST['liked'])) {
    $postId = $_POST['postid'];

    try {
        $stmt2 = $conn->prepare("SELECT * FROM posts WHERE id=:postId");
        $stmt2->bindParam(':postId', $postId, PDO::PARAM_INT);
        $stmt2->execute();
        $row = $stmt2->fetch(PDO::FETCH_ASSOC);

        $n = $row['likes'];

        $stmt3 = $conn->prepare("INSERT INTO likes (user_id, post_id) VALUES (1, :postId)");
        $stmt3->bindParam(':postId', $postId, PDO::PARAM_INT);
        $stmt3->execute();

        $nPlusOne = $n + 1;

        $stmt4 = $conn->prepare("UPDATE posts SET likes=:likes WHERE id=:postId");
        $stmt4->bindParam(':likes', $nPlusOne, PDO::PARAM_INT);
        $stmt4->bindParam(':postId', $postId, PDO::PARAM_INT);
        $stmt4->execute();

        echo $n + 1;
        exit();
    } catch (Exception $e) {
        echo "Query error.";
        exit();
    }
}

if (isset($_POST['unliked'])) {
    $postId = $_POST['postid'];

    try {
        $stmt2 = $conn->prepare("SELECT * FROM posts WHERE id=:postId");
        $stmt2->bindParam(':postId', $postId, PDO::PARAM_INT);
        $stmt2->execute();
        $row = $stmt2->fetch(PDO::FETCH_ASSOC);

        $n = $row['likes'];

        $stmt3 = $conn->prepare("DELETE FROM likes WHERE post_id=:postId AND user_id=1");
        $stmt3->bindParam(':postId', $postId, PDO::PARAM_INT);
        $stmt3->execute();

        $nMinusOne = $n - 1;

        $stmt4 = $conn->prepare("UPDATE posts SET likes=:likes WHERE id=:postId");
        $stmt4->bindParam(':likes', $nMinusOne, PDO::PARAM_INT);
        $stmt4->bindParam(':postId', $postId, PDO::PARAM_INT);
        $stmt4->execute();

        echo $n - 1;
        exit();
    } catch (Exception $e) {
        echo "Query error.";
        exit();
    }
}

try {
    $stmt2 = $conn->query("SELECT * FROM posts");
    $posts = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    $postsTitle = 'Recent Posts';

    if (isset($_GET['t_id'])) {
        $posts = getPostsbyTopicId($_GET['t_id']);
        $postsTitle = "You searched for posts under '" . $_GET['name'] . "'";
    } else if (isset($_POST['search'])) {
        $postsTitle = "You searched for '" . $_POST['search'] . "'";
        $posts = searchPosts($_POST['search']);
    } else {
        $posts = getPublishedPosts();
    }
} catch (Exception $e) {
    echo "Query error.";
    exit();
}
if (isset($_POST["post_comment"])) {
  $name = $_POST["name"];
  $comment = $_POST["comment"];
  $post_id = $_POST['post_id'];

  $stmt = $conn->prepare("SELECT * FROM comments WHERE name = :name AND comment = :comment AND post_id = :post_id" );
  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
  $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);

  $stmt->execute();

  $existingComment = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($existingComment) {
    echo "<p>Comment already exists.</p>";
  } else {
    try {
        $user_id = $_SESSION['id'];
        $stmt = $conn->prepare("INSERT INTO comments (name, comment, post_id, user_id) VALUES (:name, :comment, :post_id, :user_id)");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);      
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    
        $stmt->execute();
      
        echo '<script type="text/javascript">
                window.location.href = "index.php?page=index";
             </script>';
        exit();
  
    } catch (Exception $e) {
      echo "Query error: " . $e->getMessage();
      exit();
    }
  }
}

$topics = selectAll('topics');
?>

<section class="py-5" style="background-color: #72bd72;">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Welcome to Web-Blog site!</h1>
            <p class="lead fw-normal text-white-10 mb-0" style="font-weight: 400;">
                Feel free to explore our WEBIO blogs
            </p></br>
            <a href="index.php?page=contact" class="text-white">Click here to contact us</a>
        </div>
    </div>
</section>

<section style="margin: 5rem auto;">
    <div class="container">
        <div class="d-flex justify-content-center">
            <h2 style="padding: 2rem;">Trending Posts</h2>
        </div>
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php $i = 0;
                foreach ($posts as $post) :
                    if ($i % 3 == 0) :
                        ?>
                        <div class="carousel-item<?php if ($i == 0) echo ' active'; ?>">
                            <div class="row">
                    <?php endif; ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="assets/images/<?php echo $post['image']; ?>" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title"><a href="index.php?page=more&id=<?php echo $post['id'] ?>"><?php echo $post['title']; ?></a></h5>
                                <p class="card-text"><i class="fa fa-user me-2"></i><?php echo $post['username']; ?></p>
                                <p class="card-text"><i class="fa fa-calendar me-2"></i><?php echo date('F j. Y.', strtotime($post['created_at'])); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php if ($i % 3 == 2 || $i == count($posts) - 1) : ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php $i++;
                endforeach; ?>
            </div>
            <button class="prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
<section>
    <div class="container" style="margin: 5rem auto;">
        <div class="row">
            <div class="col-md-9">
                <div class="d-flex justify-content-center">
                    <h2 style="padding-bottom: 5rem"><?php echo $postsTitle ?></h2>
                </div>
                <?php if (empty($posts)) : ?>
                    <p>No posts yet.</p>
                <?php else : ?>
                    <div class="row">
                        <?php foreach ($posts as $post) : ?>
                            <div class="col-md-4" style="margin-bottom: 2rem;">
                                <div class="card">
                                    <img src="assets/images/<?php echo $post['image']; ?>" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="index.php?page=more.php&id=<?php echo $post['id'] ?>"><?php echo $post['title']; ?></a>
                                        </h5>
                                        <p class="card-text">
                                            <?php echo substr($post['content'], 0, 150) . '...'; ?>
                                        </p>
                                        <div class="card-footer">
                                            <i class="fa fa-user" style="margin-right: 4px;"> by: <?php echo $post['username']; ?> </i>
                                            <i class="fa fa-calendar"> <?php echo date('F j. Y.', strtotime($post['created_at'])); ?> </i>
                                            <?php if ($loggedIn) : ?>
                                                <div class="post">
                                                    

                                                    <div style="padding: 2px; margin-top: 5px;">
                                                        <?php
                                                       $stmtLikes = $conn->prepare("SELECT * FROM likes WHERE user_id=:userId AND post_id=:postId");
                                                      $stmtLikes->bindParam(':userId', $userId, PDO::PARAM_INT);
                                                      $stmtLikes->bindParam(':postId', $post['id'], PDO::PARAM_INT);
                                                      $stmtLikes->execute();
                                                
                                                      if ($stmtLikes->rowCount() == 1) :
                                                        ?>
                                                        <span class="unlike fa fa-thumbs-down" data-id="<?php echo $post['id']; ?>"></span>
                                                        <span class="like hide fa fa-thumbs-o-up" data-id="<?php echo $post['id']; ?>"></span>
                                                      <?php else : ?>
                                                        <span class="like fa fa-thumbs-o-up" data-id="<?php echo $post['id']; ?>"></span>
                                                        <span class="unlike fa fa-thumbs-down" data-id="<?php echo $post['id']; ?>"></span>
                                                      <?php endif ?>
                                                
                                                      <span class="likes_count" style="color: #d27676;
                                                    font-weight: bold;"></span>
                                                    </div>
                                                </div>

                                                <form action="index.php?page=index" method="post">
                                                  <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>" required>
                                                  <div class="mb-3">
                                                      <label for="" class="form-label">Your name</label>
                                                      <input type="text" name="name" class="form-control" required>
                                                  </div>
                                                  <div class="mb-3">
                                                      <label for="" class="form-label">Comment</label>
                                                      <textarea name="comment" class="form-control" required></textarea>
                                                  </div>
                                                  <button type="submit" class="btn btn-primary" name="post_comment" style="margin-bottom: 1rem;
                                                             font-size: 13px;">
                                                      Add Comment
                                                </button>
                                              </form>

                                                <?php
                                                $stmt = $conn->prepare("SELECT * FROM comments WHERE post_id = :post_id");
                                                $stmt->bindParam(':post_id', $post['id'], PDO::PARAM_INT);
                                                $stmt->execute();

                                                if ($stmt->errorCode() !== "00000") {
                                                  $errorInfo = $stmt->errorInfo();
                                                  echo "Error executing query: " . $errorInfo[2];
                                                  exit();
                                                }

                                                $comments = $stmt->fetchAll(PDO::FETCH_OBJ);
                                                if (count($comments) > 0) {
                                                    echo '<ul class="comments list-unstyled">';
                                                    foreach ($comments as $comment) {
                                                        echo '<li class="mb-4" style="border: 2px solid #dea7a73d;
                                                                                      border-radius: 4%;
                                                                                      padding: 8px;">';
                                                        echo '<i class="fa fa-user-o" aria-hidden="true"> ' . $comment->name . '</i>';
                                                        echo '</br><i class="fa fa-commenting-o" aria-hidden="true"> ' . $comment->comment . '</i>';
                                                        echo '<p class="text-muted">' . date("F d, Y h:i a", strtotime($comment->created_at)) . '</p>';

                                                        echo '</li>';
                                                    }
                                                    echo '</ul>';
                                                    } else {
                                                        echo 'No comments found.';
                                                    }
                                                  ?>
                                            <?php else : ?>
                                                <div class="login-warning" style=" color: #b84b4b;
                                                                                    font-weight: bold;
                                                                                    font-size: 15px;
                                                                                    margin: 10px;">
                                                    Please log in to like and comment.
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-3">
                <div class="search" style="position: relative; top: 20px;">
                    <form action="index.php" method="post">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search title">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div id="topics">
                        <h3>Topics</h3>
                        <ul class="list-group">
                            <?php foreach ($topics as $topic) : ?>
                                <li class="list-group-item">
                                    <a class="text-decoration-none" href="index.php?page=index&t_id=<?php echo $topic['id']; ?>&name=<?php echo $topic['name']; ?>">
                                        <?php echo $topic['name']; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

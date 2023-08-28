<?php
include_once "db.php";
include_once "validatePosts.php";

$table = 'posts';

$topics = selectAll('topics');
$posts = selectAll($table);

$errors = array();

$id = '';
$title = '';
$content = '';
$topic_id = '';
$published = '';


if(isset($_GET['id'])){
    
    $post = selectOne($table, ['id' => $_GET['id']]);

    $id = $post['id'];
    $title = $post['title'];
    $content =  $post['content'];
    $topic_id =  $post['topic_id'];
    $published =  $post['published'];
}

//add post
if(isset($_POST['add-post'])){
    
    // adminOnly();
    //varDumps($_FILES['image']['name']);
    $errors = validatePost($_POST);

    if(!empty($_FILES['image'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $image_src =  'assets/images/' . $image_name;

        $result = move_uploaded_file($_FILES['image']['tmp_name'], $image_src);

        if($result) {
            $_POST['image'] = $image_name;
        } else{
            array_push($errors, 'Failed to upload image.');
        }
    } else{
        array_push($errors, "Post image required.");
    }

    if(count($errors) === 0){
        unset($_POST['add-post']);

        $_POST['user_id'] = $_SESSION['id']; 
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['content'] = htmlentities($_POST['content']); //bezbednost koda da se ne pojavljuju html tagovi u bazi
       
        $post_id = insertOperation($table, $_POST);
        $_SESSION['message'] = 'Post created successfully.';
        $_SESSION['type'] = 'alert alert-success';
        echo '<script>window.location.href = "index.php?page=index-post";</script>';
    } else{
        $title = $_POST['title'];
        $content = $_POST['content'];
        $topic_id = $_POST['topic_id'];
        $published =  isset($_POST['published']) ? 1 : 0;
    }
}
//update post
if(isset($_POST['update-post'])){
    //  adminOnly();
    $errors = validatePost($_POST);

    if(!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $image_src =  'assets/images/' . $image_name;

        $result = move_uploaded_file($_FILES['image']['tmp_name'], $image_src);

        if($result) {
            $_POST['image'] = $image_name;
        } else{
            array_push($errors, 'Failed to upload image.');
        }
    } else{
        array_push($errors, "Post image required.");
    }

    if(count($errors) === 0){
        $id = $_POST['id'];
        unset($_POST['update-post'], $_POST['id']);

        $_POST['user_id'] = $_SESSION['id']; 
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['content'] = htmlentities($_POST['content']); 
       
        $post_id = updateOperation($table, $id, $_POST);
        $_SESSION['message'] = 'Post updated successfully.';
        $_SESSION['type'] = 'alert alert-success';
         echo '<script>window.location.href = "index.php?page=index-post";</script>';
    } else{
        $title = $_POST['title'];
        $content = $_POST['content'];
        $topic_id = $_POST['topic_id'];
        $published =  isset($_POST['published']) ? 1 : 0;
    }
}
//delete post

if(isset($_GET['delete_id'])){
    // adminOnly(); 
    $count = deleteOperation($table, $_GET['delete_id']);

    $_SESSION['message'] = 'Post deleted successfully.';
    $_SESSION['type'] = 'alert alert-success';
    echo '<script>window.location.href = "../index.php?page=index-post";</script>';
    exit();
}

if(isset($_GET['published']) && isset($_GET['p_id'])){
    
    $published = $_GET['published'];
    $p_id = $_GET['p_id'];

    $count = updateOperation($table, $p_id, ['published' => $published]);

    $_SESSION['message'] = 'Post published state changed.';
    $_SESSION['type'] = 'alert alert-success';
    echo '<script>window.location.href = "../index.php?page=index-post";</script>';
    exit();
}

?>
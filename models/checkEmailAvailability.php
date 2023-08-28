<?php 
require_once('db.php');
if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $existingUser = selectOne('users', ['email' => $email]);
    if($existingUser) {
        echo "Email already exists.";
    } else {
        echo "Email available.";
    }
}
?>
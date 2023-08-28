<?php

include_once "db.php";
include_once "validateUser.php";


$table = 'users';
$admin_users = selectAll($table);

$errors = array();
$id = '';
$username = '';
$role = '';
$email = '';
$password = '';
$passConfim = '';


function loginUser($user) {
 //Login user:
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['message'] = 'You are now logged in.';
    $_SESSION['type'] = 'alert alert-success';

    if($_SESSION['role']){
    echo '<script>window.location.href = "index.php?page=dashboard";</script>';
    }
    else{
       echo '<script>window.location.href = "index.php?page=index&u_id=' . $user['id'] . '";</script>';

    }
    exit();
}

if (isset($_POST['register-btn'])) {
    // Handle user registration
    $errors = validateUser($_POST);
    if (count($errors) === 0) {
        unset($_POST['register-btn'], $_POST['password_confirmation'], $_POST['add-admin']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $existingUser = selectOne($table, ['email' => $_POST['email']]);
        if (!$existingUser) {
            $_POST['role'] = 0;
            $user_id = insertOperation($table, $_POST);
            $_SESSION['message'] = "User registered and logged in successfully.";
            $_SESSION['type'] = 'alert alert-success';
            $user = selectOne($table, ['id' => $user_id]);
            loginUser($user);
        } else {
            $email = $_POST['email'];
            array_push($errors, 'Email already exists.');
        }
    } else {
        $username = $_POST['username'];
        $role = isset($_POST['role']) ? 1 : 0;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passConfim = $_POST['password_confirmation'];
    }
} elseif (isset($_POST['add-admin'])) {
    // Handle admin creation
    $errors = validateUser($_POST);
    if (count($errors) === 0) {
        unset($_POST['register-btn'], $_POST['password_confirmation'], $_POST['add-admin']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $existingUser = selectOne($table, ['email' => $_POST['email']]);
        if (!$existingUser) {
            $_POST['role'] = 1;
            $user_id = insertOperation($table, $_POST);
            $_SESSION['message'] = "Admin user created successfully.";
            $_SESSION['type'] = 'alert alert-success';
         echo "<script>window.location.href = 'index.php?page=index-user';</script>";

            exit();
        } else {
            $email = $_POST['email'];
            array_push($errors, 'Email already exists.');
        }
    } else {
        $username = $_POST['username'];
        $role = isset($_POST['role']) ? 1 : 0;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passConfim = $_POST['password_confirmation'];
    }
}


if(isset($_POST['update-user'])){
    
    $errors = validateUser($_POST);
    
    if(count($errors) === 0){
        $id = $_POST['id'];
        unset($_POST['password_confirmation'], $_POST['update-user'], $_POST['id']);
      
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $_POST['role'] = isset($_POST['role']) ? 1 : 0;
            $count = updateOperation($table, $id, $_POST);
            $_SESSION['message'] = "Admin user updated successfully.";
            $_SESSION['type'] = 'alert alert-success'; 
            echo "<script>window.location.href = 'index.php?page=index-user';</script>";
            exit();
        

    } else{
        $username = $_POST['username'];
        $role = isset($_POST['role'])? 1 : 0;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passConfim = $_POST['password_confirmation'];
    }
    
}



if(isset($_GET['id'])) {
    $user = selectOne($table, ['id' => $_GET['id']]);
    
    $id = $user['id'];
    $username = $user['username'];
    $role = $user['role'];
    $email = $user['email'];
}


if(isset($_POST['login-btn'])) {
    $errors = validateLogin($_POST);

    if(count($errors) === 0){

        $user = selectOne($table, ['email' => $_POST['email']]);

        if($user && password_verify($_POST['password'], $user['password'])) {
            loginUser($user);
        }
        else{
            array_push($errors, 'Wrong credentials.');
        }
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
}

if(isset($_GET['delete_id'])){
    // adminOnly();
    $count = deleteOperation($table, $_GET['delete_id']);
    $_SESSION['message'] = "User is deleted successfully.";
    $_SESSION['type'] = 'alert alert-success'; 
    echo "<script>window.location.href = '../index.php?page=index-user';</script>";
    exit();
}


<?php
require "../models/users.php";

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $username = $_POST['username'];
  $user = getUserByUsername($username);
  if ($user) {
    $failedAttempts = getFailedLoginAttempts($user['id']);
    if ($failedAttempts >= 3) {
      echo json_encode(['locked' => true]);
      exit();
    }
  }
  echo json_encode(['locked' => false]);
}

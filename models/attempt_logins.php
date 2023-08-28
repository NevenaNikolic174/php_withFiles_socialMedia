<?php 

include_once "db.php";


function trackLoginAttempt($userId) {
    global $conn;
  
    $stmt = $conn->prepare('INSERT INTO login_attempts (user_id) VALUES (:userId)');
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
  }



  function lockAccount($userId) {
    global $conn;
  
    $stmt = $conn->prepare('UPDATE users SET status = "locked" WHERE id = :userId');
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
  }
  




?>


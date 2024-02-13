<?php



include __DIR__ . "/../app/database/connect.php";

include  "helpers/mail.php";



function executeQuery($query, $data){

    global $conn;



    $sql = $conn->prepare($query);

    $sql->execute($data);

    return $sql;

}



function selectAll($table, $conditions = []) {



    global $conn;

    $query = "SELECT * FROM $table";

    $params = [];



    if(!empty($conditions)){

        $query .= " WHERE ";

        $i = 0;

        foreach($conditions as $key => $value) {

            if($i > 0) {

                $query .= " AND ";

            }

            $query .= "$key=?";

            $params[] = $value;

            $i++;

        }

    }



    $stmt = $conn->prepare($query);

    $stmt->execute($params);

    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);



    return $records;

}

function selectOne($table, $conditions = []) {



    global $conn;

    $query = "SELECT * FROM $table WHERE ";

    $params = [];



    $i = 0;

    foreach($conditions as $key => $value) {

        if($i > 0) {

            $query .= " AND ";

        }

        $query .= "$key=?";

        $params[] = $value;

        $i++;

    }

    $query .= " LIMIT 1";



    $stmt = $conn->prepare($query);

    $stmt->execute($params);

    $record = $stmt->fetch(PDO::FETCH_ASSOC);



    return $record;

}





function insertOperation($table, $data) {

    global $conn;



    $columns = array_keys($data);

    $placeholders = array_fill(0, count($data), '?');

    $query = "INSERT INTO $table (" . implode(',', $columns) . ") VALUES (" . implode(',', $placeholders) . ")";



    $stmt = $conn->prepare($query);

    $stmt->execute(array_values($data));

    $id = $conn->lastInsertId();



    return $id;

}

function updateOperation($table, $id, $data) {

    global $conn;



    $columns = array_keys($data);

    $placeholders = array_fill(0, count($data), '?');

    $data['id'] = $id;

    $setClause = implode('=?,', $columns) . '=?';

    $query = "UPDATE $table SET $setClause WHERE id=?";



    $stmt = $conn->prepare($query);

    $stmt->execute(array_values($data));

    $affectedRows = $stmt->rowCount();



    return $affectedRows;

}

function deleteOperation($table, $id) {

    global $conn;



    $query = "DELETE FROM $table WHERE id=?";

    $stmt = $conn->prepare($query);

    $stmt->execute([$id]);

    $affectedRows = $stmt->rowCount();



    return $affectedRows;

}

function getPublishedPosts() {

    global $conn;



    $query = "SELECT p.*, u.username 

              FROM posts AS p 

              JOIN users AS u

              ON p.user_id = u.id

              WHERE p.published = ?";



    $stmt = $conn->prepare($query);

    $stmt->execute([1]);

    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    

    return $records;

}



function getPostsbyTopicId($topic_id) {

    global $conn;

    $query = "SELECT p.*, u.username 

              FROM posts AS p 

              JOIN users AS u

              ON p.user_id = u.id

              WHERE p.published = ?

              AND topic_id = ?";



    $sql = executeQuery($query, [1, $topic_id]);



    $records = $sql->fetchAll(PDO::FETCH_ASSOC);

    return $records;

}



function searchPosts($words) {

    $match = '%' . $words . '%';

    global $conn;

    $query = "SELECT p.*, u.username 

              FROM posts AS p 

              JOIN users AS u

              ON p.user_id = u.id

              WHERE p.published = ? 

              AND (p.title LIKE ? OR p.content LIKE ?)";

    

    $sql = executeQuery($query, [1, $match, $match]);



                                 

    $records = $sql->fetchAll(PDO::FETCH_ASSOC);

    return $records;

}



function paginate($table, $page, $limit) {

    global $conn;



    $page = intval($page);



    $offset = ($page - 1) * $limit;

    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM $table");

    $stmt->execute();

    $result = $stmt->fetch();

    $total = $result->total;

    $totalPages = ceil($total / $limit);

    $stmt = $conn->prepare("SELECT * FROM $table LIMIT :offset, :limit");

    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);

    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);



    return ['data' => $data, 'totalPages' => $totalPages];

}



function getUsernameById($userId) {

    global $conn;

    $sql = "SELECT username FROM users WHERE id = :userId";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['username'] ?? 'Unknown';

}





function getPageAccessStatistics($accessLog) {

    $logContent = file_get_contents($accessLog);

    $logLines = explode("\n", $logContent);

    $totalLines = count($logLines);

    $pageCounts = array();

  

    foreach ($logLines as $line) {

      $matches = array();

      if (preg_match('/Page accessed: (\w+)/', $line, $matches)) {

        $page = $matches[1];

        if (isset($pageCounts[$page])) {

          $pageCounts[$page]++;

        } else {

          $pageCounts[$page] = 1;

        }

      }

    }

  

    $pageStatistics = array();

    foreach ($pageCounts as $page => $count) {

      $percentage = round(($count / $totalLines) * 100, 2);

      $pageStatistics[$page] = $percentage;

    }

  

    return $pageStatistics;

  }

  





  function getLoggedInUsersCount($loginLog) {

    $logContent = file_get_contents($loginLog);

    $logLines = explode("\n", $logContent);

    $loggedInUsersCount = 0;

  

    foreach ($logLines as $line) {

        if (strpos($line, "User logged in:") !== false) {

            $loggedInUsersCount++;

        }

    }

  

    return $loggedInUsersCount;

}



function getFailedLoginAttempts($userId)

{

    global $conn;



    $query = "SELECT failed_login_attempts, last_failed_login, lock_reset_time FROM users WHERE id = :userId";

    $statement = $conn->prepare($query);

    $statement->bindValue(':userId', $userId);

    $statement->execute();



    $row = $statement->fetch(PDO::FETCH_ASSOC);

    if ($row) {

        $lockResetTime = strtotime($row['lock_reset_time']);

        if ($lockResetTime > time()) {

            return 0; /

        }

        return $row['failed_login_attempts'];

    }



    return 0;

}





function incrementFailedLoginAttempts($userId)

{

    global $conn;



    $failedLoginAttempts = getFailedLoginAttempts($userId);



    if ($failedLoginAttempts >= 2) {

        $lockResetTime = time() + 30;

        updateLockResetTime($userId, $lockResetTime);

        lockAccount($userId);

    } else {

        $query = "UPDATE users SET failed_login_attempts = failed_login_attempts + 1 WHERE id = :userId";

        $statement = $conn->prepare($query);

        $statement->bindValue(':userId', $userId);

        $statement->execute();

    }

}



function lockAccount($userId)

{

    global $conn;



    $lockResetTime = date('Y-m-d H:i:s', strtotime('+30 seconds'));



    $query = "UPDATE users SET failed_login_attempts = 0, locked = 1, lock_reset_time = :lockResetTime WHERE id = :userId";

    $statement = $conn->prepare($query);

    $statement->bindValue(':lockResetTime', $lockResetTime);

    $statement->bindValue(':userId', $userId);

    $statement->execute();

}



function sendLockoutEmail($email)

{

    $subject = "Account Lockout Notification";

    $message = "Your account has been locked due to multiple failed login attempts. Please try again after 30 seconds.";



    try {

        Mail::sendMail($email, $subject, $message);

        return 'Email sent successfully.';

    } catch (Exception $e) {

        return 'Failed to send email: ' . $e->getMessage();

    }

}



function updateLockResetTime($userId, $resetTime) {

    global $conn;



  

    $formattedResetTime = date('Y-m-d H:i:s', $resetTime);



    $query = "UPDATE users SET lock_reset_time = :resetTime WHERE id = :userId";

    $statement = $conn->prepare($query);

    $statement->bindValue(':resetTime', $formattedResetTime);

    $statement->bindValue(':userId', $userId);

    $statement->execute();

}





function resetFailedLoginAttempts($userId) {



    global $conn;



    $query = "UPDATE users SET failed_login_attempts = 0 WHERE id = :userId";

    $statement = $conn->prepare($query);

    $statement->bindValue(':userId', $userId);

    $statement->execute();

}



function startTimer($seconds){

    echo '<script>

        $(document).ready(function() {

            disableLoginButton();

            var timer = setInterval(function() {

                if (' . $seconds . ' <= 0) {

                    clearInterval(timer);

                    resetLoginAttempts();

                    enableLoginButton();

                } else {

                    $("#timer-message").text("Please try again after " + ' . $seconds . ' + " seconds.");

                    ' . $seconds . '--;

                }

            }, 1000);

        });

    </script>';

}



function getTotalLoggedInUsersCount($logFile) {

    $logContent = file_get_contents($logFile);

    $logLines = explode("\n", $logContent);

    $loggedInUsers = 0;



    foreach ($logLines as $line) {

        if (!empty($line) && strpos($line, "User logged in: ") !== false) {

            $loggedInUsers++;

        }

    }



    return $loggedInUsers;

}





function logLogin($userId, $logFile) {

    $logMessage = date("Y-m-d H:i:s") . " - User logged in: " . $userId . "\n";

    file_put_contents($logFile, $logMessage, FILE_APPEND);

  }

  


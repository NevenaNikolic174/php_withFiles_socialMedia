<?php
include "models/users.php";
error_reporting(0);
$accessLog = "data/access.log";
$logMessage = date("Y-m-d H:i:s") . " - Page accessed: " . $_SERVER['REQUEST_URI'] . "\n";
file_put_contents($accessLog, $logMessage, FILE_APPEND);

$logFile = "data/login.log";
if (!file_exists($logFile)) {
    fopen($logFile, 'w'); 
}

  $userId = $_SESSION['id'];
  logLogin($userId, $logFile);

if (isset($_POST['login-btn'])) {
    $errors = validateLogin($_POST);

   if (count($errors) === 0) {
      $user = selectOne($table, ['email' => $_POST['email']]);
      if ($user && password_verify($_POST['password'], $user['password'])) {
          loginUser($user);
          logLogin($user['id'], $logFile);
          $logMessage = date("Y-m-d H:i:s") . " - User logged in: " . $user['id'] . "\n";
          file_put_contents($logFile, $logMessage, FILE_APPEND);
      } else {
            array_push($errors, 'Wrong credentials.');

            if ($user) {
                $failedLoginAttempts = getFailedLoginAttempts($user['id']);
                $maxFailedAttempts = 3;

                if ($failedLoginAttempts >= $maxFailedAttempts) {
                    try {
                        lockAccount($user['id']);
                        sendLockoutEmail($user['email']);
                        $errors = 'Please try again after 30 seconds.';
                        $lockedUntil = date('Y-m-d H:i:s', time() + 30);
                        updateLockResetTime($user['id'], $lockedUntil);
                        disableLoginButton();
                        startTimer(30);
                    } catch (Exception $e) {
                        $errors = $e->getMessage();
                    }
                } else {
                    incrementFailedLoginAttempts($user['id']);
                }
            }
        }
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
}
?>
    <section class="vh-100 gradient-custom" style="height: 100% !important;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">
                  <div class="mb-md-5 mt-md-4 pb-5">
                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                    <p class="text-white-50 mb-5">Please enter your username and password!</p>
                    <?php if(count($errors) > 0): ?>
                      <div class="alert alert-danger">
                        <?php foreach($errors as $error): ?>
                          <p><?php echo $error; ?></p>
                        <?php endforeach; ?>
                      </div>
                    <?php endif; ?>
                    <form role="form" action="index.php?page=login" method="post" onsubmit="return validateLogin()" name="myForm" novalidate>
                          <input type="hidden" name="id"/>
                      <span id="check-username"></span>
                        <div class="form-outline mb-4">
                          <input type="email" id="email" class="form-control form-control-lg" 
                            value="<?php echo $email; ?>" name="email" />
                          <label class="form-label" for="form3Example1cg" name="email">Your email</label>
                        </div>
                        <div class="form-outline form-white mb-4">
                          <input type="password" id="password" class="form-control form-control-lg" value="<?php echo $password; ?>" name="password" />
                          <label class="form-label" for="typePasswordX" name="password">Password</label>
                        </div>
                        <button id="login-btn" class="btn btn-outline-light btn-lg px-5" name="login-btn" type="submit">Login
                        </button>
                      </div>
                      <div>
                        <p class="mb-0">Don't have an account? <a href="index.php?page=register" class="text-white-50 fw-bold">Sign Up</a> </p>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    var isLocked = <?php echo ($user['locked'] == 1 ? 'true' : 'false'); ?>;
    if (isLocked) {
        disableLoginButton();
        startTimer(30);
    }
});
function disableLoginButton() {
    $('#login-btn').prop('disabled', true);
}

function enableLoginButton() {
    $('#login-btn').prop('disabled', false);
}

function startTimer(seconds) {
    var timer = setInterval(function() {
        if (seconds <= 0) {
            clearInterval(timer);
            resetFailedLoginAttempts();
            enableLoginButton();
        } else {
            seconds--;
        }
    }, 1000);
}
function resetFailedLoginAttempts() {
    <?php
    if ($user['failed_login_attempts'] >= $maxFailedAttempts) {
        $query = "UPDATE users SET failed_login_attempts = 0 WHERE id = :userId";
        $statement = $conn->prepare($query);
        $statement->bindValue(':userId', $user['id']);
        $statement->execute();
    }
    ?>
}
</script>
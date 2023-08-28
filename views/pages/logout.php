<?php

unset($_SESSION['id']); 
unset($_SESSION['username']);
unset($_SESSION['role']);
unset($_SESSION['message']); 
unset($_SESSION['type']);

session_destroy();

echo '<script>window.location.href = "index.php?page=index";</script>';
exit();
?>
<?php
require "../helpers/mail.php";

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $userEmail = $_POST["userEmail"];
  $subject = $_POST["subject"];
  $body = $_POST["body"];
  echo Mail::sendMail($userEmail, $subject, $body);
}
?>

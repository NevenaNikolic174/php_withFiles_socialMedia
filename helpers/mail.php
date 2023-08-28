<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require  __DIR__ ."/../PHPMailer-master/src/Exception.php";
require  __DIR__ ."/../PHPMailer-master/src/PHPMailer.php";
require  __DIR__ ."/../PHPMailer-master/src/SMTP.php";

class Mail
{
  public static function sendMail($userEmail, $subject, $body)
  {
    $mail = new PHPMailer(true);
    try {
      $mail->SMTPDebug = SMTP::DEBUG_OFF;
      $mail->SMTPOptions = array(
        'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
        )
      );
      $mail->CharSet = 'utf-8';
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com'; // Replace with the correct SMTP server address
      $mail->SMTPAuth = true;
      $mail->Username = 'nevena.nikolic.174.21@ict.edu.rs'; // Replace with your email address
      $mail->Password = '1jDXNFc8'; // Replace with your email password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Or ENCRYPTION_SMTPS if applicable
      $mail->Port = 587; // Or the appropriate port for your email provider

      $mail->setFrom('your_email@example.com', 'Nevena Nikolic 174/21');
      $mail->addAddress($userEmail); // Change to the dynamic user email address

      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body =
        "
        $body
        <hr/>
        Reply to email: $userEmail.
        ";

      $mail->send();
      return 'Message has been sent';
    } catch (Exception $e) {
      return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }
}

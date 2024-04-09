<?php

require_once '../vendor/autoload.php';
require_once '../core/Dotenv.php';
require_once '../Helper/Validator.php';
require_once '../Helper/OtpMail.php';
require_once '../Model/Database.php';

$env = new Dotenv();

$message = '';
$class = 'red';

if (empty($_POST['email'])) {
  $message = "Email field cannot be empty!";
}
else {
  $valid = new Validator();
  if (!$valid->isValidEmail($_POST['email'])) {
    $message = "Invalid Email";
  }
  else {
    if (!$valid->isExistingUser($_POST['email'])) {
      $message = "User does not exist! Register First";
    }
    else {
      $mail = new OtpMail();
      if ($mail->sendMail($_POST['email'], 'reset')) {
        $message = 'Check Mail for OTP';
        $class = 'green';
        session_start();
        $_SESSION['email'] = $_POST['email'];
      }
      else {
        $message = 'OTP Was not sent Try again!';
      }
    }
  }
}

echo "<p class='{$class}'>{$message}</p>";

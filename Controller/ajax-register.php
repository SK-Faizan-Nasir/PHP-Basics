<?php

require_once '../vendor/autoload.php';
require_once '../core/Dotenv.php';
require_once '../Helper/Validator.php';
require_once '../Helper/OtpMail.php';
require_once '../Model/Database.php';

$env = new Dotenv();

$message = '';
$class = 'red';

// Perform verification and validations and send otp for registering.
if (
  empty($_POST['email']) ||
  empty($_POST['fname']) ||
  empty($_POST['lname']) ||
  empty($_POST['password']) ||
  empty($_POST['confirm'])
) {
  $message = 'All fields are required.';
}
else {
  $valid = new Validator();
  if (
    !$valid->isValidEmail($_POST['email']) ||
    !$valid->isValidName($_POST['fname']) ||
    !$valid->isValidName($_POST['lname']) ||
    !$valid->isValidPassword($_POST['password'])
  ) {
    $message = 'Please match format requested.';
  }
  else {
    if ($_POST['password'] != $_POST['confirm']) {
      $message = 'Password does not match.';
    }
    else {
      if ($valid->isExistingUser($_POST['email'])) {
        $message = 'User already exist';
      }
      else {
        $mail = new OtpMail();
        if ($mail->sendMail($_POST['email'],'register')) {
          $message = 'Check Mail for OTP';
          $class = 'green';
          session_start();
          $_SESSION['fname'] = $_POST['fname'];
          $_SESSION['lname'] = $_POST['lname'];
          $_SESSION['email'] = $_POST['email'];
          $_SESSION['password'] = $_POST['password'];
        }
        else {
          $message = 'OTP Was not sent Try again!';
        }
      }
    }
  }
}
echo "<p class='{$class}'>{$message}</p>";

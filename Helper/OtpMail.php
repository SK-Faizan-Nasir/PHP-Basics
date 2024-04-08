<?php

use PHPMailer\PHPMailer\PHPMailer;

/**
 * Class to generate OTP and send mail to user.
 */
class OtpMail
{

  private $otp;

  function __construct() {
    $env = new Dotenv();
  }

  /**
   * Function to generate random otp.
   *
   * @return int
   *   Returns randomly generated otp.
   */
  private function otp_generate()
  {
    $this->otp = rand(1000, 9980);
    return $this->otp;
  }

  /**
   * Function to send OTP Mail to user.
   *
   * @param string $email
   *   Email id of the recipient.
   * @return bool
   *   Returns true if email was successfully delivered and false otherwise.
   */
  public function sendMail(string $email, string $task)
  {

    $otp = $this->otp_generate();
    // Create PHPMailer object
    $mail = new PHPMailer(true);
    // Use SMPT Protocol to send the message.
    $mail->isSMTP();
    // Setting SMTPAuth to TRUE to use gmail credentials for sending message.
    $mail->SMTPAuth = TRUE;
    // Set configurations.
    $mail->Host = $_ENV['MAILHOST'];
    $mail->Username = $_ENV['USERNAME'];
    $mail->Password = $_ENV['PASSWORD'];
    // Set SMTPSecure to ENCRYPTION_STARTTLS to ensure encrypted conversation
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->setFrom($_ENV['SENT_FROM'], $_ENV['SENT_FROM_NAME']);
    // Set recipient mail.
    $mail->addAddress($email);
    $mail->addReplyTo($_ENV['REPLY_TO'], $_ENV['REPLY_TO_NAME']);
    $mail->isHTML();
    $mail->Subject = 'Your OTP';
    $mail->Body = "<h2>Your OTP is {$otp}</h2>";
    $mail->AltBody = "<h2>Your OTP is {$otp}</h2>";
    // Send mail and return message.
    if (!$mail->send()) {
      header('location:signup/signup.php');
      return false;
    } else {
      session_start();
      date_default_timezone_set("Asia/Kolkata");
      $_SESSION['otp'] = $otp;
      $_SESSION['valid_time'] = strtotime('+60 second');
      $_SESSION['task'] = $task;
    }
    return true;
  }
}

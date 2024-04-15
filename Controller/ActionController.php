<?php

/**
 * Class to set variables for rendering and controlling form actions.
 */
class ActionController
{
  /**
   * Function to control register form action.
   *
   * @return array
   *   Returns an array of size 2 where first element is the status
   *   message and second is the css class.
   */
  public function registerController() {
    $msg = '';
    $cls = 'red';

    if (isset($_POST['submit'])) {
      if (empty($_POST['otp']) || !preg_match("/^\d{4}$/", $_POST['otp'])) {
        $msg = 'Invalid OTP';
      }
      else {
        session_start();
        if ($_POST['otp'] != $_SESSION['otp']) {
          $msg = 'OTP Does Not Match.';
        }
        else {
          if (strtotime('now') > $_SESSION['valid_time']) {
            $msg = 'OTP Expired';
            header('location:/register');
          }
          else {
            $db_obj = new Database($_ENV['HOST_NAME'],$_ENV['DB_NAME'],$_ENV['USER_NAME'], $_ENV['DB_PASSWORD']);
            if (
              $db_obj->insertInto(
                'user',
                ['first_name', 'last_name', 'email', 'password'],
                [
                  $_SESSION['fname'],
                  $_SESSION['lname'],
                  $_SESSION['email'],
                  password_hash($_SESSION['password'], PASSWORD_DEFAULT)
                ]
              )
            ) {
              $msg = 'Successfully Inserted Try Logging In';
              $cls = 'green';
              $db_obj->closeDb();
            }
            else {
              $msg = 'Could not save data';
            }
          }
        }
      }
    }
    return [$msg,$cls];
  }

  /**
   * Function to handle reset form actions.
   *
   * @return array
   *   Returns an array of size 2 where first element is the status
   *   message and second is the css class.
   */
  public function resetController() {

    $msg = '';
    $cls = 'red';

    if (isset($_POST['submit'])) {
      var_dump($_POST);
      if (empty($_POST['otp']) || !preg_match("/^\d{4}$/", $_POST['otp'])) {
        $msg = 'Invalid OTP';
      }
      else {
        if ($_POST['otp'] != $_SESSION['otp']) {
          $msg = 'OTP Does Not Match.';
        }
        else {
          if (strtotime('now') > $_SESSION['valid_time']) {
            $msg = 'OTP Expired';
            header('location:/');
          }
          else {
            $valid = new Validator();
            if ($valid->isValidPassword($_POST['new_password']) && ($_POST['new_password'] == $_POST['confirm_password'])) {
              $db_obj =
              new Database($_ENV['HOST_NAME'], $_ENV['DB_NAME'], $_ENV['USER_NAME'], $_ENV['DB_PASSWORD']);
              if ($db_obj->updateInto(
                'user',
                ['password'],
                [password_hash($_POST['new_password'],PASSWORD_DEFAULT)],
                $_SESSION['email'])) {
                  $msg = 'Successfully Updated Try Logging In';
                  $cls = 'green';
                  $db_obj->closeDb();
              }
              else {
                $msg = "Data could not be saved, Try again.";
              }
            }
            else {
              $msg = 'Check password fields!';
            }
          }
        }
      }
    }
    return [$msg,$cls];
  }

  /**
   * Function to set variables on homepage loading.
   *
   * @return array
   *   Returns the full name and the image source of the user.
   */
  public function homeController() {
    $email = $_SESSION['email'];
    $db_obj = new Database($_ENV['HOST_NAME'], $_ENV['DB_NAME'], $_ENV['USER_NAME'], $_ENV['DB_PASSWORD']);
    $res = $db_obj->selectUser('user', $email);
    return [$res['first_name']. ' ' . $res['last_name'], $res['image_source']];
  }

  /**
   * Function to set variable in profile section.
   *
   * @return array
   *   Returns the data to be shown in profile section,
   *   like image, name, and email.
   */
  public function profileController() {
    $email = $_SESSION['email'];
    $db_obj = new Database($_ENV['HOST_NAME'], $_ENV['DB_NAME'], $_ENV['USER_NAME'], $_ENV['DB_PASSWORD']);
    $res = $db_obj->selectUser('user',$email);
    $fname = $res['first_name'];
    $lname = $res['last_name'];
    $img = 'user_avatar.png';
    if (!empty($res['image_source'])) {
      $img = $res['image_source'];
    }
    $db_obj->closeDb();

    return [$img,$fname,$lname,$email];
  }

  /**
   * Function to control login action and setting variables
   *
   * @return array
   *   Returns an array of size 2 where first element is the status
   *   message and second is the css class.
   */
  public function loginController() {
    $msg = '';
    $cls = 'red';
    if (isset($_POST['submit'])) {
      $db_obj = new Database($_ENV['HOST_NAME'], $_ENV['DB_NAME'], $_ENV['USER_NAME'], $_ENV['DB_PASSWORD']);
      echo "works";
      $res = $db_obj->selectUser('user', $_POST['email']);
      if ($res) {
        if (
          $res['email'] == $_POST['email'] &&
          password_verify($_POST['password'], $res['password'])
        ) {
          $msg = 'Success';
          $cls = 'green';
          session_start();
          $_SESSION['email'] = $res['email'];
          $_SESSION['fname'] = $res['first_name'];
          $_SESSION['lname'] = $res['last_name'];
          $_SESSION['login'] = 'in';
          $db_obj->closeDb();
          print_r($_SESSION['email']);
          print_r($_SESSION['login']);
          header('location:/home');
          $db_obj->closeDb();
        }
        else {
          $msg = 'Email or password does not match.';
        }
      }
      else {
        $msg = 'User does not exist! Sign up';
      }
    }
    return [$msg,$cls];
  }
}

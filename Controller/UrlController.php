<?php

require_once 'vendor/autoload.php';
require_once 'core/Dotenv.php';
require_once 'Model/Database.php';
require_once 'Controller/ActionController.php';
require_once 'Helper/Validator.php';

/**
 * Class to route url to destination
 */
class UrlController extends ActionController {

  function __construct() {
    $obj = new Dotenv;
  }

  /**
   * Function to destroy session.
   *
   * @return void
   */
  function destroy_session()
  {
    session_start();
    session_unset();
    session_destroy();
  }

  /**
   * Function to set variables for the view and render the view page
   *
   * @return void
   */
  function redirectRegister() {
    $res = $this->registerController();
    $msg = $res[0];
    $cls = $res[1];
    $this->destroy_session();
    require 'View/register.php';
  }

  /**
   * Function to set variables for the view and render the view page
   *
   * @return void
   */
  function redirectLogin() {
    $this->destroy_session();
    require_once 'Helper/googleAuthentication.php';
    $google = new GoogleAuthentication();
    $res = $this->loginController();
    $msg = $res[0];
    $cls = $res[1];
    require 'View/login.php';
  }

  /**
   * Function to set variables for the view and render the view page
   *
   * @return void
   */
  function redirectResetPassword() {
    session_start();
    if (empty($_SESSION['otp'])) {{
      $this->destroy_session();
    }}
    $res = $this->resetController();
    $msg = $res[0];
    $cls = $res[1];
    require 'View/reset.php';
  }

  /**
   * Function to set variables for the view and render the view page
   *
   * @return void
   */
  function redirectOtp() {
    session_start();
    if (
      isset($_SESSION['email']) &&
      isset($_SESSION['otp_valid_till'])
    ) {
      require 'View/otp.php';
    }
    else {
      $this->destroy_session();
      header('Location:/');
    }
  }

  /**
   * Function to set variables for the view and render the view page
   *
   * @return void
   */
  function redirectHome() {
    session_start();
    if (
      isset($_SESSION['email']) &&
      isset($_SESSION['login'])
    ) {
      $valid = new Validator();
      if ($valid->isExistingUser($_SESSION['email'])) {
        $res = $this->homeController();
        $name = $res[0];
        $img = $res[1];
        require 'View/home.php';
      }
      else {
        $this->destroy_session();
        header('location:/register');
      }

    }
    else {
      $this->destroy_session();
      header('location:/');
    }
  }

  /**
   * Function to set variables for the view and render the view page
   *
   * @return void
   */
  function redirectProfile() {
    session_start();
    if (
      isset($_SESSION['email']) &&
      isset($_SESSION['login'])
    ) {
      $res = $this->profileController();
      $img = $res[0];
      $fname = $res[1];
      $lname = $res[2];
      $email = $res[3];
      $name = $fname . ' ' . $lname;
      require 'View/profile.php';
    }
    else {
      $this->destroy_session();
      header('location:/');
    }
  }
}

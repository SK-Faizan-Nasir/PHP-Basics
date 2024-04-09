<?php

// Require controller class
require 'Controller/UrlController.php';

$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url)[0];
$url = explode('/', $url);
// Break down the url for routing.

$control = new UrlController();
// Object of controller.

// Routing.
switch ($url[1]) {
  case '':
    $control->redirectLogin();
    break;
  case 'register':
    $control->redirectRegister();
    break;
  case 'reset':
    $control->redirectResetPassword();
    break;
  case 'otp':
    $control->redirectOtp();
    break;
  case 'home':
    $control->redirectHome();
    break;
  case 'profile':
    $control->redirectProfile();
    break;
  default:
    header('HTTP/1.0 404 not found');
}

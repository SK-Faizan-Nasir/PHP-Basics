<?php

$env = new Dotenv();

// init configuration
$clientID = $_ENV['CLIENT_ID'];
$clientSecret = $_ENV['CLIENT_SECRET'];
$redirectUri = $_ENV['REDIRECT_URI'];

// create Client Request to access Google API
$client = new Google\Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");
$code ='';
// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
  $code = $_GET['code'];
  $token = $client->fetchAccessTokenWithAuthCode($code);
  var_dump($token);
  $client->setAccessToken($token['access_token']);

  // get profile info
  $google_oauth = new Google\Service\Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;
  session_start();
  $_SESSION['email'] = $email;
  $_SESSION['login'] = true;
  header('location:/home');
  // now you can use this profile info to create account in your website and make user logged in.
}


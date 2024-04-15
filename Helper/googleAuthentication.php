<?php

/**
 * Class for google authentication and login.
 */
class GoogleAuthentication {
  // Instance variable for the client.
  private $client;

  /**
   * Constructor to initialize Google client and set variables.
   */
  function __construct() {
    $env = new Dotenv();
    // init configuration
    $clientID = $_ENV['CLIENT_ID'];
    $clientSecret = $_ENV['CLIENT_SECRET'];
    $redirectUri = $_ENV['REDIRECT_URI'];

    // create Client Request to access Google API
    $this->client = new Google\Client();
    $this->client->setClientId($clientID);
    $this->client->setClientSecret($clientSecret);
    $this->client->setRedirectUri($redirectUri);
    $this->client->addScope("email");
    $this->client->addScope("profile");
  }

  /**
   * Function to authenticate login procedure from the generated code.
   *
   * @return void
   */
  function authenticate() {
    $code = '';
    // authenticate code from Google OAuth Flow
    if (isset($_GET['code'])) {
      $code = $_GET['code'];
      $token = $this->client->fetchAccessTokenWithAuthCode($code);
      $this->client->setAccessToken($token['access_token']);

      // get profile info
      $google_oauth = new Google\Service\Oauth2($this->client);
      $google_account_info = $google_oauth->userinfo->get();
      $email =  $google_account_info->email;
      $name =  $google_account_info->name;
      session_start();
      $_SESSION['email'] = $email;
      $_SESSION['login'] = true;
      header('location:/home');
      // now you can use this profile info to create account in your website and make user logged in.
    }
  }

  /**
   * Function to generate the code and return the authentication url.
   *
   * @return string
   *   Returns the authentication url.
   */
  function authUrl() {
    return $this->client->createAuthUrl();
  }
}

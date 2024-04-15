<?php

/**
 * Class to perform validations.
 */
class Validator {

  /**
   * Creating Dotenv object to access env variables.
   */
  function __construct() {
    $env = new Dotenv();
  }

  /**
   * Function to validate email
   *
   * @param string $email
   *   Email id of the user.
   * @return boolean
   *   returns true if email is valid and false otherwise
   */
  public function isValidEmail(string $email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $ch = curl_init(
        "https://emailvalidation.abstractapi.com/v1/?api_key={$_ENV['API_KEY']}&email={$_POST['email']}"
      );
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      $data = curl_exec($ch);
      curl_close($ch);
      $result = json_decode($data, true);
      if (
        ($result['is_valid_format']['value']) &&
        ($result['is_smtp_valid']['value'])
      ) {
        return true;
      }
    }
    return false;
  }

  /**
   * Function to validate the name
   *
   * @param string $name
   *   Name provided by user.
   * @return boolean
   *   returns true if name is valid and false otherwise.
   */
  public function isValidName(string $name) {
    if (preg_match("/^[a-z A-Z]+$/",$name)){
      return true;
    }
    return false;
  }

  /**
   * Function to validate the password
   *
   * @param string $password
   *   password provided by user.
   * @return boolean
   *   returns true if password is valid and false otherwise.
   */
  public function isValidPassword(string $password) {
    if (!empty($password) && preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{5,}$/", $password)) {
      return true;
    }
    return false;
  }

  /**
   * Function to Check if a user exists in the database.
   *
   * @param string $email
   *   email provided by the user.
   * @return boolean
   *   returns true if user exists and false otherwise.
   */
  public function isExistingUser(string $email) {
    $db_obj = new Database($_ENV['HOST_NAME'], $_ENV['DB_NAME'], $_ENV['USER_NAME'], $_ENV['DB_PASSWORD']);
    if ($db_obj->selectUser('user',$email)){
      return true;
    }
    return false;
  }
}
?>

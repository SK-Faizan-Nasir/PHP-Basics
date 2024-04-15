<?php

require_once '../vendor/autoload.php';
require_once '../core/Dotenv.php';
require_once '../Model/Database.php';

$env = new Dotenv();
$db_obj = new Database($_ENV['HOST_NAME'], $_ENV['DB_NAME'], $_ENV['USER_NAME'], $_ENV['DB_PASSWORD']);
$allowed_files = ['image/png', 'image/jpeg', 'image/svg', 'image/webp'];

// Perform verifications and validations before updating the profile
if (!empty($_POST['fname']) && !empty($_POST['lname'])) {
  session_start();
  if (isset($_FILES['file'])) {
    if (in_array($_FILES['file']['type'], $allowed_files)) {
      $type = explode('/', $_FILES['file']['type'])[1];
      $img_path = uniqid("mvc_social") . '.' . $type;
      $file_name = '../static/images/' . $img_path;
      $tmp_name = $_FILES['file']['tmp_name'];
      move_uploaded_file($tmp_name, $file_name);
      $db_obj->updateInto(
        'user',
        ['first_name', 'last_name', 'image_source'],
        [$_POST['fname'], $_POST['lname'], $img_path],
        $_SESSION['email']
      );
      echo "Success";
      $_SESSION['fname'] = $_POST['fname'];
      $_SESSION['lname'] = $_POST['lname'];
    }
    else {
      echo "Invalid Image Format";
    }
  }
  else {
    $db_obj->updateInto(
      'user',
      ['first_name', 'last_name'],
      [$_POST['fname'], $_POST['lname']],
      $_SESSION['email']
    );
    // If all checks were sucessful update the table.
    echo "Success";
    $_SESSION['fname'] = $_POST['fname'];
    $_SESSION['lname'] = $_POST['lname'];
  }
}
else {
  echo "Fields must not be empty";
}
$db_obj->closeDb();

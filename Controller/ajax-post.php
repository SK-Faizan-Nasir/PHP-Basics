<?php

require_once '../vendor/autoload.php';
require_once '../core/Dotenv.php';
require_once '../Model/Database.php';

$env = new Dotenv();

$msg = '';
$cls = 'red';

$file_name = '';
$time = date("Y-m-d H:i:s");

$db_obj = new Database($_ENV['HOST_NAME'], $_ENV['DB_NAME'], $_ENV['USER_NAME'], $_ENV['DB_PASSWORD']);

if (empty($_POST['text'])) {
  echo "0";
  // If the content is empty there is nothing to post.
}
else {
  // Perform necessary checks and create new post.
  session_start();
  if (
    isset($_FILES['file']) &&
    ($_FILES['file']['type'] == 'image/png' || $_FILES['file']['type'] == 'image/jpeg')
  ) {
    $type = explode('/', $_FILES['file']['type'])[1];
    $img_path = uniqid("mvc_social") . '.' . $type;
    $file_name = '../static/images/' . $img_path;
    $tmp_name = $_FILES['file']['tmp_name'];
    move_uploaded_file($tmp_name, $file_name);
    $db_obj->insertInto(
      'posts',
      ['email', 'image', 'content', 'time'],
      [$_SESSION['email'], $img_path, $_POST['text'], $time]
    );
  }
  else {
    $db_obj->insertInto(
      'posts',
      ['email', 'content', 'time'],
      [$_SESSION['email'], $_POST['text'], $time]
    );
  }
  $db_obj->closeDb();
  echo "1";
}




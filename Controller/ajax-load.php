<?php

require_once '../vendor/autoload.php';
require_once '../core/Dotenv.php';
require_once '../Model/Database.php';

$env = new Dotenv();

$db_obj = new Database($_ENV['HOST_NAME'], $_ENV['DB_NAME'], $_ENV['USER_NAME'], $_ENV['DB_PASSWORD']);

$res = $db_obj->getMorePost($_POST['offset']);

// Load more number of posts.
require 'ajax-display.php';

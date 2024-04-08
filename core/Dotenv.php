<?php

/**
 * Class to load environment variables.
 */
class Dotenv
{
  public function __construct() {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
  }
}

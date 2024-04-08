<?php

class Database {

  private $sql;
  private $stmt;
  private $pdo;

  function __construct($server,$db,$user,$password) {
    try {
      $this->pdo = new PDO("mysql:host=$server;dbname=$db",$user,$password);
    }
    catch (Exception $e) {
      echo "Connection Failed: " . $e->getMessage();
    }

  }

  public function closeDb() {
    $this->pdo = NULL;
    $this->stmt = NULL;
  }

  public function insertInto(string $table_name, array $column_names, array $values) {
    $this->sql = "INSERT INTO {$table_name} (";
    $col_len = count($column_names);
    $val_len = count($values);
    for ($i = 0; $i < $col_len; $i++) {
      $tmp = '';
      if ($i == $col_len-1) {
        $tmp = "{$column_names[$i]}) VALUES(";
      }
      else {
        $tmp = "{$column_names[$i]}, ";
      }
      $this->sql .= $tmp;
    }

    for ($i = 0; $i < $val_len; $i++) {
      $tmp = '';
      if ($i == $val_len - 1) {
        $tmp = "?);";
      }
      else {
        $tmp = "?, ";
      }
      $this->sql .= $tmp;
    }

    $this->stmt = $this->pdo->prepare($this->sql);
    try{
      return $this->stmt->execute($values);
    }
    catch (Exception $e) {
      echo "Error Occured: " . $e;
    }
  }

  public function updateInto(string $table_name, array $column_names, array $values, $email) {
    $this->sql = "UPDATE {$table_name} SET ";
    $col_len = count($column_names);
    for ($i = 0; $i < $col_len; $i++) {
      $tmp = '';
      if ($i == $col_len - 1) {
        $tmp = "{$column_names[$i]} = '{$values[$i]}' WHERE email = '{$email}';";
      } else {
        $tmp = "{$column_names[$i]} = '{$values[$i]}', ";
      }
      $this->sql .= $tmp;
    }
    $this->stmt = $this->pdo->prepare($this->sql);
    try {
      return $this->stmt->execute();
    }
    catch (Exception $e) {
      echo "Error Occured: " . $e;
    }
  }

 public function selectUser(string $table_name, string $email) {
  $this->sql = "SELECT * FROM {$table_name} WHERE email = ?;";
  $this->stmt = $this->pdo->prepare($this->sql);
    try {
      $this->stmt->execute([$email]);
      $res = $this->stmt->fetch();
      return $res;
    }
    catch (Exception $e) {
      echo "Error Occured: " . $e;
    }
 }

 public function selectAll(string $table_name) {
    $this->sql = "SELECT * FROM {$table_name}";
    $this->stmt = $this->pdo->prepare($this->sql);
    try {
      $this->stmt->execute();
      $res = $this->stmt->fetch();
      return $res;
    }
    catch (Exception $e) {
      echo "Error Occured: " . $e;
    }
 }

 function getDefaultPost() {
    $this->sql = "SELECT * FROM posts AS p JOIN user AS u ON p.email = u.email ORDER BY time DESC LIMIT 3;";
    $this->stmt = $this->pdo->prepare($this->sql);
    try {
      $this->stmt->execute();
      $res = $this->stmt->fetchAll();
      return $res;
    }
    catch (Exception $e) {
      echo "Error Occured: " . $e;
    }
 }

 function getMorePost(string $offset) {
    $this->sql = "SELECT * FROM posts AS p JOIN user AS u ON p.email = u.email ORDER BY time DESC LIMIT {$offset},3;";
    $this->stmt = $this->pdo->prepare($this->sql);
    try {
      $this->stmt->execute();
      $res = $this->stmt->fetchAll();
      return $res;
    }
    catch (Exception $e) {
      echo "Error Occured: " . $e;
    }
 }

 function searchContent(string $search) {
    $this->sql = "SELECT * FROM posts AS p INNER JOIN user AS u ON p.email = u.email WHERE content LIKE '%$search%' ORDER BY time DESC;";
    $this->stmt = $this->pdo->prepare($this->sql);
    try {
      $this->stmt->execute();
      $res = $this->stmt->fetchAll();
      return $res;
    }
    catch (Exception $e) {
      echo "Error Occured: " . $e;
    }
 }

}

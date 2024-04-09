<?php

/**
 * Class to perform all database based operations.
 */
class Database {

  private $sql;
  private $stmt;
  private $pdo;

  /**
   * Constructor to initialize PDO object for performing queries.
   *
   * @param string $host
   *   Host name.
   * @param string $db
   *   Database Name.
   * @param string $user
   *   Database User Name.
   * @param string $password
   *   Password of database user.
   */
  function __construct(string $host, string $db, string $user, string $password) {
    // Initializing PDO Object.
    try {
      $this->pdo = new PDO("mysql:host=$host;dbname=$db",$user,$password);
    }
    catch (Exception $e) {
      echo "Connection Failed: " . $e->getMessage();
    }

  }

  /**
   * Function to close the database connection
   *
   * @return void
   */
  public function closeDb() {
    $this->pdo = NULL;
    $this->stmt = NULL;
  }

  /**
   * Function to insert into any table in the database.
   *
   * @param string $table_name
   *   Name of the table to insert data into.
   * @param array $column_names
   *   Column Names in the table.
   * @param array $values
   *   Values to be inserted.
   *
   * @return bool
   *   Returns true on success and false otherwise.
   */
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

  /**
   * Undocumented function
   *
   * @param string $table_name
   *   Name of the table.
   * @param array $column_names
   *   Name of columns to be updated.
   * @param array $values
   *   Values to be updated.
   * @param string $email
   *   Email to identify the updation selection.
   *
   * @return bool
   *   Returns true on success and false otherwise.
   */
  public function updateInto(string $table_name, array $column_names, array $values, string $email) {
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

 /**
  * Function to select a particular row from a table using email.
  *
  * @param string $table_name
  *   Table name to select from.
  * @param string $email
  *   Email id to identify row.
  *
  * @return mixed
  *  Returns array of details on success and false otherwise.
  */
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

  /**
   * Function to select all data from any table.
   *
   * @param string $table_name
   *   Table name to select from.
   *
   * @return mixed
   *   Returns array of details on success and false otherwise.
   */
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

 /**
  * Function to load 3 latest posts.
  *
  * @return array|false
  *   Returns fetched array on success and false otherwise.
  */
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

  /**
   * Function to load 3 more post from database.
   *
   * @param string $offset
   *   No of values to ignore.
   *
   * @return array|false
   *   Returns fetched array on success and false otherwise.
   */
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

  /**
   * Function to perform search query and return results.
   *
   * @param string $search
   *   Value of content to be searched.
   *
   * @return array|false
   *   Returns fetched array on success and false otherwise.
   */
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

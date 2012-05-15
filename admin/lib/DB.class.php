<?php
/**********************************************
DB.class.php
Defines the DB class. Used for various queries.
**********************************************/

if(!defined('IN_PAGINI')) {
  die('You are not authorized to view this file.');
  }

class DB {
  public $con, $dbhost, $dbuser, $dbpass, $dbname;
  
  public function __construct() {
    global $dbhost, $dbuser, $dbpass, $dbname;
    $this->dbhost = $dbhost;
    $this->dbuser = $dbuser;
    $this->dbpass = $dbpass;
    $this->dbname = $dbname;
    $this->con = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
    }
    
  public function create($table, $exists, $values) {
    $table = $this->con->real_escape_string($table);
    if($exists == 1) {
      $exists = " IF NOT EXISTS";
      }
    else {
      $exists = "";
      }
    $columns = "";
    $first = true;
    foreach($values as $column) {
      if($first == true) {
        $first = false;
        }
      else {
        $columns .= ", ";
        }
      $columns .= $this->con->real_escape_string($column);
      }
    $create = "CREATE TABLE$exists $table ($columns)";
    $result = $this->con->query($create);
    if($result == true) {
      return true;
      }
    else {
      return false;
      }
    }
  
  public function select($select) {
    $args = func_get_args();
    for($i = 1; $i < func_num_args(); $i++) {
      $args[$i-1] = $this->con->real_escape_string($args[$i]);
      }
    $select = vsprintf($select, $args);
    $result = $this->con->query($select);
    if($result->num_rows >= 1) {
      while($row = $result->fetch_array()) {
        $return[] = $row;
        }
      }
    else {
      $return = false;
      }
    return $return;
    }
  
  public function insert($table, $query) {
    $table = $this->con->real_escape_string($table);
    $columns = "";
    $values = "";
    $first = true;
    foreach($query as $column => $value) {
      if($first == true) {
        $first = false;
        }
      else {
        $columns .= ", ";
        $values .= ", ";
        }
      $columns .= $column;
      $values .= "'";
      $values .= $this->con->real_escape_string($value);
      $values .= "'";
      }
    $insert = "INSERT INTO $table ($columns) VALUES ($values)";
    $result = $this->con->query($insert);
    if($result == true) {	
      if($this->con->insert_id != 0) {
        return $this->con->insert_id;
        }
      else {
        return true;
        }
      }
    else {
      return false;
      }
    }
  
  public function update($table, $query, $fields) {
    $values = "";
    $first1 = true;
    foreach($query as $column => $value) {
      if($first1 == true) {
        $first1 = false;
        }
      else {
        $values .= ", ";
        }
      $values .= "$column = '";
      $values .= $this->con->real_escape_string($value);
      $values .= "'";
      }
    $where = "";
    $first2 = true;
    foreach($fields as $column => $value) {
      if($first2 == true) {
        $first2 = false;
        }
      else {
        $where .= " AND ";
        }
      $where .= "$column = '";
      $where .= $this->con->real_escape_string($value);
      $where .= "'";
      }
    $update = "UPDATE $table SET $values WHERE $where";
    $result = $this->con->query($update);
    if($result == true) {
      return true;
      }
    else {
      return false;
      }
    }
  
  public function delete($table, $fields) {
    $where = "";
    $first = true;
    foreach($fields as $column => $value) {
      if($first == true) {
        $first = false;
        }
      else {
        $where .= " AND ";
        }
      $where .= "$column = '";
      $where .= $this->con->real_escape_string($value);
      $where .= "'";
      }
    $delete = "DELETE FROM $table WHERE $where";
    $result = $this->con->query($delete);
    if($result == true) {
      return true;
      }
    else {
      return false;
      }
    }
  
  public function query($query) {
    $args = func_get_args();
    for($i = 1; $i < func_num_args(); $i++) {
      $args[$i-1] = $this->con->real_escape_string($args[$i]);
      }
    $query = vsprintf($query, $args);
    $result = $this->con->query($query);
    return $result;
    }
  }
?>

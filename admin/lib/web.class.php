<?php
/*****************************************************************
web.class.php
Defines the Web class. Gets a number of website-related variables.
*****************************************************************/

if(!defined('IN_PAGINI')) {
  die('You are not authorized to view this file.');
  }

class Web {
  public $db, $values, $name, $desc, $date;
  public function __construct($db) {
    $this->db = $db;
    $this->values = $this->db->select("SELECT value FROM settings");
    $this->name = $this->values[0][0];
    $this->desc = $this->values[1][0];
    $this->date = "date";
    }
  }
?>

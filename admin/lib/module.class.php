<?php
/*****************************************
module.class.php
Defines the Module class. Used by modules.
*****************************************/

if(!defined('IN_PAGINI')) {
  die('You are not authorized to view this file.');
  }

class Module {
  public $db;
  
  public function __construct() {
    $this->db = new DB();
    }
    
  public function add_menu_item($name, $category, $file) {
    global $menu;
    $menu[] = array($category, $name, $file);
    }
  
  public function add_tag($tag, $function) {
    global $tags;
    $tags[$tag] = $function;
    }
  
  public function add_type($var, $name, $function) {
    global $types;
    $types[$var] = array($name, call_user_func($function));
    }
  }
?>

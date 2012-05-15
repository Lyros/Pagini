<?php
/*****************************************
plugin.class.php
Defines the Plugin class. Used by plugins.
*****************************************/

if(!defined('IN_PAGINI')) {
  die('You are not authorized to view this file.');
  }

class Plugin extends Module {
  public function add_menu_item($alias, $name, $category, $file) {
    $this->add_admin($alias, $name, $category, $file);
    parent::add_menu_item($name, $category, "admin.php?p=$alias");
    }
    
  public function add_admin($alias, $name, $category, $file) {
    global $admins;
    $admins[$alias] = array($name, $category, "../plugins/$file");
    }
  }
?>

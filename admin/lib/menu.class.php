<?php
/************************************************
menu.class.php
Defines the Menu class. Used to create the menus.
************************************************/

if(!defined('IN_PAGINI')) {
  die('You are not authorized to view this file.');
  }

class Menu {
  public $cat_menu, $category, $menu;
  
  public function __construct($category, $menulist) {
    $this->menulist = $menulist;
    $this->category = $category;
    }
    
  public function display() {
    foreach($this->menulist as $item) {
      $this->cat_menu[$item[0]][] = array($item[1], $item[2]);
      }
    foreach($this->cat_menu[$this->category] as $item) {
      if($item[0] != "" && $item[0] != null){
        $this->menu .= "<li><a href=\"" . $item[1] . "\">" . $item[0] . "</a></li>";
        }
      }
    if(isset($this->menu)) {
      return "<ul id=\"$this->category\">" . $this->menu . "</ul>";
      }
    }
  }
?>

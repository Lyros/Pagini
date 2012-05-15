<?php
/*********************************************************
nav.class.php
Defines the Nav class. Used to create the navigation menu.
*********************************************************/

if(!defined('IN_PAGINI')) {
  die('You are not authorized to view this file.');
  }

class Nav {
  public $category, $navlist, $cat_nav, $navigation;
  public function __construct($category) {
    global $menu;
    $this->category = $category;
    $this->navlist = $menu;
    }
    
  public function display() {
    $this->navigation = "\n";
    foreach($this->navlist as $item)
      {
      $this->cat_nav[$item[0]][] = array($item[1], $item[2]);
      }
    foreach($this->cat_nav as $cat => $item) {
      if($this->category == $cat) {
        $this->navigation .= "          <li id=\"current\"><a href=\"" . $item[0][1] . "\">" . $cat . "</a></li>\n";
        }
      else {
        $this->navigation .= "          <li><a href=\"" . $item[0][1] . "\">" . $cat . "</a></li>\n";
        }
      }
    return $this->navigation;
    }
  }
?>

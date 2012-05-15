<?php
/***********************************************************
editor.class.php
Defines the Editor class. Used to create an editor instance.
***********************************************************/

if(!defined('IN_PAGINI')) {
  die('You are not authorized to view this file.');
  }

class Editor {
  public function name($name, $title, $value = "") {
    return "<input type=\"text\" name=\"$name\" title=\"$title\" value=\"$value\" id=\"$name\" class=\"hint\" />";
    }
  
  public function content($name, $value = "") {
    return "<textarea name=\"$name\" id=\"$name\">$value</textarea>";
    }
  
  public function orderid($name, $value = "") {
    return "<input type=\"text\" name=\"$name\" title=\"0\" id=\"$name\" value=\"$value\" maxlength=\"3\" class=\"hint\" />";
    }
  
  public function category($name, $title, $value = "") {
    }
  }
?>

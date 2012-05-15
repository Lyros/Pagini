<?php
/********************************************************
page.class.php
Defines the Page class. Used to display any type of page.
********************************************************/

// TO-DO
// Generate DB error message.
// Activate preview mode.
// Get page information relevant to page/news/category.
// TIDY UP!

if(!defined('IN_PAGINI')) {
  die('You are not authorized to view this file.');
  }

class Page {
  public $id, $type, $types, $theme, $name, $category, $description, $db;
  public function __construct() {
    global $types;
    $this->types = $types;
    $this->db = new DB();
    $this->theme = $this->db->select("SELECT value FROM settings WHERE id='4'");
    if($this->db->con == false) {
      // Print out error message and die(), after investigating cause.
      }
    foreach($this->types as $var => $result) {
      if(!empty($_GET[$var])) {
        $this->type = $result[0];
        $this->name = $result[1][0];
        $this->content = $result[1][1];
        }
      elseif(empty($_GET[$var]) && $var = "page") {
        $this->type = $result[0];
        $this->name = $result[1][0];
        $this->content = $result[1][1];
        }
      }
    if(isset($_GET['preview'])) {
      $this->display_preview($_GET['preview']);
      }
    else {
      $this->get_theme();
      }
    }
  
  private function get_theme() {
    $this->nav = "Navigation"; // Add navigation.
    $this->path = "themes/" . $this->theme[0][0] . "/";
    require("themes/" . $this->theme[0][0] .  ".php"); // Handle theme errors.
    $output = "";
    foreach($header as $file) {
      $output .= fread(fopen($this->path . $file, "r"), filesize($this->path . $file));
      }
    if(file_exists($this->path . $this->type . ".php")) { 
      $output .= fread(fopen($this->path . $this->type . ".php", "r"), filesize($this->path . $this->type . ".php"));
      }
    else {
      $output .= fread(fopen($this->path . "page.php", "r"), filesize($this->path . "page.php"));
      }
    foreach($footer as $file) {
      $output .= fread(fopen($this->path . $file, "r"), filesize($this->path . $file));
      }
    $web = new Web($this->db);
    $page = $this;
    $output = addcslashes($output, '",\\');
    eval('$output = "' . $output . '";');
    echo $output;
    }
    
  private function display_preview() {
    }
  
  private function apply_tags() {
    global $tags;
    }
    
  public function __destruct() {
    $this->db->con->close();
    }
  }
?>

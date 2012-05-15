<?php
/*********************************************************
admin.class.php
Defines the Admin class. Used in all administration pages.
*********************************************************/

if(!defined('IN_PAGINI')) {
  die('You are not authorized to view this file.');
  }

class Admin {
  public $name, $slug, $category, $nav, $menu, $menulist, $fh, $template, $content, $db, $checker, $scripts;
  
  public function __construct($pageName, $pageSlug, $pageCategory, $pageDesc = "") {
    global $menu;
    ob_start(array($this, 'process'));
    $this->name = $pageName;
    $this->slug = $pageSlug;
    $this->category = $pageCategory;
    $this->desc = $pageDesc;
    $this->menu = new Menu($this->category, $menu);
    $this->nav = new Nav($this->category);
    $this->fh = fopen("tpl/index.php", 'r');
    $this->template = fread($this->fh, filesize("tpl/index.php"));
    fclose($this->fh);
    $this->db = new DB();
    $this->checker = new Checker();
    }
  
  // scripts() will probably be replaced by better code eventually.
  public function scripts() {
    $return = "";
    foreach($this->scripts as $script) {
      $return .= "\n    <script type=\"text/javascript\" src=\"$script\"></script>";
      }
    return $return;
    }
    
  public function process($buffer) {
    $this->content = ob_get_contents();
    $buffer = $this->template;
    $buffer = str_replace("{page}", $this->name, $buffer);
    $buffer = str_replace("{slug}", $this->slug, $buffer);
    $buffer = str_replace("{category}", $this->category, $buffer);
    $buffer = str_replace("{desc}", $this->desc, $buffer);
    $buffer = str_replace("{scripts}", $this->scripts(), $buffer);
    $buffer = str_replace("{nav}", $this->nav->display(), $buffer);
    $buffer = str_replace("{menu}", $this->menu->display(), $buffer);
    $buffer = str_replace("{content}", $this->content, $buffer);
    return $buffer;
    }
    
  public function __destruct() {
    ob_end_flush();
    $this->db->con->close();
    }
  }
?>

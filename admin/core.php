<?php
/************************
core.php
Handles all core modules.
************************/

if(!defined('IN_PAGINI')) {
  die('You are not authorized to view this file.');
  }

$core = new Module();

/* General settings module */
$core->add_menu_item("General", "Configure", "settings-general.php");

/* Presentation settings module */
$core->add_menu_item("Presentation", "Configure", "settings-presentation.php");

/* Pages module */
function display_page() {
  global $core;
  if(isset($_GET['p']) && is_numeric($_GET['p'])) {
    $id = $_GET['p'];
    }
  else {
    $id = $core->db->select("SELECT value FROM settings WHERE id='5'");
    $id = $id[0][0];
    }
  $values = $core->db->select("SELECT name, content FROM pages WHERE id='%d'", $id); // Add category.
  return $values[0];
  }
$core->add_menu_item("Pages", "Build", "pages.php");
$core->add_type("p", "page", "display_page");

/* Scripts module */
$core->add_menu_item("Scripts", "Build", "scripts.php");

/* Media module */
$core->add_menu_item("Media", "Manage", "media.php");

/* Users module */
$core->add_menu_item("Users", "Manage", "users.php");

/* Mail module */
$core->add_menu_item("Mail", "Manage", "mail.php");

/* Updates module */
$core->add_menu_item("Updates", "Manage", "updates.php");

/* Themes module */
$core->add_menu_item("Themes", "Customize", "themes.php");

/* Plugins module */
$core->add_menu_item("Plugins", "Customize", "plugins.php");

?>

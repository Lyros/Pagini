<?php
/****************************************
includer.php
Includes libraries, functions, and so on.
****************************************/

if(!defined('IN_PAGINI')) {
  die('You are not authorized to view this file.');
  }

set_include_path(substr(__FILE__, 0, -strlen("admin/" . basename(__FILE__))));

/* Config file */
require_once("config/config.php");

/* Library files */
require_once("admin/lib/DB.class.php");
require_once("admin/lib/page.class.php");
require_once("admin/lib/admin.class.php");
require_once("admin/lib/checker.class.php");
require_once("admin/lib/editor.class.php");
require_once("admin/lib/error.class.php");
require_once("admin/lib/menu.class.php");
require_once("admin/lib/module.class.php");
require_once("admin/lib/nav.class.php");
require_once("admin/lib/plugin.class.php");
require_once("admin/lib/settings.class.php");
require_once("admin/lib/web.class.php");

/* Modules */
require_once("admin/moduler.php");
?>

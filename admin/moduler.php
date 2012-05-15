<?php
/****************************************
moduler.php
Includes core modules and plugin modules.
****************************************/

if(!defined('IN_PAGINI')) {
  die('You are not authorized to view this file.');
  }

/* Core modules */
require_once("admin/core.php");

/* Plugin modules */  
require_once("plugins/news.php"); // Temporary.
?>

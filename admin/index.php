<?php
/*******************************************
index.php
Presents the Overview to the administrators.
*******************************************/

define('IN_PAGINI', true);

require_once("manager.php");

$page = new Admin("Overview", "index", "");

?>
<p>Welcome to Pagini. Currently in development.</p>

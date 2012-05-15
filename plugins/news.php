<?php
/*
 * Name: News
 * Description: Publish up-to-date news posts.
 * Version: 1.1
 * Developer: Drastically Dedicated Developer
 * Plugin URL: http://www.lyros.net/pagini/
 * Developer URL: http://www.lyros.net
 */

// Add meta information.
// Note: in future versions, these two lines will become irrelevant.
$name = "Default";
$description = "A clean default theme for Pagini.";

$news = new Plugin();

// Add menu item, under the Build category.
$news->add_menu_item("news", "News", "Build", "news/news.php");

// Add other administration screens.
$news->add_admin("news-new", "New Post", "Build", "news/news-new.php");
$news->add_admin("news-edit", "Edit Post", "Build", "news/news-edit.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>{page} - Pagini</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="tpl/style/style.css" />
    <link rel="stylesheet" type="text/css" href="tpl/style/{slug}.css" />{scripts}
  </head>
  <body>
    <div id="header">
      <div id="login">
        <ul id="login">
          <li id="viewweb"><a href="../">View website</a></li>
          <li id="logout"><a href="login.php?action=logout">Logout</a></li>
        </ul>
      </div>
      <a href="index.php"><img src="tpl/img/logo.png" alt="logo" /></a>
      <div id="nav">
        <ul>{nav}        </ul>
      </div>
    </div>
    <div id="main">
      <div id="sidebar">
        <div id="menu">
          {menu}
        </div>
      </div>
      <div id="content">
        <h2 id="title">{page}</h2>
        <span class="smalldesc" id="subtitle">{desc}</span>
        {content}      
      </div>
    </div>
  </body>
</html>

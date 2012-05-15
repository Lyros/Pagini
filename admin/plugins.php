<?php
/***********************************************
plugins.php
Presents the plugins section, to manage plugins.
***********************************************/

define('IN_PAGINI', true);

require_once("manager.php");

$page = new Admin("Plugins", "plugins", "Customize", "Extend Pagini's functionality with plugins.");

$page->scripts = array("js/jquery.js", "js/plugins.js");

?>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
  <table class="lister" id="news" cellspacing="0">
    <tr><td id="top">Plugin</td></tr>
    <?php
    $plugins = scandir("../plugins/");
    foreach($plugins as $plugin) {
      if(is_file("../plugins/" . $plugin) && $plugin != "index.html") { 
        $include = include_once("../plugins/" . $plugin);
        if(isset($name) && isset($description)) { ?><tr>
          <td></td>
        </tr><?php }
        }
      }
    ?>
  </table>
</form>

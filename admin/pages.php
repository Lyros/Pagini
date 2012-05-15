<?php
/*******************************************
pages.php
Presents the Pages section, to manage pages.
*******************************************/

define('IN_PAGINI', true);

require_once("manager.php");

$page = new Admin("Pages", "pages", "Build", "Manage your pages as you wish.");

$page->scripts = array("js/jquery.js", "js/pages.js");

if(isset($_POST["delete"]) && !empty($_POST["delete"])) {
  $result = $page->db->delete("pages", array("id" => $_POST["delete"]));
  if($result == false) {
    /* Error message */
    }
  }

if(isset($_POST["rename"]) && !empty($_POST["rename"])) {
  $result = $page->db->update("pages", array("name" => htmlentities($_POST["rename"])), array("id" => $_POST['id']));
  if($result == false) {
    /* Error message */
    }
  }

?>
<table class="lister" id="pages" cellspacing="0">
  <tr><td id="top">Page</td><td id="top" style="text-align:right;"><a href="pages-new.php">New page</a></td></tr>
  <?php
  $result = $page->db->select("SELECT id, name, orderid FROM pages ORDER BY orderid, name");
  if($result != false) {
    foreach($result as $content) {
      ?>
      <tr class="page" id="<?php echo $content[0]; ?>"><td colspan="2"><span class="orderid"><?php echo $content[2]; ?></span><a class="name" href="../index.php?p=<?php echo $content[0]; ?>"><?php echo $content[1]; ?></a><br /><span><a href="pages-edit.php?id=<?php echo $content[0]; ?>" class="action" style="color:#2E8B57;">Edit</a><a href="#" class="action" rename="<?php echo $content[0]; ?>" name="<?php echo $content[1]; ?>">Rename</a><a href="#" class="action" id="delete" delete="<?php echo $content[0]; ?>" style="color:#CD0000;">Delete</a></span></td></tr>
      <?php
      }
    }
  else {
    ?>
    <tr><td colspan="2" style="color:#454545;font-size:11px; font-style:italic;">No pages were found.</td></tr>
    <?php
    }
  ?>
</table>

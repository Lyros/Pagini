<?php
/*************************************
pages-new.php
Presents the New Page editor instance.
*************************************/

define('IN_PAGINI', true);

require_once("manager.php");
  
$page = new Admin("New Page", "pages", "Build");

$page->scripts = array("js/jquery.js", "js/ckeditor/ckeditor.js", "js/ckeditor/adapters/jquery.js", "js/pages.js");

$editor = new Editor();

if(isset($_POST['submit'])) {
  $page_name = htmlentities($_POST['page_name']);
  $page_content = $_POST['page_content'];
  $page_orderid = $page->checker->num($_POST['page_orderid']);
  if(!empty($page_name) && !empty($page_content) && ($page_orderid == 0 || !empty($page_orderid))) {
    $return = $page->db->insert("pages", array("name" => $page_name, "content" => $page_content, "orderid" => $page_orderid));
    if($return != false) {
      header("Location:pages-edit.php?id=$return&action=created");
      }
    else {
      // Remove hard-code. Switch to error class.
      ?>
      <div class="error">There was an error creating your page.</div>
      <?php
      }
    }
  else {
    // Remove hard-code. Switch to error class.
    ?>
    <div class="error">You haven't filled in all the required fields.</div>
    <?php
    }
  }
  
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <fieldset>
    <table id="page">
      <tr><td id="page_name"><?php echo $editor->name("page_name", "Your page"); ?></td><td id="page_orderid"><?php echo $editor->orderid("page_orderid"); ?></td></tr>
      <tr><td id="page_content" colspan="2"><?php echo $editor->content("page_content"); ?></td></tr>
    </table>
    <input type="submit" name="submit" value="Create page" />
  </fieldset>
</form>

<?php
/**************************************
pages-edit.php
Presents the Edit Page editor instance.
**************************************/

define('IN_PAGINI', true);

require_once("manager.php");

$page = new Admin("Edit Page", "pages", "Build");

$page->scripts = array("js/jquery.js", "js/ckeditor/ckeditor.js", "js/ckeditor/adapters/jquery.js", "js/main.js", "js/pages.js");

$editor = new Editor();

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
  if(isset($_POST['submit'])) {
    $page_name_new = htmlentities($_POST['page_name']);
    $page_content_new = $_POST['page_content'];
    $page_orderid_new = $page->checker->num($_POST['page_orderid']);
    $page_id = $_GET['id'];
    if(!empty($page_name_new) && !empty($page_content_new) && ($page_orderid_new == 0 || !empty($page_orderid_new))) {
      $return = $page->db->update("pages", array("name" => $page_name_new, "content" => $page_content_new, "orderid" => $page_orderid_new), array("id" => $page_id)); 
      if($return != false) {
        header("Location:pages-edit.php?id=$page_id&action=updated");
        }
      else {
        // Remove hard-code. Switch to error class.
        ?>
        <div class="error">There was an error editing your page.</div>
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
  $result = $page->db->select("SELECT * FROM pages WHERE id='%d'", $_GET['id']);
  if($result != false) {
    $page_name = $result[0][1];
    $page_content = $result[0][2];
    $page_orderid = $result[0][3];
    }
  else {
    header("Location:pages-new.php");
    }
  if(isset($_GET["action"]) && $_GET["action"] == "updated") {
    // Remove hard-code. Switch to error class.
    ?>
    <div class="update">Your page was succesfully updated.</div>
    <?php
    }
  elseif(isset($_GET["action"]) && $_GET["action"] == "created") {
    // Remove hard-code. Switch to error class.
    ?>
    <div class="update">Your page was succesfully created.</div>
    <?php
    }
  }
    
else {
  header("Location:pages-new.php");
  }

?>
<form action="pages-edit.php?id=<?php echo $_GET['id']; ?>" method="post">
  <fieldset>
    <table id="page">
      <tr><td id="page_name"><?php echo $editor->name("page_name", "Your page", $page_name); ?></td><td id="page_orderid"><?php echo $editor->orderid("page_orderid", $page_orderid); ?></td></tr>
      <tr><td id="page_content" colspan="2"><?php echo $editor->content("page_content", $page_content); ?></td></tr>
    </table>
    <input type="submit" name="submit" value="Edit page" />
  </fieldset>
</form>

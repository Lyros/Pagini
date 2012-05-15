<?php
/**************************************
news-edit.php
Presents the Edit Post editor instance.
**************************************/

define('IN_PAGINI', true);

require_once("manager.php");

$page = new Admin("Edit Post", "news", "Build");

$page->scripts = array("js/jquery.js", "js/ckeditor/ckeditor.js", "js/ckeditor/adapters/jquery.js", "js/main.js", "js/news.js");

$editor = new Editor();

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
  if(isset($_POST['submit'])) {
    $post_title_new = htmlentities($_POST['post_title']);
    $post_content_new = $_POST['post_content'];
    $post_id = $_GET['id'];
    if(!empty($post_title_new) && !empty($post_content_new)) {
      $return = $page->db->update("news", array("title" => $post_title_new, "content" => $post_content_new), array("id" => $post_id)); 
      if($return != false) {
        header("Location:news-edit.php?id=$post_id&action=updated");
        }
      else {
        // Remove hard-code. Switch to error class.
        ?>
        <div class="error">There was an error editing your news article.</div>
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
  $result = $page->db->select("SELECT title, content FROM news WHERE id='%d'", $_GET['id']);
  if($result != false) {
    $post_title = $result[0][0];
    $post_content = $result[0][1];
    }
  else {
    header("Location:edit-new.php");
    }
  if(isset($_GET["action"]) && $_GET["action"] == "updated") {
    // Remove hard-code. Switch to error class.
    ?>
    <div class="update">Your post was succesfully updated.</div>
    <?php
    }
  elseif(isset($_GET["action"]) && $_GET["action"] == "created") {
    // Remove hard-code. Switch to error class.
    ?>
    <div class="update">Your post was succesfully created.</div>
    <?php
    }
  }
    
else {
  header("Location:news-new.php");
  }

?>
<form action="news-edit.php?id=<?php echo $_GET['id']; ?>" method="post">
  <fieldset>
    <table id="post">
      <tr><td id="post_title"><?php echo $editor->name("post_title", "Your post", $post_title); ?></td></tr>
      <tr><td id="post_content"><?php echo $editor->content("post_content", $post_content); ?></td></tr>
    </table>
    <input type="submit" name="submit" value="Edit post" />
  </fieldset>
</form>

<?php
/*************************************
news-new.php
Presents the New Post editor instance.
*************************************/
  
$page = new Admin("New Post", "news", "Build");

$page->scripts = array("js/jquery.js", "js/ckeditor/ckeditor.js", "js/ckeditor/adapters/jquery.js", "js/news.js");

$editor = new Editor();

if(isset($_POST['submit'])) {
  $post_title = htmlentities($_POST['post_title']);
  $post_date = date("d/m/y");
//  $post_user = $_SESSION['username']; Complete when Manager is finished.
  $post_user = "Lyrositor"; // Temporary code.
  $post_content = $_POST['post_content'];
  if(!empty($post_title) && !empty($post_content) && !empty($post_user)) {
    $return = $page->db->insert("news", array("title" => $post_title, "date" => $post_date, "user" => $post_user, "content" => $post_content));
    if($return != false) {
      header("Location:news-edit.php?id=$return&action=created");
      }
    else {
      // Remove hard-code. Switch to error class.
      ?>
      <div class="error">There was an error posting your news article.</div>
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
    <table id="post">
      <tr><td id="post_title"><?php echo $editor->name("post_title", "Your post"); ?></td></tr>
      <tr><td id="post_content"><?php echo $editor->content("post_content"); ?></td></tr>
    </table>
    <input type="submit" name="submit" value="Post article" />
  </fieldset>
</form>

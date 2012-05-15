<?php
/***********************************************
news.php
Presents the News section, to manage news posts.
***********************************************/

define('IN_PAGINI', true);

$page = new Admin("News", "news", "Build", "Publish up-to-date news posts.");

$page->scripts = array("js/jquery.js", "js/news.js");

if(isset($_POST["delete"]) && !empty($_POST["delete"])) {
  $result = $page->db->delete("news", array("id" => $_POST["delete"]));
  if($result == false) {
    /* Error message */
    }
  }

if(isset($_POST["rename"]) && !empty($_POST["rename"])) {
  $result = $page->db->update("news", array("title" => htmlentities($_POST["rename"])), array("id" => $_POST['id']));
  if($result == false) {
    /* Error message */
    }
  }
  
?>
<table class="lister" id="news" cellspacing="0">
  <tr><td id="top">News post</td><td id="top" style="text-align:right;"><a href="news-new.php">New post</a></td></tr>
  <?php
  $result = $page->db->select("SELECT id, title, date FROM news ORDER BY id DESC");
  if($result != false) {
    foreach($result as $post) {
      ?>
      <tr class="post" id="<?php echo $post[0]; ?>"><td colspan="2"><a class="name" href="../index.php?n=<?php echo $post[0]; ?>"><?php echo $post[1]; ?></a><br /><span><a href="news-edit.php?id=<?php echo $post[0]; ?>" class="action" style="color:#2E8B57;">Edit</a><a href="#" class="action" rename="<?php echo $post[0]; ?>" name="<?php echo $post[1]; ?>">Rename</a><a href="#" class="action" id="delete" delete="<?php echo $post[0]; ?>" style="color:#CD0000;">Delete</a></span></td></tr>
      <?php
      }
    }
  else {
    ?>
    <tr><td colspan="2" style="color:#454545;font-size:11px; font-style:italic;">No posts were found.</td></tr>
    <?php
    }
  ?>
</table>

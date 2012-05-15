<?php
/**********************************************************
themes.php
Presents the Themes section, to manage the website's theme.
**********************************************************/

define('IN_PAGINI', true);

require_once("manager.php");

$page = new Admin("Themes", "themes", "Customize", "Manage your website's themes.");

if(isset($_POST['activate']) && $_POST['theme']) {
  $theme = htmlentities($_POST['theme']);
  if(!empty($theme)) {
    $page->db->update("settings", array("value" => $theme), array("id" => 4));
    }
  }
?>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
  <table id="themes" cellspacing="0">
  <?php
  $curtheme = $page->db->select("SELECT value FROM settings WHERE id='4'");
  $curtheme = $curtheme[0][0];
  if(file_exists("../themes/" . $curtheme . ".php")) {
    $include = include_once("../themes/" . $curtheme . ".php");
    }
  elseif(!file_exists("../themes/" . $curtheme . ".php") && $curtheme != "") {
    $page->db->update("settings", array("value" => ""), array("id" => 4));
    $curtheme = "";
    $include = false;
    }
  else {
    $include = false;
    }
  if($include && isset($name) && isset($description)) { 
    $slug = $curtheme;
    ?>  <tr id="current">
      <td class="screenshot">
      <?php if(file_exists("../themes/$slug/screenshot.png")) {
        ?>  <a href="../index.php?preview=<?php echo $slug; ?>" class="preview">
          <img src="../themes/<?php echo $slug; ?>/screenshot.png" alt="Screenshot" class="screenshot" />
        </a>
      <?php } ?></td>
      <td>
        <a href="../index.php?preview=<?php echo $slug; ?>" class="preview"><?php echo $name; ?></a>
        <span class="description"><?php echo $description; ?></span>
        <input type="hidden" name="theme" value="<?php echo $slug; ?>" />
        <input type="submit" disabled="1" name="activate" value="Activate" />
        <input type="submit" name="edit" id="edit" value="Edit theme" />
      </td>
    </tr>
    <?php
    unset($name);
    unset($description);
    }
  unset($include);
  $themes = scandir("../themes/");
  foreach($themes as $theme) {
    $slug = substr($theme, 0, -4);
    if(is_file("../themes/" . $theme) && $theme != "index.html" && $curtheme != $theme) {
      $include = include_once("../themes/" . $theme);
      if(isset($name) && isset($description)) { ?><tr>
      <td class="screenshot">
          <?php if(file_exists("../themes/$slug/screenshot.png")) { ?><a href="../index.php?preview=<?php echo $slug; ?>" class="preview">
          <img src="../themes/<?php echo $slug; ?>/screenshot.png" alt="Screenshot" class="screenshot" />
        </a>
      <?php } ?></td>
      <td>
        <a href="../index.php?preview=<?php echo $slug; ?>" class="preview"><?php echo $name; ?></a>
        <span class="description"><?php echo $description; ?></span>
        <input type="hidden" name="theme" value="<?php echo $slug; ?>" />
        <input type="submit" name="activate" value="Activate" />
        <input type="submit" name="edit" id="edit" value="Edit theme" />
      </td>
    </tr>
        <?php
        unset($include);
        unset($name);
        unset($description);
        }
      }
    } ?>
  </table>
</form>

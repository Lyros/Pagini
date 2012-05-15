<?php
/**************************************************************************
settings-presentation.php
Presents the Presentation settings, pertaining to the looks of the website.
**************************************************************************/

define('IN_PAGINI', true);

require_once("manager.php");

$page = new Settings("Presentation", "settings", "Configure", "Settings pertaining to the looks.");

$page->scripts = array("js/jquery.js", "js/main.js");

?>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
  <fieldset>
    <table id="settings">
      <tr><td>Front page<br /><span class="smalldesc">The front page of the website.</span></td><td><select name="5"><option disabled="1"<?php 
      $home = $page->db->select("SELECT value FROM settings WHERE id='5'");
      if($page->db->select("SELECT * FROM pages WHERE id='%d'", $home[0][0]) == false) {
        echo "disabled=\"1\"";
        }
      ?>>-----</option><?php 
      foreach($page->db->select("SELECT id, name FROM pages") as $option) { 
        if($option[0] == $home[0][0]) {
          $selected = " selected=\"1\"";
          }
        else {
          $selected = "";
          }
        echo "<option value=\"$option[0]\"$selected>$option[1]</option>"; 
        } 
      ?></select></td></tr>
    </table>
    <input type="submit" name="submit" value="Apply changes"/>
  </fieldset>
</form>

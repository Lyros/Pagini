<?php
/**************************************************************
settings-general.php
Presents the General settings, pertaining to the whole website.
**************************************************************/

define('IN_PAGINI', true);

require_once("manager.php");

$page = new Settings("General", "settings", "Configure", "Settings pertaining to the whole website.", array(1 => "alphanum"));

$page->scripts = array("js/jquery.js", "js/main.js");

?>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
  <fieldset>
    <table id="settings">
      <tr><td>Website name<br /><span class="smalldesc">The name of the website.</span></td><td><input type="text" name="1" value="<?php $page->get_value(1); ?>" /></td></tr>
      <tr><td>Website description<br /><span class="smalldesc">A small description for the website.</span></td><td><input type="text" name="2" value="<?php $page->get_value(2); ?>" /></td></tr>
      <tr><td>E-mail<br /><span class="smalldesc">The official e-mail address for the website.</span></td><td><input type="text" name="3" value="<?php $page->get_value(3); ?>" /></td></tr>
    </table>
    <input type="submit" name="submit" value="Apply changes"/>
  </fieldset>
</form>

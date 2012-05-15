<?php
/*********************************************************
settings.class.php
Defines the Settings class, a special administration page.
*********************************************************/

if(!defined('IN_PAGINI')) {
  die('You are not authorized to view this file.');
  }

class Settings extends Admin {
  public function __construct($pageName, $pageSlug, $pageCategory, $pageDesc = "", $check = array()) {
    parent::__construct($pageName, $pageSlug, $pageCategory, $pageDesc);
    if(isset($_POST['submit'])) {
      foreach($_POST as $id => $value) {
        if($id != "submit" && is_int($id)) {
          if(isset($check[$id])) {
            // Check to see if the value is acceptable, then either update or add an error message. NOTE: Must create Error class, autoloaded by Admin class.
            }
          else {
            $result[$id] = $this->db->update("settings", array("value" => $value), array("id" => $id));
            }
          }
        }
      if($result != false) {
        // Remove hard-code. Switch to error class.
        ?>
        <div class="update">Settings updated.</div>
        <?php
        }
      }
    }
    
  public function get_value($id) {
    $value = $this->db->select("SELECT value FROM settings WHERE id='%d'", $id);
    echo $value[0][0];
    }
  }
?>

<?php
define('IN_PAGINI', true);

error_reporting(0);
  
if(isset($_POST['test'])) {
  $testcon = mysql_select_db($_POST['dbname'], mysql_connect($_POST['dbhost'], $_POST['dbuser'], $_POST['dbpass']));
  }

if(isset($_POST['config'])) {
  $config_text = "<?php
/*********************************************
config.php
Configuration file to connect to the database.
*********************************************/

if(!defined('IN_PAGINI')) {
  die('You are not authorized to view this file.');
  }
  
/**************************** SETTINGS ****************************/
/****** Manually set your database settings in this section. ******/

// \$dbhost - The host for the database; usually localhost.
\$dbhost = \"" . $_POST['dbhost'] . "\";

// \$dbuser - The name of the user with full access to the database.
\$dbuser = \"" . $_POST['dbuser'] . "\";

// \$dbpass - The password for the user of the database.
\$dbpass = \"" . $_POST['dbpass'] . "\";

// \$dbname - The name of the database to which Pagini will connect.
\$dbname = \"" . $_POST['dbname'] . "\";
?>";
  if(file_exists("../config/config.php") && is_writable("../config/config.php")) {
    $fh = fopen("../config/config.php", 'w') or die("Can't open file.");
    fwrite($fh, $config_text);
    fclose($fh);
    }
  include("../config/config.php");
  }

if(isset($_POST['create']) && $_POST['webname'] != "" && $_POST['username'] != "" && $_POST['email'] != "" && $_POST['password'] != "" && $_POST['confirm'] != "" && $_POST['password'] == $_POST['confirm']) {
  require_once("../config/config.php");
  mysql_select_db($dbname, mysql_connect($dbhost, $dbuser, $dbpass));
  $sql1 = "CREATE TABLE pages (id int NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), name text NOT NULL, content text NOT NULL, orderid int NOT NULL DEFAULT 0)";
  $sql2 = "CREATE TABLE news (id int NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), title text NOT NULL, date text NOT NULL, user varchar(30) NOT NULL, content text NOT NULL)";
  $sql3 = "CREATE TABLE settings (id int NOT NULL, PRIMARY KEY(id), name text NOT NULL, description text NOT NULL, value text)";
  $sql4 = "CREATE TABLE users (id int NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), username varchar(30) NOT NULL, password varchar(32) NOT NULL, level int NOT NULL DEFAULT 2 )";
  $username = mysql_real_escape_string($_POST['username']);
  $email = mysql_real_escape_string($_POST['email']);
  $password = md5($_POST['password']);
  $webname = mysql_real_escape_string($_POST['webname']);
  $webdesc = mysql_real_escape_string($_POST['webdesc']);
  mysql_query($sql1);
  mysql_query($sql2);
  mysql_query($sql3);
  mysql_query($sql4);
  mysql_query("INSERT INTO users (username, password, level) VALUES ('$username', '$password', '0') ");
  mysql_query("INSERT INTO settings (id, name, description, value) VALUES ('1', 'Website name', 'The name of the website.', '$webname' ) ");
  mysql_query("INSERT INTO settings (id, name, description, value) VALUES ('2', 'Website description', 'A small description for the website.', '$webdesc' ) ");
  mysql_query("INSERT INTO settings (id, name, description, value) VALUES ('3', 'E-mail', 'The official e-mail address for the website.', '$email' ) ");
  mysql_query("INSERT INTO settings (id, name, description, value) VALUES ('4', 'Theme', 'The current theme for your website.', 'default' ) ");
  mysql_query("INSERT INTO settings (id, name, description, value) VALUES ('5', 'Home page', 'The home page for your website.', '1' ) ");
  mysql_query("INSERT INTO pages (id, name, content, orderid) VALUES ('1', 'Home', '<p>This is your first page. It is rather boring, so why not spruce it up by going into your admin and changing it?</p>', '1' ) ");
  }
  
if((file_exists("../config/config.php") && filesize("../config/config.php") != null) || (isset($_GET['step']) && $_GET['step'] >= 1)) {
  $step = 1;
  if(filesize("../config/config.php") != null) {
    require("../config/config.php");
    $con = mysql_connect($dbhost, $dbuser, $dbpass);
    mysql_select_db($dbname, $con);
    if($con != false) {
      $result = mysql_query("SELECT * FROM settings"); 
      if($result == true) {
        if($_GET['step'] != 3) {
          header("Location:index.php?step=3");
          }
        $step = 3;
        }
      else {
        if($_GET['step'] != 2) {
          header("Location:index.php?step=2");
          }
        $step = 2;
        }
      }
    }
  }
else {
  $step = 0;
  }

if($step == 1 && $_GET['step'] != 0 && $_GET['step'] != 1 && isset($_GET['step'])) {
  header("Location:index.php?step=1");
  }
    
function install_step() {
  global $step;
  switch($step)
  {
  case 0:
    echo "Introduction";
    break;
  case 1:
    echo "Step 1: Database";
    break;
  case 2:
    echo "Step 2: Website";
    break;
  case 3:
    echo "Step 3: Finishing up";
    break;
  }
  }

function install_wizard() {
  global $step;
  global $errors;
  global $testcon;
  global $config_text;
  switch($step)
  {
  case 0:
    ?>
    <p>Greetings, and congratulations on choosing Pagini as your CMS! Installation is quite simple, and you will be walked through every step. There are only two steps at best, and maybe one more at the worst. You are only a few clicks away from a fully functional Pagini installation, so let's dive in.</p>
    <h2>Preparing</h2>
    <p>Before we begin the installation process, make sure you have the following details available:</p>
    <ul>
      <li>The name and host of an empty database which will be populated by Pagini,</li>
      <li>The username and password of a user with all rights on said database.</li>
    </ul>
    <p>Pagini uses a database to store all data pertaining to settings, website content, and so on. Currently, it is compatible only with <strong>MySQL 4</strong> and later versions. Your web server must also have <strong>PHP 5</strong> or higher installed. Finally, make sure Javascript is enabled in your browser (most modern browsers enable it by default).</p>
    <p>In order to avoid an extra step, it is recommended, if your webserver is UNIX-based (e.g. running a Linux distribution), to change the permissions of the file <code>config/config.php</code> to <strong>777</strong>, so that the installer can automatically write the configuration details; it is also possible to edit it manually, without having to change the permissions.</p>
    <p><em>OPTIONAL:</em> if you wish to enable uploads on your website, you will also have to change the permissions of the <code>uploads</code> directory to <strong>777</strong>.</p>
    <p>Once your server is ready and you are prepared, you may proceed to the next step.</p>
    <div style="text-align:right;"><input type="button" name="next" onClick="parent.location='index.php?step=1'" value="Next Step: Database" /></div>
    <?php
    break;
  case 1:
    if(isset($_POST['config'])) { 
      $_POST['test'] = "tested";
      $testcon = true;
      }
    ?>
    <p>In order for Pagini to be able to store information, it needs to have access to a database on which it will have full permissions. Set up such a database (in whichever you prefer; if you like doing it graphically, tools like phpMyAdmin are a must), then fill in the fields below.</p>
    <form action="index.php?step=1" method="post">
      <fieldset>
        <table>
          <tr><td><label for="dbhost">Database host:</label><input type="text" name="dbhost" <?php if(isset($_POST['test']) && $testcon == true) { ?>value="<?php echo $_POST['dbhost']; ?>" disabled="1" <?php } ?> /></td></tr>
          <tr><td><label for="dbname">Database name:</label><input type="text" name="dbname" <?php if(isset($_POST['test']) && $testcon == true) { ?>value="<?php echo $_POST['dbname']; ?>" disabled="1" <?php } ?> /></td></tr>
          <tr><td><label for="dbuser">Database username:</label><input type="text" name="dbuser" <?php if(isset($_POST['test']) && $testcon == true) { ?>value="<?php echo $_POST['dbuser']; ?>" disabled="1" <?php } ?> /><td></tr>
          <tr><td><label for="dbpass">Database password:</label><input type="password" name="dbpass" <?php if(isset($_POST['test']) && $testcon == true) { ?>value="<?php echo $_POST['dbpass']; ?>" disabled="1" <?php } ?> /></td></tr>
        </table>
      </fieldset>
      <div style="text-align:right;"><input type="submit" name="test" value="Test connection" <?php if(isset($_POST['test']) && $testcon == true) { ?>disabled="1" <?php } ?> /></div>
      <?php 
      if(isset($_POST['test'])) { 
        if($testcon == true) {
          ?>
          <p>Pagini was able to connect to your database! If the details you provided are correct, we can move on to the next step: it's time to create your configuration file. To make things easier, <strong>make sure that </strong><code>admin/config/config.php</code><strong> is writable</strong>.</p>
          <div style="text-align:right;"><input type="hidden" name="dbhost" value="<?php echo $_POST['dbhost']; ?>" /><input type="hidden" name="dbname" value="<?php echo $_POST['dbname']; ?>" /><input type="hidden" name="dbuser" value="<?php echo $_POST['dbuser']; ?>" /><input type="hidden" name="dbpass" value="<?php echo $_POST['dbpass']; ?>" /><input type="submit" name="config" value="Create configuration" <?php if(isset($_POST['config']) && $con == true) { ?>disabled="1" <?php } ?>/></div>
          <?php 
          }
        elseif($testcon == false) {
          ?>
          <p>Pagini was unable to connect to a database with the details you provided. Please double-check them, then try again.</p>
          <?php
          }
        }
      ?>  
    </form>
    <?php
    if(isset($_POST['config'])) { 
      if(!file_exists("../config/config.php") || (file_exists("../config/config.php") && !is_writable("../config/config.php"))) {
        ?>
        <p><span style="color:red; font-weight:bold;">WARNING:</span> it appears that <code>config/config.php</code><?php if(!file_exists("../config/config.php")) { ?> does not exist. Please create it and fill it with the text below.<?php } elseif(file_exists("../config/config.php") && !is_writable("../config/config.php")) {?> is not writable. Either change its permissions and press the "Create configuration" button once more, or edit it manually with the following text.<?php } ?></p>
        <textarea rows="32" readonly="1" style="width:100%;">
<?php echo $config_text;?>
        </textarea>
        <?php
        }
      }
    break;
  case 2:
    ?>
    <p>Pagini has been configured to access your database! You can now start filling in your website's basic details.</p>
    <?php
      if(isset($_POST['create']) && ($_POST['webname'] == "" || $_POST['username'] == "" || $_POST['email'] == "" || $_POST['password'] == "" || $_POST['confirm'] == "" || $_POST['password'] != $_POST['confirm'])) {  
        ?>
        <p style="background-color:#FEE0C6; border:solid 1px #8B2323; margin-top:25px; padding:5px;">You didn't fill in all the required fields, or one or more was filled incorrectly. Please make sure all required fields are filled with the correct information, then try again.</p>
        <?php
        }
      ?>
    <form action="index.php?step=2" method="post">
      <fieldset>
        <table>
          <tr><td><label for="webname">Website name (*):</label><input type="text" name="webname" /></td></tr>
          <tr><td><label for="webdesc">Website description:</label><input type="text" name="webdesc" /></td></tr>
        </table>
      </fieldset>
      <fieldset style="border:none; margin:0px; margin-bottom:30px; padding:0px;">
        <table>
          <tr><td><label for="username">Username (*):</label><input type="text" id="username" name="username" /></td></tr>
          <tr><td><label for="email">E-mail address (*):</label><input type="text" name="email" /></td></tr>
        </table>	
      </fieldset>
      <fieldset style="border:none; margin:0px; margin-bottom:30px; padding:0px;">
        <table>
          <tr><td><label for="password">Password (*):</label><input type="password" id="password" name="password" /></td></tr>
          <tr><td><label for="confirm">Confirm password (*):</label><input type="password" name="confirm" /></td></tr>
        </table>
      </fieldset>
      <p style="float:left; font-size:10px; text-transform:italic;">(*): Required fields.</p><div style="text-align:right;"><input type="submit" name="create" value="Create website" /></div>
    </form>
    <?php
    break;
  case 3:
    ?>
    <p>Congratulations! Pagini has been installed, and your website is ready to be used. This completes the installation process.</p>
    <p>You can access <strong>your website</strong> <a href="../">here</a>.</p>
    <p>You can access <strong>the administration section</strong> <a href="..">here</a>.</p>
    <div><p style="color:red; font-weight:bold; text-align:center;">Do not forget to delete the <code>install/</code> directory for security measures!</p></div>
    <?php
    break;
  }
  }
?>
<html>
  <head>
    <title>Installation - Pagini</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="jquery.js"></script>
    <script src="pass.js"></script>
    <script>
    $(document).ready(function() {
      $("#password").passStrength({
        userid: "#username"
        });
      });
    </script>
  </head>
  <body>
    <div id="main">
      <a href="index.php" style="border:none;"><img src="logo.png" id="logo" style="border:none;" /></a>
      <h2><?php install_step(); ?></h2>
      <?php install_wizard(); ?>
    </div>
  </body>
</html>

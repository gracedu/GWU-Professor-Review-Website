<?php
require_once('head.php');

// Student ID
$sql = "SELECT studentID FROM user WHERE userName LIKE '" . $_SESSION["NAME"] . "'";
$studentID = TCommon::getOneColumn($sql);

// Email
$sql = "SELECT email FROM user WHERE userName LIKE '" . $_SESSION["NAME"] . "'";
$email = TCommon::getOneColumn($sql);
?>

<h1 style="font-family: Helvetica Neue;">Account Settings</h1>
<h3 style="font-family: Helvetica Neue;">GWid: <?php echo $studentID ?></h3>
<h3 style="font-family: Helvetica Neue;">Email: <?php echo $email ?></h3>
<h3 style="font-family: Helvetica Neue;">Username: <?php echo $u_name ?></h3>
<br /><br />

<a id="add-professor" data-toggle="modal" data-target="#changePasswordModal">Change Password</a>

<?php require_once('component_change_password.php')?>

<?php require_once('foot.php'); ?>
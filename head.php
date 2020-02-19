<?php
require_once('./main/control.php');
$u_name = FALSE;
if (isset($_SESSION["NAME"])) {
    $u_name = FALSE == $_SESSION["NAME"] ? FALSE : $_SESSION["NAME"];
}
?>
<!DOCTYPE html>
<html>
<head>
    <img src="BG.bmp" style="position:fixed; width:100%;z-index:-1;opacity:0.1"></img>

    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <script src="assets/jquery.min.js"></script>
    <!-- bootstrap local-->
    <!-- <script src="assets/bootstrap.js"></script> -->
    <!-- <link rel="stylesheet" type="text/css" href="assets/bootstrap.css"/> -->
    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"  >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"  ></script>

    <!-- star -->
    <script src="assets/star-rating.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/star-rating.css"/>
    <!-- local -->
    <link rel="stylesheet" type="text/css" href="assets/style.css"/>
    <script src="assets/common.js"></script>
    <title><?php echo TCommon::$mainTitle; ?></title>
</head>

<body>

<div class="topnav">
  <a class="active" href="index.php">Home</a>
  <a href="about.php">About</a>
  <a href="contact.php">Contact</a>
  <?php if ($u_name === FALSE) { ?>
            <a href="user_login.php">Login/Register</a>
        <?php } else { ?>
            <a id="add-professor" data-toggle="modal" data-target="#myModal">Add Professor</a>
            <a href="account_settings.php">Account Settings</a>
            <a href="./main/control.php?act=out">Log Out</a>
        <?php } ?>
    <img align="right" src="logo.png" style="height:50px";></img>
</div>
<br /><br />
<div id="body" class="container">


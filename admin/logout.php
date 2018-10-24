<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/chef/connect/connect.php';
 unset($_SESSION['SBUser']);
 header("Location: login.php");

 ?>

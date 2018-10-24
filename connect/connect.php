<?php
$conn = mysqli_connect("localhost", "root", "", "chef");

if (!$conn) {
  echo "coonection error please try again".mysqli_connect_error();
}
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/chef/helpers.php';
require_once BASEURL.'config/config.php';
$cart_id = '';
if (isset($_COOKIE[CART_COOKIE])) {
$cart_id = sanitize($_COOKIE[CART_COOKIE]);
}
if (isset($_SESSION['SBUser'])) {
  $user_id = $_SESSION['SBUser'];
  $query = $conn->query("SELECT * FROM users WHERE id ='$user_id'");
  $userData = mysqli_fetch_assoc($query);
  $fn = explode(' ',$userData['full_name']);
  $userData['first'] = $fn[0];
  $userData['last'] = $fn[1];
}
if (isset($_SESSION['success_flash'])) {
     echo '<div class="bg-success" style="margin-top:15px;"><p class="text-success text-center">'.$_SESSION['success_flash'].'</p></div>';
     unset($_SESSION['success_flash']);
}
if (isset($_SESSION['error_flash'])) {
     echo '<div class="bg-danger" style="margin-top:15px;"><p class="text-center text-danger">'.$_SESSION['error_flash'].'</p></div>';
     unset($_SESSION['error_flash']);
}


 ?>

<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/chef/connect/connect.php';
if (!is_logged_in()) {
logged_in_error_redirect();
}
include 'includes/head.php';
$hashed = $userData['password'];
$old_password = ((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
$old_password = trim($old_password);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$conferm = ((isset($_POST['conferm']))?sanitize($_POST['conferm']):'');
$conferm = trim($conferm);
$new_hashed = password_hash($password, PASSWORD_DEFAULT);
$errors = array();
$user_id = $userData['id'];
 ?>

 <div id="login-form">
   <div>
<?php
if ($_POST) {
  //form validation
    if (empty($_POST['old_password']) || empty($_POST['password']) || empty($_POST['conferm'])) {
    $errors[] = "Please Fill all the required fields.";

  }
//check password more than 6 characters
/*if (strlen($password) < 6) {
$errors[] = "your password must be more than six characters.";
}*/
//check new password matches conferm
if ($password != $conferm) {
  $errors[] = "the  New password and conferm password does not match.";
}
  if (!password_verify($old_password, $hashed)) {
  $errors = "Your old password does not match.";
  }
  //check for errors
  if (!empty($errors)) {
    echo display_errors($errors);
  }else {
  //change password
  $conn->query("UPDATE users SET password ='$new_hashed' WHERE id ='$user_id'");
  $_SESSION['success_flash'] = "Your password has been reset";
  header('Location:index.php');

  }
}


 ?>


   </div>
   <h2 class="text-center">Chanege Password</h2>
   <form action="change_password.php" method="POST">
     <div class="form-group">
        <label for="old_password">old_password</label>
       <input type="password" name="old_password" id="old_password" class="form-control" value="<?=$old_password;?>">
     </div>
     <div class="form-group">
       <label for="password"> New Password</label>
       <input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
     </div>
     <div class="form-group">
       <label for="conferm">Conferm New Password</label>
       <input type="password" name="conferm" id="conferm" class="form-control" value="<?=$conferm;?>">
     </div>
     <div class="form-group">
       <a href="index.php" class="btn btn-danger">cancel</a>
       <input type="submit" value="Change password" class="btn btn-success">
     </div>
   </form>
   <p class="text-right"><a href="../index.php" alt="home">Visit Site</a></p>
 </div>

<?php
error_reporting(0);
require_once $_SERVER['DOCUMENT_ROOT'].'/chef/connect/connect.php';
$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
$email = trim($email);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$errors = array();
 ?>
 <link rel="stylesheet" href="css/bootstrap.min.css">
 <script src="../jquery-3.3.1.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
   <link rel="stylesheet"  href="../font-awesome-4.7.0/css/font-awesome.min.css">
 <style>
 body{
   background-image: url("../images/delightful_flowing_waterfall.jpg");
   background-repeat: no-repeat;
   background-size: 100vw 100vh;
   background-attachment: fixed;
 }
 #login-form{
   width: 50%;
   height: 60%;
   border: 2px solid black;
   border-radius: 15px;
   box-shadow: 7px, 7px, 15px rgba(0,0,0,0.6);
   margin: 8% auto;
   padding: 15px;
   background-color: #fff;
 }
 </style>
 <div id="login-form">
   <div>
<?php
if ($_POST) {
  //form validation
    if (empty($_POST['email']) || empty($_POST['password'])) {
    $errors[] = "Please Fill all the required fields.";

  }
//check password more than 6 characters
if (strlen($password) < 6) {
$errors[] = "your password must be more than six characters.";
}

  //validate email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors[] = "must enter a valid email.";
  }
  //check if the email exist in the database
  $query = $conn->query("SELECT * FROM users WHERE email ='$email'");
  $user = mysqli_fetch_assoc($query);

  $userCount = mysqli_num_rows($query);
  if ($userCount == 0) {
  $errors[] = "Your email or password is incorrect.";
  }

  if (!password_verify($password, $user['password'])) {
  $errors = "the password does not match please try again.";
  }
  //check for errors
  if (!empty($errors)) {
    echo display_errors($errors);
  }else {
    //log in users
    $user_id = $user['id'];
    login($user_id);
  }
}


 ?>


   </div>
   <h2 class="text-center">Login</h2>
   <form action="login.php" method="POST">
     <div class="form-group">
        <label for="email">Email</label>
       <input type="email" name="email" id="email" class="form-control" value="<?=$email;?>">
     </div>
     <div class="form-group">
       <label for="password">Password</label>
       <input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
     </div>
     <div class="form-group">
       <input type="submit" value="Login" class="btn btn-success">
     </div>
   </form>
   <p class="text-right"><a href="../index.php" alt="home">Visit Site</a></p>
 </div>

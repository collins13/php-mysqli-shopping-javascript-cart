<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/chef/connect/connect.php';
include 'includes/head.php';
if (!is_logged_in()) {
logged_in_error_redirect();
}
if (!has_permission('admin')) {
  permision_error_redirect('index.php');
}
if (isset($_GET['delete'])) {
  $user_id = sanitize($_GET['delete']);
  $conn->query("DELETE FROM users WHERE id ='$user_id'");
  $_SESSION['success_flash'] = 'user has been deleted';
  header('Location:users.php');
}
if (isset($_GET['add'])) {
  $name = (($_POST['name'])?sanitize($_POST['name']):'');
  $email = (($_POST['email'])?sanitize($_POST['email']):'');
  $password = (($_POST['password'])?sanitize($_POST['password']):'');
  $conferm = (($_POST['conferm'])?sanitize($_POST['conferm']):'');
  $permision = (($_POST['permision'])?sanitize($_POST['permision']):'');
  $errors = array();
  if ($_POST) {
    $emailQuery = $conn->query("SELECT * FROM users WHERE email ='$email'");
    $emailCount = mysqli_num_rows($emailQuery);
    if ($emailCount != 0) {
    $errors[] = 'That Email already exist in the database';
    }
   $required = array('name', 'email', 'password', 'conferm', 'permision');
   foreach ($required as $f) {
    if (empty($_POST[$f])) {
    $errors[] = 'You need to fill all fields.';
    break;
    }
   }
   if (strlen($password) < 6) {
    $errors[] = 'password must be more than six characters.';
   }
   if ($password != $conferm) {
    $errors[] = 'Your password does not match';
   }
   if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
     $errors[] = 'Your Email is not Valid';
   }
   if (!empty($errors)) {
     echo display_errors($errors);
   }else {
     $hashed = password_hash($password,PASSWORD_DEFAULT);
     $conn->query("INSERT INTO users(full_name, email, password, permision)
                               VALUES('$name', '$email', '$hashed', '$permision')");
     $_SESSION['success_flash'] = 'user has been added';
     header('Location:users.php');
   }
  }
  ?>
  <h2 class="text-center">Add A new User</h2>

  <form role="form" action="users.php?add=1" method="POST">
  <div class="form-group col-md-6">
    <label for="Name">Full Name:</label>
    <input type="text" name="name" id="name" class="form-control" value="<?=$name;?>">
  </div>
  <div class="form-group col-md-6">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" class="form-control" value="<?=$email;?>">
  </div>
  <div class="form-group col-md-6">
    <label for="password">password:</label>
    <input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
  </div>
  <div class="form-group col-md-6">
    <label for="password">Conferm Password:</label>
    <input type="password" name="conferm" id="conferm" class="form-control" value="<?=$conferm;?>">
  </div>
  <div class="form-group col-md-6">
      <label for="permision">permision:</label>
    <select name="permision" id="permision" class="form-control">
    <option value="<?=(($permision == '')?' selected':'');?>"></option>
    <option value="editor<?=(($permision == 'editor')?' selected':'');?>">Editor</option>
    <option value="admin,editor<?=(($permision == 'admin,editor')?' selected':'');?>">admin</option>
  </select>
  </div>
  <div class="form-group col-md-6 pull-right" style="margin-top:25px;">
    <a href="users.php" class="btn btn-danger">Cancel</a>
    <input type="submit" class="btn btn-primary" value="Add User">
</form>
<?php
}else {
$usersQuery = $conn->query("SELECT * FROM users ORDER BY full_name");
?>

<div class="container-fluid">
  <div class="row content">

    <?php include 'includes/sidebar.php'; ?>

    <div class="col-sm-10">
      <h2 class="text-center">Users</h2>
        <a href="users.php?add=1" class="btn btn-success pull-right" id="add-product-button">Add New User</a><br>
      <hr>
      <table class="table table-bordered table-striped table-condesed table-responsive">
        <thead>
          <th>hello</th><th>Name</th><th>Email</th><th>Joined Date</th><th>Last Login</th><th>Permision</th>
        </thead>
        <tbody>
            <?php while($users = mysqli_fetch_assoc($usersQuery)): ?>
          <tr>
              <td>
                  <?php if($users['id'] != $userData['id']): ?>
              <a href="users.php?delete=<?=$users['id'];?>" class="btn btn-sm btn-warning"><i class="fa fa-trash-o">delete</i></a>
            <?php endif; ?>
              </td>
            <td><?=$users['full_name'];?></td>
            <td><?=$users['email'];?></td>
            <td><?=pretty_date($users['joined_date']);?></td>
            <td><?=(($users['last_login'] == '0000-00-00 00:00:00')?'never':pretty_date($users['last_login']));?></td>
            <td><?=$users['permision'];?></td>
          </tr>
            <?php endwhile; ?>
        </tbody>

      </table>

    </div>
  </div>
</div>
<?php } ?>
</body>
</html>

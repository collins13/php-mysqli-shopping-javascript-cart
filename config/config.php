<?php
function display_errors($errors){
  $display = '<ul style="list-stye:none; color:red; font-weight:bold;" class="bd-danger">';
  foreach($errors as $error) {
    $display .= '<li class="text-danger">'.$error.'</li>';
  }
  $display .= '</ul>';
  return $display;
}

function sanitize($dirty){
  return htmlentities($dirty, ENT_QUOTES, "UTF-8" );
}

function money($number){
  return '$.'.number_format($number, 2);
}

function login($user_id){
  $_SESSION['SBUser'] = $user_id;
  global $conn;
  $date = date("Y:m:d H:i:s");
  $conn->query("UPDATE users SET last_login ='$date' WHERE id ='$user_id'");
  $_SESSION['success_flash'] = "You are now Loged in";
  header('Location:index.php');
}
function is_logged_in(){
  if (isset($_SESSION['SBUser']) && $_SESSION['SBUser'] > 0) {
  return true;
}else {
  return false;
  }
}

function logged_in_error_redirect($url = 'login.php'){
  $_SESSION['error_flash'] = "you must be logged to be logged to access the page";
  header('Location: '.$url);
}
function permision_error_redirect($url = 'login.php'){
  $_SESSION['error_flash'] = "you do not have permision to access that page";
  header('Location: '.$url);
}
function has_permission($permision = 'admin'){
  global $userData;
   $permisions = explode(',',$userData['permision']);
   if (in_array($permision,$permisions,true)) {
      return true;
   }else {
     return false;
   }
}
function pretty_date($date){
  return date("M d, Y h:i A",strtotime($date));
}
function get_category($child_id){
  global $conn;
  $id = sanitize($child_id);
  $sql = "SELECT p.id AS 'pid', p.name AS 'parent', c.id AS 'cid', c.name AS 'child'
         FROM categories c
         INNER JOIN categories p
         ON c.parent = p.id
         WHERE c.id = '$id'";
      $query = $conn->query($sql);
      $category = mysqli_fetch_assoc($query);
      return $category;
}



 ?>

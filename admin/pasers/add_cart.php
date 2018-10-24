<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/chef/connect/connect.php';
$details_id = sanitize($_POST['details_id']);
$quantity = sanitize($_POST['quantity']);
$item = array();
$item[] = array(
  'id'  => $details_id,
  'quantity' => $quantity,

);
$domain = ($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false;
$query = $conn->query("SELECT * FROM products WHERE id ='{$details_id}'");
$product = mysqli_fetch_assoc($query);
$_SESSION['success_flash'] = $product['title']. ' was added to your cart.';
//check if the cart cookie exist
if ($cart_id != '') {
  //update cart
}else {
  //add cart to the database and set cookie
  $items_json = json_encode($item);
  $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
  $conn->query("INSERT INTO categorie(items,expire_date) VALUES('{$items_json}','{$cart_expire}')");
  $cart_id = $conn->insert_id;
  setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);
}

 ?>

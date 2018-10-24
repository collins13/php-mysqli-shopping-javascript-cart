<?php
require_once 'connect/connect.php';
include 'includes/header.php';


if ($cart_id != '') {
$catQ = $conn->query("SELECT * FROM cart WHERE id ='$cart_id'");
$result = mysqli_fetch_assoc($catQ);
$items = json_decode($result['items'],true); var_dump($items);

$i = 1;
$sub_total = 0;
$item_count = 0;
}
 ?>

 <div class="col-md-12">
   <div class="row">
     <h2 class="text-center">My Shopping Cart</h2><hr>
     <?php if ($cart_id == ''): ?>
       <div class="bg-danger">
         <p class="text-center text-danger">
          Your shopping cart is empty.
         </p>
       </div>
     <?php else: ?>
       <table class="table table-bordered table-condesed table-striped">
         <thead><th>#</th><th>Item</th><th>Price</th><th>Quantity</th><th>Sub Total</th></thead>
         <tr>
           <tbody><tbody>
         </tr>
       </table>
     <?php endif; ?>
   </div>
 </div>

<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/chef/connect/connect.php';
?>
<?php include 'includes/header.php'; ?>
<?php
  if (isset($_GET['details'])) {
  $details_id = $_GET['details'];
  $sql = "SELECT * FROM products WHERE id ='$details_id'";
  $results = $conn->query($sql);
  $product = mysqli_fetch_assoc($results);
  }
 ?>

    <div class="content">
      <div id="modal_details">
        <div id="side_1">

          <div class="row">
            <span id="modal_errors" class="bg-danger"></span>
        <div class="col-sm-6">
          <img src="images/<?=$product['image'];?>" width="600" height="500" style="margin-left:auto; margin-right:auto;" class="img-responsive img-fluid rounded img-thumbnail" height="300" style="margin-left:10px; margin-bottom:10px;">
        </div>
        <div class="col-sm-6">
          <h1 style="text-align:center; color:red"><?=$product['title'];?></h1>
          <h3>RATING:</h3>
          <a href="#" class="fa fa-star fa-2x"></a>
          <a href="#" class="fa fa-star fa-2x"></a>
          <a href="#" class="fa fa-star fa-2x"></a>
          <a href="#" class="fa fa-star fa-2x"></a>
          <a href="#" class="fa fa-star fa-2x"></a>

          <h3>DESCRIPTION:</h3>
          <p><?=$product['description'];?><br></p>

                 <h3>STATUS: Available</h3>

                 <h3 style="text-align:left; margin-right10px;">PRICE: $.<?=$product['price'];?></h3>
             <form action="add_cart.php" method="post" id="add_product_form">
               <input type="hidden" name="details_id" value="<?=$details_id;?>">
               <div class=" form-group">
                 <div class="col-sm-3" style="margin-top:15px;"><label for="quantity">Quantity</label>
               <input type="number" name="quantity" id="quantity" class="form-control" min="0"></div>
             </div>
             <div class="col-xs-9">&nbsp;</div>
            </form>
            <div class="row">
            <div class="col-sm-3">
              <button class="btn btn-success btn-sm form-control pull-right" onclick="add_to_cart();return false;" style="margin-top:20px; width:80%;">Add To Cart</button>
            </div>
        </div>
      </div>
    </div>
    </div>
      <hr style="width:80%">
      <!--<div id="side_2">
      <div class="row">
      </div>
    </div>-->
  </div>
</div>
<!--<script>
jQuery('#size').change(function(){
  var available = jQuery('#size option:selected').data("#available");
  jQuery('#available').val(available);
});
</script>-->
<?php include 'includes/footer.php'; ?>

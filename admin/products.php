<?php
include '../config/config.php';
include '../connect/connect.php';
 if (!is_logged_in()) {
logged_in_error_redirect();
}

include 'includes/head.php';
 ?>
<style>
body{
  background-size: 100vw 100vh;
}
</style>
<div class="container-fluid">
  <div class="row content">
    <?php include 'includes/sidebar.php'; ?>
      <h2 class="text-center">Products</h2>
      <hr>
  <?php
  error_reporting(0);
  //delete products
  if (isset($_GET['delete'])) {
    $id = sanitize($_GET['delete']);
    $conn->query("UPDATE products SET deleted = 1 WHERE id = '$id'");
    header("Location:products.php");
  }
  $file_name = '';
      if (isset($_GET['add']) || isset($_GET['edit'])) {
       include '../script/products.inc.php';

  ?>
<h2 class="text-center"><?=((isset($_GET['edit']))?'Edit':'Add A New')?> Product</h2>
<hr>
<?php if(isset($error)){echo'<div id="error">'.$error.'</div>';} ?>
  <?php if(isset($success)){echo'<div id="success">'.$success.'</div>';} ?>
<form action="products.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1')?>" method="POST" enctype="multipart/form-data">
  <div class="form-group col-md-3">
    <label for="title" style="color:red;">Title*:</label>
    <input type="text" name="title" id="title" class="form-control" value="<?=$title;?>">
  </div>
  <div class="form-group col-md-3">
    <label for="parent" style="color:red;">Parent Category*:</label>
    <select name="parent" id="parent" class="form-control">
      <option value="<?=(($parent == '')?' selected':'');?>"></option>
      <?php while($p = mysqli_fetch_assoc($parentQuery)) : ?>
      <option value="<?=$p['id']; ?>"<?=(($parent == $p['id'])?'selected':'');?>><?=$p['name']; ?></option>
    <?php endwhile; ?>
  </select>
  </div>
  <div class="form-group col-md-3">
    <label for="child" style="color:red;">Child Category*:</label>
    <select name="child" id="child" class="form-control">
    </select>
  </div>
  <div class="form-group col-md-3">
    <label for="Price" style="color:red;">Price*:</label>
    <input type="text" name="price" id="price" class="form-control" value="<?=$price;?>">
  </div>
  <div class="form-group col-md-3">
      <label for="nutrition" style="color:red;">Nutrition & Quantity*:</label>
    <button type="button" class="btn btn-info form-control" data-toggle="modal" data-target="#sizesModal" onclick="jQuery('#sizesModal').modal('toggle');return false;">Nutrition & Quantity</button>
  </div>
  <div class="form-group col-md-3">
    <label for="sizes" style="color:red;">Nutrition & Qty preview*:</label>
    <input type="text" name="sizes" id="sizes" class="form-control" value="<?=$nutrition;?>" readonly>
  </div>
  <div class="form-group col-md-3">
    <?php if($saved_image != '') : ?>
    <div class="saved_image"><img src="../images/<?=$saved_image;?>" alt="saved image" style="width:200px; height:auto;" class="img-responsive"><br>
      <a href="products.php?delete_image=1&edit=<?=$edit_id;?>" class="text-danger">Delete Image</a>
    </div>
  <?php else: ?>
    <label for="photo" style="color:red;">Product Photo*:</label>
    <input type="file" name="photo" id="photo" class="form-control">
  <?php endif; ?>
  </div>
  <div class="form-group col-md-5">
    <label for="Description" style="color:red;">Description*:</label>
    <textarea type="text" name="description" class="form-control" rows="10" cols="6"><?=$description;?></textarea>
  </div>
  <div class="form-group col-md-3 pull-right">
  <input type="submit" class="btn btn-success" value="<?=((isset($_GET['edit']))?'Edit':'Add')?> Product" style="margin-bottom:10px;">
  <a href="products.php" class="btn btn-danger" style="margin-bottom:10px;">Cancel</a>
</div><div class="clearfix"></div>
</form>

<div class="modal fade" id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="sizesModalLabel" style="color:black; font-wight:bold;">Sizes $ Quantity</h4>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
        <?php for($i=1; $i <= 12; $i++): ?>
          <div class="form-group col-md-4">
            <label for="size<?=$i;?>">Nutrition*:</label>
            <input type="text" name="size<?=$i;?>" id="size<?=$i;?>" class="form-control" value="<?=((!empty($sArray[$i-1]))?$sArray[$i-1]:'');?>">
          </div>
          <div class="form-group col-md-2">
            <label for="qty<?=$i?>" style="color:red;">Quantity(grams)*:</label>
            <input type="number" name="qty<?=$i;?>" id="qty<?=$i;?>" class="form-control" value="<?=((!empty($qArray[$i-1]))?$qArray[$i-1]:'');?>" min="0">
          </div>
        <?php endfor; ?>
      </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="updateSizes(); jQuery('#sizesModal').modal('toggle'); return false;">Save changes</button>
        </div>
      </div>
    </div>
  </div>


      <?php }else{
    include '../connect/connect.php';
    $sql = "SELECT * FROM products WHERE deleted = 0";
    $presult = $conn->query($sql);

    if (isset($_GET['feature'])) {
    $id = (int)$_GET['id'];
    $feature = (int)$_GET['feature'];
    $fsql = "UPDATE products SET feature ='$feature' WHERE id ='$id'";
    $conn->query($fsql);
    header("Location:products.php");
    }

     ?>

    <div class="col-md-10">
<a href="products.php?add=1" class="btn btn-success pull-right" id="add-product-button">Add Product</a><div class="clearfix"></div><hr>
<table class="table table-bordered table-striped table-condesed">
  <tr>
    <th></th><th>Title</th><th>Price</th><th>Category</th><th>Feature</th><th>Sold</th>
  </tr>
  <?php
  while($product = mysqli_fetch_assoc($presult)):
      $childID = $product['categories'];
      $catsql ="SELECT * FROM categories WHERE id ='$childID'";
      $catresult = $conn->query($catsql);
      $child = mysqli_fetch_assoc($catresult);
      $parentID = $child['parent'];
      $parentsql = "SELECT * FROM categories WHERE id ='$parentID'";
      $parentresult = $conn->query($parentsql);
      $parent = mysqli_fetch_assoc($parentresult);
      $category = $parent['name'].'~'.$child['name'];

      ?>
  <tr>
    <td>
      <a href="products.php?edit=<?= $product['id']; ?>"><i class="fa fa-2x fa-edit"></i></a>
      <a href="products.php?delete=<?= $product['id']; ?>"><i class="fa fa-2x fa-close"></i></a>
    </td>
    <td><?=$product['title'];?></td>
    <td><?=money($product['price']);?></td>
    <td><?=$category; ?></td>
    <td>
      <a href="products.php?feature=<?=(($product['feature'] == 0)?'1':'0'); ?>&id=<?=$product['id'];?>" class="btn btn-xs btn-default">
           <span class="fa fa-<?=(($product['feature'] == 0)?'plus':'minus'); ?>"></span></a>
           &nbsp <?=(($product['feature'] == 1)?'featured product':'');?>
    </td>
    </td>
    <td>hello</td>
  </tr>
<?php endwhile; ?>

</table>

  </div>
</div>
</div>
<?php } ?>

<script src="../jquery-3.3.1.min.js"></script>
<script>
function updateSizes(){
  let sizeString = '';
       for(var i=1;i<=12;i++) {
         if (jQuery('#size'+i).val()!= '') {
            sizeString += jQuery('#size'+ i).val()+' :'+jQuery('#qty'+i).val()+',  ';
         }
       }
       jQuery('#sizes').val(sizeString);
     }
function get_child_options(selected){
  if (typeof selected === 'undefined') {
    var selected ='';
}
  var parentID = jQuery('#parent').val();
  jQuery.ajax({
    url: '/chef/admin/pasers/child_categories.php',
    type: 'POST',
    data: {parentID : parentID, selected: selected},
    success: function(data){
      jQuery('#child').html(data);
    },
    error: function(){alert("something went wrong with child category")},
  });
}
jQuery('select[name="parent"]').change(function() {
  get_child_options();
});

jQuery('document').ready(function(){
  get_child_options('<?=$categories;?>');
});

</script>
</body>
</html>

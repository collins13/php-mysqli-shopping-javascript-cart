<?php require_once $_SERVER['DOCUMENT_ROOT'].'/chef/connect/connect.php'; ?>
<?php if (!is_logged_in()) {
logged_in_error_redirect();
}
 include 'includes/head.php';
 ?>

<div class="container-fluid">
  <div class="row content">

    <?php include 'includes/sidebar.php'; ?>
<?php
$errors = array();
$sql = "SELECT  * FROM categories WHERE parent = 0";
$result = $conn->query($sql);

$category = '';
$p_parent = '';
//edit category

if (isset($_GET['edit']) && !empty($_GET['edit'])) {
$edit_id = (int)$_GET['edit'];
$edit_id = sanitize($edit_id);
$esql = "SELECT * FROM categories WHERE id ='$edit_id'";
$eresult = $conn->query($esql);
$editcategory = mysqli_fetch_assoc($eresult);
}

//delete category
 if (isset($_GET['delete']) && !empty($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  $delete_id = sanitize($delete_id);

  $sql = "SELECT * FROM categories WHERE id ='$delete_id'";
  $result = $conn->query($sql);
  $category = mysqli_fetch_assoc($result);

  if ($category['parent'] == 0) {
  $sql = "DELETE FROM categories WHERE parent ='$delete_id'";
  $conn->query($sql);
}
  $dsql =  "DELETE FROM categories WHERE id='$delete_id'";
  $dresult = $conn->query($dsql);
  header("Location: categories.php");

 }
//proces form
if (isset($_POST) && !empty($_POST)) {
   $p_parent = sanitize($_POST['parent']);
   $name = sanitize($_POST['name']);
   $formsql = "SELECT * FROM categories WHERE name ='$name' AND parent = '$p_parent' ";
   if (isset($_GET['edit'])) {
    $id = $editcategory['id'];
    $sqlform = "SELECT * FROM categories WHERE name='$name' AND parent ='$p_parent' AND id !='$id'";
   }
   $fresult = $conn->query($formsql);

   $count = mysqli_num_rows( $fresult );
//check if is empty
   if ($name == '') {
  $errors[] .='catgories cannot be left empty';
   }
   //check if category exists
   if ($count > 0) {
    $errors[] .=$name.' Alredy exists. Please Choose A New Category';
   }
   //display errore or update the database
   if (!empty($errors)) {
     echo display_errors($errors); ?>
<script stype="text/javascript">
jQuery('document').ready(function(){
  jQuery('#errors').html(<?=$display;?>);
});
</script>


<?php
  }else {
  $updatesql = "INSERT INTO categories (name, parent) VALUES('$name', '$p_parent')";
  $updatesql = "UPDATE categories SET name ='$name', parent ='$p_parent' WHERE id ='$edit_id'";
  $conn->query($updatesql);
  header('Location: categories.php');
   }
}
$category_value ='';
$parent_value = '';
if (isset($_GET['edit'])) {
  $category_value = $editcategory['name'];
  $parent_value = $editcategory['parent'];
}else {
  if (isset($_POST)) {
    $categories_value = $category;
    $parent_value = $p_parent;
  }
}
 ?>
 <div class="col-sm-10">
<h2 class="text-center">categories</h2><hr>
    <form class="form" action="categories.php<?= ((isset($_GET['edit']))?'?edit='.$edit_id:'')?>" method="POST">
      <legend><?=((isset($_GET['edit']))?'Edit':'Add A  ');?> Category</legend>
      <div class="errors"></div>
  <div class="form-group">
    <div class="col-sm-10">
    <label for="parent">Parent</label>
    <select class="form-control" name="parent" id="parent">
       <option value="0"<?=(($parent_value == 0)?' selected="selected"':'');?>>select category</option>
             <?php while($parent = mysqli_fetch_assoc($result)) : ?>
               <option value="<?=$parent['id'];?>"<?=(($parent_value == $parent['id'])?' selected="selected"':'');?>><?=$parent['name']; ?></option>
             <?php endwhile; ?>

    </select><br>
  </div>
</div>
  <div class="form-group">
      <div class="col-sm-10">
      <label for="category">Category</label>
               <input type="text" class="form-control" id="Category" placeholder="Category" name="name" value="<?=$category_value; ?>"><br>
       </div>
     </div>
     <div class="form-group">
        <div class="col-sm-offset-1 col-sm-10">
          <input type="submit" name="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add')?> Category" class="btn btn-success"><br>
        </div>
      </div>
</form><br>
<div class="clearfix"></div>
<hr>

<?php
  $sql = "SELECT  * FROM categories WHERE parent = 0";
  $result = $conn->query($sql);

  ?>
    <!--table column-->
      <table class="table table-bordered">
          <thead>
            <th>Categories</th><th>Parent</th><th></th>
          <thead>
            <tbody>
              <?php while($parent = mysqli_fetch_assoc($result)) :
                  $parent_id = (int)$parent['id'];
                  $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
                  $cresult = $conn->query($sql2);
                 ?>
              <tr class="bg-primary" style="color:white;">
              <td><?=$parent['name']; ?></td>
              <td>Category</td>
              <td>

                <a href="categories.php?edit=<?=$parent['id'];  ?>" class="btn btn-xs btn-warning">Edit<i class="fa fa-1x fa-edit"></i></a>
                <a href="categories.php?delete=<?=$parent['id'];  ?>" class="btn btn-xs btn-danger">Delete<i class="fa fa-1x fa-trash-o"></i></a>
              </td>
            </tr>
            <?php while($child = mysqli_fetch_assoc($cresult)) : ?>
              <tr class="bg-info" style="color:white;">
                    <td style="color:black;"><?=$child['name']; ?></td>
                    <td style="color:black;"><?=$parent['name']; ?></td>
                    <td>

                    <a href="categories.php?edit=<?=$child['id'];  ?>" class="btn btn-xs btn-warning">Edit<i class="fa fa-1x fa-edit"></i></a>
                    <a href="categories.php?delete=<?=$child['id'];  ?>" class="btn btn-xs btn-danger">Delete<i class="fa fa-1x fa-trash-o"></i></a>
              </td>
            </tr>
            <?php endwhile; ?>
          <?php endwhile; ?>
            <tbody>
      </table>
    </div>



  </div>
</div>

</body>
</html>

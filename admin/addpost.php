<?php include '../connect/connect.php'; ?>
<?php include 'includes/head.php';  ?>
<?php
if (isset($_POST['submit'])) {
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $body = mysqli_real_escape_string($conn, $_POST['message']);


  if (empty($title) || empty($body)) {
  echo "all fileds area required";
  }
  if(isset($_FILES['file'])){
     $errors= array();
     $file_name = $_FILES['file']['name'];
     $file_size =$_FILES['file']['size'];
     $file_tmp =$_FILES['file']['tmp_name'];
     $file_type=$_FILES['file']['type'];
     $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));

     $expensions= array("jpeg","jpg","png", "mp4", "mp3");

     if(in_array($file_ext,$expensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
     }

     if($file_size > 2097152){
        $errors[]='File size must be excately 2 MB';
     }

     if(empty($errors)==true){
        move_uploaded_file($file_tmp,"../images/".$file_name);
       $sql = "INSERT INTO posts(p_title, p_image, p_body)
                     VALUES('$title', '$file_name', '$body')";
           $result = $conn->query($sql);
     }else{
        print_r($errors);
     }
  }
}
?>


<div class="container-fluid">
  <div class="row content">

    <?php include 'includes/sidebar.php'; ?>

    <div class="col-sm-9">
      <div class="well">
        <h4>Dashboard</h4>
        <p>Some text..</p>
      </div>
      <br>

      <form class="form-horizontal" role="form" action="addpost.php" method="POST" enctype="multipart/form-data">
<div class="form-group">
  <label for="title" class="col-sm-2 control-label">Title</label>
  <div class="col-sm-6">
    <input type="text" name="title" class="form-control" id="title" placeholder="Post Title">
  </div>
</div>
<div class="form-group">
  <label for="image" class="col-sm-2 control-label">Image</label>
  <div class="col-sm-6">
    <input type="file" name="file" class="form-control" id="image" placeholder="choole an image">
  </div>
</div>
<div class="form-group">
  <label for="Body" class="col-sm-2 control-label">Body</label>
  <div class="col-sm-8">
    <textarea name="message" class="form-control" rows="6"></textarea>
  </div>
</div>
<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
    <button type="submit" name="submit" class="btn btn-success">Add Post</button>
  </div>
</div>
</form>

</body>
</html>

        $parentQuery = $conn->query("SELECT * FROM categories WHERE parent = 0 ORDER BY name");
        $title = ((isset($_POST['title']) && $_POST['title'] !== '')?sanitize($_POST['title']):'');
        if (isset($_GET['edit'])) {
        $edit_id = (int)$_GET['edit'];
        }

if($_POST){
error_reporting(0);
$title = sanitize($_POST['title']);
$price = sanitize($_POST['price']);
$categories = sanitize($_POST['child']);
$price = sanitize($_POST['price']);
$nutrition = sanitize($_POST['sizes']);
$description = sanitize($_POST['description']);
if (empty($title) && empty($price) && empty($nutrition) && empty($categories) && empty($description)) {
$error = "All fields with castrisk are required";
}
          $errors = array();
  if (!empty($_POST['sizes'])) {
  $sizeString = sanitize($_POST['sizes']);
  $sizeString = rtrim($sizeString,',');
  $sizesArray = explode(',',$sizeString);
  $sArray = array();
  $qArray = array();
  foreach ($sizesArray as $ss) {
    $s = explode(':', $ss);
    $sArray[] = $s[0];
    $qArray[] = $s[1];

  }
}else {$sizesArray = array();}




//special
<?php
if(isset($_FILES['photo'])){
 $errors= array();
 $file_name = $_FILES['photo']['name'];
 $file_size =$_FILES['photo']['size'];
 $file_tmp =$_FILES['photo']['tmp_name'];
 $file_type=$_FILES['photo']['type'];
 $file_ext= strtolower(end(explode('.', $_FILES['photo']['name'])));

 $expensions= array("jpeg","jpg","png");

 if(in_array($file_ext,$expensions)=== false){
    $error = "extension not allowed, please choose a JPEG or PNG file.";
 }

 if($file_size > 25000000){
    $errors[]='your file is too large';
 }
  }
  if (!empty($errors)) {
 echo desplay_errors($errors);
}else {
  move_uploaded_file($file_tmp,"../images/".$file_name);
  $insertSql = "INSERT INTO products(title, price, image, categories, description, nutrition)
                VALUES('$title', '$price', '$file_name', '$categories',  '$description', '$nutrition')";
                $resultSql = $conn->query($insertSql);
  }
}

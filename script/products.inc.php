<?php
$parentQuery = $conn->query("SELECT * FROM categories WHERE parent = 0 ORDER BY name");
$title = ((isset($_POST['title']) && $_POST['title'] !== '')?sanitize($_POST['title']):'');
$price = ((isset($_POST['price']) && !empty($_POST['price']))?sanitize($_POST['price']):'');
$description = ((isset($_POST['description']) && !empty($_POST['description']))?sanitize($_POST['description']):'');
$categories = ((isset($_POST['child']) && !empty($_POST['child']))?sanitize($_POST['child']):'');
$parent = ((isset($_POST['parent']) && !empty($_POST['parent']))?sanitize($_POST['parent']):'');
$nutrition = ((isset($_POST['sizes']) && $_POST['sizes'] !== '')?sanitize($_POST['sizes']):'');
$nutrition = rtrim($nutrition,',');
$saved_image ='';

if (isset($_GET['edit'])) {
$edit_id = (int)$_GET['edit'];
$productsResults = $conn->query("SELECT * FROM products WHERE id='$edit_id' ");
$product = mysqli_fetch_assoc($productsResults);
if (isset($_GET['delete_image'])) {
$image_url = $_SERVER['DOCUMENT_ROOT'].$product['image'];
unlink($image_url);
$conn->query("UPDATE  products SET image ='' WHERE id ='$edit_id'");
header('Location:products.php?edit='.$edit_id);
}
$categories = ((isset($_POST['child']) && $_POST['child'] == '')?sanitize($_POST['child']):$product['categories']);
$title = ((isset($_POST['title']) && $_POST['title'] = '')?sanitize($_POST['title']):$product['title']);
$price = ((isset($_POST['price']) && $_POST['price'] ='')?sanitize($_POST['price']):$product['price']);
$description = ((isset($_POST['description']) && $_POST['description'] ='')?sanitize($_POST['description']):$product['description']);
$parentSql = $conn->query("SELECT * FROM categories WHERE id ='$categories'");
$parentResult = mysqli_fetch_assoc($parentSql);
$parent = ((isset($_POST['parent']) && $_POST['parent'] ='')?sanitize($_POST['parent']):$parentResult['parent']);
$nutrition = ((isset($_POST['sizes']) && $_POST['sizes'] = '')?sanitize($_POST['sizes']):$product['nutrition']);
$nutrition = rtrim($nutrition,',');
$saved_image = (($product['image'] != '')?$product['image']: '');
$file_name = $saved_image;

}
if (!empty($nutrition)) {
$sizeString = sanitize($nutrition);
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
if($_POST){
$errors = array();
if(!empty($_FILES['photo'])){
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
if (empty($_POST['title']) || empty($price) || empty($categories) || empty($nutrition) || empty($description) || empty($file_name) && empty($sizeString)) {
$error = "All fields with Astrisk are required";
}else {

move_uploaded_file($file_tmp,"../images/".$file_name);
$insertSql = "INSERT INTO products(title, price, image, categories, description, nutrition)
        VALUES('$title', '$price', '$file_name', '$categories',  '$description', '$nutrition')";
if (isset($_GET['edit'])) {
$insertSql = "UPDATE products SET `title` = '$title', `price` ='$price', `image` = '$file_name', `categories` = '$categories', `description`= '$description', `nutrition` ='$nutrition'
        WHERE id ='$edit_id'";
}
          $resultSql = $conn->query($insertSql);
          header("Location:products.php");
 }
}
 ?>

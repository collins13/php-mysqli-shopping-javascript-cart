<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/chef/connect/connect.php';
$parentID = (int)$_POST['parentID'];
$selected = $_POST['selected'];
$childQuery = $conn->query("SELECT * FROM categories WHERE parent ='$parentID' ORDER BY name");
ob_start(); ?>

<option value=""></option>
<?php while($child = mysqli_fetch_assoc($childQuery)) : ?>
<option value="<?=$child['id']; ?>"<?=(($selected == $child['id'])?' selected':'');?>><?=$child['name']; ?></option>
<?php endwhile; ?>

<?php echo ob_get_clean(); ?>

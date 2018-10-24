<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/chef/connect/connect.php';
if (!is_logged_in()) {
header('Location:login.php');
}
?>
<?php
include 'includes/head.php';
$achieveSql = $conn->query("SELECT * FROM products WHERE deleted =1");

    if (isset($_GET['feature'])) {
    $id = (int)$_GET['id'];
    $feature = (int)$_GET['feature'];
    $fsql = "UPDATE products SET feature ='$feature' WHERE id ='$id'";
    $conn->query($fsql);
    header("Location:achieve.php");
    }

    if (isset($_GET['delete'])) {
           $delete_id = $_GET['delete'];
           $deleteQuery = $conn->query("DELETE FROM products WHERE deleted = 1 AND id ='$delete_id'");
           header('Location:achieve.php');
    }

    if (isset($_GET['refresh'])) {
      $refresh_id = $_GET['refresh'];
      $refreshQuery = $conn->query("UPDATE products SET deleted = 0 WHERE id ='$refresh_id'");
       header('Location:achieve.php');
    }

?>

<div class="container-fluid">
  <div class="row content">

    <?php include 'includes/sidebar.php'; ?>

    <div class="col-sm-10">
      <h2><Achieved Products</h2>
           <hr>
      <table class="table table-striped tabel-bordered">
        <tr>
          <th>Actions</th>
          <th>Title</th>
          <th>price</th>
          <th>category</th>
          <th>feature</th>
          <th>sold</th>
        </tr>
        <?php
        while($achieve = mysqli_fetch_assoc($achieveSql)) :
          $childID = $achieve['categories'];
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
              <a href="achieve.php?delete=<?= $achieve['id']; ?>"><i class="fa fa-1x fa-trash-o"></i></a>
              <a href="achieve.php?refresh=<?= $achieve['id']; ?>"><i class="fa fa-1x fa-refresh"></i></a>
            </td>
          <td><?=$achieve['title'];?></td>
          <td><?=$achieve['price']?></td>
          <td><?=$category?></td>
          <td>
            <a href="achieve.php?feature=<?=(($achieve['feature'] == 0)?'1':'0'); ?>&id=<?=$achieve['id'];?>" class="btn btn-xs btn-default">
                 <span class="fa fa-<?=(($achieve['feature'] == 0)?'plus':'minus'); ?>"></span></a>
                 &nbsp <?=(($achieve['feature'] == 1)?'featured product':'');?>
          </td>
          <td>sold</td>
        </tr>
      <?php endwhile; ?>

     </table>


    </div>
  </div>
</div>
<script type="text/javascript">
   $('#sidebar ul li').hover(function(){
       $(this).children('ul').stop(true, false, true).slidetoggle(400);
   });
</script>
</body>
</html>

<?php
error_reporting(0);
include 'connect/connect.php';
include 'core/init.php';
?>
<?php include 'includes/header.php'; ?>
<div class="container text-center">
  <!-- Heading Row -->
      <?php
      if (isset($_GET['cat'])) {
        $cat_id = $_GET['cat'];
      }
      else {
        $cat_id = '';
      }
      $sql = "SELECT * FROM products WHERE categories ='$cat_id'";
      $result = $conn->query($sql);
      $category = get_category($cat_id);
       ?>
       <div id="main-page">
      <div class="row">
  <h2 class="text-center"><?=$category['parent'].' '.$category['child'];?></h2><hr>
        <?php while($row = mysqli_fetch_assoc($result)) : ?>
        <div class="col-md-4 mb-4">
          <div id="size">
            <img src="images/<?=$row['image'];?>" alt="food" style="width:300px; heigth:100px; margin-bottom:5px;"
            class="pull-left img-responsive img-fluid rounded img-thumbnail"><br>
              <h3 class="text-left" style="color:black; font-weight:blod;"><?=$row['title'];?></h3>

        <div class="col-md-12">
          <p class="card-text" style="float:left;"><?= shortenText($row['description']);?></p>
        </div>
    <div class="row">
      <div class="col-md-6">
          <p class="h4" style="color:red; margin-left:1px;">Save Upto 5%</p>
      </div>
      <div class="col-md-6">
            <p class="card-text text-success h4" style="text-align:right;">$.<?=$row['price'];?></p>
      </div>
    </div>
   <div class="row">
    <div class="col-md-6">
     <div class="rate" style="float:left;  margin-left:1px;">
     <a href="#" style="color:orange;" class="fa fa-star fa-1x"></a>
     <a href="#" style="color:orange;" class="fa fa-star fa-1x"></a>
     <a href="#" style="color:orange;" class="fa fa-star fa-1x"></a>
     <a href="#" style="color:orange;" class="fa fa-star fa-1x"></a>
     <a href="#" style="color:orange;" class="fa fa-star fa-1x"></a>
   </div>
 </div>
      <div class="col-md-6">
            <div class="card-footer">
                <a href="details.php?details=<?=$row['id'];?>" class="btn btn-info btn-sm pull-right">more</a>
            </div>
              <br>
      </div>
    </div>
    </div>
    <hr>
      <br>
    </div>

      <?php endwhile; ?>


        <!-- /.col-md-4 -->
      </div>
      <br><br><br>
    </div>
      <hr>


</div>
<div id="comment-side">
  <h2>Drop A Comment Below</h2>
  <hr>
<form class="form-horizontal" role="form">
  <div class="form-group">
    <label for="Name" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="name" id="name" placeholder="User Name">
    </div>
  </div>
  <div class="form-group">
    <label for="Email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-4">
      <input type="email" class="form-control" name="email" id="email" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="Email" class="col-sm-2 control-label">Comment</label>
    <div class="col-sm-4">
    <textarea class="form-control" rows="3" name="message"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    <input type="submit" name="submit" value="Comment" class="btn btn-success">
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>

<?php
error_reporting(0);
include 'connect/connect.php';
include 'core/init.php';
?>
<?php  ?>
<?php include 'includes/header.php'; ?>
<div class="container text-center">
  <!-- Heading Row -->
      <div class="row">
        <div class="col-lg-8">
           <img src="images/c2035f1796818e245588c31c80bd2419 (1).jpg"  class="img-responsive img-fluid rounded img-thumbnail" style="height:500px; width:100%;">
        </div>
        <div class="col-lg-4">
          <div class="panel panel-default subscribe" style="background-color:LightBlue">
           <div class="card h-100 panel-body">
             <div class="card-body">
               <img src="images/test.png" alt="food" width="300" height="150" class="img-responsive img-thumbnail"><br><br>
               <p  style="text-align:center; font-size:30px;">SIGN UP</p><br>
               <p class="card-text" style="text-align:left;">Sign Up below to subscribe for our daily newsletter and our latest updates on food recipes</p>
             </div><br>
             <form>
               <div class="form-group">
                 <div class="col-sm-8">
                   <input type="email" name="email" placeholder="your email adress" class="form-control">
                 </div>
                 <input type="submit" name="submit" value="SUBSCRIBE" class="btn btn-success">
               </div>
             </form><br>
             <div class="card-footer">
               <a href="#" class="btn btn-primary">More Info</a>
             </div>
           </div>
         </div>
        </div>
        <!-- /.col-md-4 -->
      </div>
      <!-- /.row -->
      <?php
      $sql = "SELECT * FROM products WHERE feature = 0";
      $result = $conn->query($sql);
       ?>
       <div id="main-page">
      <div class="row">

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

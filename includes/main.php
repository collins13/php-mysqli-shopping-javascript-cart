<?php
include 'connect/connect.php';
include 'helpers/helpers.php';
$sql = "SELECT * FROM posts";
$result = $conn->query($sql);


 ?>

  <?php while($row = mysqli_fetch_assoc($result)) : ?>
<div class="row">
  <div class="col-md-4 mb-4">
   <div class="panel panel-default">
    <div class="card h-100 panel-body">
      <div class="card-body">
        <h2 class="card-title"><?=$row['p_title'];?></h2>
          <img src="images/<?=$row['p_image'];?>" alt="food" width="300" height="150" class="img-responsive"><br>
        <p class="card-text" style="text-align:left;"><?= shortenText($row['p_body']);?></p>
      </div>
      <div class="card-footer">
        <a href="details.php?id=<?=$row['id'];?>" class="btn btn-primary">Read more</a>
      </div>
    </div>
  </div>
</div>
  <!-- /.col-md-4 -->
</div>
  <!-- /.col-md-4 -->
<?php endwhile; ?>

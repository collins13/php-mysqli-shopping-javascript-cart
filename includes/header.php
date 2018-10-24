<?php require_once 'connect/connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>CHEF</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="main.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="jq/jquery-3.3.1 (1).js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet"  href="font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="navbar1">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">CHEF JUMA</a>
      </div>
      <?php
       $sql = "SELECT * FROM categories WHERE parent = 0";
       $result = $conn->query($sql);
       ?>
      <div class="collapse navbar-collapse" id="myNavbar">

        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php">Home</a></li>
      <?php
      while($row = mysqli_fetch_assoc($result)) :
        $parent_id = $row['id'];
        $sql2 = "SELECT * FROM categories WHERE parent ='$parent_id'";
        $result2 = $conn->query($sql2);
          ?>
          <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $row['name']; ?><span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <?php while($child = mysqli_fetch_assoc($result2)) : ?>
          <li><a href="category.php?cat=<?=$child['id'];?>"><?=$child['name'];?></a></li>
        <?php endwhile; ?>
        </ul>
      </li>
    <?php endwhile; ?>
        </ul>
        <form class="navbar-form navbar-right" role="search">
          <div class="form-group input-group">
            <input type="text" class="form-control" placeholder="Search..">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">
                <span class="glyphicon glyphicon-search"></span>
              </button>
            </span>
          </div>
        </form>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> My Account</a></li>
        </ul>
      </div>
    </div>
  </nav>



  <div class="jumbotron">
  <div class="container text-center">
    <h1>LIKE FOOD LOVE FOOD</h1>
  </div>
</div>

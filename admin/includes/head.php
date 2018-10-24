<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="../jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet"  href="../font-awesome-4.7.0/css/font-awesome.min.css">
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px;}

    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 800px;;
    }
    #error{
      color: red;
      font-weight: bold;
      margin-left: auto;
      margin-right: auto;
      margin-bottom: 20px;
      text-align: center;

    }

    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;}
    }
    #login-form{
      width: 50%;
      height: 60%;
      border: 2px solid black;
      border-radius: 15px;
      box-shadow: 7px, 7px, 15px rgba(0,0,0,0.6);
      margin: 8% auto;
      padding: 15px;
      background-color: #fff;
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-inverse navbar-fixed-top navbar-green bg-green" role="navigation" id="navbar1">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><i class="fa fa-trash-o">Logo</i></a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">

        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php">Home</a></li>
          <li class="dropdown">
        <a href="#">hello</a>
      </li>
        </ul>
        <form class="navbar-form navbar-right" role="search">
          <div class="form-group input-group">
            <input type="text" class="form-control" style="height:41px;" placeholder="Search..">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">
                <i class="fa fa-search fa-2x"></i>
              </button>
            </span>
          </div>
        </form>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class=" dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-1x"> Hello <?=$userData['first'];?></i>!
              <span class=" caret caret-lg"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="change_password.php">Change Password</a></li>
                <li><a href="logout.php">Logout</a></li>
              </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<br><br><br>

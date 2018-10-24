<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/chef/connect/connect.php';
if (!is_logged_in()) {
header('Location:login.php');
}
?>
<?php include 'includes/head.php'; ?>

<div class="container-fluid">
  <div class="row content">

    <?php include 'includes/sidebar.php'; ?>

    <div class="col-sm-10">



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

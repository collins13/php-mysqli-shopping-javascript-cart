<footer class="container-fluid text-center">
  <div class="row">
    <div class="col-sm-3">
      <p>Great Value</p>
      <p style="color:grey; text-align:left;">we offer best menus and recipes for all type of Food including breakfast, Lunch and Dinnar and special Recipes</p>
    </div>
    <div class="col-sm-3">
      <p>Help Center</p>
      <p style="color:grey; text-align:left;"><a href="#">Email: peterjuma@hotmail.com</a></p>
      <p style="color:grey; text-align:left;"><a href="#">Phone: +254705533211</a></p>
      <p style="color:grey; text-align:left;"><a href="#">Sms: 25478</a></p>
      <p style="color:grey; text-align:left;"><a href="#">Facebook: chef Juma</a></p>
    </div>
    <div class="col-sm-3">
      <p>Services</p>
      <p style="color:grey; text-align:left;"><a href="#">Menu Scripts</a></p>
      <p style="color:grey; text-align:left;"><a href="#">Special Classess</a></p>
      <p style="color:grey; text-align:left;"><a href="#">Cooking Tips</a></p>
      <p style="color:grey; text-align:left;"><a href="#">Management</a></p>
    </div>
    <div class="col-sm-3">
      <p>social media</p>
      <p><a href="#">Facebook</a></p>
      <p><a href="#">Twitter</a></p>
      <p><a href="#">Linkedin</a></p>
      <p><a href="#">Google+</a></p>
      <p><a href="#">Youtube</a></p>
    </div>
  </div>
  <hr>
  <h1>SOCIAL NETWORKS</h1>
  <ul class="nav navbar-nav">
    <li class="active"><i class="fa fa-4x fa-facebook"><a href="index.php"> Facebook </a></i></li>

    <li><i class="fa  fa-4x fa-twitter"><a href="#"> Twitter</a></i></li>
    <li><i class="fa fa-4x fa-github"><a href="contact.php"> Github </a></i></li>
      <li><i class="fa fa-4x fa-linkedin"><a href="contact.php"> LinkedIn </i></a></li>
      <li><i class="fa fa-4x fa-google+"><a href="contact.php"> Google+ </a></i></li>
  </ul>
</footer>


<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade details-1" id="details-1" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Peter Juma</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
        <div class="col-md-6">
          <div class="center-block">
                 <img src="images/alex 20161202_191549.jpg" class="details img-responsive img-circle" height="200" width="150" alt="Avatar">
          </div>
        </div>
        <div class="col-md-6">
          <h4 style="color:red;">Contact Info</h4>
          <pcontenteditable="true">Email: rashid collins@gmail.com</p>
          <pcontenteditable="true">Phone: +17587135203m</p>
          <pcontenteditable="true">TWitter: peter juma the chef</p>
          <pcontenteditable="true">facebook: Chef Juma</p>
        </div>
      </div>
    </div>
  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  function add_to_cart(){
    jQuery('#modal_errors').html("");
    var quantity = jQuery('#quantity').val();
    var error = '';
    var data = jQuery('#add_product_form').serialize();
   if (quantity == '') {
   error += '<p class="text-center text-danger">Please Choose Quantity u need</p>';
   jQuery('#modal_errors').html(error);
   return;
 }else {
   jQuery.ajax({
     url : '/chef/admin/pasers/add_cart.php',
     method : 'post',
     data : data,
     success : function(){
       location.reload();
     },
     error : function(){alert("something went wrong");}
   });
  }
 }
  </script>
</body>
</html>

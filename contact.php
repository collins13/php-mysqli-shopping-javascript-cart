<?php
 include 'includes/header.php';
 include 'includes/nav.php';
  ?>
<?php
  if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  if (empty($name) || empty($email) || empty($subject) || empty($textarea)) {
  $error = "All fields are required";
}else {

  $mailTo = "peterjuma@hotmail.com";
  $headers = "From:".$email;
  $text = "You have Received Email From".$name.".\n\n".$message;
  mail($mailTo, $subject, $text, $headers);
  header("Location:contact.php");
  $success = "Message Sent";
}
  }
 ?>
 <h2>Contact Us</h2>
 <hr>
  <form class="form-horizontal" role="form" action="contact.php" method="POST" id="contact-form">
      <?php if(isset($error)){echo'<div id="error">'.$error.'</div>';} ?>
        <?php if(isset($success)){echo'<div id="success">'.$success.'</div>';} ?>
    <div class="form-group">
      <label for="inputname3" class="col-sm-2 control-label">Name</label>
      <div class="col-sm-10">
        <input type="text" name="name" class="form-control" id="inputName" placeholder="Name">
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
      <div class="col-sm-10">
        <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email">
      </div>
    </div>
    <div class="form-group">
      <label for="inputSubject"  class="col-sm-2 control-label">Subject</label>
      <div class="col-sm-10">
        <input type="text" name="subject" class="form-control" id="inputSubject" placeholder="subject">
      </div>
    </div>
    <div class="form-group">
      <label for="inputMessage" class="col-sm-2 control-label">Message</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="message" rows="6"></textarea>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default" name="submit">Send</button>
      </div>
    </div>
  </form>

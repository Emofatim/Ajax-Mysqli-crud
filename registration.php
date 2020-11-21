<?php include_once("header.php"); ?>
<?php isset($_SESSION['email']) ? header('location:account.php') : '' ?>


<h3>Registration</h3>
<form method="POST" id="registration-form">
  <div class="form-group">
    <label for="InputName1">Name</label>
    <input type="name" class="form-control" id="InputName1" aria-describedby="NameHelp" placeholder="Enter Name" name="username">
  </div>
  <div class="form-group">
    <label for="InputEmail1">Email address</label>
    <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="InputPassword1">Password</label>
    <input type="password" class="form-control" id="InputPassword1" placeholder="Password" name="password">
  </div>
  <div class="form-group">
    <label for="InputConfirmPassword1">Confirm Password</label>
    <input type="password" class="form-control" id="InputConfirmPassword1" placeholder="Confirm Password" name="confirm-password">
  </div>
  <button type="submit" class="btn btn-primary submit-form">Submit</button>
</form>


<?php include_once("footer.php"); ?>

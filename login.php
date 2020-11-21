<?php include_once("header.php"); ?>
<?php isset($_SESSION['email']) ? header('location:account.php') : '' ?>

<?php
  if(isset($_POST['email']) && isset($_POST['password']))
  {
    $query = "select * from users where Email = '{$_POST['email']}' ";
    $result = mysqli_query($link, $query);
    if(mysqli_num_rows($result) > 0) 
    {
        $user = mysqli_fetch_assoc($result);
        if(password_verify($_POST['password'],$user['Password'])){
            $_SESSION['email'] = $user['Id'];
            header('location:account.php');

        }
        else{
            echo CREDENTIALS;
        }
    }
    else{
        echo ERROR;
    }
  }
?>

<h3>Login</h3>
<form method = "POST">
  <div class="form-group">
    <label for="InputEmail1">Email address</label>
    <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="InputPassword1">Password</label>
    <input type="password" class="form-control" id="InputPassword1" placeholder="Password" name="password">
  </div>
  <a href="registration.php" class="btn btn-link">Click Here for Registration</a>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


<?php include_once("footer.php"); ?>

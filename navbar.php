
<?php include_once("header.php"); ?>
<?php !isset($_SESSION['email']) ? header('location:login.php') : '' ?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Store</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="company.php">Company</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="category.php">Categories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="products.php">Products</a>
      </li>
    </ul>
  </div>
</nav>

<?php include_once("footer.php"); ?>


 
<?php require_once("navbar.php"); ?>

<?php

    $query = "select * from users where Id = '{$_SESSION['email']}' ";
    $result = mysqli_query($link, $query);
    echo '<pre>';
    var_dump(mysqli_fetch_assoc($result));die;
?>
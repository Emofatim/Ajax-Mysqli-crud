<?php
    
    require_once("constant.php");
    $link = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME);
        if (mysqli_connect_errno())
        {
            die(mysqli_connect_error());
        }


?>
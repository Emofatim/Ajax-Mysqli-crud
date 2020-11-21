<?php require_once("connection.php"); ?>

<?php
if(isset($_POST['username']))
{ 
    $query_email = "select * from users";
    $resultset = mysqli_query($link, $query_email);
    if(mysqli_num_rows($resultset) < 0) {
        if($_POST['password'] == $_POST['confirm-password'])
        {
            $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
            $query = "INSERT INTO users(`Name`, `Email`, `Password`) values('{$_POST['username']}', '{$_POST['email']}', 
            '{$password}')";
            $result = mysqli_query($link, $query);
            if($result)
            {
                echo json_encode(['status' => 'success','message' => REGISTERED]);
            }
        }
        else{
        echo json_encode(['status' => 'error','message' => PASSWORDERROR]);
        }
    }
    else{
        echo json_encode(['status' => 'error','message' => EMAIL]);
    }
}

?>
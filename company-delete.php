<?php require_once("navbar.php"); ?>

  <?php
    if(isset($_POST["action"]))  
    {   
         if($_POST["action"] == "Delete")  
         {  
              $procedure = "  
              CREATE PROCEDURE deleteUser(IN user_id int(11))  
              BEGIN   
              DELETE FROM company WHERE Id = user_id;  
              END;  
              ";  
              if(mysqli_query($link, "DROP PROCEDURE IF EXISTS deleteUser"))  
              {  
                   if(mysqli_query($link, $procedure))  
                   {  
                        $query = "CALL deleteUser('".$_POST["id"]."')";  
                        mysqli_query($link, $query);  
                        echo 'Data Deleted';  
                   }  
              }  
         }  
    } 

  ?>
  

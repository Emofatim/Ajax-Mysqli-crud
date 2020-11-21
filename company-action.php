<?php require_once("connection.php"); ?>

<?php

  if(isset($_POST["action"]))  
    {  
      $output = '';   
      if($_POST["action"] == "Add")  
      {   
        
        $Company_Name = mysqli_real_escape_string($link, $_POST["companyName"]);  
        $procedure = "  
          CREATE PROCEDURE insertUser(IN companyName varchar(250))  
          BEGIN  
          INSERT INTO company(Company_Name) VALUES (companyName);   
          END;  
        ";  
        if(mysqli_query($link, "DROP PROCEDURE IF EXISTS insertUser"))  
        {  
          if(mysqli_query($link, $procedure))  
          {  
            $query = "CALL insertUser('".$Company_Name."')";  
            mysqli_query($link, $query);  
            echo 'Data Inserted';  
          }  
        }  
      }
      
      if($_POST["action"] == "Edit")  
      {   
           $Company_Name = mysqli_real_escape_string($link, $_POST["companyName"]);  
           $procedure = "  
                CREATE PROCEDURE updateUser(IN user_id int(11), companyName varchar(250))  
                BEGIN   
                UPDATE company SET Company_Name = companyName  
                WHERE Id = user_id;  
                END;   
           ";  
           if(mysqli_query($link, "DROP PROCEDURE IF EXISTS updateUser"))  
           {  
                if(mysqli_query($link, $procedure))  
                {  
                     $query = "CALL updateUser('".$_POST["id"]."', '".$Company_Name."')";  
                     mysqli_query($link, $query);  
                     echo 'Data Updated';  
                }  
           }  
      }  
    }    

?>
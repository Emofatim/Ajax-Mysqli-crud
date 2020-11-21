<?php require_once("connection.php"); ?>

<?php

  if(isset($_POST["action"]))  
    {  
      $output = '';   
      if($_POST["action"] == "Add")  
      {   
        
        $Category_Name = mysqli_real_escape_string($link, $_POST["categoryName"]);
        $Company_Id = mysqli_real_escape_string($link, $_POST["companyName"]);  
        $procedure = "  
          CREATE PROCEDURE insertUser(IN categoryName varchar(250), companyName int(11) )  
          BEGIN  
          INSERT INTO categories(Category_Name, Company_Id) VALUES (categoryName, companyName);   
          END;  
        ";  
        if(mysqli_query($link, "DROP PROCEDURE IF EXISTS insertUser"))  
        {  
          if(mysqli_query($link, $procedure))  
          {  
            $query = "CALL insertUser('".$Category_Name."', '".$Company_Id."')";  
            mysqli_query($link, $query);  
            echo 'Data Inserted';  
          }  
        }  
      }
      
      if($_POST["action"] == "Edit")  
      {   
           $Category_Name = mysqli_real_escape_string($link, $_POST["categoryName"]);  
           $Company_Id = mysqli_real_escape_string($link, $_POST["companyName"]);  
           $procedure = "  
                CREATE PROCEDURE updateUser(IN user_id int(11), categoryName varchar(250), companyName int(11))  
                BEGIN   
                UPDATE categories SET Category_Name = categoryName , Company_Id = companyName
                WHERE Id = user_id;  
                END;   
           ";  
           if(mysqli_query($link, "DROP PROCEDURE IF EXISTS updateUser"))  
           {  
                if(mysqli_query($link, $procedure))  
                {  
                     $query = "CALL updateUser('".$_POST["id"]."', '".$Category_Name."', '".$Company_Id."')";  
                     mysqli_query($link, $query);  
                     echo 'Data Updated';  
                }  
           }  
      }  
    }    

?>
<?php require_once("connection.php"); ?>

<?php

  if(isset($_POST["action"]))  
    {  
      $output = '';   
      if($_POST["action"] == "Add")  
      {   
        
        $Model_Name = mysqli_real_escape_string($link, $_POST["productName"]);
        $Category_Id = mysqli_real_escape_string($link, $_POST["categoryName"]);  
        $Amount = mysqli_real_escape_string($link, $_POST["productPrice"]);  
        $procedure = "  
          CREATE PROCEDURE insertUser(IN productName varchar(250), categoryName int(11), productPrice varchar(100) )  
          BEGIN  
          INSERT INTO products(Model_Name, Category_Id, Amount) VALUES (productName, categoryName, productPrice);   
          END;  
        ";  
        if(mysqli_query($link, "DROP PROCEDURE IF EXISTS insertUser"))  
        {  
          if(mysqli_query($link, $procedure))  
          {  
            $query = "CALL insertUser('".$Model_Name."', '".$Category_Id."', '".$Amount."')";  
            mysqli_query($link, $query);  
            echo 'Data Inserted';  
          }  
        }  
      }
      
      if($_POST["action"] == "Edit")  
      {   
           $Model_Name = mysqli_real_escape_string($link, $_POST["productName"]);  
           $Category_Id = mysqli_real_escape_string($link, $_POST["categoryName"]);  
           $Amount = mysqli_real_escape_string($link, $_POST["productPrice"]);  
           $procedure = "  
                CREATE PROCEDURE updateUser(IN user_id int(11), productName varchar(250), categoryName int(11), productPrice varchar(100))  
                BEGIN   
                UPDATE products SET Model_Name = productName , Category_Id = categoryName, Amount = productPrice
                WHERE Id = user_id;  
                END;   
           ";  
           if(mysqli_query($link, "DROP PROCEDURE IF EXISTS updateUser"))  
           {  
                if(mysqli_query($link, $procedure))  
                {  
                     $query = "CALL updateUser('".$_POST["id"]."', '".$Model_Name."', '".$Category_Id."', '".$Amount."')";  
                     mysqli_query($link, $query);  
                     echo 'Data Updated';  
                }  
           }  
      }  
    }    

?>
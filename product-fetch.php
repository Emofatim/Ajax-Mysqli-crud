<?php require_once("connection.php"); ?>

<?php  

 if(isset($_POST["id"]))  
 {  
      $output = array();
      $procedure = "  
      CREATE PROCEDURE whereUser(IN user_id int(11))  
      BEGIN   
      SELECT products.Id, products.Model_Name, products.Amount, products.`Category_Id`, categories.`Category_Name` FROM products INNER JOIN
      categories on  products.`Category_Id` = categories.Id WHERE products.Id = user_id;  
      END;   
      ";  
      
      if(mysqli_query($link, "DROP PROCEDURE IF EXISTS whereUser"))  
      {  
           if(mysqli_query($link, $procedure))  
           {  
                $query = "CALL whereUser(".$_POST["id"].")";  
                $result = mysqli_query($link, $query);  
                while($row = mysqli_fetch_array($result))  
                {    
                     $output['ProductName'] = $row["Model_Name"];  
                     $output['CategoryName'] = $row["Category_Id"];
                     $output['ProductPrice'] = $row["Amount"];
                     
                }  
                echo json_encode($output);  
           }  
      }  
 }  
 ?>  
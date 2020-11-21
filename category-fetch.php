<?php require_once("connection.php"); ?>

<?php  

 if(isset($_POST["id"]))  
 {  
      $output = array();
      $procedure = "  
      CREATE PROCEDURE whereUser(IN user_id int(11))  
      BEGIN   
      SELECT categories.Id, categories.Category_Name, categories.`Company_Id`, company.`Company_Name` from categories INNER JOIN
      company on categories.`Company_Id` = company.Id WHERE categories.Id = user_id;  
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
                     $output['CategoryName'] = $row["Category_Name"];  
                     $output['CompanyName'] = $row["Company_Id"];
                }  
                echo json_encode($output);  
           }  
      }  
 }  
 ?>  
<?php require_once("connection.php"); ?>

<?php  

 if(isset($_POST["id"]))  
 {  
      $output = array();
      $procedure = "  
      CREATE PROCEDURE whereUser(IN user_id int(11))  
      BEGIN   
      SELECT * FROM company WHERE Id = user_id;  
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
                     $output['CompanyName'] = $row["Company_Name"];  
                }  
                echo json_encode($output);  
           }  
      }  
 }  
 ?>  
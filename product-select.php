<?php require_once("connection.php"); ?>

<?php  
 //select.php  
 $output = '';   
 if(isset($_POST["action"]))  
 {  
    $procedure = "  
    CREATE PROCEDURE selectUser()  
    BEGIN  
    SELECT products.Id, products.Model_Name, products.Amount, categories.`Category_Name` FROM products INNER JOIN
    categories on  products.`Category_Id` = categories.Id ;  
    END;  
    ";  
    if(mysqli_query($link, "DROP PROCEDURE IF EXISTS selectUser"))  
    {  
      if(mysqli_query($link, $procedure))  
      {  
        $query = "CALL selectUser()";  
        $result = mysqli_query($link, $query); 
        $output .= '
          <table class="table">
            <thead class="bg-light">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Product Name</th>
                <th scope="col">Category Name</th>
                <th scope="col">Product Price</th>
                <th scope="col">Delete</th>
                <th scope="col">Edit</th>
              </tr>
            </thead>
            <tbody>
          ';
          if(mysqli_num_rows($result) > 0)  
          {  
            while($product = mysqli_fetch_array($result))  
            {  
              $output .= '  
                <tr>
                  <td>'.$product['Id'].'</td>
                  <td>'.$product['Model_Name'].'</td>
                  <td>'.$product['Category_Name'].'</td>
                  <td>'.$product['Amount'].'</td>
                  <td>  
                    <button class="btn btn-primary delete" id='.$product['Id'].'>delete</button>
                  </td> 
                  <td>
                    <button class="btn btn-primary update" id='.$product['Id'].'>Edit</button>
                  </td>
                </tr> 
              ';  
            }  
          }  
          else{  
            $output .= '  
              <tr>  
                <td colspan="4">Data not Found</td>  
              </tr>  
            ';  
          }   
          $output .= '
          </tbody>
          </table>
          ';
          echo $output;
      }  
    }  
 }  
 ?>  
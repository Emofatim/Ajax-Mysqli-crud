<?php require_once("connection.php"); ?>

<?php  
 //select.php  
 $output = '';   
 if(isset($_POST["action"]))  
 {  
    $procedure = "  
    CREATE PROCEDURE selectUser()  
    BEGIN  
    SELECT categories.Id, categories.Category_Name, company.`Company_Name` from categories INNER JOIN
    company on categories.`Company_Id` = company.Id ;  
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
                <th scope="col">Category Name</th>
                <th scope="col">Company Name</th>
                <th scope="col">Delete</th>
                <th scope="col">Edit</th>
              </tr>
            </thead>
            <tbody>
          ';
          if(mysqli_num_rows($result) > 0)  
          {  
            while($category = mysqli_fetch_array($result))  
            {  
              $output .= '  
                <tr>
                  <td>'.$category['Id'].'</td>
                  <td>'.$category['Category_Name'].'</td>
                  <td>'.$category['Company_Name'].'</td>
                  <td>  
                    <button class="btn btn-primary delete" id='.$category['Id'].'>delete</button>
                  </td> 
                  <td>
                    <button class="btn btn-primary update" id='.$category['Id'].'>Edit</button>
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
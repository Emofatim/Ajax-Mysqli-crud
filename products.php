<?php require_once("navbar.php"); ?>


<?php
  $cat_query = "select categories.Id, categories.Category_Name, company.`Company_Name` from categories inner join
  company on  categories.`Company_Id` = company.Id";
  $cat_result = mysqli_query($link, $cat_query);
  $category = mysqli_fetch_all($cat_result,1);   
?>

<?php 
  if(isset($_POST['order_by'])){
    $append_query = " order by {$_POST['order_by']} {$_POST['order_with']}";
  }

  if(isset($_POST['Search'])){
    if(!empty((trim($_POST['Search'])))){
      $query = "select products.Id, products.Model_Name, products.Amount, categories.`Category_Name` from products inner join
      categories on  products.`Category_Id` = categories.Id where products.Model_Name like \"%{$_POST['Search']}%\" or
      products.Amount like \"%{$_POST['Search']}%\" or categories.`Category_Name` like \"%{$_POST['Search']}%\" ";
    }
    else{
      $query = "select products.Id, products.Model_Name, products.Amount, categories.`Category_Name` from products inner join
      categories on  products.`Category_Id` = categories.Id";
    }
  }
  else{
    $query = "select products.Id, products.Model_Name, products.Amount, categories.`Category_Name` from products inner join
    categories on  products.`Category_Id` = categories.Id";
  }

  if(isset($append_query)){
    $query .= $append_query;
  }
  

  $resultset = mysqli_query($link, $query);
  if(mysqli_error($link))
  {
      die(mysqli_error($link));
  }
?> 



  <div class="container-fluid">
    <div class="row" >
      <div class="col-lg-6">
        <form method="POST" >
          <div class="form-group" >
            <label>Product Name</label>
            <input name="ProductName" id="ProductName" class="form-control" Placeholder="Enter Product Name" >
          </div>
          <div class="form-group" >
            <label>Category Name</label>
            <select name="select" class="form-control" id="CategoryName" >
              <option value="">Select Category</option>
              <?php foreach($category as $categories){ ?>
                  <option value="<?php echo $categories['Id'] ?>" ><?php echo $categories['Category_Name'];
                  echo " - "; echo $categories['Company_Name']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group" >
            <label>Product Price</label>
            <input name="ProductPrice" id="ProductPrice" class="form-control" Placeholder="Enter Product Price" >
          </div>
          <div class="form-group" >
            <input type="hidden" name="id" id="user_id" >
            <button type="button" name="action" id="action" class="btn btn-default">Add</button>
          </div>
        </form>
      </div>
    </div>
    <div class="row" >
      <div class="col-lg-6">
        <form method="POST" >
          <div class="form-group" >
            <label>Sort by</label>
            <select name="order_by" class="form-control">
              <option value="Model_Name">By Name</option>
              <option value="Category_Name">By Category</option>
              <option value="Amount">By Price</option>
            </select>
            <select name="order_with" class="form-control">
              <option value="asc">Ascending</option>
              <option value="desc">Descending</option>
            </select>
          </div>
          <div class="form-group" >
            <input type="submit" name="sort" value="Sort" class="btn btn-defalt" >
          </div>
        </form>
      </div>
    </div>
    <table class="table">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
          <form class="form-inline my-2 my-lg-0" method="POST">
            <input class="form-control mr-sm-2" name="Search" placeholder="Search......." aria-label="Search">
            <input class="btn btn-danger" type="submit" name="search" value="Search">
          </form>
        </div>
      </nav>
    </table>  
    <div id="result" class="table-responsive">  
    </div>
  </div>

  <script >

$(document).ready(function(){  
      fetchUser();  
      function fetchUser()  
      {  
        var action = "select";  
        $.ajax({  
          url : "product-select.php",  
          method:"POST",  
          data:{action:action},  
          success:function(data){   
            $('#ProductName').val(''); 
            $('#CategoryName').val(''); 
            $('#ProductPrice').val(''); 
            $('#action').text("Add");  
            $('#result').html(data);  
          }  
        });  
      }  
      //add
      $('#action').click(function(){  
           var productName = $('#ProductName').val(); 
           var categoryName = $('#CategoryName').val(); 
           var productPrice = $('#ProductPrice').val(); 
           var id = $('#user_id').val();  
           var action = $('#action').text();  
           if(productName != '' && categoryName != '' && productPrice != '')  
           {  
                $.ajax({  
                     url : "product-action.php",  
                     method:"POST",  
                     data:{productName:productName, categoryName:categoryName, productPrice:productPrice, id:id, action:action},  
                     success:function(data){   
                          alert(data);  
                          fetchUser();  
                     }  
                });  
           }  
           else  
           {  
                alert("*All Fields are Required");  
           }  
      });  
      //update
      $(document).on('click', '.update', function(){  
           var id = $(this).attr("id");  
           $.ajax({  
                url:"product-fetch.php",  
                method:"POST",  
                data:{id:id},  
                dataType:"json",  
                success:function(data){  
                     $('#action').text("Edit");  
                     $('#user_id').val(id);    
                     $('#ProductName').val(data.ProductName);  
                     $('#CategoryName').val(data.CategoryName);  
                     $('#ProductPrice').val(data.ProductPrice);  
                }  
           })  
      });  
      //delete
      $(document).on('click', '.delete', function(){  
           var id = $(this).attr("id");  
           if(confirm("Are you sure you want to remove this data?"))  
           {  
                var action = "Delete";  
                $.ajax({  
                     url:"product-delete.php",  
                     method:"POST",  
                     data:{id:id, action:action},  
                     success:function(data)  
                     {  
                          fetchUser();   
                     }  
                })  
           }  
           else  
           {  
                return false;  
           }  
      });  
 });  
  </script>


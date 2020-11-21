<?php require_once("navbar.php"); ?>

<?php
  if(isset($_POST['order_by'])){
    $append_query = " order by {$_POST['order_by']} {$_POST['order_with']}";
  }

  if(isset($_POST['Search'])){
    if(!empty((trim($_POST['Search'])))){
      $query = "select * from company where company.Company_Name like \"%{$_POST['Search']}%\" ";
    }
    else{
      $query = "select * from company";
    }
  }
  else{
    $query = "select * from company";
  }

  if(isset($append_query)){
    $query .= $append_query;
  }
  else{
    $query = "select * from company";
  }
  
  $resultset = mysqli_query($link,$query);  
?>

<?php 
  
?>

  <div class="container-fluid">
    <div class="row" >
      <div class="col-lg-6">
        <form method="POST" >
          <div class="form-group" >
            <label>Company Name</label>
            <input name="CompanyName" id="CompanyName" class="form-control" Placeholder="Enter Company Name" >
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
              <option value="Company_Name">By Name</option>
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

  

  <script>
    
    $(document).ready(function(){  
      fetchUser();  
      function fetchUser()  
      {  
        var action = "select";  
        $.ajax({  
          url : "company-select.php",  
          method:"POST",  
          data:{action:action},  
          success:function(data){   
            $('#CompanyName').val('');  
            $('#action').text("Add");  
            $('#result').html(data);  
          }  
        });  
      }  
      //add
      $('#action').click(function(){  
           var companyName = $('#CompanyName').val();  
           var id = $('#user_id').val();  
           var action = $('#action').text();  
           if(companyName != '')  
           {  
                $.ajax({  
                     url : "company-action.php",  
                     method:"POST",  
                     data:{companyName:companyName, id:id, action:action},  
                     success:function(data){  
                          fetchUser();  
                     }  
                });  
           }  
           else  
           {  
                alert("*Field is Required");  
           }  
      });  
      //update
      $(document).on('click', '.update', function(){  
           var id = $(this).attr("id");  
           $.ajax({  
                url:"company-fetch.php",  
                method:"POST",  
                data:{id:id},  
                dataType:"json",  
                success:function(data){  
                     $('#action').text("Edit");  
                     $('#user_id').val(id);    
                     $('#CompanyName').val(data.CompanyName);  
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
                     url:"company-delete.php",  
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


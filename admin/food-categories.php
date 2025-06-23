<?php
include "connection.php";
include "header.php";



?>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            margin-left: 250px; /* Assuming left navbar is 250px wide */
            padding: 100px;
        }
        .form-box {
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: auto;
        }
        .category-table {
       margin-top: 50px; 
               }
    </style>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
  <div class="form-container">
    <div class="form-box">
        <h3 class="text-center mb-4">Add Food Category</h3>
        <form name="form1" action="" method="post">
            <div class="mb-3">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="food_category" required>
            </div>

      

            <div class="text-center">
                <button type="submit" name="submit" class="btn btn-primary">Add Category</button>
            </div>
               <div class="alert alert-success" id="success" role="alert" style="display:none">
                    Data Insert sucessfully!
                  </div>
          <div class="alert alert-danger" id="error" role="alert" style="display:none">
                    The Data Not Insert Data
                  </div>
        </form>
        
                 
    </div>

    <div class="category-table">
     <div class="row">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Category Name</th>
       <th scope="col">Edit</th>
          <th scope="col">Delete</th>
    
    </tr>
  </thead>
  <tbody>
   <?php
   $count=0;
   $res=mysqli_query($link,"select * from food_category");
   while($row=mysqli_fetch_array($res))
   {
    $count=$count+1;
    echo "<tr>";
    echo "<td>"; echo $count; echo "</td>";
      echo "<td>"; echo $row["food_category"]; echo "</td>";
        echo "<td>"; ?> <a href="edit_category.php?id=<?php echo $row["id"]; ?>" style="color: green;">Edit</a> <?php  echo "</td>";
          echo "<td>"; ?> <a href="delete_category.php?id=<?php echo $row["id"]; ?>" style="color: red;">Delete</a> <?php  echo "</td>";
       echo "</tr>";
   }

?>
  </tbody>
</table>
    </div>
    </div>
   
</div>





  <?php
  if(isset($_POST["submit"]))
  {
    $count=0;
    $res=mysqli_query($link,"select * from food_category where food_category='$_POST[food_category]'");
    $count=mysqli_num_rows($res);
    if($count>0){
        ?>
        <script type="text/javascript">
            document.getElementById("error").style.display="block";
              document.getElementById("success").style.display="none";
            </script>
            <?php
    }
    else
    { 
        mysqli_query($link,"insert into food_category values(NULL,'$_POST[food_category]')");

         ?>
        <script type="text/javascript">
                    document.getElementById("error").style.display="none";
              document.getElementById("success").style.display="block";

              setTimeout(function(){
                window.location.href=Window.location.href;
              },100);
            </script>
            <?php
    }
    
  }
  ?>
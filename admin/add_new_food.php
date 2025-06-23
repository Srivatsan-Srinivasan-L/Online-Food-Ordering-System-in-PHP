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
        <h3 class="text-center mb-4">Add New Food</h3>
           <div class="alert alert-success" id="success" role="alert" style="display:none">
                    Food Details Insert sucessfully!
                  </div>
          <div class="alert alert-danger" id="error" role="alert" style="display:none">
                    The Food Details Not Insert 
                  </div>
        <form name="form1" action="" method="post"  enctype="multipart/form-data">
            <div class="mb-3">
                <label for="category_name" class="form-label">Food Name</label>
                <input type="text" class="form-control" id="category_name" name="food_name" required>
            </div>
              <div class="mb-3">

                 <label for="category_name" class="form-label">Food Image</label>
          <input type="file" class="form-control" name="food_image" accept="image/*" required>
            </div>
              <div class="mb-3">
                <label for="category_name" class="form-label">Food Category</label>
                <select name="food_category" class="form-control">
                   
                    <?php
                    $res=mysqli_query($link,"select * from food_category order by food_category ASC"); 
                     
                     while($row=mysqli_fetch_array($res)) {
                          echo "<option>";
                          
                           echo $row["food_category"]; 
                            echo "</option>";  

                          }
                     ?>
                </select>
               
            </div>
              <div class="mb-3">
                <label for="category_name" class="form-label">Food Description</label>
                <textarea type="text" class="form-control" id="category_name" name="food_description" required></textarea>
            </div>
              <div class="mb-3">
                <label for="category_name" class="form-label">Food Actual Price</label>
                <input type="text" class="form-control" id="category_name" name="food_original_price" >
            </div>
              <div class="mb-3">
                <label for="category_name" class="form-label">Food Discount Price</label>
                <input type="text" class="form-control" id="category_name" name="food_discount_price" >
            </div>
              <div class="mb-3">
                <label for="category_name" class="form-label">Food Availability</label>
                <select name="food_availability" class="form-control">
                   <option>Yes</option>
                     <option>No</option>
                </select>
            </div>

                <div class="mb-3">
                <label for="category_name" class="form-label">Food Veg / Non-Veg</label>
                   <select name="food_veg_nonveg" class="form-control">
                   <option>Veg</option>
                     <option>Non Veg</option>
                </select>
            </div>
               <div class="form-group">
                <?php
                $res=mysqli_query($link,"select * from food_ingredients order by food_ingredients asc");
              while($row=mysqli_fetch_array($res))
              {
            ?>
            <div class="col-lg-4">
                <input type="checkbox" name="food_ingredients[]" value="<?php echo $row["food_ingredients"]?>">	&nbsp; <?php echo $row["food_ingredients"]?>

            </div>
             <?php
              }

?>

                        </div>

      

            <div class="mt-3 ">
                <button type="submit" name="submit" class="btn btn-primary col-12">Submit</button>
            </div>
            
        </form>
        
                 
    </div>

  
   
</div>





  <?php
  if(isset($_POST["submit"]))

  {
     $count=0;
     $ingredients="";
     foreach($_POST["food_ingredients"] as $check)
      {

        $count=$count+1;
        if($count==1)
          {
            $ingredients=$check;

         }
         else 
           {

            $ingredients=$ingredients.",".$check;
             }
            }
    $count=0;
    $res=mysqli_query($link,"select * from food where food_name='$_POST[food_name]'");
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
  $image_name = $_FILES['food_image']['name'];
$image_tmp = $_FILES['food_image']['tmp_name'];
$image_folder = "uploads/" . $image_name;

if (move_uploaded_file($image_tmp, $image_folder)) {
    // Insert with correct column names
    $query = "INSERT INTO food (food_name, food_category, food_description, food_original_price, food_discount_price, food_availability, food_veg_nonveg, food_ingredients, food_image)
              VALUES (
                '$_POST[food_name]',
                '$_POST[food_category]',
                '$_POST[food_description]',
                '$_POST[food_original_price]',
                '$_POST[food_discount_price]',
                '$_POST[food_availability]',
                '$_POST[food_veg_nonveg]',
                '$ingredients',
                '$image_name'
              )";
    
    mysqli_query($link, $query);
    ?>
    <script>
        document.getElementById("error").style.display = "none";
        document.getElementById("success").style.display = "block";
        setTimeout(() => {
            window.location.href = window.location.href;
        }, 100);
    </script>
    <?php
} else {
    echo "<script>alert('Image upload failed. Make sure uploads folder exists and is writable.');</script>";
}

    
  }
  ?>
<?php
include "connection.php";
include "header.php";

$id=$_GET["id"];
$food_name="";
$food_category="";
$food_description="";
$food_original_price="";
$food_discount_price="";
$food_availibility="";
$food_veg_nonveg="";
$food_ingredients="";
$food_image = "";
$res=mysqli_query($link,"select * from food where id=$id");
while($row=mysqli_fetch_array($res))
{

    $food_name=$row["food_name"];
     $food_category=$row["food_category"];
      $food_description=$row["food_description"];
       $food_original_price=$row["food_original_price"];
        $food_discount_price=$row["food_discount_price"];
         $food_availibility=$row["food_availability"];
          $food_veg_nonveg=$row["food_veg_nonveg"];
           $food_ingredients=$row["food_ingredients"];
              $food_image = $row["food_image"];


     }

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
        <h3 class="text-center mb-4">Edit Food</h3>
           <div class="alert alert-success" id="success" role="alert" style="display:none">
                    Food Details Update sucessfully!
                  </div>
          <div class="alert alert-danger" id="error" role="alert" style="display:none">
                    The Food Details Not Insert 
                  </div>
        <form name="form1" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="category_name" class="form-label">Food Name</label>
                <input type="text" class="form-control" id="category_name" name="food_name" value="<?php echo $food_name ?>" required>
            </div>

    <div class="mb-3">
        <label class="form-label">Food Image:</label><br>
        <img src="uploads/<?php echo $food_image; ?>" value="<?php echo $food_image ?>"   width="100" height="100" style="object-fit: cover; border-radius: 8px;">
    </div>
    <div class="mb-3">
    <label class="form-label">Change Image:</label>
    <input type="file" class="form-control" name="food_image">
</div>


              <div class="mb-3">
                <label for="category_name" class="form-label">Food Category</label>
                <select name="food_category" value="<?php echo $food_category ?>" class="form-control">
                   
                    <?php
                    $res=mysqli_query($link,"select * from food_category order by food_category ASC"); 
                     
                     while($row=mysqli_fetch_array($res)) {
                        
                          ?><option  <?php if($food_category==$row["food_category"]) {  echo  "selected"; } ?>> <?php
                           echo $row["food_category"]; 
                            echo "</option>";  

                         }
                     ?>
                </select>
               
            </div>
              <div class="mb-3">
                <label for="category_name" class="form-label">Food Description</label>
                <textarea type="text" class="form-control" id="category_name" name="food_description" required><?php echo $food_description ?> </textarea>
            </div>
              <div class="mb-3">
                <label for="category_name" class="form-label">Food Actual Price</label>
                <input type="text" class="form-control" id="category_name" name="food_original_price" value="<?php echo $food_original_price ?>" >
            </div>
              <div class="mb-3">
                <label for="category_name" class="form-label">Food Discount Price</label>
                <input type="text" class="form-control" id="category_name" name="food_discount_price" value="<?php echo $food_discount_price ?>" >
            </div>
              <div class="mb-3">
                <label for="category_name" class="form-label">Food Availability</label>
                <select name="food_availability" class="form-control">
                   <option <?php if($food_availibility=="yes")    { echo "selected";   } ?> >Yes</option>
                     <option <?php if($food_availibility=="no")    { echo "selected";   } ?> >No</option>
                </select>
            </div>

                <div class="mb-3">
                <label for="category_name" class="form-label">Food Veg / Non-Veg</label>
                   <select name="food_veg_nonveg"  value="<?php echo $food_veg_nonveg ?>" class="form-control">
                   <option <?php if($food_veg_nonveg=="veg")    { echo "selected";   } ?> >Veg</option>
                     <option <?php if($food_veg_nonveg=="nonveg")    { echo "selected";   } ?> >Non Veg</option>
                </select>
            </div>
               <div class="form-group">
                <?php
                $res=mysqli_query($link,"select * from food_ingredients order by food_ingredients asc");
              while($row=mysqli_fetch_array($res))
              {
                $mystring=$food_ingredients;
            ?>
            <div class="col-lg-4">
                <input type="checkbox" name="food_ingredients[]"  value="<?php echo $row["food_ingredients"]; ?>" <?php if(strpos($mystring,$row["food_ingredients"])!==false)  { echo "checked";   } ?> >	&nbsp; <?php echo $row["food_ingredients"]?>

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
    // Handle Image Upload
    $image_name = $food_image; // default is old image
    if (isset($_FILES["food_image"]) && $_FILES["food_image"]["error"] == 0) {
        $image_name = $_FILES["food_image"]["name"];
        $tmp_path = $_FILES["food_image"]["tmp_name"];
        $upload_path = "uploads/" . basename($image_name);
        move_uploaded_file($tmp_path, $upload_path);
    }

    // Update the record including image
    mysqli_query($link, "UPDATE food SET 
        food_name='$_POST[food_name]', 
        food_category='$_POST[food_category]', 
        food_description='$_POST[food_description]', 
        food_original_price='$_POST[food_original_price]', 
        food_discount_price='$_POST[food_discount_price]', 
        food_availability='$_POST[food_availability]', 
        food_veg_nonveg='$_POST[food_veg_nonveg]', 
        food_ingredients='$ingredients', 
        food_image='$image_name' 
        WHERE id=$id
    ") or die(mysqli_error($link));
?>
    <script type="text/javascript">
        document.getElementById("error").style.display = "none";
        document.getElementById("success").style.display = "block";
        setTimeout(function () {
            window.location.href = "dispaly_food.php";
        }, 1000);
    </script>
<?php
    }
    
  
  ?>
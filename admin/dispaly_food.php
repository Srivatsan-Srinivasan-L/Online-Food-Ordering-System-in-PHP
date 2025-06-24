<?php
include "connection.php";
include "header.php";
?>

<style>
  .main-content {
    margin-left: 250px; /* Sidebar width */
    padding: 30px;
  }

  .scroll-table-card {
    max-height: 400px; /* Set height limit */
    overflow-x: auto;
    overflow-y: auto;
  }

  table {
    min-width: 1000px; /* Avoid column squishing */
  }

  .food-thumb {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 6px;
  }
</style>

<div class="main-content">
  <div class="container-fluid">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h4 class="mb-10">Food Items List</h4>
      </div>
      <div class="card-body scroll-table-card p-0">
        <table class="table table-bordered table-hover text-center m-0">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Image</th>
              <th>Category</th>
              <th>Description</th>
              <th>Original Price</th>
              <th>Discount</th>
              <th>Availability</th>
              <th>Veg/Non-Veg</th>
              <th>Ingredients</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $count = 0;
            $res = mysqli_query($link, "SELECT * FROM food");
            while ($row = mysqli_fetch_array($res)) {
              $count++;
            ?>
              <tr>
                <td><?= $count ?></td>
                <td><?= $row["food_name"] ?></td>
                <td>
                  <?php if (!empty($row["food_image"]) && file_exists("uploads/" . $row["food_image"])) { ?>
                    <img src="uploads/<?= $row["food_image"] ?>" alt="Food" class="food-thumb">
                  <?php } else { ?>
                    <span>No image</span>
                  <?php } ?>
                </td>
                <td><?= $row["food_category"] ?></td>
                <td><?= $row["food_description"] ?></td>
                <td><?= $row["food_original_price"] ?></td>
                <td><?= $row["food_discount_price"] ?></td>
                <td><?= $row["food_availability"] ?></td>
                <td><?= $row["food_veg_nonveg"] ?></td>
                <td><?= $row["food_ingredients"] ?></td>
                <td>
                  <a href="edit_food.php?id=<?= $row["id"]; ?>" class="btn btn-sm btn-success">Edit</a>
                </td>
                <td>
                  <a href="delete_food.php?id=<?= $row["id"]; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div> <!-- card-body -->
    </div> <!-- card -->
  </div> <!-- container-fluid -->
</div> <!-- main-content -->

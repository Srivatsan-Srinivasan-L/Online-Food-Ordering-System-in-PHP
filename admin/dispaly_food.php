<?php
include "connection.php";
include "header.php";
?>

<style>
    /* Ensure body doesn't scroll horizontally */
    body {
        overflow-x: hidden;
    }

    /* Container respects fixed sidebar */
    .main-content {
         margin-top: 50px;
        margin-left: 350px; /* width of sidebar */
        padding: 20px;
    }

    /* Optional: Limit max table width and allow scroll */
    .table-wrapper {
        overflow-x: auto;
        width: 100%;
    }

    /* Optional: fix table min-width to prevent column squeeze */
    .table-fixed {
        min-width: 1200px;
    }
</style>

<div class="main-content">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Food Items List</h4>
        </div>
        <div class="card-body">
            <div class="table-wrapper">
                <table class="table table-bordered table-hover text-center table-fixed">
                    <thead class="table-dark">
                        <tr>
                            <th>S.No</th>
                            <th>Food Name</th>
                             <th>Food Image</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Original Price</th>
                            <th>Discount Price</th>
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
        <img src="uploads/<?= $row["food_image"] ?>" alt="Food Image" width="70" height="70" style="object-fit: cover; border-radius: 6px;">
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
                                    <a href="delete_food.php?id=<?= $row["id"]; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div> <!-- table-wrapper -->
        </div> <!-- card-body -->
    </div> <!-- card -->
</div> <!-- main-content -->

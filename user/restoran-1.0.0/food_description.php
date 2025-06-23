<?php
session_start();
include "../../admin/connection.php";

$id = $_GET["id"];
$food = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM food WHERE id=$id"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Food Detail</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
  <div class="row g-4 align-items-center">
    <div class="col-md-5 text-center">
      <img src="../../admin/uploads/<?= $food['food_image']; ?>" alt="Food Image" class="img-fluid rounded" style="width: 300px; height: 300px;">
    </div>
    <div class="col-md-7">
      <h2><?= $food['food_name']; ?></h2>
      <p><?= $food['food_description']; ?></p>
      <h5>Ingredients: <?= $food['food_ingredients']; ?></h5>
      <h4 class="text-success">₹<?= $food['food_discount_price']; ?></h4>

      <form method="post" action="cart.php">
        <input type="hidden" name="food_id" value="<?= $food['id']; ?>">
        <input type="hidden" name="name" value="<?= $food['food_name']; ?>">
        <input type="hidden" name="price" value="<?= $food['food_discount_price']; ?>">
        <input type="hidden" name="image" value="<?= $food['food_image']; ?>">

        <label>Quantity:</label>
        
        <input type="number" name="qty" value="1" min="1" class="form-control w-25 mb-3">

        <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
      </form>
    </div>
  </div>
</div>

</body>
</html>

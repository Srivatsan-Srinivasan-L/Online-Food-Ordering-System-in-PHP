
<?php
session_start();

// --- Add to Cart ---
if (isset($_POST['add_to_cart'])) {
    $id = $_POST['food_id'];
    $name = $_POST['name'];
    $price = (float) $_POST['price'];
    $qty = (int) $_POST['qty'];
    $image = $_POST['image'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty'] += $qty;
    } else {
        $_SESSION['cart'][$id] = [
            'name' => $name,
            'price' => $price,
            'qty' => $qty,
            'image' => $image
        ];
    }
    header("Location: cart.php");
    exit;
}

// --- Remove Item ---
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    unset($_SESSION['cart'][$remove_id]);
    header("Location: cart.php");
    exit;
}

// --- Decrease Quantity ---
if (isset($_GET['decrease'])) {
    $id = $_GET['decrease'];
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty']--;
        if ($_SESSION['cart'][$id]['qty'] <= 0) {
            unset($_SESSION['cart'][$id]);
        }
    }
    header("Location: cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .action-buttons a {
            margin: 0 3px;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <h2 class="mb-4">🛒 Your Cart</h2>

    <?php if (!empty($_SESSION['cart'])): ?>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
            <tr>
                <th>Image</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $grand_total = 0;
            foreach ($_SESSION['cart'] as $id => $item):
                $item_total = $item['price'] * $item['qty'];
                $grand_total += $item_total;
                ?>
                <tr>
                    <td><img src="../../admin/uploads/<?= $item['image'] ?>" width="80" class="rounded"></td>
                    <td><?= $item['name'] ?></td>
                    <td>₹<?= $item['price'] ?></td>
                    <td><?= $item['qty'] ?></td>
                    <td>₹<?= $item_total ?></td>
                    <td class="action-buttons">
                        <a href="?decrease=<?= $id ?>" class="btn btn-sm btn-warning">–</a>
                        <a href="?remove=<?= $id ?>" class="btn btn-sm btn-danger">Remove</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr class="table-info">
                <td colspan="4" class="text-end"><strong>Grand Total:</strong></td>
                <td colspan="2"><strong>₹<?= $grand_total ?></strong></td>
            </tr>
            </tbody>
        </table>

        <!-- Footer Buttons -->
   <div class="container my-5">
    <form action="" method="post">
    <div class="row justify-content-end"> <!-- push to right -->
        <div class="col-md-6 col-lg-5"> <!-- width adjusted -->

            <!-- Payment Section -->
            <h4 class="mb-3">Payment Method</h4>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="r1" value="cod" id="cod" checked>
                <label class="form-check-label" for="cod">Cash on Delivery</label>
            </div>
            <div class="form-check mt-2">
                <input class="form-check-input" type="radio" name="r1" value="paypal" id="paypal">
                <label class="form-check-label" for="paypal">PayPal</label>
            </div>

            <hr class="my-4">

            <!-- Grand Total -->
          <div class="d-flex justify-content-between mb-3">
    <h5 class="mb-0">Grand Total:</h5>
    <h5 class="mb-0 text-success">₹<?= $grand_total ?></h5>
</div>


          

         

        </div>
    </div>
</div>


           
        <div class="d-flex justify-content-between">
            <a href="index.php" class="btn btn-secondary">← Back to Menu</a>
            <button type="submit" name="continue2" class="btn btn-success">Proceed to Checkout →</button>
        </div>
    </form>

    <?php else: ?>
        <div class="alert alert-warning">Your cart is empty.</div>
        <a href="demo.php" class="btn btn-secondary">← Back to Menu</a>
    <?php endif; ?>
</div>
</body>
</html>



<?php
  if(isset($_POST["continue2"]))
  {
    $_SESSION["payment_type"]=$_POST["r1"];
    $_SESSION["cart_count"]=$count;
     $_SESSION["checkout"]="yes";
      $_SESSION["sub_total"]=$grand_total;
      ?>
      <script type="text/javascript">
    window.location="checkout.php";
        </script>
        <?php
  } 

    ?>

  
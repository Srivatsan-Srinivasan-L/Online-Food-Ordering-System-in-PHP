<?php
if (!isset($_SESSION)) {
    session_start();
}
include "connection.php";


$order_id = $_GET['id']; // Get the order ID from URL

// Fetch current order status
$current_status = "";
$res = mysqli_query($link, "SELECT order_status FROM order_main WHERE id = '$order_id'");
if ($row = mysqli_fetch_assoc($res)) {
    $current_status = $row['order_status'];
}

// Update status if form submitted
if (isset($_POST['update_status'])) {
    $new_status = $_POST['order_status'];
    mysqli_query($link, "UPDATE order_main SET order_status = '$new_status' WHERE id = '$order_id'");
    echo "<script>alert('Order status updated!'); window.location.href='all-userorder.php';</script>";
    exit;
}

$name = $email = $contact_no = $order_date = $order_type = $order_status = $order_number = $order_address = "";

$res = mysqli_query($link, "SELECT * FROM order_main WHERE id=$order_id");
if ($row = mysqli_fetch_assoc($res)) {
    $name = $row["user_name"];
    $email = $row["user_email"];
    $contact_no = $row["user_contact"];
    $order_date = $row["order_date"] . " " . $row["order_time"];
    $order_type = $row["order_type"];
    $order_status = $row["order_status"];
    $order_number = $row["order_number"];
    $order_address = $row["order_address"];
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Order Details</h2>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <h5>Customer Info</h5>
            <p><strong>Name:</strong> <?= $name ?></p>
            <p><strong>Contact No:</strong> <?= $contact_no ?></p>
            <p><strong>Email:</strong> <?= $email ?></p>
            <p><strong>Address:</strong> <?= $order_address ?></p>
        </div>
        <div class="col-md-6 text-md-end">
            <h5>Order Info</h5>
            <p><strong>Order Number:</strong> <?= $order_number ?></p>
            <p><strong>Date:</strong> <?= $order_date ?></p>
            <p><strong>Order Type:</strong> <?= ucfirst($order_type) ?></p>
            <p><strong>Status:</strong> <?= $order_status ?></p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Sr No</th>
                    <th>Image</th>
                    <th>Food Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Ingredients</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Veg/NonVeg</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $srno = 0;
                $tot = 0;
                $res = mysqli_query($link, "SELECT * FROM order_details WHERE order_id = '$order_id'");
                while ($row = mysqli_fetch_assoc($res)) {
                    $srno++;
                    $sub_total = $row["food_discount_price"] * $row["food_qty"];
                    $tot += $sub_total;
                    ?>
                    <tr>
                        <td><?= $srno ?></td>
                        <td><img src="./uploads/<?= $row["food_image"] ?>" width="100" class="img-thumbnail"></td>
                        <td><?= $row["food_name"] ?></td>
                        <td><?= $row["food_category"] ?></td>
                        <td><?= $row["food_description"] ?></td>
                        <td><?= $row["food_ingredents"] ?></td>
                        <td>₹<?= $row["food_discount_price"] ?></td>
                        <td><?= $row["food_qty"] ?></td>
                        <td><?= $row["food_veg_nonveg"] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

<div class="row my-4 align-items-start">
    <!-- Left: Order Status Form -->
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="order_status" class="form-label fw-semibold">Select Order Status:</label>
                        <select name="order_status" id="order_status" class="form-select">
                            <option value="Active" <?= ($current_status == 'Active') ? 'selected' : '' ?>>Active</option>
                            <option value="In Process" <?= ($current_status == 'In Process') ? 'selected' : '' ?>>In Process</option>
                            <option value="Completed" <?= ($current_status == 'Completed') ? 'selected' : '' ?>>Completed</option>
                        </select>
                    </div>
                    <div class="d-grid">
                        <button type="submit" name="update_status" class="btn btn-primary">
                            ✅ Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Right: Total Amount Display -->
    <div class="col-sm-6">
        <div class="card shadow-sm border-0 bg-success text-white">
            <div class="card-body text-end">
                <h5 class="fw-bold mb-0">Total Amount: ₹<?= $tot ?></h5>
            </div>
        </div>
    </div>
</div>


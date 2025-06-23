<?php
if (!isset($_SESSION)) {
    session_start();
}
include "../../admin/connection.php";

$id = $_GET["id"];

$name = $email = $contact_no = $order_date = $order_type = $order_status = $order_number = $order_address = "";

$res = mysqli_query($link, "SELECT * FROM order_main WHERE id=$id");
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
                $res = mysqli_query($link, "SELECT * FROM order_details WHERE order_id = '$id'");
                while ($row = mysqli_fetch_assoc($res)) {
                    $srno++;
                    $sub_total = $row["food_discount_price"] * $row["food_qty"];
                    $tot += $sub_total;
                    ?>
                    <tr>
                        <td><?= $srno ?></td>
                        <td><img src="../../admin/uploads/<?= $row["food_image"] ?>" width="100" class="img-thumbnail"></td>
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

    <div class="text-end mt-3">
        <h5 class="fw-bold">Total Amount: ₹<?= $tot ?></h5>
    </div>
    <a href="generate_order_pdf.php?id=<?= $id ?>" class="btn btn-danger" target="_blank">Download Invoice PDF</a>

</div>

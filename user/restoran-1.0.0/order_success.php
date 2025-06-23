<?php
session_start();
include "../../admin/connection.php";

// Validate session
if (!isset($_SESSION["checkout"]) || !isset($_SESSION["cart"]) || count($_SESSION["cart"]) == 0 || !isset($_SESSION["user_username"])) {
    echo "<script>window.location='index.php';</script>";
    exit;
}

// Fetch user data
$user = $_SESSION["user_username"];
$res = mysqli_query($link, "SELECT * FROM user_register WHERE name='$user'");
$row = mysqli_fetch_assoc($res);
$name = $row["name"];
$email = $row["email"];
$contact_no = $row["contact_no"];

// Generate order details
$order_number = strtoupper(uniqid("ORD"));
$order_date = date("Y-m-d");
$order_time = date("H:i:s");
$order_status = "Order Taken";
$order_type = $_SESSION['payment_type'] ?? 'cod';
$order_address = "Your Address Placeholder"; // Update if you have dynamic address

// Insert into order_main
mysqli_query($link, "INSERT INTO order_main (
    order_number, order_username, order_date, order_time, order_status,
    order_address, user_name, user_email, user_contact, order_type
) VALUES (
    '$order_number', '$user', '$order_date', '$order_time', '$order_status',
    '$order_address', '$name', '$email', '$contact_no', '$order_type'
)");

$order_main_id = mysqli_insert_id($link);

// Insert into order_details
foreach ($_SESSION["cart"] as $food_id => $item) {
    $qty = $item['qty'];

    // Get food details
    $res2 = mysqli_query($link, "SELECT * FROM food WHERE id='$food_id'");
    if ($food = mysqli_fetch_assoc($res2)) {
        $food_name = mysqli_real_escape_string($link, $food["food_name"]);
        $food_category = mysqli_real_escape_string($link, $food["food_category"]);
        $food_description = mysqli_real_escape_string($link, $food["food_description"]);
        $food_ingredients = mysqli_real_escape_string($link, $food["food_ingredients"]);
        $food_original_price = $food["food_original_price"];
        $food_discount_price = $food["food_discount_price"];
        $food_veg_nonveg = $food["food_veg_nonveg"];
        $food_image = $food["food_image"];

        // Insert into order_details
        mysqli_query($link, "INSERT INTO order_details (
            order_id, food_name, food_category, food_description,
            food_ingredents, food_orginal_price, food_discount_price,
            food_veg_nonveg, food_image, food_qty
        ) VALUES (
            '$order_main_id', '$food_name', '$food_category', '$food_description',
            '$food_ingredients', '$food_original_price', '$food_discount_price',
            '$food_veg_nonveg', '$food_image', '$qty'
        )");
    }
}

// Clear cart/session
unset($_SESSION["checkout"]);
unset($_SESSION["cart"]);
unset($_SESSION["payment_type"]);
unset($_SESSION["orderno"]);

$_SESSION["order_complete_msg"] = "yes";
$_SESSION["final_order_number"] = $order_number;

// Redirect
echo "<script>window.location='order_complete.php';</script>";
exit;
?>

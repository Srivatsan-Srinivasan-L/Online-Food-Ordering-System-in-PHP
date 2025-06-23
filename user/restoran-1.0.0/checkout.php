<?php
session_start();
include "../../admin/connection.php";

// 1. If cart is empty, redirect to demo page
if (!isset($_SESSION["cart"]) || count($_SESSION["cart"]) == 0) {
    header("Location: demo.php");
    exit();
}

// 2. Store that checkout is initiated
$_SESSION["checkout"] = "yes";
$_SESSION["cart_item"] = "yes";

// 3. If not logged in, store redirect and go to login
if (!isset($_SESSION["user_username"])) {
    $_SESSION["redirect_after_login"] = "address_verify.php";
    header("Location: login.php");
    exit();
}

// 4. If logged in, go to payment page
header("Location: address_verify.php");
exit();
?>

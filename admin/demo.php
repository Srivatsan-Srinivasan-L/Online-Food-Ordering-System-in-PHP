<?php
include "connection.php";
include "header.php";

// Count total food
$res_food = mysqli_query($link, "SELECT COUNT(*) as total FROM food");
$row_food = mysqli_fetch_assoc($res_food);
$total_food = $row_food['total'];

// Count total users
$res_users = mysqli_query($link, "SELECT COUNT(*) as total FROM user_register");
$row_users = mysqli_fetch_assoc($res_users);
$total_users = $row_users['total'];

// Count total orders
$res_orders = mysqli_query($link, "SELECT COUNT(*) as total FROM order_main");
$row_orders = mysqli_fetch_assoc($res_orders);
$total_orders = $row_orders['total'];

$res_category = mysqli_query($link, "SELECT COUNT(*) as total FROM food_category");
$row_category = mysqli_fetch_assoc($res_category);
$total_category = $row_category['total'];
?>


<!-- Main Dashboard Container -->
<div class="container-fluid" style="padding: 80px;"> <!-- Adjust margin if sidebar is 250px -->
    <div class="text-center mb-4">
        <h3 class="fw-bold">🍴 Food Order System - Admin Dashboard</h3>
    </div>

    <div class="row justify-content-center g-4">
        <!-- Total Food -->
        <div class="col-sm-6 col-md-4 col-lg-2">
            <div class="card shadow-sm border-0 bg-primary text-white">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">  🍽️ Total Foods</h5>
                    <h3><?= $total_food ?></h3>
                </div>
            </div>
        </div>


        
           <div class="col-sm-6 col-md-4 col-lg-2">
            <div class="card shadow-sm border-0 bg-warning text-dark">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Total Food Category</h5>
                    <h3><?= $total_category ?></h3>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="col-sm-6 col-md-4 col-lg-2">
            <div class="card shadow-sm border-0 bg-success text-white">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">👤 Total Users</h5>
                    <h3><?= $total_users ?></h3>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="col-sm-6 col-md-4 col-lg-2">
            <div class="card shadow-sm border-0 bg-warning text-dark">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">🛒 Total Orders</h5>
                    <h3><?= $total_orders ?></h3>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
session_start();
if (!isset($_SESSION["order_complete_msg"])) {
    echo "<script>window.location='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Complete</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-center d-flex flex-column justify-content-center align-items-center" style="height:100vh">
    <div class="p-5 bg-white rounded shadow">
        <img src="./img/images.png" width="100" alt="Success">
        <h2 class="text-success mt-3">Your Order Has Been Placed!</h2>
        <p class="lead">Order Number: <strong><?= $_SESSION["final_order_number"] ?? '' ?></strong></p>
        <a href="demo.php" class="btn btn-primary mt-3">Back to Home</a>
    </div>
</body>
</html>

<?php
unset($_SESSION["order_complete_msg"]);
unset($_SESSION["final_order_number"]);
?>

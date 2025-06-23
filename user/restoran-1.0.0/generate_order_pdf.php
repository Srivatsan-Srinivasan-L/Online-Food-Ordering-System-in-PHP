<?php
require_once '../../vendor/autoload.php';

use Dompdf\Dompdf;

// Start session and DB
session_start();
include "../../admin/connection.php";

$id = $_GET['id'];
$res = mysqli_query($link, "SELECT * FROM order_main WHERE id='$id'");
$row = mysqli_fetch_assoc($res);

$name = $row['user_name'];
$email = $row['user_email'];
$contact = $row['user_contact'];
$order_number = $row['order_number'];
$order_date = $row['order_date'] . ' ' . $row['order_time'];
$order_address = $row['order_address'];
$order_type = strtoupper($row['order_type']);
$order_status = $row['order_status'];

$logoPath = $_SERVER['DOCUMENT_ROOT'] . "/Food-Ordering-System/user/restoran-1.0.0/img/sree hotel.jpg";
$logoPath = str_replace('\\', '/', $logoPath); // Convert Windows \ to /
$logoUrl = 'file:///' . $logoPath;




// CSS + HTML Content
$html = "
<style>
    body { font-family: Arial, sans-serif; font-size: 12px; }
    .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; }
    h2, h4 { text-align: center; margin: 0; padding: 0; }
    .logo { text-align: center; margin-bottom: 10px; }
    .info { margin-bottom: 20px; }
    .info p { margin: 5px 0; }
    table { width: 100%; border-collapse: collapse; margin-top: 15px; }
    table, th, td { border: 1px solid #ddd; }
    th { background-color: #f8f9fa; text-align: center; }
    td { padding: 8px; text-align: center; }
    .text-left { text-align: left; }
    .footer { text-align: center; margin-top: 30px; font-style: italic; }
     @font-face {
        font-family: 'DejaVu Sans';
        font-style: normal;
        font-weight: normal;
        src: url('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/fonts/dejavu/DejaVuSans.ttf') format('truetype');
    }

    body {
        font-family: 'DejaVu Sans', sans-serif;
        font-size: 12px;
    }

</style>

 

  


<div class='invoice-box'>
    <div class='logo'>
        <img src='$logoUrl' height='50'>
    </div>
    <h2>Order Invoice</h2>
    <hr>
    <div class='info'>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Contact:</strong> $contact</p>
        <p><strong>Order No:</strong> $order_number</p>
        <p><strong>Order Date:</strong> $order_date</p>
        <p><strong>Address:</strong> $order_address</p>
        <p><strong>Payment Method:</strong> $order_type</p>
        <p><strong>Status:</strong> $order_status</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th class='text-left'>Food Name</th>
                <th>Category</th>
                <th>Qty</th>
                <th>Price (₹)</th>
                <th>Total (₹)</th>
            </tr>
        </thead>
        <tbody>";

$sr = 1;
$grand_total = 0;

$res2 = mysqli_query($link, "SELECT * FROM order_details WHERE order_id='$id'");
while ($food = mysqli_fetch_assoc($res2)) {
    $qty = $food['food_qty'];
    $price = $food['food_discount_price'];
    $total = $qty * $price;
    $grand_total += $total;

    $html .= "
        <tr>
            <td>{$sr}</td>
            <td class='text-left'>{$food['food_name']}</td>
            <td>{$food['food_category']}</td>
            <td>{$qty}</td>
            <td>₹{$price}</td>
            <td>{$total}</td>
        </tr>";
    $sr++;
}

$html .= "
        <tr>
            <td colspan='5' class='text-right'><strong>Grand Total</strong></td>
            <td><strong>₹{$grand_total}</strong></td>
        </tr>
        </tbody>
    </table>

    <div class='footer'>
        <p>Thank you for your order!<br>Visit again ❤️</p>
    </div>
</div>
";

// Generate PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("Order_Invoice_$order_number.pdf", ["Attachment" => false]); // true to force download
exit;

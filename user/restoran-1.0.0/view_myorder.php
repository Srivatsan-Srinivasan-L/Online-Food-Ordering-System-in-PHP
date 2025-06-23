<?php
if(!isset($_SESSION)){
    session_start();
}
?>

<?php
include "../../admin/connection.php";


?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<section class="products-section"> 

<div class="container my-5">
    <div class="text-center mb-4">
        <h2>My Order</h2>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Sr No.</th>
                    <th>Order Number</th>
                    <th>Order Date</th>
                    <th>Order Time</th>
                    <th>Order Address</th>
                    <th>Order Type</th>
                    <th>Order Status</th>
                    <th>Order Details</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP Loop: Insert dynamic order rows here -->
                 <?php
                 $srno=0;
                 $res=mysqli_query($link,"select * from order_main where order_username='$_SESSION[user_username]' order by id desc");
                  $srno=mysqli_num_rows($res);
                  while($row=mysqli_fetch_array($res)){
                    echo "<tr>";
                                        echo "<td>"; echo $srno; "</td>";

                    echo "<td>"; echo $row["order_number"]; "</td>";
                    echo "<td>"; echo $row["order_date"]; "</td>";

                    echo "<td>"; echo $row["order_time"]; "</td>";

                    echo "<td>"; echo $row["order_address"]; "</td>";

                    echo "<td>"; echo $row["order_type"]; "</td>";

                    echo "<td>"; echo $row["order_status"]; "</td>";

                    echo "<td>"; ?> <a href="order_details.php?id=<?php echo $row["id"]; ?>">Order Details</a> <?php echo "</td>";




                     echo "<tr>";
                      $srno= $srno-1;
                  }
                 ?>

            </tbody>
        </table>
    </div>
</div>

 
</section>

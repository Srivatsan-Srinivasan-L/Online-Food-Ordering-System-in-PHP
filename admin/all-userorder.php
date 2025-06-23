<?php
include "connection.php";
include "header.php";
?>

<style>
  .main-content {
    margin-left: 250px; /* Adjust this based on your sidebar width */
    padding: 60px;
  }

  .centered-table {
    max-width: 900px;
    margin: 0 auto; /* This centers the table */
  }
</style>


<div class="main-content">
  <div class="container my-5 centered-table">
    <div class="text-center mb-4">
        <h2>All User Order Detail</h2>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>Sr No.</th>
                    <th>Order Number</th>
                    <th>User Name</th>
                    <th>Order Date</th>
                    <th>Order Time</th>

                    <th>Order Status</th>
                    <th>Order Address</th>
                    <th>Order Type</th>
                     <th>Order Details</th>


                </tr>
            </thead>
            <tbody>
                <?php
                $srno = 1;
                $res = mysqli_query($link, "SELECT * FROM order_main");
                while ($row = mysqli_fetch_array($res)) {
                    echo "<tr>";
                    echo "<td>" . $srno . "</td>";
                    echo "<td>" . $row["order_number"] . "</td>";
                    echo "<td>" . $row["order_username"] . "</td>";
                    echo "<td>" . $row["order_date"] . "</td>";
                    echo "<td>" . $row["order_time"] . "</td>";
                      echo "<td>" . $row["order_status"] . "</td>";
                        echo "<td>" . $row["order_address"] . "</td>";
                          echo "<td>" . $row["order_type"] . "</td>";
                                              echo "<td>"; ?> <a href="order_userdetail.php?id=<?php echo $row["id"]; ?>">Order Details</a> <?php echo "</td>";

                    echo "</tr>";
                    $srno++;
                }
                ?>
            </tbody>
        </table>
    </div>
  </div>
</div>

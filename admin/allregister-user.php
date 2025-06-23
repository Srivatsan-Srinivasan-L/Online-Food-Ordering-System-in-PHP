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
        <h2>User Register Detail</h2>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>Sr No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Contact</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $srno = 1;
                $res = mysqli_query($link, "SELECT * FROM user_register");
                while ($row = mysqli_fetch_array($res)) {
                    echo "<tr>";
                    echo "<td>" . $srno . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";
                    echo "<td>" . $row["contact_no"] . "</td>";
                    echo "</tr>";
                    $srno++;
                }
                ?>
            </tbody>
        </table>
    </div>
  </div>
</div>

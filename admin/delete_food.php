<?php
include "connection.php";

$id=$_GET["id"];
mysqli_query($link,"delete from food where id=$id");



?>

<script type="text/javascript">
    window.location="dispaly_food.php";
    </script>

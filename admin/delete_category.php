<?php
include "connection.php";

$id=$_GET["id"];
mysqli_query($link,"delete from food_category where id=$id");



?>

<script type="text/javascript">
    window.location="food-categories.php";
    </script>

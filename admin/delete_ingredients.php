<?php
include "connection.php";

$id=$_GET["id"];
mysqli_query($link,"delete from food_ingredients where id=$id");



?>

<script type="text/javascript">
    window.location="food-ingredients.php";
    </script>

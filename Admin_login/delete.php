<?php
include('connection.php'); 

$id = $_POST['id'];
$query = "DELETE FROM category_info WHERE id=".$id;
$result =mysqli_query($con,$query);
echo 1;
?>

<?php
include('connection.php'); 

$id = $_POST['id'];
$query = "DELETE FROM Product_info WHERE Id=".$id;
$result =mysqli_query($con,$query);
echo 1;
?>

<?php
include('connection.php'); 

$id = $_POST['id'];
$query = "DELETE FROM slider WHERE id=".$id;
$result =mysqli_query($con,$query);
echo 1;
?>

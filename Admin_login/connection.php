<?php
$host = "localhost";
$user = "root";
$pass = "Admin@123";
$db_name = "demo_lifekart";

// Create connection
$con = new mysqli($host, $user, $pass);
$query = mysqli_select_db($con,$db_name);
$database = mysqli_query($con, $query);

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}
?>
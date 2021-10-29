<?php
include('connection.php'); 

if(!empty($_POST['Id'])){
     $da=date("Y/m/d");
     $ua=date("Y/m/d");

$query = "UPDATE customer_info SET FirstName='" . $_POST['FirstName'] . "', LastName='" . $_POST['LastName'] . "', Email='" . $_POST['Email'] . "', phone_number='" . $_POST['phone_number'] . "', Address='" . $_POST['Address'] . "', country='" . $_POST['country'] . "',create_at='$da',update_at='$ua' WHERE Id=".$_POST['Id'];
$result = mysqli_query($con, $query);
    echo 1;

}
  ?>
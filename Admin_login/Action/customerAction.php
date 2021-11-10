<?php
include('connection.php'); 

if(count([$_POST])>0){
$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];
$Email = $_POST['Email'];
$phone_number = $_POST['phone_number'];
$Address = $_POST['Address'];
$country = $_POST['country'];
$da=date("Y/m/d");
$ua=date("Y/m/d");

if(!empty($_POST)){
 $query = "INSERT INTO customer_info(FirstName,LastName,Email,phone_number,Address,country,create_at,update_at)
 VALUES ('$FirstName','$LastName','$Email','$phone_number','$Address','$country','$da','$ua')";
 $result = mysqli_query($con, $query); 
 echo 1;
}
}



if($_POST['action']=='customer_edit')
{ 
    $id = $_POST['id'];
    $query="SELECT * from customer_info WHERE Id =".$id;
    $result = mysqli_query($con,$query);
    $data = array();
    while ($cust = mysqli_fetch_assoc($result)) {
        $data[] = $cust;
    } 
    if($data) {
     echo json_encode($data);
    } 
}

if($_POST['action']=='customer_update')
{ 
if(!empty($_POST['Id'])){
    $da=date("Y/m/d");
    $ua=date("Y/m/d");

$query = "UPDATE customer_info SET FirstName='" . $_POST['FirstName'] . "', LastName='" . $_POST['LastName'] . "', Email='" . $_POST['Email'] . "', phone_number='" . $_POST['phone_number'] . "', Address='" . $_POST['Address'] . "', country='" . $_POST['country'] . "',create_at='$da',update_at='$ua' WHERE Id=".$_POST['Id'];
$result = mysqli_query($con, $query);
   echo 1;
}
}

if($_POST['action']=='customer_delete')
{ 
$id = $_POST['id'];
$query = "DELETE FROM customer_info WHERE Id=".$id;
$result =mysqli_query($con,$query);
echo 1;
}
?>
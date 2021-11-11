<?php
include 'connection.php';
if (isset($_POST['search'])) {

    $Name = $_POST['search'];

  $query="select id from Product_info where pname ='".$Name."'";
    $result=mysqli_query($con,$query); 
  
   while($row=mysqli_fetch_array($result)){
    $data1=$row[0];
   }

$query="select id from category_info where CName ='".$Name."'";

$result1=mysqli_query($con,$query); 
   while($row=mysqli_fetch_array($result1)){
    $data2=$row[0];
   }

    echo json_encode(array('pid'=>$data1,'cid'=>$data2));
   
}
?>

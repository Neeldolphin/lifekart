<?php
    include "connection.php"; 

    $id = $_POST['id'];
    $query="SELECT * from Product_info WHERE Id =".$id;
    $result = mysqli_query($con,$query);
    $data = array();
    while ($cust = mysqli_fetch_assoc($result)) {
        $data[] = $cust;
    } 
    if($data) {
     echo json_encode($data);
    } 
?>
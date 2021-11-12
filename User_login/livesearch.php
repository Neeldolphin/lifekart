<?php
include 'class.php';
include 'connection.php';
if (isset($_POST['search'])) {

  $Name = $_POST['search'];
  $search=new product_details();
  $array=$search->search_item($Name);
    echo json_encode($array);  
}
?>

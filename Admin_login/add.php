<?php
if(count($_POST)>0)
{    
    include('connection.php');  
     
     $pname = $_POST['pname'];
     $category = $_POST['category'];
     $SKU = $_POST['sku'];
     $image = $_POST['image'];
     $price = $_POST['Price'];
     $description = $_POST['Description'];
     $Video = $_POST['Video'];
     $qty = $_POST['QTY'];
     $Status = $_POST['Status'];
     $da=date("Y/m/d");
     $ua=date("Y/m/d");

     $load = array();
   
for ($i=0; $i<count($_FILES["image"]["name"]); $i++) { 
      
     $targetDir = "uploads/";
    $fileName = basename($_FILES["image"]["name"][$i]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

     if($_FILES['image']['name'][$i]){
        $allowTypes = array('jpg','png','jpeg','gif');

     if(in_array($fileType, $allowTypes)){

 move_uploaded_file($_FILES['image']['tmp_name'][$i], $targetFilePath); 
    
    $image = $_FILES['image']['name'][$i];
      $load[]=$fileName;
}
   }else{
   echo 0;
      }
}

$display=serialize($load);
    $targetDir = "uploads/";
    $fileName = basename($_FILES["Video"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

     if($_FILES['Video']['name']){
        $allowTypes = array('gif','mp4');

     if(in_array($fileType, $allowTypes)){

 move_uploaded_file($_FILES['Video']['tmp_name'], $targetFilePath); 
    
    $Video = $_FILES['Video']['name'];

 
 if(!empty($_POST)){
       $query = "INSERT INTO Product_info(pname,category ,SKU,image,price,description,video,qty,  Status,create_at,update_at)
      VALUES ('$pname','$category','$SKU','$display','$price','$description','$Video ','$qty','$Status','$da','$ua')";
      $result = mysqli_query($con, $query); 
     echo 1;
     }
     }else{
      echo 0;
     }
}
}
?>


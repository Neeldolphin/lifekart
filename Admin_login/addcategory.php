<?php
if(count($_POST)>0)
{    
    include('connection.php');  
     
     $CName = $_POST['cname'];
     $image = $_POST['image'];
     $description = $_POST['description'];
     $da=date("Y/m/d");
     $ua=date("Y/m/d");

    $targetDir = "uploads/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

     if($_FILES['image']['name']){

    $allowTypes = array('jpg','png','jpeg','gif');
     if(in_array($fileType, $allowTypes)){

    move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath); 
 
    $image = $_FILES['image']['name'];
    if(!empty($_POST)){
 
      $query = "INSERT INTO category_info(CName,image,description,create_at,update_at)
      VALUES ('$CName','$image','$description','$da','$ua')";
      $result = mysqli_query($con, $query); 
                echo 1;
     }
    }else{
        echo 0;
    }
}    
}
?>
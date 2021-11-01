<?php
if(count($_POST)>0)
{    
    include('connection.php');  
     
     $link = $_POST['link'];

    $targetDir = "uploads/";
    $fileName = basename($_FILES["imageName"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

     if($_FILES['imageName']['name']){

    $allowTypes = array('jpg','png','jpeg','gif');
     if(in_array($fileType, $allowTypes)){

    move_uploaded_file($_FILES['imageName']['tmp_name'], $targetFilePath); 
 
    $image = $_FILES['imageName']['name'];
    if(!empty($_POST)){
 
 echo $query = "INSERT INTO slider(imageName,link) VALUES ('$image','$link')";
      $result = mysqli_query($con, $query); 
                echo 1;
     }
    }else{
        echo 0;
    }
}    
}
?>
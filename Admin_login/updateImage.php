<?php    
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('connection.php'); 

if(!empty($_POST['eid'])){

    $targetDir = "uploads/";
    $fileName = basename($_FILES["eimageName"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

     if($_FILES['eimageName']['name']){

    $allowTypes = array('jpg','png','jpeg','gif');
     if(in_array($fileType, $allowTypes)){

    move_uploaded_file($_FILES['eimageName']['tmp_name'], $targetFilePath); 
 
    $image = $_FILES['eimageName']['name'];


 $query = "UPDATE slider SET imageName='". $image . "', link='" .$_POST['elink']."' WHERE id=".$_POST['eid'];
    $result = mysqli_query($con, $query);
        if($result) {
     echo 1;
    } else {
     echo 0;
    }
}else{ 
    echo 0;
    }
}
}
?>
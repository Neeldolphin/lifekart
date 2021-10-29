<?php    
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('connection.php'); 

if(!empty($_POST['eid'])){
    
    $ua=date("Y/m/d");
    $da=date("Y/m/d");

    $targetDir = "uploads/";
    $fileName = basename($_FILES["eimage"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

     if($_FILES['eimage']['name']){

    $allowTypes = array('jpg','png','jpeg','gif');
     if(in_array($fileType, $allowTypes)){

    move_uploaded_file($_FILES['eimage']['tmp_name'], $targetFilePath); 
 
    $image = $_FILES['eimage']['name'];


 $query = "UPDATE category_info SET CName='" . $_POST['ecname'] . "', image='". $image . "', description='" .$_POST['edescription']."',create_at='$da',update_at='$ua' WHERE id=".$_POST['eid'];
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
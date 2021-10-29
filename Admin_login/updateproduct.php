<?php    
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('connection.php'); 

if(!empty($_POST['eid'])){
    
     $da=date("Y/m/d");
     $ua=date("Y/m/d");

     $load = array();
   
for ($i=0; $i<count($_FILES["eimage"]["name"]); $i++) { 

    $targetDir = "uploads/";
    $fileName = basename($_FILES["eimage"]["name"][$i]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

     if($_FILES['eimage']['name'][$i]){

    $allowTypes = array('jpg','png','jpeg','gif');
     if(in_array($fileType, $allowTypes)){

    move_uploaded_file($_FILES['eimage']['tmp_name'][$i], $targetFilePath); 
 
    $image = $_FILES['eimage']['name'][$i];
     $load[]=$fileName;

     }
   }else{
   echo 0;
      }
}

$display=serialize($load);
    $targetDir = "uploads/";
    $fileName = basename($_FILES["eVideo"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

     if($_FILES['eVideo']['name']){
        $allowTypes = array('gif','mp4');

     if(in_array($fileType, $allowTypes)){

 move_uploaded_file($_FILES['eVideo']['tmp_name'], $targetFilePath); 
    
    $Video = $_FILES['eVideo']['name'];


  echo $query = "UPDATE Product_info SET pname='" . $_POST['epname'] . "', category='". $_POST['ecategory'] . "', SKU='" .$_POST['esku']."', image='". $display. "', price='". $_POST['ePrice'] . "', description='". $_POST['eDescription'] . "',video='". $Video . "',qty='". $_POST['eQTY'] . "',Status='". $_POST['eStatus'] . "',create_at='$da',update_at='$ua' WHERE Id=".$_POST['eid'];
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
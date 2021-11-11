<?php

if($_POST['action']=='image_details')
{ 
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


if($_POST['action']=='image_edit')
{ 
$id = $_POST['id'];
$query="SELECT * from slider WHERE id =".$id;
$result = mysqli_query($con,$query);
$data = array();
while ($cust = mysqli_fetch_assoc($result)) {
    $data[] = $cust;
} 
if($data) {
 echo json_encode($data);
} 
}


if($_POST['action']=='image_update')
{ 
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
}


if($_POST['action']=='image_delete')
{ 
$id = $_POST['id'];
$query = "DELETE FROM slider WHERE id=".$id;
$result =mysqli_query($con,$query);
echo 1;
}
?>
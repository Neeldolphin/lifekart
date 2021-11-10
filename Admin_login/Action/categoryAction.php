<?php
include('connection.php'); 

if($_POST['action']=='category_details')
{     
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

if($_POST['action']=='category_edit')
{  
    $id = $_POST['id'];
    $query="SELECT * from category_info WHERE id =".$id;
    $result = mysqli_query($con,$query);
    $data = array();
    while ($cust = mysqli_fetch_assoc($result)) {
        $data[] = $cust;
    } 
    if($data) {
     echo json_encode($data);
    } 
}

if($_POST['action']=='category_delete')
{
$id = $_POST['id'];
$query = "DELETE FROM category_info WHERE id=".$id;
$result =mysqli_query($con,$query);
echo 1;
}

if($_POST['action']=='category_update'){
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
}
?>
<?php
include('connection.php'); 



if($_POST['action']=='product_details')
{    
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


if($_POST['action']=='product_change')
{  
$id = $_POST['id'];
$query="SELECT * from Product_info WHERE Id =".$id;
$result = mysqli_query($con,$query);
$data = array();
while ($cust = mysqli_fetch_assoc($result)) {
    $data[] = $cust;
    $img = unserialize($cust['image']);
} 
if($data) {
 echo json_encode(array('img'=>$img,'data'=>$data));
} 
}


if($_POST['action']=='product_update')
{ 
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

  $query = "UPDATE Product_info SET pname='" . $_POST['epname'] . "', category='". $_POST['ecategory'] . "', SKU='" .$_POST['esku']."', image='". $display. "', price='". $_POST['ePrice'] . "', description='". $_POST['eDescription'] . "',video='". $Video . "',qty='". $_POST['eQTY'] . "',Status='". $_POST['eStatus'] . "',create_at='$da',update_at='$ua' WHERE Id=".$_POST['eid'];
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
}else{
 $query = "UPDATE Product_info SET pname='" . $_POST['epname'] . "', category='". $_POST['ecategory'] . "', SKU='" .$_POST['esku']."', image='". $display. "', price='". $_POST['ePrice'] . "', description='". $_POST['eDescription'] . "',video='". $Video . "',qty='". $_POST['eQTY'] . "',Status='". $_POST['eStatus'] . "',create_at='$da',update_at='$ua' WHERE Id=".$_POST['eid'];
 $result = mysqli_query($con, $query);
  if($result) {
  echo 1;
 } else {
  echo 0;
 }
}
}


if($_POST['action']=='product_delete')
{ 
$id = $_POST['id'];
$query = "DELETE FROM Product_info WHERE Id=".$id;
$result =mysqli_query($con,$query);
echo 1;
}

?>
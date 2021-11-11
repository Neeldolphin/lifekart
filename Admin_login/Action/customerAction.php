<?php

if($_POST['action']=='customer_details')
{ 
if(count([$_POST])>0){
$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];
$Email = $_POST['Email'];
$phone_number = $_POST['phone_number'];
$Address = $_POST['Address'];
$country = $_POST['country'];
$create_at=date("Y/m/d");
$update_at=date("Y/m/d");
$customer_insert = new customer();
$customer_insert->insert($FirstName,$LastName,$Email,$phone_number,$Address,$country,$create_at,$update_at);
}
echo 1;
}


if($_POST['action']=='customer_edit')
{ 
    $id = $_POST['id'];
    $edit =new customer();
   $edit->edit($id);
}

if($_POST['action']=='customer_update')
{ 
if(!empty($_POST['Id'])){
    $create_at=date("Y/m/d");
    $update_at=date("Y/m/d");
    $post=$_POST;
    $update = new customer();
    $update->update($post,$create_at,$update_at);
echo 1;
}
}

if($_POST['action']=='customer_delete')
{ 
$id = $_POST['id'];
$delete=new customer();
$delete->delete($id);
echo 1;
}
?>
<?php

if($_POST['action']=='coupen_details')
{ 
if(count([$_POST])>0){
$CoupenCode = $_POST['CoupenCode'];
$CoupenDiscount = $_POST['CoupenDiscount'];

$coupen_insert = new coupen();
$coupen_insert->insert($CoupenCode,$CoupenDiscount);
}
echo 1;
}


if($_POST['action']=='coupen_edit')
{ 
    $id = $_POST['id'];
    $edit =new coupen();
   $edit->edit($id);
}

if($_POST['action']=='coupen_update')
{ 
if(!empty($_POST['coupen_id'])){
    $post=$_POST;
    $update = new coupen();
    $update->update($post);
echo 1;
}
}

if($_POST['action']=='coupen_delete')
{ 
$id = $_POST['id'];
$delete=new coupen();
$delete->delete($id);
echo 1;
}
?>
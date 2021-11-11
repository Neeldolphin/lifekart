<?php

if($_POST['action']=='category_details')
{     
     $CName = $_POST['cname'];
     $image = $_POST['image'];
     $description = $_POST['description'];
     $create_at=date("Y/m/d");
     $update_at=date("Y/m/d");
    $files = $_FILES;
    $image = new category();
    $image->insert($files,$CName,$image,$description,$create_at,$update_at);
    echo 1;
}

if($_POST['action']=='category_edit')
{  
    $id = $_POST['id'];
   $edit =new category();
   $edit->edit($id);
}

if($_POST['action']=='category_update'){
if(!empty($_POST['eid'])){
    

    $create_at=date("Y/m/d");
    $update_at=date("Y/m/d");
    $files=$_FILES;
    $post=$_POST;
    $update = new category();
    $update->update($files,$post,$create_at,$update_at);
    echo 1;

}
}

if($_POST['action']=='category_delete')
{
$id = $_POST['id'];
$delete=new category();
$delete->delete($id);
echo 1;
}
?>
<?php
 include ('../connection.php');

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
     $create_at=date("Y/m/d");
     $update_at=date("Y/m/d");
     $files = $_FILES;
     $image = new product();
     $image->insert($files,$pname,$category,$SKU,$price,$description,$qty,$Status,$create_at,$update_at);
}


if($_POST['action']=='product_change')
{  
$id = $_POST['id'];
$change =new product();
$change->edit($id);
}


if($_POST['action']=='product_update')
{ 
if(!empty($_POST['eid'])){
    
    $create_at=date("Y/m/d");
    $update_at=date("Y/m/d");
    $files=$_FILES;
    $post=$_POST;
    $update = new product();
    $update->update($files,$post,$create_at,$update_at);   
}
}


if($_POST['action']=='product_delete')
{ 
$id = $_POST['id'];
$delete=new product();
$delete->delete($id);
echo 1;
}

if($_POST['action']=='single_remove')
{    
    $id = $_POST['id'];
    $key = $_POST['imgname'];
    $query="SELECT * from Product_info WHERE Id =".$id;
    $result = mysqli_query($con,$query);
    while($row = mysqli_fetch_array($result)){
            $image=$row[4];
    }
    $img1=unserialize($image);
    

    if (($key = array_search($key, $img1)) !== false) {
        unset($img1[$key]);
    }
        $img2=array_values($img1);
        $img2=serialize($img2);
        
    echo $query = "UPDATE Product_info SET image='". $img2. "'WHERE Id=".$id;
    $result = mysqli_query($con, $query);
}

?>
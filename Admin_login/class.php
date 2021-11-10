<?php
class database {
     const host = "localhost";
     const user = "root";
     const pass = "Admin@123";
     const db_name = "demo_lifekart";
    
     protected $con; 

     function __construct() { 

        $this->con = mysqli_connect(self::host,self::user,self::pass,self::db_name); 
        return $this->con;
    }
}

class product extends database{
     public function __construct()
     {
      parent::__construct();   
     }

        public function insert($pname,$category ,$SKU,$image,$price,$description,$video,$qty,$Status,$create_at,$update_at)
        {
        $query="INSERT INTO Product_info(pname,category ,SKU,image,price,description,video,qty,  Status,create_at,update_at)
        VALUES ('$pname','$category','$SKU','$image','$price','$description','$video ','$qty','$Status','$create_at','$update_at')";
        $result=mysqli_query($this->con,$query);
        $array= mysqli_fetch_array($result);
        }
        
        public function update($pname,$category ,$SKU,$image,$price,$description,$video,$qty,$Status,$create_at,$update_at)
        {
            $query="UPDATE Product_info SET pname='" . $_POST['epname'] . "', category='". $_POST['ecategory'] . "', SKU='" .$_POST['esku']."', image='". $display. "', price='". $_POST['ePrice'] . "', description='". $_POST['eDescription'] . "',video='". $Video . "',qty='". $_POST['eQTY'] . "',Status='". $_POST['eStatus'] . "',create_at='$da',update_at='$ua' WHERE Id=".$_POST['eid'];
            $result=mysqli_query($this->con,$query);
            $array= mysqli_fetch_array($result);
        }
        public function delete($id)
        {
            $query = "DELETE FROM Product_info WHERE Id=".$id;
            $result=mysqli_query($this->con,$query);
            $array= mysqli_fetch_array($result);
        }
}

class category extends database{
    public function __construct()
    {
     parent::__construct();   
    }
        public function insert($files,$CName,$image,$description,$create_at,$update_at)
        {
            $targetDir = "uploads/";
            $fileName = basename($files["image"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        
             if($files['image']['name']){
        
            $allowTypes = array('jpg','png','jpeg','gif');
             if(in_array($fileType, $allowTypes)){
        
            move_uploaded_file($files['image']['tmp_name'], $targetFilePath); 
             }
            }

        $query = "INSERT INTO category_info(CName,image,description,create_at,update_at)VALUES ('$CName','$image','$description','$create_at','$update_at')";
        $result=mysqli_query($this->con,$query);
        $array= mysqli_fetch_array($result);
        return $array;
        }
        
        public function update($CName,$image,$description,$create_at,$update_at)
        {
            $query = "UPDATE category_info SET CName='" . $_POST['ecname'] . "', image='". $image . "', description='" .$_POST['edescription']."',create_at='$da',update_at='$ua' WHERE id=".$_POST['eid'];
            $result=mysqli_query($this->con,$query);
            $array= mysqli_fetch_array($result);
        }
        public function delete($id)
        {
            $query = "DELETE FROM category_info WHERE id=".$id;
            $result=mysqli_query($this->con,$query);
            $array= mysqli_fetch_array($result);
        }
}

class customer extends database{
    public function __construct()
    {
     parent::__construct();   
    }
        public function insert($FirstName,$LastName,$Email,$phone_number,$Address,$country,$create_at,$update_at)
        {
        $query = "INSERT INTO customer_info(FirstName,LastName,Email,phone_number,Address,country,create_at,update_at)VALUES ('$FirstName','$LastName','$Email','$phone_number','$Address','$country','$da','$ua')";
        $result=mysqli_query($this->con,$query);
        $array= mysqli_fetch_array($result);
        }
        
        public function update($FirstName,$LastName,$Email,$phone_number,$Address,$country,$create_at,$update_at)
        {
            $query ="UPDATE customer_info SET FirstName='" . $_POST['FirstName'] . "', LastName='" . $_POST['LastName'] . "', Email='" . $_POST['Email'] . "', phone_number='" . $_POST['phone_number'] . "', Address='" . $_POST['Address'] . "', country='" . $_POST['country'] . "',create_at='$da',update_at='$ua' WHERE Id=".$_POST['Id'];
            $result=mysqli_query($this->con,$query);
            $array= mysqli_fetch_array($result);
        }
        public function delete($id)
        {
            $query = "DELETE FROM customer_info WHERE Id=".$id;
            $result=mysqli_query($this->con,$query);
            $array= mysqli_fetch_array($result);
        }
}

?>
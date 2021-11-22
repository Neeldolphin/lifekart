<?php
class database {
     const host = "localhost";
     const user = "root";
     const pass = "Admin@123";
     const db_name = "demo_lifekart";
    
     protected $con; 

     function __construct() { 

        $this->con = mysqli_connect(self::host,self::user,self::pass); 
        $this->db =mysqli_select_db($this->con,self::db_name);
        $this->sql =mysqli_query($this->con, $this->db);
        return $this->con;
    }
}

class product extends database{
     public function __construct()
     {
      parent::__construct();   
     }

        public function insert($files,$pname,$category,$SKU,$price,$description,$qty,$Status,$create_at,$update_at)
        {
       
     $load = array();
   
     for ($i=0; $i<count($files["image"]["name"]); $i++) { 
           
          $targetDir = "../uploads/";
         $fileName = basename($files["image"]["name"][$i]);
         $targetFilePath = $targetDir . $fileName;
         $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
     
          if($files['image']['name'][$i]){
             $allowTypes = array('jpg','png','jpeg','gif');
     
          if(in_array($fileType, $allowTypes)){
     
      move_uploaded_file($files['image']['tmp_name'][$i], $targetFilePath); 
         
         $image = $files['image']['name'][$i];
           $load[]=$fileName;
     }
        }else{
        echo 0;
           }
     }
     $display=serialize($load);
         $targetDir = "../uploads/";
         $fileName = basename($files["Video"]["name"]);
         $targetFilePath = $targetDir . $fileName;
         $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
     
          if($files['Video']['name']){
             $allowTypes = array('gif','mp4');
     
          if(in_array($fileType, $allowTypes)){
     
      move_uploaded_file($files['Video']['tmp_name'], $targetFilePath); 
         
         $Video = $files['Video']['name'];
     
      
      if(!empty($_POST)){
        $check="select count(1) from Product_info where SKU='$SKU' ";
        $exists=mysqli_query($this->con,$check);
        $row=mysqli_fetch_row($exists);
        if($row[0] >= 1) {
            echo 5;
             }else{
            $query = "INSERT INTO Product_info(pname,category ,SKU,image,price,description,video,qty,  Status,create_at,update_at)
           VALUES ('$pname','$category','$SKU','$display','$price','$description','$Video ','$qty','$Status','$create_at','$update_at')";
           $result = mysqli_query($this->con, $query); 
          echo 1;
          }
        }
          }else{
           echo 0;
          }
     }
        }

        public function edit($id)
        {
            $query="SELECT * from Product_info WHERE Id =".$id;
            $result = mysqli_query($this->con,$query);
            $data = array();
            while ($cust = mysqli_fetch_assoc($result)) {
                $data[] = $cust;
                $img = unserialize($cust['image']);
            } 
            if($data) {
             echo json_encode(array('img'=>$img,'data'=>$data));
            } 
        }
        
        public function update($files,$post,$create_at,$update_at)
        {
            if(!empty($files['eimage']['name'][0])){
                $load = array();
                
                for ($i=0; $i<count($files["eimage"]["name"]); $i++) { 
            
               $targetDir = "../uploads/";
               $fileName = basename($files["eimage"]["name"][$i]);
               $targetFilePath = $targetDir . $fileName;
               $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            
               $allowTypes = array('jpg','png','jpeg','gif');
                if(in_array($fileType, $allowTypes)){
            
               move_uploaded_file($files['eimage']['tmp_name'][$i], $targetFilePath); 
            
               $image = $files['eimage']['name'][$i];
                $load[]=$fileName;
            }
        }
        $display=serialize($load);
         $query = "UPDATE Product_info SET  image='". $display. "' WHERE Id=".$post['eid'];
        $result = mysqli_query($this->con, $query);
     }

    if(!empty($files['eVideo']['name'])){

               $targetDir = "../uploads/";
               $fileName = basename($files["eVideo"]["name"]);
               $targetFilePath = $targetDir . $fileName;
               $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

                   $allowTypes = array('gif','mp4');
            
                if(in_array($fileType, $allowTypes)){
            
            move_uploaded_file($files['eVideo']['tmp_name'], $targetFilePath); 
               
               $Video = $files['eVideo']['name'];
               $load[]=$fileName;
            }
         $query = "UPDATE Product_info SET video='". $Video . "' WHERE Id=".$post['eid'];
               $result = mysqli_query($this->con, $query);  
    }   
         $query = "UPDATE Product_info SET pname='" . $post['epname'] . "', category='". $post['ecategory'] . "', SKU='" .$post['esku']."', price='". $post['ePrice'] . "', description='". $post['eDescription'] . "',qty='". $post['eQTY'] . "',Status='". $post['eStatus'] . "',create_at='$create_at',update_at='$update_at' WHERE Id=".$post['eid'];
               $result = mysqli_query($this->con, $query);
               echo 1; 
    }   

        public function delete($id)
        {
            $query = "DELETE FROM Product_info WHERE Id=".$id;
            $result =mysqli_query($this->con,$query);
        }

        public function removeimage($post)
        {
            $id = $post['id'];
            $key = $post['imgname'];
            $query="SELECT * from Product_info WHERE Id =".$id;
            $result = mysqli_query($this->con,$query);
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
            $result = mysqli_query($this->con, $query);
        }
        public function productInfo()
        {
            $query="select * from Product_info INNER JOIN category_info ON Product_info.category=category_info.id "; 
            $result=mysqli_query($this->con,$query);
            while($product=mysqli_fetch_row($result)){
                $data[]=$product;
            }
            return $data;
        }
        public function categoryInfo()
        {
            $query="SELECT * FROM category_info";
            $result = mysqli_query($this->con,$query);
            while($category=mysqli_fetch_row($result)){
                $data[]=$category;
            }
            return $data;
        }
       
}

class category extends database{
    public function __construct()
    {
     parent::__construct();   
    }
        public function insert($files,$CName,$image,$description,$create_at,$update_at)
        {
            $targetDir = "../uploads/";
            $fileName = basename($files["image"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        
             if($files['image']['name']){
        
            $allowTypes = array('jpg','png','jpeg','gif');
             if(in_array($fileType, $allowTypes)){
        
            move_uploaded_file($files['image']['tmp_name'], $targetFilePath); 
         
            $image = $files['image']['name'];
            if(!empty($_POST)){
                $check="select count(1) from category_info where CName='$CName' ";
                $exists=mysqli_query($this->con,$check);
                $row=mysqli_fetch_row($exists);
                if($row[0] >= 1) {
                    echo 5;
                     }else{
              $query = "INSERT INTO category_info(CName,image,description,create_at,update_at)
              VALUES ('$CName','$image','$description','$create_at','$update_at')";
              $result = mysqli_query($this->con, $query);
              echo 1;
                     }
            }
        }
    }
  }
        public function edit($id)
        {
            $query="SELECT * from category_info WHERE id =".$id;
            $result = mysqli_query($this->con,$query);
            $data = array();
            while ($cust = mysqli_fetch_assoc($result)) {
                $data[] = $cust;
            } 
            if($data) {
             echo json_encode($data);
            } 
        }
        
        public function update($files,$post,$create_at,$update_at)
        {
            $targetDir = "../uploads/";
                $fileName = basename($files["eimage"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

                if(!empty($files['eimage']['name'])){

                $allowTypes = array('jpg','png','jpeg','gif');
                if(in_array($fileType, $allowTypes)){

                move_uploaded_file($files['eimage']['tmp_name'], $targetFilePath); 
            
                $image = $files['eimage']['name'];


            $query = "UPDATE category_info SET image='". $image . "' WHERE id=".$post['eid'];
                $result = mysqli_query($this->con, $query);
            }
        }
        $query = "UPDATE category_info SET CName='" . $post['ecname'] . "', description='" .$post['edescription']."',create_at='$create_at',update_at='$update_at' WHERE id=".$post['eid'];
        $result = mysqli_query($this->con, $query);
        }

        public function delete($id)
        {
            $query = "DELETE FROM category_info WHERE id=".$id;
            $result =mysqli_query($this->con,$query);
        }

        public function categoryInfo()
        {
            $query="select * from category_info"; 
            $result=mysqli_query($this->con,$query);
            while($category=mysqli_fetch_row($result)){
                $data[]=$category;
            }
            return $data;
        }


}

class customer extends database{
    public function __construct()
    {
     parent::__construct();   
    }
        public function insert($FirstName,$LastName,$Email,$phone_number,$Address,$country,$create_at,$update_at)
        {
            if(!empty($_POST)){
                $check="select count(1) from customer_info where Email='$Email' ";
                $exists=mysqli_query($this->con,$check);
                $row=mysqli_fetch_row($exists);
                if($row[0] >= 1) {
                    echo 5;
                     }else{
                $query = "INSERT INTO customer_info(FirstName,LastName,Email,phone_number,Address,country,create_at,update_at)
                VALUES ('$FirstName','$LastName','$Email','$phone_number','$Address','$country','$create_at','$update_at')";
                $result = mysqli_query($this->con, $query); 
                echo 1;
               }
            }
        }
        
        public function edit($id)
        {
            $query="SELECT * from customer_info WHERE Id =".$id;
            $result = mysqli_query($this->con,$query);
            $data = array();
            while ($cust = mysqli_fetch_assoc($result)) {
                $data[] = $cust;
            } 
            if($data) {
             echo json_encode($data);
            } 
        }

        public function update($post,$create_at,$update_at)
        {
            $query = "UPDATE customer_info SET FirstName='" . $post['FirstName'] . "', LastName='" . $post['LastName'] . "', Email='" . $post['Email'] . "', phone_number='" . $post['phone_number'] . "', Address='" . $post['Address'] . "', country='" . $post['country'] . "',create_at='$create_at',update_at='$update_at' WHERE Id=".$post['Id'];
            $result = mysqli_query($this->con, $query);
        }

        public function delete($id)
        {       
            $query = "DELETE FROM customer_info WHERE Id=".$id;
            $result =mysqli_query($this->con,$query);
        }

        public function customerInfo()
        {
            
				$query="select * from customer_info"; 
				$result=mysqli_query($this->con,$query);
                while($customer=mysqli_fetch_row($result)){
                    $data[]=$customer;
                }
                return $data;
        }
}

class coupen extends database{
    public function __construct()
    {
     parent::__construct();   
    }
        public function insert($coupen_name,$coupen_discount)
        {
            if(!empty($_POST)){
                $query = "INSERT INTO coupen_code(coupen_name,coupen_discount)
                VALUES ('$coupen_name','$coupen_discount')";
                $result = mysqli_query($this->con, $query); 
                echo 1;
               }
        }
        
        public function edit($id)
        {
            $query="SELECT * from coupen_code WHERE coupen_id =".$id;
            $result = mysqli_query($this->con,$query);
            while ($cust = mysqli_fetch_assoc($result)) {
                $data = $cust;
            } 
            if($data) {
             echo json_encode($data);
            } 
        }

        public function update($post)
        {
            $query = "UPDATE coupen_code SET coupen_name='" . $post['coupen_name'] . "', coupen_discount='" . $post['coupen_discount'] . "' WHERE coupen_id=".$post['coupen_id'];
            $result = mysqli_query($this->con, $query);
        }

        public function delete($id)
        {       
            $query = "DELETE FROM coupen_code WHERE coupen_id=".$id;
            $result =mysqli_query($this->con,$query);
        }
        
        public function coupenInfo()
        {
            
			$query="select * from coupen_code"; 
            $result=mysqli_query($this->con,$query);
                while($coupen=mysqli_fetch_row($result)){
                    $data[]=$coupen;
                }
                return $data;
        }

        
}


class carousel extends database{
    public function __construct()
    {
     parent::__construct();   
    }
        public function insertcarousel($post,$files)
        {
            $link = $post['link'];

            $targetDir = "../uploads/";
            $fileName = basename($files["imageName"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

            if($files['imageName']['name']){

            $allowTypes = array('jpg','png','jpeg','gif');
            if(in_array($fileType, $allowTypes)){

            move_uploaded_file($files['imageName']['tmp_name'], $targetFilePath); 
        
            $image = $files['imageName']['name'];
            if(!empty($post)){
        
        $query = "INSERT INTO slider(imageName,link) VALUES ('$image','$link')";
            $result = mysqli_query($this->con, $query); 
                        echo 1;
            }
            }else{
                echo 0;
            }
          }  

        }
        
        public function editcarousel($post)
        {
            $id = $post['id'];
            $query="SELECT * from slider WHERE id =".$id;
            $result = mysqli_query($this->con,$query);
            $data = array();
            while ($cust = mysqli_fetch_assoc($result)) {
                $data[] = $cust;
            } 
            if($data) {
             echo json_encode($data);
            } 
        }

        public function updatecarousel($post,$files)
        {
            if(!empty($post['eid'])){

                $targetDir = "../uploads/";
                $fileName = basename($files["eimageName"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            
                 if(!empty($files['eimageName']['name'])){
            
                $allowTypes = array('jpg','png','jpeg','gif');
                 if(in_array($fileType, $allowTypes)){
            
                move_uploaded_file($files['eimageName']['tmp_name'], $targetFilePath); 
             
                $image = $files['eimageName']['name'];
            
            
             $query = "UPDATE slider SET imageName='". $image . "' WHERE id=".$_POST['eid'];
                $result = mysqli_query($this->con, $query);
            }
            }
            $query = "UPDATE slider SET link='" .$post['elink']."' WHERE id=".$_POST['eid'];
             $result = mysqli_query($this->con, $query);
             echo 1;
             }
        }

        public function deletecarousel($post)
        {       
            $id = $post['id'];
            $query = "DELETE FROM slider WHERE id=".$id;
            $result =mysqli_query($this->con,$query);
            echo 1;
        }
        public function carouselInfo()
        {
            
				$query="select * from slider"; 
				$result=mysqli_query($this->con,$query);
                while($carousel=mysqli_fetch_row($result)){
                    $data[]=$carousel;
                }
                return $data;
        }

}



class login extends database{
    public function __construct()
    {
     parent::__construct();   
    }

    public function admin($post,$request)
    {
        if (isset($post['username'])) {
            $username = stripslashes($request['username']);    // removes backslashes
            $username = mysqli_real_escape_string($this->con, $username);
            $password = stripslashes($request['password']);
            $password = mysqli_real_escape_string($this->con, $password);
            // Check user is exist in the database
            $query    = "SELECT * FROM `Admin_login` WHERE username='$username'
                         AND password='$password'";
            $result = mysqli_query($this->con, $query) or die(mysqli_error($this->con));
            $rows = mysqli_num_rows($result);
            $array = mysqli_fetch_array($result);
            if ($rows == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $array[0];
                // Redirect to user home page
                header("Location: home.php");
        }else {
                echo 'Incorrect Username/password.';
        }
    }
    
    }
        
        
}
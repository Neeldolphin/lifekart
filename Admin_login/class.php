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
           
          $targetDir = "uploads/";
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
         $targetDir = "uploads/";
         $fileName = basename($files["Video"]["name"]);
         $targetFilePath = $targetDir . $fileName;
         $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
     
          if($files['Video']['name']){
             $allowTypes = array('gif','mp4');
     
          if(in_array($fileType, $allowTypes)){
     
      move_uploaded_file($files['Video']['tmp_name'], $targetFilePath); 
         
         $Video = $files['Video']['name'];
     
      
      if(!empty($_POST)){
            $query = "INSERT INTO Product_info(pname,category ,SKU,image,price,description,video,qty,  Status,create_at,update_at)
           VALUES ('$pname','$category','$SKU','$display','$price','$description','$Video ','$qty','$Status','$create_at','$update_at')";
           $result = mysqli_query($this->con, $query); 
          echo 1;
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
            $load = array();
  
            for ($i=0; $i<count($files["eimage"]["name"]); $i++) { 
            
               $targetDir = "uploads/";
               $fileName = basename($files["eimage"]["name"][$i]);
               $targetFilePath = $targetDir . $fileName;
               $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            
                if($files['eimage']['name'][$i]){
            
               $allowTypes = array('jpg','png','jpeg','gif');
                if(in_array($fileType, $allowTypes)){
            
               move_uploaded_file($files['eimage']['tmp_name'][$i], $targetFilePath); 
            
               $image = $files['eimage']['name'][$i];
                $load[]=$fileName;
            
                }
              }else{
              echo 0;
                 }
            }
            $display=serialize($load);
               $targetDir = "uploads/";
               $fileName = basename($files["eVideo"]["name"]);
               $targetFilePath = $targetDir . $fileName;
               $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            
                if($files['eVideo']['name']){
                   $allowTypes = array('gif','mp4');
            
                if(in_array($fileType, $allowTypes)){
            
            move_uploaded_file($files['eVideo']['tmp_name'], $targetFilePath); 
               
               $Video = $files['eVideo']['name'];
            
              $query = "UPDATE Product_info SET pname='" . $post['epname'] . "', category='". $post['ecategory'] . "', SKU='" .$post['esku']."', image='". $display. "', price='". $post['ePrice'] . "', description='". $post['eDescription'] . "',video='". $Video . "',qty='". $post['eQTY'] . "',Status='". $post['eStatus'] . "',create_at='$create_at',update_at='$update_at' WHERE Id=".$post['eid'];
               $result = mysqli_query($this->con, $query);
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

        public function delete($id)
        {
            $query = "DELETE FROM Product_info WHERE Id=".$id;
            $result =mysqli_query($this->con,$query);
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
         
            $image = $files['image']['name'];
            if(!empty($_POST)){
         
              $query = "INSERT INTO category_info(CName,image,description,create_at,update_at)
              VALUES ('$CName','$image','$description','$create_at','$update_at')";
              $result = mysqli_query($this->con, $query);
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
            $targetDir = "uploads/";
                $fileName = basename($files["eimage"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

                if($files['eimage']['name']){

                $allowTypes = array('jpg','png','jpeg','gif');
                if(in_array($fileType, $allowTypes)){

                move_uploaded_file($files['eimage']['tmp_name'], $targetFilePath); 
            
                $image = $files['eimage']['name'];


            $query = "UPDATE category_info SET CName='" . $post['ecname'] . "', image='". $image . "', description='" .$post['edescription']."',create_at='$create_at',update_at='$update_at' WHERE id=".$post['eid'];
                $result = mysqli_query($this->con, $query);
            }
        }
        }
        public function delete($id)
        {
            $query = "DELETE FROM category_info WHERE id=".$id;
            $result =mysqli_query($this->con,$query);
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
                $query = "INSERT INTO customer_info(FirstName,LastName,Email,phone_number,Address,country,create_at,update_at)
                VALUES ('$FirstName','$LastName','$Email','$phone_number','$Address','$country','$create_at','$update_at')";
                $result = mysqli_query($this->con, $query); 
                echo 1;
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
}

?>
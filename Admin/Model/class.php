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
        
        public function ExportCsv($post)
        {  
            session_start();
            if($post['select_csv']!=''){
            header('Content-Type: text/csv');  
            header('Content-Disposition: attachment; filename="data.csv"');  

            $output = fopen("php://output", "wb");  

            fputcsv($output,array("pname","category","SKU","image","price","description","video","qty","Status","create_at","update_at","Position"));  
            $count=0;
            
            foreach($post['select_csv'] as $id){
                     
         $query = "SELECT  pname,category,SKU,image,price,description,video,qty,Status,create_at,update_at,Position FROM Product_info where Id=".$id;
            $result = mysqli_query($this->con, $query); 
            while($row = mysqli_fetch_assoc($result))  
            { 
                $id=$row['category'];
                $cate=new product();
                $row['category']=$cate->categoryName($id);

                $count++;
                 $store=array();
                 $img = unserialize($row['image']);
                foreach($img as $line){
                    $img1="http://localhost/lifekart/Admin/uploads/".$line;
                    $store[]=$img1;
                }
                $row['image']=implode(",",$store);
                $row['video']="http://localhost/lifekart/Admin/uploads/".$row['video'];
    
                 fputcsv($output, $row);  
            }
            if(!isset($result)){
                $_SESSION['success_message']="CSV File has been successfully Exported.added:$count";
                header("Location: ../View/product.php");
            }  
        }
            fclose($output);
    }else{
        $_SESSION['success_message']="select proper record";
       header("Location: ../View/product.php");
    }
}

public function ImportCsv($files)
        {
            session_start();
            $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
            if(!empty($files['file']['name']) && in_array($files['file']['type'], $csvMimes)){
                if(is_uploaded_file($files['file']['tmp_name'])){
           
                $csvFile = fopen($files['file']['tmp_name'], 'r');
                $count=0;
                $add=0;
                $getValue = 0;
                while ($variable = fgetcsv($csvFile)) 
                {
                    $getValue++;
                    if($getValue>1){
                    foreach ($variable as $getData){continue;}
                    }else{
                            $_SESSION['success_message']="CSV File is empty. Enter some valid info";
                            header("Location: ../View/product.php");
                        }
                 while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
                  {
                    $getData=array_combine($variable,$getData);
                    $prevQuery = "SELECT SKU FROM Product_info WHERE SKU=".$getData['SKU'];
                    $prevResult = $this->con->query($prevQuery);
                  
                    if($prevResult->num_rows > 0){
                            
                        $count++;
                    $rows=array();
                    $row=explode(",",$getData['image']);
                    foreach($row as $line){
                        $imag2=str_replace("http://localhost/lifekart/Admin/uploads/","",$line);
                        $check=explode(".",$imag2);
                        if(in_array($check[1],array('jpg','jpeg','png'))){
                            $rows[]=$imag2;
                        }else{
                            $_SESSION['success_message']="invalid image type.updated:$count skipped:$add";
                        }
                    }
                    $setData['image']=serialize($rows);
                    $getData['video']=str_replace("http://localhost/lifekart/Admin/uploads/","",$getData['video']);

                    $sql = "UPDATE Product_info set pname='".$getData['pname']."',category='".$getData['category']."',image='".$setData['image']."',price='".$getData['price']."',description='".$getData['description']."',video='".$getData['video']."',qty='".$getData['qty']."',Status='".$getData['Status']."',create_at='".$getData['create_at']."',update_at='".$getData['update_at']."',Position='".$getData['Position']."' where SKU=".$getData['SKU'];
                    $result = mysqli_query($this->con, $sql);
                    }else{
                        $add++;
                        $rows=array();
                        $row=explode(",",$getData['image']);
                        foreach($row as $line){
                        $imag2=str_replace("http://localhost/lifekart/Admin/uploads/","",$line);
                        $check=explode(".",$imag2);
                            if(in_array($check[1],array('jpg','jpeg','png'))){
                                $rows[]=$imag2;
                            }else{    
                                $_SESSION['success_message']="invalid image type.updated:$count skipped:$add";
                            }
                            }
                        $setData['image']=serialize($rows);
    
                        $getData['video']=str_replace("http://localhost/lifekart/Admin/uploads/","",$getData['video']);
    
              $sql = "INSERT INTO Product_info(pname,category ,SKU,image,price,description,video,qty,Status,create_at,update_at,Position) 
                               values ('".$getData['pname']."','".$getData['category']."','".$getData['SKU']."','".$setData['image']."','".$getData['price']."','".$getData['description']."','".$getData['video']."','".$getData['qty']."','".$getData['Status']."','".$getData['create_at']."','".$getData['update_at']."','".$getData['Position']."')";
                               $result1 = mysqli_query($this->con, $sql);
                    }
               if(isset($result1))
               {
                $_SESSION['success_message']="CSV File has been successfully Imported.updated:$count added:$add";
                header("Location: ../View/product.php");
               }    
               else if($result) {
                $_SESSION['success_message']="sku already exists.updated:$count";
                header("Location: ../View/product.php");
                                    }
                            }
                            }               
                }
                  fclose($csvFile);  
        }
    }

    public function DeleteCsv($files){

            session_start();
            $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
            if(!empty($files['file1']['name']) && in_array($files['file1']['type'], $csvMimes)){
                if(is_uploaded_file($files['file1']['tmp_name'])){
           
                    $csvFile = fopen($files['file1']['tmp_name'], 'r');
                    $count=0;
                    $getValue = 0;
                    while ($variable = fgetcsv($csvFile)) 
                    {
                        $getValue++;
                        if($getValue>1){
                        foreach ($variable as $getData){continue;}
                        }else{
                                $_SESSION['success_message']="CSV File is empty. Enter some valid info";
                                header("Location: ../View/product.php");
                            }
                 while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
                  {  
                      $count++;
                      $query="SELECT SKU FROM Product_info WHERE SKU='".$getData[0]."'";
                      $result1 = mysqli_query($this->con, $query);
                      if($result1->num_rows >0){

                    $sql = "DELETE FROM Product_info WHERE SKU= '".$getData[0]."'";
                    $result = mysqli_query($this->con, $sql);
                }else{
                    $_SESSION['success_message']="files no match found";
                    header("Location: ../View/product.php"); 
                }
            }
                if(isset($result))
               {  
                $_SESSION['success_message']="$count files have been deleted";
                header("Location: ../View/product.php");    
               }
            }
                  fclose($csvFile);  
        }
    }
        }

    public function SelectDeleteCsv($post)
        {  
            session_start();
            if($post['select_csv']!=''){

            $count=0;
            foreach($post['select_csv'] as $id){
                
            $count++;
           $query = "DELETE FROM Product_info WHERE Id=".$id;  
            $result = mysqli_query($this->con, $query);  
          
            if(isset($result)){
                $_SESSION['success_message']="Selected record has been successfully Deleted.$count";
                header("Location: ../View/product.php");
            }  
        }
    }else{
       $_SESSION['success_message']="select proper record";
                header("Location: ../View/product.php");
    }
}

    public function insert($files,$pname,$category,$SKU,$price,$description,$qty,$Status,$create_at,$update_at){
       
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

        public function insert2($customergroup,$customergroupprice,$SKU)
        {
            $i=0;
            foreach($customergroup as $customerGroup){
                $sql="select customer_group	 from customer_group where id=".$customerGroup;  
                $result1=mysqli_query($this->con,$sql);
                while($row=mysqli_fetch_row($result1)){ 
                    $data=$row[0];
            }
            $query = "INSERT INTO Product_Customer_Group_Price(Customer_Group,Customer_Group_Name,Group_Price,sku)VALUES ('$customerGroup','$data','$customergroupprice[$i]','$SKU')";
          $result = mysqli_query($this->con, $query);
                $i++;
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
            $query1="SELECT SKU from Product_info WHERE Id=".$id;
            $result1 = mysqli_query($this->con,$query1);
            while ($cust1 = mysqli_fetch_assoc($result1)) {
                $data1= $cust1['SKU'];
            }
            $data3 ='';
             
           $sql="SELECT * FROM Product_Customer_Group_Price WHERE sku=".$data1;
            $result2= mysqli_query($this->con,$sql);
            $data2=array();
            $i=0;
            while ($cust2= mysqli_fetch_assoc($result2)) {
                $data2[]=$cust2;
                $data3 .= "<div class='input-box1' id='choices_".$i."'>
                            <div class='row'>
                            <div class='col-sm-4'>              
                            <select class='form-control' name='eCustomerGroup[]' id='choices_".$i."'>
                            <option value='".$data2[$i]['Customer_Group']." '>".$data2[$i]['Customer_Group_Name']."</option>
                                </select>
                                </div>
                                <div class='col-md-4'>
                            <input type='number' class='form-control' id='choices_".$i."' name='eCustomerGroupPrice[]' placeholder='Customer Group Price' min='0' value='".$data2[$i]['Group_Price']."'>
                            </div>
                            <button type='button' id='aed_$i' class='add-btn1 btn addCustomerGroupPrice' ><i class='fa fa-plus' aria-hidden='true'></i></button>
                            <button type='button' id='tras_$i' class='btn remove-lnk1' ><i class='fa fa-trash'></i></button> 
                            </div>
                        </div>";
                        $i++;
                    }
                    if ($data3 =='') {
                        $data3 .= "<div class='input-box1'>
                    <div class='row'>
                    <div class='col-sm-4'>              
                        </div>
                        <div class='col-md-4'>
                    </div>
                    <button type='button' class='add-btn1 btn addCustomerGroupPrice' data-id='' data-label=''><i class='fa fa-plus' aria-hidden='true'></i></button>
                    </div>
                </div>";
                    }       
            if($data) {
                echo json_encode(array('img'=>$img,'data'=>$data,'data2'=>$data2,'data3'=>$data3));
            }
        }

        public function displayVideo($id)
        {
            $query="SELECT video from Product_info WHERE Id =".$id;
            $result = mysqli_query($this->con,$query);
            while ($cust = mysqli_fetch_array($result)) {
                $data = $cust[0];
            } 
             echo json_encode($data);
        }

        public function disImg($id)
        {
             $query="SELECT image from Product_info WHERE Id =".$id;
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
                
         $query = "UPDATE Product_info SET image='". $img2. "'WHERE Id=".$id;
        $result = mysqli_query($this->con, $query);
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

     if($post['vidrget']=='undefined'){
        $Video1='';
     $query = "UPDATE Product_info SET video='". $Video1. "'WHERE Id=".$post['eid'];
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

         $query = "UPDATE Product_info SET video='". $Video ."' WHERE Id=".$post['eid'];
               $result = mysqli_query($this->con, $query);  
    }   
           if($post['check_list']!=''){ 
           foreach($post['check_list'] as $id){
            $Cateid[]=$id;    
        }
        $imploded=implode(",",$Cateid);  
    } 
    if(empty($_POST['esku'])){
            echo 5;
            }else{
            $query = "UPDATE Product_info SET pname='" . $post['epname'] . "', category='$imploded', SKU='" .$post['esku']."', price='". $post['ePrice'] . "', description='". $post['eDescription'] . "',qty='". $post['eQTY'] . "',Status='". $post['eStatus'] . "',create_at='$create_at',update_at='$update_at' WHERE Id=".$post['eid'];
              $result = mysqli_query($this->con, $query);
               echo 1;
            }
    }   
 
    public function update2($customergroup,$customergroupprice,$SKU)
    {

         $query = "DELETE FROM Product_Customer_Group_Price WHERE sku=".$SKU;
         $result =mysqli_query($this->con,$query);
         $i=0;

        $check_array=array();
            foreach($customergroup as $customerGroup){
                if(!in_array($customerGroup,$check_array)){
                    array_push($check_array,$customerGroup);    
                    $sql="select customer_group	 from customer_group where id=".$customerGroup;  
                    $result1=mysqli_query($this->con,$sql);
                    while($row=mysqli_fetch_row($result1)){ 
                        $data=$row[0];
                }
                 $query = "INSERT INTO Product_Customer_Group_Price(Customer_Group,Customer_Group_Name,Group_Price,sku)VALUES ('$customerGroup','$data','$customergroupprice[$i]','$SKU')";
                 $result = mysqli_query($this->con, $query);
              }
                $i++;
        }
    } 


        public function delete($id)
        {
            $query = "DELETE FROM Product_info WHERE Id=".$id;
            $result =mysqli_query($this->con,$query);
        }

        public function deleteprice($id)
        {
            $query = "DELETE FROM Product_Customer_Group_Price WHERE id=".$id;
            $result =mysqli_query($this->con,$query);
        }

        public function productInfo()
        {
            $query="select * from Product_info"; 
            $result=mysqli_query($this->con,$query);
            while($product=mysqli_fetch_row($result)){
                $data[]=$product;
            }
            return $data;
        }

        public function categoryName($id)
        { 
        $data=array();
         $value=explode(",",$id);
         foreach($value as $id){
          $query="SELECT CName FROM category_info WHERE id=".$id;
            $result = mysqli_query($this->con,$query);
            while($category=mysqli_fetch_array($result)){
                $data[]=$category['CName'];
            }
        }
            $imploded=implode(",",$data);  
            return $imploded; 
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
              $query = "INSERT INTO category_info(CName,image,description,img_thumb,create_at,update_at)
              VALUES ('$CName','$image','$description','$image','$create_at','$update_at')";
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
         $query1="select Id,pname from Product_info where concat(',',category,',') like '%,$id,%'"; 
            $result1=mysqli_query($this->con,$query1);
            while($product[]=mysqli_fetch_row($result1)){                
               $data[1]=$product;
            }
                if($data) {
             echo json_encode($data);
            } 
        }
        
        public function update($files,$post,$create_at,$update_at)
        {   
            $categoryName=trim($post['ecname']);
            if($categoryName!=''){
            $targetDir = "../uploads/";
                $fileName = basename($files["eimage"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

                if(!empty($files['eimage']['name'])){

                $allowTypes = array('jpg','png','jpeg','gif');
                if(in_array($fileType, $allowTypes)){

                move_uploaded_file($files['eimage']['tmp_name'], $targetFilePath); 
            
                $image = $files['eimage']['name'];


            $query = "UPDATE category_info SET image='". $image . "',img_thumb='". $image . "' WHERE id=".$post['eid'];
                $result = mysqli_query($this->con, $query);
            }
        }
       if($post['check_list']!=''){ 
           foreach($post['check_list'] as $id){
            $sql="select category from Product_info where Id=".$id;
            $result1 = mysqli_query($this->con, $sql);
            $data=array();
            while($Categoryid=mysqli_fetch_array($result1)){
               
                $value= explode(',', $Categoryid['category']);
                if(!in_array($post['eid'],$value)){
                 $data[]=$Categoryid['category'];
                 $arr=array($Categoryid['category'],$post['eid']);
               $imploded=implode(",",$arr);      
        }else{
            $imploded=$Categoryid['category']; 
        }  
      $query="UPDATE Product_info SET category='$imploded' WHERE Id=".$id;
        $result = mysqli_query($this->con, $query);
           }
        }
        }
        if($post['Position']!=''){
            $i=0;
            foreach($post['posid'] as $id){
               $Position=$post['Position'];
                $query="UPDATE Product_info SET Position=".$Position[$i]." WHERE Id=".$id;
                $result = mysqli_query($this->con, $query);
                  $i++;
         }
        }
        $query = "UPDATE category_info SET CName='$categoryName', description='" .$post['edescription']."',create_at='$create_at',update_at='$update_at' WHERE id=".$post['eid'];
        $result = mysqli_query($this->con, $query);
        }else {
            echo 5;
        }
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
        public function insert($FirstName,$LastName,$Email,$phone_number,$Address,$country,$CustomerGroup,$create_at,$update_at)
        {
            if(!empty($_POST)){
                $check="select count(1) from customer_info where Email='$Email' ";
                $exists=mysqli_query($this->con,$check);
                $row=mysqli_fetch_row($exists);
                if($row[0] >= 1) {
                    echo 5;
                     }else{
                $query = "INSERT INTO customer_info(FirstName,LastName,Email,phone_number,Address,country,customerGroup	,create_at,update_at)
                VALUES ('$FirstName','$LastName','$Email','$phone_number','$Address','$country','$CustomerGroup','$create_at','$update_at')";
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
            $query = "UPDATE customer_info SET FirstName='" . $post['FirstName'] . "', LastName='" . $post['LastName'] . "', Email='" . $post['Email'] . "', phone_number='" . $post['phone_number'] . "', Address='" . $post['Address'] . "', country='" . $post['country'] . "', customerGroup='" . $post['customerGroup'] . "',create_at='$create_at',update_at='$update_at' WHERE Id=".$post['Id'];
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

public function CustomerDisplay($id)
{
 $query="SELECT * from customer_info LEFT JOIN customer_group on customer_info.customerGroup=customer_group.id WHERE customer_info.Id=".$id;
   $result = mysqli_query($this->con,$query);
    $data = array();
    while ($cust = mysqli_fetch_assoc($result)) {
        $data[] = $cust;
    } 
    if($data) {
     echo json_encode(array('data'=>$data));
    } 
}

        public function customerGrpinsert($CustomerGroup)
        {
            
			if(!empty($_POST)){
                    $check="select count(1) from customer_group where customer_group='$CustomerGroup' ";
                    $exists=mysqli_query($this->con,$check);
                    $row=mysqli_fetch_row($exists);
                    if($row[0] >= 1) {
                        echo 5;
                        }else{
                $query = "INSERT INTO customer_group(customer_group) VALUES ('$CustomerGroup')";
                $result = mysqli_query($this->con, $query); 
                echo 1;
               }
            }
        }

        public function customerGrpedit ($id)
        {
            $query="SELECT * from customer_group WHERE id =".$id;
            $result = mysqli_query($this->con,$query);
            $data = array();
            while ($cust = mysqli_fetch_assoc($result)) {
                $data[] = $cust;
            } 
            if($data) {
             echo json_encode($data);
            } 
        }

        public function customerGrpupdate($post)
        {
            $query = "UPDATE customer_group SET customer_group='" . $post['customer_group'] . "' WHERE id=".$post['id'];
            $result = mysqli_query($this->con, $query);
        }

        public function customerGrpdelete($id)
        {       
            $query = "DELETE FROM customer_group WHERE id=".$id;
            $result =mysqli_query($this->con,$query);
        }

        public function customerGrp()
        {
				$query="select * from customer_group"; 
				$result=mysqli_query($this->con,$query);
                while($customer=mysqli_fetch_row($result)){
                    $data[]=$customer;
                }
                return $data;
        }
        public function groupName($id)
        { 
        $data=array();
         $value=explode(",",$id);
         foreach($value as $id){
          $query="SELECT customer_group FROM customer_group WHERE id=".$id;
            $result = mysqli_query($this->con,$query);
            while($category=mysqli_fetch_array($result)){
                $data[]=$category['customer_group'];
            }
        }
            $imploded=implode(",",$data);  
            return $imploded; 
}

public function SelectDeleteGroup($post)
{  
    session_start();
    if($post['select_field']!=''){

    $count=0;
    foreach($post['select_field'] as $id){
        
    $count++;
   $query = "DELETE FROM customer_group WHERE id=".$id;  
    $result = mysqli_query($this->con, $query);  
  
    if(isset($result)){
        echo 1;
         }  
    }
    }else{
        echo 5;
}
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
                $check="select count(1) from coupen_code where coupen_name='$coupen_name' ";
                $exists=mysqli_query($this->con,$check);
                $row=mysqli_fetch_row($exists);
                if($row[0] >= 1) {
                    echo 5;
                     }else{
                $query = "INSERT INTO coupen_code(coupen_name,coupen_discount)
                VALUES ('$coupen_name','$coupen_discount')";
                $result = mysqli_query($this->con, $query); 
                echo 1;
               }
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
                header("Location: index.php");
        }else {
                echo 'Incorrect Username/password.';
        }
    }
    
    }
        
        
}

class cart extends database{

    public function __construct()
    {
     parent::__construct();   
    }

    public function customerOrderInfo()
    {
           $query="select DISTINCT Order_details.order_id, Order_details.order_date, Order_details.cust_info, customer_info.FirstName, customer_info.Email from Order_details INNER JOIN customer_info ON Order_details.cust_info=customer_info.Id"; 
            $result=mysqli_query($this->con,$query);
            while($order=mysqli_fetch_row($result)){
                $data[]=$order;
            }
           return $data;
    }

    public function OrderInfo($v_id)
    {
            $query="select Order_details.prod_info, Order_details.prod_qty,Order_details.prod_price from Order_details where order_id=".$v_id;
            $result=mysqli_query($this->con,$query);
            while($order=mysqli_fetch_row($result)){
                $sql="select pname from Product_info where Id=".$order[0];
                $result1=mysqli_query($this->con,$sql);
               $select=mysqli_fetch_row($result1);
                $order[0]=$select[0];
                $data[]=$order;
            }
           echo json_encode($data);
    }

    public function OrderpriceInfo($v_id)
    {
            $query="select order_id,prod_qty,prod_price from Order_details where order_id=".$v_id;
            $result=mysqli_query($this->con,$query);
            while($order=mysqli_fetch_row($result)){
                $data[]=$order;
            }
           return $data;
    }

}
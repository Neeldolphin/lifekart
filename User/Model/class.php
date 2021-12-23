<?php

use database as GlobalDatabase;

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

class cart extends database{
    public function __construct()
    {
     parent::__construct();   
    }

    public function view_cart($session)
    {
        if(!empty($session['cart'])){
         if(!isset($session['qty'])){
             $session['qty'] = array_fill(0, count($session['cart']), 1);
         }
         $rows=($session['cart']);
         $data=array();
         foreach($rows as $row){
        $sql = "SELECT * FROM Product_info WHERE id=".$row;
        $query = mysqli_query($this->con,$sql);
        while($row = $query->fetch_assoc()){
            $data[]=$row;
        }
         }
        return $data;
    }
}

    public function coupen_view($coupen)
    {
    $query ="SELECT * FROM  coupen_code WHERE coupen_name='$coupen'";
    $result=mysqli_query($this->con,$query);
    while($array=mysqli_fetch_row($result)){
        $data=$array;
    }
    return $data;
    }
    
    public function qty_check($id)
    {
        $query="select qty from Product_info where Id=".$id; 
        $result=mysqli_query($this->con,$query);
        $array= mysqli_fetch_array($result);
        return $array;
    }
}


class slider extends database{
    public function __construct()
    {
     parent::__construct();   
    }

    public function slidebar()
    {

        $query="select * from slider"; 
        $result=mysqli_query($this->con,$query);
        while($array=mysqli_fetch_row($result)){
            $data[]=$array;
        }
        return $data;
    }
}



class product_details extends database{
    public function __construct()
    {
     parent::__construct();   
    }

    public function group_customer()
    {
        $query="select sku from Product_Customer_Group_Price where Customer_Group=".$_SESSION['customerGroup'];
	    $result=mysqli_query($this->con,$query);
        while($array=mysqli_fetch_row($result)){
            $data[]=$array[0];
        }
         return $data;
    }

    public function group_price($SKU)
    {
      
        $query="select Group_Price from Product_Customer_Group_Price where Customer_Group=".$_SESSION['customerGroup']." AND sku=".$SKU; 
	    $result=mysqli_query($this->con,$query);
        while($array=mysqli_fetch_row($result)){
            $data=$array;
        }
         return $data;
    }

    public function category_related($id)
    {
       $query="select category from Product_info where id=".$id; 
        $result=mysqli_query($this->con,$query);
        while($category=mysqli_fetch_array($result)){
            $data[]=$category;
        }
        return $data;
    }

    public function product_Details($id)
    {
        $query="select * from Product_info where id=".$id; 
	    $result=mysqli_query($this->con,$query);
        while($array=mysqli_fetch_row($result)){
            $data=$array;
        }
        return $data;
    }
    public function product_page($id)
    {
       $query="select * from Product_info where concat(',',category,',') like '%,$id,%' ORDER BY RAND()"; 
       $result2=mysqli_query($this->con,$query);
        while($array=mysqli_fetch_row($result2)){
            $data[]=$array;
        }
        return $data;
    }
    public function search_item($Name){

    $query="select id from Product_info where pname ='".$Name."'";
      $result=mysqli_query($this->con,$query); 
      while($row=mysqli_fetch_array($result)){
        $data1=$row[0];
       }
       $query="select id from category_info where CName ='".$Name."'";
        $result1=mysqli_query($this->con,$query);     
        while($row=mysqli_fetch_array($result1)){
        $data2=$row[0];
   }
   $array=array('pid'=>$data1,'cid'=>$data2);
    return $array;    
}
    public function product_info($id,$order,$page_id)
    {
        $perPage = 5;
        if(isset($page_id)){$page=$page_id;}else{$page=1;};
        $start_from=($page-1)* $perPage;
        if ($order == 1) {
          $query="select * from Product_info where concat(',',category,',') like '%,$id,%' order by price ASC LIMIT $start_from,$perPage"; 
            $result2=mysqli_query($this->con,$query);
            while($array=mysqli_fetch_row($result2)){
                $data[]=$array;
            }
            return $data;
            }
         elseif ($order == 2) {
            $query="select * from Product_info where concat(',',category,',') like '%,$id,%' order by price DESC LIMIT $start_from,$perPage"; 
            $result2=mysqli_query($this->con,$query);
            while($array=mysqli_fetch_row($result2)){
                $data[]=$array;
            }
            return $data;
            }
        elseif ($order== 3) {
            $query="select * from Product_info where concat(',',category,',') like '%,$id,%' order by pname ASC LIMIT $start_from,$perPage"; 
            $result2=mysqli_query($this->con,$query);
            while($array=mysqli_fetch_row($result2)){
                $data[]=$array;
            }
            return $data;
            }
        elseif ($order == 4) {
            $query="select * from Product_info where concat(',',category,',') like '%,$id,%' order by pname DESC LIMIT $start_from,$perPage"; 
            $result2=mysqli_query($this->con,$query);
            while($array=mysqli_fetch_row($result2)){
                $data[]=$array;
            }
            return $data;
            }
        elseif ($order == 5) {
                $query="select * from Product_info where concat(',',category,',') like '%,$id,%' order by Position ASC LIMIT $start_from,$perPage"; 
                $result2=mysqli_query($this->con,$query);
                while($array=mysqli_fetch_row($result2)){
                    $data[]=$array;
                }
                return $data;
            }
        elseif ($order == 6) {
                $query="select * from Product_info where concat(',',category,',') like '%,$id,%' order by Position DESC LIMIT $start_from,$perPage"; 
                $result2=mysqli_query($this->con,$query);
                while($array=mysqli_fetch_row($result2)){
                    $data[]=$array;
                }
                return $data;
            }else {
                $query="select * from Product_info where concat(',',category,',') like '%,$id,%' LIMIT $start_from,$perPage"; 
                $result2=mysqli_query($this->con,$query);
                while($array=mysqli_fetch_row($result2)){
                    $data[]=$array;
                }
                return $data;
                }
        }
        public function Pagination($id)
        {
            $perPage = 5;
            $query = "select * from Product_info where concat(',',category,',') like '%,$id,%'"; 
            $result = mysqli_query($this->con, $query);
            $totalRecords = mysqli_num_rows($result);
            $totalPages = ceil($totalRecords/$perPage);
            return $totalPages;
        }
}


class category_main extends database {
    public function __construct()
    {
     parent::__construct();   
    }

    public function category1()
    {
       $query="select * from category_info where id=1";
        $result=mysqli_query($this->con,$query);
        while($category=mysqli_fetch_row($result)){
            $data[]=$category;
        }
        return $data;
    } 

    public function category2()
    {
       $query="select * from category_info where id=6";
        $result=mysqli_query($this->con,$query);
        while($category=mysqli_fetch_row($result)){
            $data[]=$category;
        }
        return $data;
    } 

    public function categoryMain()
    {
       $query="select * from category_info"; 
        $result=mysqli_query($this->con,$query);
        while($category=mysqli_fetch_row($result)){
            $data[]=$category;
        }
        return $data;
    }

    public function category_info($id)
    {
        $query="select * from category_info where id=".$id; 
        $result=mysqli_query($this->con,$query);
        while($category=mysqli_fetch_row($result)){
            $data=$category;
        }
        return $data;
    }
    
}

class log_in extends database {
    public function __construct()
    {
     parent::__construct();   
    }
    public function signIn($post,$request)
    {
        if (isset($post['username'])) {
            $username = stripslashes($request['username']);    // removes backslashes
            $username = mysqli_real_escape_string($this->con, $username);
            $password = stripslashes($request['password']);
            $password = mysqli_real_escape_string($this->con, $password);
        $query = "SELECT * FROM customer_info WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($this->con, $query) ;
        // $rows = mysqli_num_rows($result);
        $array = mysqli_fetch_array($result);
        if (mysqli_num_rows($result)>0) {
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $array[0];
            $_SESSION['customerGroup'] = $array[8];
            // Redirect to user home page
            header("Location: index.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  <p class='link'>Click here to <a href='index.php'>Home</a> again.</p>
                  </div>";
        }
    }
    }


    public function signUp($request)
    {
           if (isset($request['username'])) {
                 // removes backslashes
                $FirstName = stripslashes($request['FirstName']);
                $FirstName = mysqli_real_escape_string($this->con, $FirstName);
                $LastName = stripslashes($request['LastName']);
                $LastName = mysqli_real_escape_string($this->con, $LastName);
                $username = stripslashes($request['username']);
                //escapes special characters in a string
                $username = mysqli_real_escape_string($this->con, $username);
                $email    = stripslashes($request['Email']);
                $email    = mysqli_real_escape_string($this->con, $email);
                $phone = stripslashes($request['phone_number']);
                $phone = mysqli_real_escape_string($this->con, $phone);
                $Address = stripslashes($request['Address']);
                $Address = mysqli_real_escape_string($this->con, $Address);
                $country = stripslashes($request['country']);
                $country = mysqli_real_escape_string($this->con, $country);
                $password = stripslashes($request['password']);
                $password = mysqli_real_escape_string($this->con, $password);

                $check="select count(1) from customer_info where Email='$email' ";
                $exists=mysqli_query($this->con,$check);
                $row=mysqli_fetch_row($exists);
                if($row[0] >= 1) {
                    echo "<div class='form'>
                    <h3>Email already exists!!!!!!!</h3><br/>
                    </div>";;
                     }else{
       $query    = "INSERT into customer_info (FirstName,LastName,Email,username,phone_number,Address,country,password)
                     VALUES ('$FirstName','$LastName','$username','$email','$phone ','$Address','$country', '" . md5($password) . "')";           
        $result   = mysqli_query($this->con, $query); 
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='signUp.php'>Sign Up</a> again.</p>
                  </div>";
        }
           }
        }
}
}
?>
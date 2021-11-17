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
         //initialize total
        if(!empty($session['cart'])){
        //create array of initail qty which is 1
         if(!isset($session['qty'])){
             $session['qty'] = array_fill(0, count($session['cart']), 1);
         }
        $sql = "SELECT * FROM Product_info WHERE id IN (".implode(',',$session['cart']).")";
        $query = $this->con->query($sql);
        $data=array();
        while($row = $query->fetch_assoc()){
            $data[]=$row;
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
        $query="select qty from Product_info where id=".$id; 
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
        $query="select * from Product_info where category =$id"; 
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
    public function product_info($id,$order)
    {
        
        if ($order == 1) {
          $query="select * from Product_info where category =$id order by price ASC"; 
            $result2=mysqli_query($this->con,$query);
            while($array=mysqli_fetch_row($result2)){
                $data[]=$array;
            }
            return $data;
            }
         elseif ($order == 2) {
            $query="select * from Product_info where category =$id order by price DESC"; 
            $result2=mysqli_query($this->con,$query);
            while($array=mysqli_fetch_row($result2)){
                $data[]=$array;
            }
            return $data;
            }
        elseif ($order== 3) {
            $query="select * from Product_info where category =$id order by pname ASC"; 
            $result2=mysqli_query($this->con,$query);
            while($array=mysqli_fetch_row($result2)){
                $data[]=$array;
            }
            return $data;
            }
        elseif ($order == 4) {
            $query="select * from Product_info where category =$id order by pname DESC "; 
            $result2=mysqli_query($this->con,$query);
            while($array=mysqli_fetch_row($result2)){
                $data[]=$array;
            }
            return $data;
            }else {
                $query="select * from Product_info where category =".$id; 
                $result2=mysqli_query($this->con,$query);
                while($array=mysqli_fetch_row($result2)){
                    $data[]=$array;
                }
                return $data;
                }
        }
        public function Pagination($id)
        {
            $perPage = 2;
            $query = "select * from Product_info where category =".$id; 
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
        $query = "SELECT * FROM `customer_signup` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($this->con, $query) ;
        $rows = mysqli_num_rows($result);
        $array = mysqli_fetch_array($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $array[0];
            // Redirect to user home page
            header("Location: home.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  <p class='link'>Click here to <a href='home.php'>Home</a> again.</p>
                  </div>";
        }
    }
    }


    public function signUp($FirstName,$LastName,$username,$password,$email)
    {
        $query    = "INSERT into `customer_signup` (FirstName,LastName,username, password, email)
                     VALUES ('$FirstName','$LastName','$username', '" . md5($password) . "', '$email')";           
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
?>
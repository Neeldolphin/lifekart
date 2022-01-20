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

    public function product_discount($id,$session,$price)
    {
        $sql="select product_id from cart where customer_id=".$session['id'];
        $result=mysqli_query($this->con,$sql);
        $query=mysqli_fetch_row($result);
        $check=explode(",",$query[0]);
        if (in_array($id,$check)) {
            if (count(array_keys($check, $id)) < 10) 
            {
                return $price*(1-0.1*(count(array_keys($check, $id))));   
            }else{
                return $price;
            }      
        }else{
            return $price;
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

    public function order_placed($customer_id,$product_id)
    {
        $sql="select customer_id from cart where customer_id=".$customer_id;
        $result=mysqli_query($this->con,$sql);
        if (mysqli_num_rows($result)>0) {

             $sql0="select product_id from cart where customer_id=".$customer_id;
            $result0=mysqli_query($this->con,$sql0);
             $data=mysqli_fetch_row($result0);
             $explod=explode(",",$data[0]);
             $pro_expod=explode(",",$product_id);
                  foreach($pro_expod as $p_id){
                //     if (!in_array($p_id,$explod)) {
                         array_push($explod,$p_id);
                   }       
                  $product_id=implode(",",$explod);
                  $sql1 = "UPDATE cart SET product_id='".$product_id."' where customer_id='".$customer_id."'";
                 $result1=mysqli_query($this->con,$sql1);
                  
        }else{
        $query="insert into cart (product_id,customer_id ) VALUES ('$product_id','$customer_id')"; 
        $result2=mysqli_query($this->con,$query);
         }
    }

    public function order_info($cust_info,$prod_info,$order_date,$product_qty,$product_price)
    { 
         $sql="select count(DISTINCT order_id)as order_id from Order_details";
         $result=mysqli_query($this->con,$sql);
         $vare=mysqli_fetch_row($result);
            $vare[0] +=1;
           
        $i=0;
        foreach($prod_info as $row ){
         $query="insert into Order_details (prod_info,order_id,cust_info,order_date,prod_qty,prod_price) VALUES ('$row','$vare[0]','$cust_info','$order_date','$product_qty[$i]','$product_price[$i]')"; 
         $result1=mysqli_query($this->con,$query);
        $i++;
        }
    }

    public function customerOrderInfo($c_id)
    {
            $query="select DISTINCT order_id,order_date from Order_details where cust_info=".$c_id; 
            $result=mysqli_query($this->con,$query);
            while($order=mysqli_fetch_row($result)){
                $data[]=$order;
            }
           return $data;
    }

    public function product_name($id)
    {
        $query="select pname from Product_info where Id=".$id; 
            $result=mysqli_query($this->con,$query);
            while($order=mysqli_fetch_row($result)){
                $data[]=$order;
            }
           return $data;
    }

    public function OrderInfo($v_id)
    {
            $query="select order_id,prod_info,prod_qty,prod_price from Order_details where order_id=".$v_id; 
            $result=mysqli_query($this->con,$query);
            while($order=mysqli_fetch_row($result)){
                $data[]=$order;
            }
           return $data;
    }

    public function customerOrderCount($c_id)
    {
         $query="select count(DISTINCT order_id)as order_id from Order_details where cust_info=".$c_id; 
            $result=mysqli_query($this->con,$query);
            while($order=mysqli_fetch_row($result)){
                $data=$order;
            }
           return $data;
    }

    public function Orderinvoice()
    {
            $query="select count(DISTINCT order_id)as order_id from Order_details"; 
            $result=mysqli_query($this->con,$query);
            while($order=mysqli_fetch_row($result)){
                $data=$order;
            }
           return $data;
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

    public function price_range($id)
    {
        $query2="select MIN(price) from Product_info where concat(',',category,',') like '%,$id,%'"; 
        $select2=mysqli_query($this->con,$query2);
        $sql2=mysqli_fetch_row($select2);
       
        $query3="select Max(price) from Product_info where concat(',',category,',') like '%,$id,%'"; 
        $select3=mysqli_query($this->con,$query3);
        $sql3=mysqli_fetch_row($select3);
         return array($sql2[0],$sql3[0]);
    }

    public function product_info($id,$order,$page_id,$pricestart,$priceend)
    {
        if ($pricestart=='' && $priceend=='') {
            $pricestart=0;
            $priceend=5000; 
        }
        $price1=$pricestart;
	    $price2=$priceend;

        $perPage = 8;
        if(isset($page_id)){$page=$page_id;}else{$page=1;};
        $start_from=($page-1)* $perPage;
        if ($order == 1) {
            $query="select * from Product_info where price BETWEEN '$price1' AND '$price2' AND concat(',',category,',') like '%,$id,%' order by price ASC LIMIT $start_from,$perPage"; 
            $result2=mysqli_query($this->con,$query);
            while($array=mysqli_fetch_row($result2)){
                $data[]=$array;
            }
            return $data;
            }
         elseif ($order == 2) {
            $query="select * from Product_info where price BETWEEN '$price1' AND '$price2' AND concat(',',category,',') like '%,$id,%' order by price DESC LIMIT $start_from,$perPage"; 
            $result2=mysqli_query($this->con,$query);
            while($array=mysqli_fetch_row($result2)){
                $data[]=$array;
            }
            return $data;
            }
        elseif ($order== 3) {
            $query="select * from Product_info where price BETWEEN '$price1' AND '$price2' AND concat(',',category,',') like '%,$id,%' order by pname ASC LIMIT $start_from,$perPage"; 
            $result2=mysqli_query($this->con,$query);
            while($array=mysqli_fetch_row($result2)){
                $data[]=$array;
            }
            return $data;
            }
        elseif ($order == 4) {
            $query="select * from Product_info where price BETWEEN '$price1' AND '$price2' AND concat(',',category,',') like '%,$id,%' order by pname DESC LIMIT $start_from,$perPage"; 
            $result2=mysqli_query($this->con,$query);
            while($array=mysqli_fetch_row($result2)){
                $data[]=$array;
            }
            return $data;
            }
        elseif ($order == 5) {
                $query="select * from Product_info where price BETWEEN '$price1' AND '$price2' AND concat(',',category,',') like '%,$id,%' order by Position ASC LIMIT $start_from,$perPage"; 
                $result2=mysqli_query($this->con,$query);
                while($array=mysqli_fetch_row($result2)){
                    $data[]=$array;
                }
                return $data;
            }
        elseif ($order == 6) {
                $query="select * from Product_info where price BETWEEN '$price1' AND '$price2' AND concat(',',category,',') like '%,$id,%' order by Position DESC LIMIT $start_from,$perPage"; 
                $result2=mysqli_query($this->con,$query);
                while($array=mysqli_fetch_row($result2)){
                    $data[]=$array;
                }
                return $data;
            }else {
                 $query="select * from Product_info where price BETWEEN '$price1' AND '$price2' AND concat(',',category,',') like '%,$id,%' LIMIT $start_from,$perPage"; 
                $result2=mysqli_query($this->con,$query);
                while($array=mysqli_fetch_row($result2)){
                    $data[]=$array;
                }
                return $data;
                }
        }

        public function Pagination($id)
        {
            $perPage = 8;
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
    
    // public function updatepricesort($post)
    // {
    //     $select ="select * from Product_info where category=".$post['cate_id']." AND price BETWEEN '$price1' AND '$price2'" ;
    //     $result=mysqli_query($this->con,$select);
    //     while($category=mysqli_fetch_row($result)){
    //         $data=$category;
    //     }
    //     return $data;
    // }

}

class Blog_info extends database {
    public function __construct()
    {
     parent::__construct();   
    }

    public function search_Blog($Name){

         $query="select id from Blog_info where concat(' ',B_name,' ') like '% $Name %' or concat(' ',Description,' ') like '% $Name %'";
          $result=mysqli_query($this->con,$query); 
          while($row=mysqli_fetch_row($result)){
            $data1[]=$row[0];
           }
        return $data1;    
    }

public function blog_tags()
{
    $query="select * from Tags"; 
    $result=mysqli_query($this->con,$query);
    while($category=mysqli_fetch_row($result)){
        $data[]=$category;
    }
    return $data;    
}

public function posts_tags($id)
{ 
    $data=array();
    $value=explode(",",$id); 
    foreach($value as $ide){
    $query="select * from Tags where id=".$ide.";"; 
    $result=mysqli_query($this->con,$query);
    $category=mysqli_fetch_array($result);
        $data[]=$category;
    }
    return $data;    
    
}

public function Posted_in($value)
{
    $query="select * from Category_blog where id=".$value.";"; 
    $result=mysqli_query($this->con,$query);
    while($category=mysqli_fetch_row($result)){
        $data[]=$category;
    }
    return $data;    
}

public function Posted_By($value)
{
    $query="select * from writer where id=".$value.";"; 
    $result=mysqli_query($this->con,$query);
    while($category=mysqli_fetch_row($result)){
        $data[]=$category;
    }
    return $data;    
}

public function writer_info($value)
{
    $query="select * from writer where id=".$value.";"; 
    $result=mysqli_query($this->con,$query);
    while($category=mysqli_fetch_row($result)){
        $data[]=$category;
    }
    return $data;    
}

public function blog_category()
{
    $query="select * from Category_blog"; 
    $result=mysqli_query($this->con,$query);
    while($category=mysqli_fetch_row($result)){
        $data[]=$category;
    }
    return $data;    
}
public function blog_post()
{
    $query="select * from Blog_info ORDER BY RAND()"; 
    $result=mysqli_query($this->con,$query);
    while($category=mysqli_fetch_row($result)){
        $data[]=$category;
    }
    return $data;    
}

public function Load_more_data($post)
{
if (isset($post['row'])) {
    $start = $post['row'];
    $limit = 3;
     $query = "SELECT * FROM Blog_info ORDER BY id desc LIMIT ".$start.",".$limit;
    $result = mysqli_query($this->con,$query);
    $data="";
    if ($result->num_rows > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
      $data.="<div class='Blog_Posts mt-3'>
      <div>
          <div>
               <img class='blogpostimg' src='http://localhost/lifekart/User/images/".$row['B_image']."'>
          </div>
          <div class='p-4'>";
          $id=$row['tags'];
          $cate=new Blog_info();
          $rows=$cate->posts_tags($id);
           foreach($rows as $tag){
        $data.="<a class='btn btn_tag' href='http://localhost/lifekart/User/View/blogTag.php?blogTagId=".$tag['id']."'>".$tag['tags']."</a>
           ";
      }
           $data.="</div>
          <div class='p-3'>
              <h4><a href='http://localhost/lifekart/User/View/blog_details.php?postid=".$row['id']."'>".$row['B_name']."</a></h4>
              <div class='mt-3 mb-3'>
              ".$row['info']."
              </div>
              ".$cate->time_elapsed_string($row['created_at'])."
              <div class='row mt-4'>
                      <div class='col-md-3'>";
                        $value=$row['category'];
                        $rows=$cate->Posted_in($value);
                        foreach($rows as $category){
                           $data.="<h6>Posted in : <a href='http://localhost/lifekart/User/View/blogCategory.php?blogCategoryId=".$category[0]."'>".$category[2]."</a></h6>
                        ";}
                           $data.="</div>
                      <div class='col-md-3'>";
                      $value=$row['Author'];
                      $rows=$cate->Posted_By($value);
                      foreach($rows as $category){
                           $data.="<h6><i class='fas fa-user-alt'></i>  By : <a href='http://localhost/lifekart/User/View/blogWriter.php?blogAuthorId=".$category[0]."'>".$category[2]."</a></h6>
                           ";}
                           $data.="</div>
                      <div class='col-md-3'>
                         <h6><a href='http://localhost/lifekart/User/View/blog_details.php?postid=".$row['id']."#comments'><i class='fas fa-comments'></i>  comment</a></h6>   
                      </div>
                      <div class='col-md-3'>
                      <h6><a href='http://localhost/lifekart/User/View/blog_details.php?postid=".$row['id']."'>READ MORE <i class='fas fa-arrow-right'></i></a></h6> 
                      </div>
               </div>
          </div>
      </div>
  </div>";
       }
    }
    return $data;
  }
}

public function blog_post_tmp()
{
    $count_query = "SELECT count(*) as allcount FROM Blog_info";
    $count_result = mysqli_query($this->con,$count_query);
    $count_fetch = mysqli_fetch_array($count_result);
    $postCount = $count_fetch['allcount'];
    return $postCount;  
}

public function blog_post_main()
{
 
      $query = "SELECT * FROM Blog_info ORDER BY id desc LIMIT 0,3"; 
      $result = mysqli_query($this->con,$query);
      if ($result->num_rows > 0) {
        while($row = mysqli_fetch_row($result)){ 
        $data[]=$row;
      }
        return $data;
    }
}

public function recent_blog_post()
{
    $query="select * from Blog_info ORDER BY created_at desc"; 
    $result=mysqli_query($this->con,$query);
    while($category=mysqli_fetch_row($result)){
        $data[]=$category;
    }
    return $data;    
}

public function post_info($id)
{
    $query="select * from Blog_info where id=".$id; 
    $result=mysqli_query($this->con,$query);
    while($category=mysqli_fetch_row($result)){
        $data[]=$category;
    }
    return $data;    
}

public function search_post_info($id)
{
    $value=explode(",",$id);
    foreach($value as $id){
    $query="select * from Blog_info where id=".$id.";"; 
    $result=mysqli_query($this->con,$query);
    while($category=mysqli_fetch_row($result)){
        $data[]=$category;
    }
}
    return $data;    
}

public function category_Blog_info($id)
{
    $query="select * from Blog_info where category=".$id; 
    $result=mysqli_query($this->con,$query);
    while($category=mysqli_fetch_row($result)){
        $data[]=$category;
    }
    return $data;    
}

public function Writer_Blog_info($id)
{
    $query="select * from Blog_info where Author=".$id; 
    $result=mysqli_query($this->con,$query);
    while($category=mysqli_fetch_row($result)){
        $data[]=$category;
    }
    return $data;    
}

public function tag_Blog_info($id)
{
    $query=" select * from Blog_info where concat(',',tags,',') like '%,$id,%'"; 
    $result=mysqli_query($this->con,$query);
    while($category=mysqli_fetch_row($result)){
        $data[]=$category;
    }
    return $data;    
}

public function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    public function comment_Blog($post)
    {
        $date= date("Y/m/d");
        $query="INSERT INTO comment (User_id,Comm_name,Comm_email,comment,Blog_id,time) VALUES ('$post[user_id]', '$post[name]', '$post[email]', '$post[comment]', '$post[blog_id]','$date')";
        $result= mysqli_query($this->con, $query);
        echo 1;
    }
    
    public function comment_Blog_reply($post)
    {
        $date= date("Y/m/d");
        $query="INSERT INTO reply (Comm_name,Comm_email,comment,Comm_id,time) VALUES ('$post[name]', '$post[email]', '$post[comment]', '$post[Comm_id]','$date')";
        $result= mysqli_query($this->con, $query);
        echo 1;
    }

    public function blog_comment($id)
    {
        $query=" select * from comment where Blog_id=".$id; 
        $result=mysqli_query($this->con,$query);
        while($category=mysqli_fetch_row($result)){
            $data[]=$category;
        }
        return $data;   
    }

    public function blog_reply($id)
    {
        $query=" select * from reply where id=".$id; 
        $result=mysqli_query($this->con,$query);
        while($category=mysqli_fetch_row($result)){
            $data[]=$category;
         }
        return $data;   
    }

    public function getReply($id)
    {
        $query=" select * from reply where Comm_id=".$id; 
        $result=mysqli_query($this->con,$query);
        while($category=mysqli_fetch_row($result)){
            $data[]=$category;
         }
        return $data;   
    }

    public function blog_recent_comment()
    {
        $query=" select * from comment ORDER BY time ASC "; 
        $result=mysqli_query($this->con,$query);
        while($category=mysqli_fetch_row($result)){
            $data[]=$category;
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
        $array = mysqli_fetch_array($result);
        if (mysqli_num_rows($result)>0) {
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $array[0];
            $_SESSION['customerGroup'] = $array[8];
            $_SESSION['firstname']=$array[1];
            $_SESSION['lastname']=$array[2];
            $_SESSION['Email']=$array[3];
            $_SESSION['phone']=$array[5];
            $_SESSION['address']=$array[6];
            $_SESSION['country']=$array[7];
            // Redirect to user home page
            echo "<div class='form'>
            <h3>You are login successfully.</h3><br/>
            <p class='link'>Click here to <a href='index.php'><b>Home</b></a></p>
            </div>";
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'> Forgot Password<b>?</b> <a href='forgot.php'>Click here</a>.</p>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  <p class='link'>Click here to <a href='index.php'>Home</a> again.</p>
                  </div>";
        }
    }
    }

    public function passCheck($post,$request)
    {
        if (isset($post['username'])) {
            $username = stripslashes($request['username']);    // removes backslashes
            $username = mysqli_real_escape_string($this->con, $username);
            $password = stripslashes($request['password']);
            $password = mysqli_real_escape_string($this->con, $password);

        $query = "SELECT * FROM customer_info WHERE username='$username'";
        $result = mysqli_query($this->con, $query) ;
        $array = mysqli_fetch_array($result);
        if (mysqli_num_rows($result)>0) {
            $query = "UPDATE customer_info set password='" . md5($password) . "' where username='".$username."'";        
            $result = mysqli_query($this->con, $query); 
            
            // Redirect to user home page
            echo "<div class='form'>
            <h3>You are new passwoard set successfully.</h3><br/>
            <p class='link'>Click here to <a href='index.php'><b>Home</b></a></p>
            </div>";
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username.</h3><br/>
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
                $create_at=date("Y/m/d");
                $update_at=date("Y/m/d");

                $check="select count(1) from customer_info where Email='$email' ";
                $exists=mysqli_query($this->con,$check);
                $row=mysqli_fetch_row($exists);
                if($row[0] >= 1) {
                    echo "<div class='form'>
                    <h3>Email already exists!!!!!!!</h3><br/>
                    </div>";
                     }else{    
       $query    = "INSERT into customer_info (FirstName,LastName,Email,username,phone_number,Address,country,password,create_at,update_at)
                     VALUES ('$FirstName','$LastName','$email','$username','$phone ','$Address','$country', '".md5($password) ."','$create_at','$update_at')";           
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

public function custinfo($id)
{
   $query="select * from customer_info where id=".$id;
    $result=mysqli_query($this->con,$query);
    while($category=mysqli_fetch_row($result)){
        $data=$category;
    }
    return $data;
}

public function update($post)
{
    $query = "UPDATE customer_info SET FirstName='" . $post['FirstName'] . "', LastName='" . $post['LastName'] . "', Email='" . $post['Email'] . "', phone_number='" . $post['phone_number'] . "', Address='" . $post['Address'] . "', country='" . $post['country'] . "' WHERE Id=".$post['Id'];
    $result = mysqli_query($this->con, $query);
}

}
?>
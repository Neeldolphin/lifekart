<?php
include 'header.php';
 include 'auth_session.php';
 if(!isset($_SESSION['username'])){?>
<a href="login.php">Login</a>
<?php }
include 'sidebar.php';
include '../Model/class.php';?> 

<div class="main-section">
    <div class="dashbord">
      <div class="icon-section">
        <i class="fa fa-product-hunt" aria-hidden="true"></i><br>
            <small>Product</small>
              <p>
                <?php
                 $cate=new login();                                                  
                 $rows=$cate->d_product();
                 echo $rows[0];
                ?></p>
        </div>
      <div class="detail-section">
        <a href="http://localhost/lifekart/Admin/View/product.php">More Info </a>
      </div>
    </div>
    <div class="dashbord dashbord-green">
      <div class="icon-section">
        <i class="fa fa-tasks" aria-hidden="true"></i><br>
          <small>Category</small>
            <p><?php                                                
                 $rows=$cate->d_category();
                 echo $rows[0];
                ?></p>
      </div>
    <div class="detail-section">
      <a href="http://localhost/lifekart/Admin/View/category.php">More Info </a>
    </div>
  </div>
    <div class="dashbord dashbord-skyblue">
      <div class="icon-section">
        <i class="fa fa-user" aria-hidden="true"></i><br>
          <small>Customer</small>
            <p><?php                                                
                 $rows=$cate->d_customer();
                 echo $rows[0];
                ?></p>
      </div>
      <div class="detail-section">
        <a href="http://localhost/lifekart/Admin/View/customer.php">More Info </a>
      </div>
  </div>
  <div class="dashbord dashbord-blue">
    <div class="icon-section">
      <i class="fa fa-users" aria-hidden="true"></i><br>
        <small>Customer Group</small>
          <p><?php                                                
                 $rows=$cate->d_customer_grp();
                 echo $rows[0];
                ?></p>
    </div>
    <div class="detail-section">
      <a href="http://localhost/lifekart/Admin/View/custom_grp.php">More Info </a>
    </div>
  </div>
  <div class="dashbord dashbord-red">
    <div class="icon-section">
      <i class="fa fa-shopping-cart" aria-hidden="true"></i><br>
        <small>Order</small>
          <p><?php                                                
                 $rows=$cate->d_order();
                 echo $rows[0];
                ?></p>
    </div>
    <div class="detail-section">
      <a href="http://localhost/lifekart/Admin/View/Order.php">More Info </a>
    </div>
</div>
</div>
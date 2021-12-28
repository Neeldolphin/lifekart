<div class="container main">
<div class="block-html-top col-md-12 mt-3 p-2">
    <div class="row">
        <div class="block-top1 col-md-4 text-center">
            <span><i class="fas fa-truck mr-2"></i>Free Shipping on Orders Over ₹99</span>
        </div>  
        <div class="block-top2 col-md-4 text-center">
            <span><i class="fas fa-dollar-sign mr-2"></i>Up to 40% OFF on Selected Items</span>
        </div>   
        <div class="block-top3 col-md-4 text-center">    
            <span><i class="fas fa-graduation-cap mr-2"></i>15% OFF Student Discount</span>
        </div>   
    </div>
</div>
<?php 
include 'header.php';
 include_once 'navbar.php';
//  print_r($_SESSION);
 if(isset($_SESSION["username"])){
    ?>
    <div class="container">                
    <div class="contentbar">  
    <h1 class="page-header text-center">Cart Details</h1>              
            <!-- Start row -->
            <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <form method="POST" action="save_cart.php">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th width=1%;>No.</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th width=5%;>Quantity</th>
                        <th width=5%;>Subtotal</th>
                        <th width=1%;>Remove</th>
                    </thead>
                    <tbody>
                    <p id="msg1" class="msg1"></p></td>
                        <?php                          
                                  $sr=1;
                                 $index=0;
                                 $shipping=0;
                                $total=0;
                                $session=$_SESSION;
                                $view= new cart();  
                                $rows=$view->view_cart($session);
                                if(!empty($_SESSION['cart'])){
                                 foreach($rows as $row){
                                  $cate=new product_details();
                                  $ows=$cate->group_customer();
                                  if(in_array($row['SKU'],$ows)){
                                   $SKU=$row['SKU'];
                                   $gprice=$cate->group_price($SKU);
                                   $row['price']=$gprice[0];
                                  }
                                   $row['price']=$view->product_discount($row['Id'],$session,$row['price']);
                                    ?>
                                    <tr>
                                    <td><?php echo $sr; ?></td>
                                        <td><?php echo $row['pname']; ?></td>
                                        <td><?php echo number_format($row['price'], 2); ?></td>
                                        <td><input type="text" class="form-control quantity1" data-id="<?php echo $row['Id']?>" required=""  value="<?php echo $_SESSION['qty'][$index]; ?>" name="qty_<?php echo $index; ?>"></td>
                                        <input type="hidden" class="msg" >
                                        <input type="hidden" name="indexes[]"  value="<?php echo $index; ?>">
                                        <td><?php echo number_format($_SESSION['qty'][$index]*$row['price'], 2); ?></td>
                                        <?php $total+=$_SESSION['qty'][$index]*$row['price']; ?>
                                        <?php if(isset($_SESSION['coupen_discount'])){ ?>
                                        <?php $coupen =$total-($total*$_SESSION['coupen_discount'])/100; ?>
                                        <?php $discount =($total*$_SESSION['coupen_discount'])/100; ?>
                                        <?php }
                                        ?>
                                        <td>
                                        <input type="hidden" class="DeleteId" value="<?php echo $row['Id'];?>">
                                        <input type="hidden" class="indexId" value="<?php echo $index;?>">
								                    	<a class="btn btn-danger btn-sm deleteItem"><span class="glyphicon glyphicon-trash">X</span></a>
									                  </td>
                                    </tr>
                                    <?php
                                    $index ++;
                                    $sr ++;
                                }
                             }
                           ?>
                        <tr>
                            <td colspan="4" align="right"><b>Total</b></td>
                            <td><b><?php echo number_format($total, 2); ?></b></td>
                        </tr>
                        <tr>
                        <?php if(isset($discount)){ ?>
                        <td colspan="4" align="right"><b>Discount</b></td>
                        <td><b><?php echo number_format($discount, 2); ?></b></td>
                        <?php }?>
                        </tr>
                        <tr>
                        <?php if(isset($coupen)){ ?>
                        <td colspan="4" align="right"><b>Paiable Amount</b></td>
                        <td><b><?php echo number_format($coupen, 2); ?></b></td>
                        <?php }?>
                        </tr>
                    </tbody>
                        </table>
                <button type="submit" class="btn btn-success qtybutton" name="save">Save Changes</button>
                <a class="btn btn-danger clearCart"><span class="glyphicon glyphicon-trash"></span> Clear Cart</a>
                <a href="http://localhost/lifekart/User/View/invoice.php" class="btn btn-success invoice" name="invoice">Invoice</a>
                </form>
            </div>
            <div class="col-sm-3 offset-md-1">
                <div class="form-group">
                <label for="promo_code"><b>Apply Promocode:</b></label> 
                <td><input type="text" class="form-control" id="coupen_code"  placeholder="Enter Promocode" name="coupen_code"></td>
                <p id="mes"></p>
                <td><button class="btn btn-success btn-sm" id="apply" >Apply</button></td>
                <?php if(isset($_SESSION['coupen_name'])){ ?>
                <label>Applied Promocode is:<?php echo $_SESSION['coupen_name']?></label> 
                <td><button id="remove" class="btn btn-danger btn-sm" >Remove</button></td>
                <?php }?>
            </div>
            </div>
        </div>
            <!-- End row -->
        </div>
        
        <?php 
 }else{
     ?>
     <div>
     <h4 align="center"><a href="http://localhost/lifekart/User/View/login.php">Login First</a> </h4>
     </div>
     <?php }?>
    
     <div class="footer">
<div class="footer-middle">
    <div class="container">
       <div class="row mt-4 mb-4">
            <div class="col-lg-4"><div class="widget widget-block">
  <div class="block">
    <div class="porto-block">
      <div class="row">
        <div class="col-md-12">
          <div class="wpb_wrapper vc_column-inner">
            <div class="wpb_single_image wpb_content_element vc_align_left mb-4">
              <div class="wpb_wrapper">
                <a href="#" target="_self">
                  <div class="vc_single_image-wrapper vc_box_border_grey mt-2">
                    <img src="http://localhost/lifekart/User/images/download.png" style="max-width:111px;display: block;">
                  </div>
                </a>
              </div>
            </div>
            <p class="vc_custom_heading align-left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent pulvinar feugiat quam, vitae aliquam urna egestas nec. Phasellus sit amet consequat tortor.</p>
            <div class="vc_row wpb_row vc_inner row">
              <div class="col-md-2-5">
                <div class="wpb_wrapper vc_column-inner">
                  <h6 style="font-weight: 600;" class="vc_custom_heading text-color-dark mb-0 align-left text-uppercase">questions?</h6>
                  <h4 style="font-size: 22px; line-height: 1.4; font-weight: 700;" class="vc_custom_heading text-color-primary mb-4 mb-md-0 align-left">(123) 456-7890</h4>
                </div>
              </div>
              <div class="col-md-3-5">
                <div class="wpb_wrapper vc_column-inner">
                  <h6 style="font-weight: 600; margin-bottom: 1px;" class="vc_custom_heading text-color-dark align-left text-uppercase">payment methods</h6>
                  <div class="wpb_single_image wpb_content_element vc_align_left mb-0 ml-3 mt-2">
                    <div class="wpb_wrapper">
                      <div class="vc_single_image-wrapper vc_box_border_grey">
                        <img src="https://www.portotheme.com/magento2/porto/pub/media/wysiwyg/smartwave/porto/homepage/24/shop24_payment_logo.jpg">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="col-lg-2">
  <div class="widget_text widget widget_custom_html">
  <h4 class="widget-title">My Account</h4>
  <div class="textwidget custom-html-widget">
    <ul class="listremove">
      <li><a href="#">My Account</a></li>
      <li><a href="#">Track Your Order</a></li>
      <li><a href="#">Payment Methods</a></li>
      <li><a href="#">Shipping Guide</a></li>
      <li><a href="#">FAQs</a></li>
      <li><a href="#">Product Support</a></li>
      <li><a href="#">Privacy</a></li>
    </ul>
  </div>
</div>
</div>
<div class="col-lg-3">
  <div class="widget widget_text">
  <h4 class="widget-title">About</h4>
  <div class="textwidget">
    <ul class="listremove">
      <li><a title="About us" href="#">About Porto</a></li>
      <li><a href="#">Our Guarantees</a></li>
      <li><a href="#">Terms And Conditions</a></li>
      <li><a href="#">Privacy policy</a></li>
      <li><a href="#">Return Policy</a></li>
      <li><a href="#">Intellectual Property Claims</a></li>
      <li><a href="#">Site Map</a></li>
    </ul>
  </div>
</div>
</div>
<div class="col-lg-3">
  <div class="widget_text widget widget_custom_html">
  <h4 class="widget-title">Features</h4>
  <div class="textwidget custom-html-widget">
    <ul class="listremove">
      <li><a href="#">Super Fast Magento Theme</a></li>
      <li><a href="#">1st Fully working Ajax Theme</a></li>
      <li><a href="#">36 Unique Shop Layouts</a></li>
      <li><a href="#">Powerful Admin Panel</a></li>
      <li><a href="#">Mobile &amp; Retina Optimized</a></li>
    </ul>
  </div>
</div>
</div>     
       </div>
        </div>
    </div>
    <div class="footer-bottom bg-light">
        <div class="container">
           <address>© All Rights Reserved</address>
                    </div>
    </div>
    </div>

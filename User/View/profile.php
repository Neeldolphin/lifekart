<div class="profile">
<?php
include 'header.php';
include 'navbar.php';
$id=$_SESSION['id'];
$session=$_SESSION;
$sign=new log_in();
$ex=$sign->custinfo($id);
?>
<div class="form customerInfo1" action="" method="post">
<h3>Customer Profile</h3>
<div>
        <div class="row">
          <div class="col-md-6">
                <p><b>First Name :</b><?php echo $ex[1];?> </p>
                <p><b>Last Name :</b><?php echo $ex[2];?> </p> 
                <p><b>User Name :</b><?php echo $ex[4];?> </p>
                <p><b>Email :</b> <?php echo $ex[3];?></p>  
          </div>
          <div class="col-md-6">
                <p><b>Number :</b> <?php echo $ex[5];?></p>
                <p><b>Address :</b> <?php echo $ex[6];?></p>
                <p><b>country :</b> <?php echo $ex[7];?></p>
          </div>       
        </div>
        <button class="customeredit" id="customeredit" style="float: right;"><i class="fas fa-pen"></i></button>
    </div>
</div>

    <form class="form customerInfo" id="customerInfo" action="" method="post">
<div>
        <div class="row">
          <div class="col-md-6">
            <input type="hidden" name="id" id="id" value="<?php echo $ex[0];?>"> 
                <p><b>First Name :</b></p> <input type="text" id="FirstName" name="FirstName" value="<?php echo $ex[1];?>"/>
                <p><b>Last Name :</b></p> <input type="text" id="LastName" name="LastName" value="<?php echo $ex[2];?>"/>
                <p><b>User Name :</b></p> <input type="text" id="username" name="username" value="<?php echo $ex[4];?>"/>
                <p><b>Email :</b></p> <input type="text" id="Email" name="Email" value="<?php echo $ex[3];?>"/>
          </div>
          <div class="col-md-6">
                <p><b>Number :</b></p> <input type="text" id="phone_number" name="phone_number" value="<?php echo $ex[5];?>"/>
                <p><b>Address :</b></p> <input type="text" id="Address" name="Address" value="<?php echo $ex[6];?>"/>
                <p><b>country :</b></p><input type="text" id="country" name="country" value="<?php echo $ex[7];?>"/>
          </div>       
        </div>
        <button type="submit" name="submit" data-id="<?php echo $ex[0];?>" class="btn-success btn" id="save" style="float: right;" >save</button>
    </div>
    </form>
</div>


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
<div class="signuppage">
<?php
include 'header.php';
include 'navbar.php';
        $request=$_REQUEST;
        $sign_up=new log_in();
        $sign_up->signUp($request);
?>
    <form class="form signupform" id="signup" action="" method="post" enctype="multipart/form-data">
        <h1 class="login-title">Sign Up</h1>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">First Name<span style=" color:red;" id="star">*</span></label>
                <input type="text" id="FirstName" class="form-control" name="FirstName" placeholder="FirstName">
            </div>
            <div class="form-group">
                <label class="control-label">Last Name</label>
                <input type="text" id="LastName" class="form-control" name="LastName" placeholder="LastName"> 
            </div>
            <div class="form-group">
                <label class="control-label">User Name<span style=" color:red;" id="star">*</span></label>
                <input type="text" id="username" class="form-control" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label class="control-label">Email<span style=" color:red;" id="star">*</span></label>
                <input type="text" id="Email" class="form-control" name="Email" placeholder="Email Address">
            </div>
            <div class="form-group">
                <label class="control-label">Number<span style=" color:red;" id="star">*</span></label>
                <input type="number" id="phone_number" class="form-control" name="phone_number" placeholder="Number" min="7000000000" max="9999999999">
          </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Address</label>
                <textarea class="form-control" id="Address" rows="2" cols="50" name="Address" placeholder="Address"></textarea>
            </div>
            <div class="form-group">
                <label class="control-label">country<span style=" color:red;" id="star">*</span></label>
                <input type="text" class="form-control" id="country" name="country" placeholder="country" >
            </div>
            <div class="form-group">
                <label class="control-label">Password<span style=" color:red;" id="star">*</span></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
                <input type="submit" name="submit" value="Register" class="login-button Register">
                <p class="link"><a href="login.php">Click to Login</a></p>    
        </div>   
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
           <address>?? All Rights Reserved</address>
                    </div>
    </div>
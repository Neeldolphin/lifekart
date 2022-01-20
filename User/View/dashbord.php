<?php
include 'header.php';
include 'navbar.php';
?>
<div class="dash">
<div class="page-wrapper mt-4" style="min-height: 464px;">
            <div class="container-fluid orderpage">
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h1 class="text-themecolor"><b>Dashboard</b></h1>
                    </div>
                </div>

                <div class="row mb-4 mt-3">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">ORDER PLACED</h4>
                                <div class="text-end">
                                <?php 
                                                    $c_id=$_SESSION['id'];
                                                    $cate=new cart();
                                                    $order=$cate->customerOrderCount($c_id);
                                          ?>
                                    <h1 class="font-light"><sup><i class="ti-arrow-up text-success"></i></sup><?php echo $order[0];?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Orders Overview</h5>
                                <div class="table-responsive m-t-30">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Order ID</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php 
                                                    $rows=$cate->customerOrderInfo($c_id);
                                                    foreach($rows as $array){
                                          ?>
                                            <tr>
                                                <td><span class="displayData" data-id="<?php echo $array[0];?>">+</span></td>
                                                <td><?php echo $array[0];?></td>
                                                <td><?php echo $array[1];?></td>
                                                <td>
                                                <table class="table child_data <?php echo $array[0];?>">
                                                  <thead>
                                                    <tr>
                                                      <th>Product</th>
                                                      <th>Quantity</th>
                                                      <th>Price</th>
                                                    </tr>
                                                  </thead>
                                              <tbody >
                                              <?php 
                                              $detail=$cate->OrderInfo($array[0]);
                                                    foreach($detail as $c_arr){
                                                      $id=$c_arr[1];
                                                      $name=$cate-> product_name($id);
                                                    foreach($name as $name_arr){
                                              ?>
                                              <tr>
                                              <td><a href="http://localhost/lifekart/User/View/productDetails.php?page=array&id=<?php echo $c_arr[1];?>"><?php echo $name_arr[0];?></a></td> 
                                              <?php } ?>
                                                <td><?php echo $c_arr[2];?></td>
                                                <td><?php echo $c_arr[3];?></td>
                                              </tr>
                                              <?php }?>
                                              </tbody>
                                              </table>
                                                 </td>
                                                 </tr> 
                                              <?php  } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
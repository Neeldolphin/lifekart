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
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include 'header.php';
?>
<?php
include 'navbar.php';
?> 
<div class="text-center">
 <?php
 include 'slidebar.php';
 ?>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
        <?php
        $id = (int)$_GET['id'];
        if(isset($_GET['page_id'])){
        $pages = $_GET['page_id'];}else{
            $pages =1;
        }
        $categoryGet=new category_main();
        $category=$categoryGet->category_info($id);
            ?>
				<div>           
                <h2><?php echo $category[1];?></h2>  
                <input type="hidden" id="sortBy" value="<?php echo $id?>">
                <input type="hidden" id="pageId" value="<?php echo $pages?>">
                <label for="dropdown">SortBy:</label>
                    <select name="dropdown" id="dropdown">
                    <option value="0"></option>
                    <?php $val=$_GET['datasend']?>
                    <option <?php if(isset($val) && $val=="1") {?> selected="selected"<?php } ?> value="1">Price:low to high</option>
                    <option <?php if(isset($val) && $val=="2") {?> selected="selected"<?php } ?> value="2">Price:high to low</option>
                    <option <?php if(isset($val) && $val=="3") {?> selected="selected"<?php } ?> value="3" >Name:ascending</option>
                    <option <?php if(isset($val) && $val=="4") {?> selected="selected"<?php } ?> value="4" >Name:descending</option>
                    <option <?php if(isset($val) && $val=="5") {?> selected="selected"<?php } ?> value="5" >Position:low to high</option>
                    <option <?php if(isset($val) && $val=="6") {?> selected="selected"<?php } ?> value="6" >Position:high to low</option>
                    </select>   
                     <div class='row'>
            <?php 
			$order = (int)$_GET['id'];
			if(isset($_GET['datasend'])){
			$order = $_GET['datasend'];}
			$id=$category[0];
			if(isset($_GET['page_id'])){
				$page_id = $_GET['page_id'];}
			$productM=new product_details();
			$rows=$productM->product_info($id,$order,$page_id);
			foreach ($rows as $array) {
            $var=unserialize($array[4]);
			if($array[9] =='Enable'){
	            ?>
				<div class="col-sm-3">
					<div class="thumb-wrapper">
						<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
					    	<div class="img-box cateimg text-center">
                <a href="http://localhost/lifekart/User/View/productDetails.php?page=array&id=<?php echo $array[0]?>"> <img src="http://localhost/lifekart/User/images/<?php echo $var[0];?>" alt="" class="img-fluid"></a>						
								</div>
								<div class="thumb-content text-center">
								<h4><a href="http://localhost/lifekart/User/View/productDetails.php?page=array&id=<?php echo $array[0]?>"><?php echo $array[1];?></a></h4>									
								<p class="item-price">Price:<?php echo $array[5];?></p>
							</div>						
						</div>
					</div>			
			 <?php }
			 }?>
        </div>
        </div>	  
        </div>	
        <?php 
        $id= (int)$_GET['id'];
        if(isset($_GET['datasend'])){
        $page_id = $_GET['datasend'];}
        ?>
        <input type="hidden" id="page" value="<?php echo $page_id?>">
        <label for="page">pages:</label>
        <nav aria-label="Page navigation example ">
        <ul class="pagination pg-blue justify-content-end">
        <?php 
        $pageGet=new product_details();
        $page=$pageGet->Pagination($id);
        $i=1;
        while($i<=$page){
        ?>        
        <li class="page-item" id="totalPages"><a class="page-link totalPages"><?php echo $i; ?></a></li>
        <?php $i++; }  ?>
            </ul>
        </nav>  
	</div>
</div>
<div class="footer mt-5">
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
                  <div class="wpb_single_image wpb_content_element vc_align_left mb-0">
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
    <div class="footer-bottom">
        <div class="container">
           <address>© All Rights Reserved</address>
                    </div>
    </div>
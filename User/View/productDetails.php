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
include 'navbar.php';
?> 

<main id="maincontent" class="page-main">
    <div class="columns">
        <div class="row">
        <div class="column_main col-md-9">

            <div class="row">
            <div class="product_media col-md-5">
            <?php
                     $id = (int)$_GET['id'];
                     $details=new product_details();
                     $array=$details->product_Details($id);
                            $var=unserialize($array[4]);
                            $i=0;
                    ?>
                    <div class="col-md-12 ">                    
                        <div id="demo" class="carousel slide" data-interval="false">
                               <div class="img_width ml-4 mt-4">
                               <div class="border p-3">
                                    <img class="img_width xzoom"  src="http://localhost/lifekart/Admin/uploads/<?php echo $var[0];?>" xoriginal="http://localhost/lifekart/Admin/uploads/<?php echo $var[0];?>">
                                    </div>
                                    </div>
                                     <div class="row allimg ml-4">
                                    <?php 
                                        $j=0;
                                        while( $j<count($var)){ 
                                        ?>
                                        <div class="xzoom-thumbs">
                                        <a data-target="#demo" data-slide-to="<?php echo $j ?>" href="http://localhost/lifekart/Admin/uploads/<?php echo $var[$j];?>">  
                                                    <img class="xzoom-gallery" id="target" width="80" src="http://localhost/lifekart/Admin/uploads/<?php echo $var[$j];?>" xpreview="http://localhost/lifekart/Admin/uploads/<?php echo $var[$j];?>"> 
                                                  </a>  
                                    </div> 
                                    <?php $j++;} ?>
                                    <div class="xzoom-thumbs">
                                    <span data-target="#demo" data-slide-to="<?php echo $j ?>">
                                    <video class="xzoom-gallery" controls>
                                        <source src="http://localhost/lifekart/Admin/uploads/<?php echo $array[7];?>" type="video/mp4"></video>
                                 </span>
                           </div>
                       </div>
                   </div>
                </div>
            </div> 

            <div class="product-info-main col-md-7">

            <div class="col-md-12 mt-3">
             <h1 class="page-title"><span><?php echo $array[1];?></span></h1>
             <div class="product-reviews-summary empty">
                <div class="reviews-actions">
                <i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                    <a class="action add" href="http://localhost/lifekart/User/View/productDetails.php?page=array&id=227">Be the first to review this product</a>
                        </div>
                    </div>
                 <?php $cate=new product_details();
                    $rows=$cate->group_customer();
                    if(in_array($array[3],$rows)){
                     $SKU=$array[3];
                     $row=$cate->group_price($SKU);
                     ?>
                     <div class="product-info-price">
                         <div class="price-box price-final_price" data-role="priceBox" data-product-id="2580" data-price-box="product-id-2580">
                            <span class="price-container price-final_price tax weee">
                             <span id="product-price-2580" data-price-amount="55" data-price-type="finalPrice" class="price-wrapper ">
                                 <span class="price">₹<?php echo $row[0];?></span>
                            </span>
                          </span>
                         </div>
                      </div> 
                        <?php }else{?>
                            <div class="product-info-price">
                                 <div class="price-box price-final_price" data-role="priceBox" data-product-id="2580" data-price-box="product-id-2580">
                                     <span class="price-container price-final_price tax weee">
                                     <span id="product-price-2580" data-price-amount="55" data-price-type="finalPrice" class="price-wrapper ">
                                         <span class="price">₹<?php echo $array[5];?></span>
                                        </span>
                                    </span>
                                    </div>
                                </div> 
                                 <?php }?>
                                 <div class="product attribute overview">
                                     <div class="value" itemprop="description"><?php echo $array[6];?></div>
                                    </div>
                                    <div class="product-info-stock-sku">
                                        <div class="product attribute sku">
                                            <strong class="type">SKU:</strong>
                                            <div class="value" itemprop="sku"><?php echo $array[3];?></div>
                                    </div>
                                    </div>

                                    <div class="product-add-form">
                                     <div class="box-tocart">
                                            <div class="fieldset">
                                                    <div class="field qty">
                                                    <form method='POST' action="../Controller/control.php"> 
                                                    <div class="input-group">
                                                    <span class="minus"><i class="fa fa-minus mt-2"></i></span>
                                                    <input type="number" name="quantity" class="col-md-1 quantity" value="1" min="1" id="quantity" required="">
                                                    <span class="plus"><i class="fa fa-plus mt-2"></i></span>
                                                    <button type="submit" title="Add to Cart" class="action primary tocart qtybutton" id="product-addtocart-button">
                                                    <span><i class="fas fa-shopping-bag mr-2"></i>Add to Cart</span> </button>
                                                    <input type="hidden" value="<?php echo $array[0];?>" class="msg" id="msg" name="msg">
                                                    <input type="hidden" value="productdetail" name="action">
                                                    <p id="msg1" class="msg1"></p>
                                                    </div>
                                                </form>
                                        </div>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="row policy">
                                         <div data-icon-content="icon-container" id="PAY_ON_DELIVERY" class="icon-container">
                                             <div class="a-section"> <img src="https://images-na.ssl-images-amazon.com/images/G/31/A2I-Convert/mobile/IconFarm/icon-cod._CB485937110_.png" class="a-image-wrapper a-manually-loaded icon-box" id="" style="margin-left:40px; height:35px;width:35px;" alt="Pay on Delivery" data-a-image-source="https://images-na.ssl-images-amazon.com/images/G/31/A2I-Convert/mobile/IconFarm/icon-cod._CB485937110_.png"> 
                                         </div>
                                             <div class="a-section icon-content"> Pay on Delivery</div>        
                                         </div>                                      
                                             <div data-icon-content="icon-farm-secondary-view-holder" id="RETURNS_POLICY" class="icon-container"> 
                                            <div class="a-section "> <img src="https://images-na.ssl-images-amazon.com/images/G/31/A2I-Convert/mobile/IconFarm/icon-returns._CB484059092_.png" class="a-image-wrapper a-manually-loaded icon-box" id="" style="margin-left:55px;height:35px;width:35px;" alt="7 Days Replacement" data-a-image-source="https://images-na.ssl-images-amazon.com/images/G/31/A2I-Convert/mobile/IconFarm/icon-returns._CB484059092_.png"> 
                                         </div> 
                                            <div class="a-section icon-content">7 Days Replacement </div> 
                                       </div>     
                                            <div data-icon-content="icon-container" id="AMAZON_DELIVERED" class="icon-container"> 
                                        <div class="a-section"> <img src="https://images-na.ssl-images-amazon.com/images/G/31/A2I-Convert/mobile/IconFarm/icon-amazon-delivered._CB485933725_.png" class="a-image-wrapper a-manually-loaded icon-box" id="" style="margin-left:50px;height:35px;width:35px;" alt="Amazon Delivered" data-a-image-source="https://images-na.ssl-images-amazon.com/images/G/31/A2I-Convert/mobile/IconFarm/icon-amazon-delivered._CB485933725_.png"> 
                                        </div> 
                                             <div class="a-section icon-content">Amazon Delivered  </div>   
                                         </div>                                  
                                        <div data-icon-content="icon-container" id="WARRANTY" class="icon-container">    
                                         <div class="a-section"> <img src="https://images-na.ssl-images-amazon.com/images/G/31/A2I-Convert/mobile/IconFarm/icon-warranty._CB485935626_.png" class="a-image-wrapper a-manually-loaded icon-box" id="" style="margin-left:40px;height:35px;width:35px;" alt="1 Year Warranty" data-a-image-source="https://images-na.ssl-images-amazon.com/images/G/31/A2I-Convert/mobile/IconFarm/icon-warranty._CB485935626_.png">
                                         </div> 
                                            <div class="a-section icon-content">1 Year Warranty </div>     
                                        </div>
                                    </div>

                                    <div class="product-social-links"><div class="product-share">
                                    <div class="share-links">
                                        <a href="#" data-placement="bottom" class="share-facebook" data-original-title="Facebook"><i class="fab fa-facebook-square"></i></a>
                                            <a href="#" data-placement="bottom" class="share-twitter" data-original-title="Twitter"><i class="fab fa-twitter"></i></a>
                                            <a href="#" data-placement="bottom" title="" class="share-linkedin" data-original-title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                                            <a href="#" data-placement="bottom" title="" class="share-googleplus" data-original-title="Google +"><i class="fab fa-google-plus-square"></i></a>
                                            <a href="#" data-placement="bottom" title="" class="share-email" data-original-title="Email"><i class="fas fa-envelope"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
            </div>

                            <div class="product info detailed mt-5 ml-4">
                            <div class="tab">
                            <button class="tablinks" onclick="openCity(event, 'Details')">Details</button>
                            <button class="tablinks" onclick="openCity(event, 'More Information')">More Information</button>
                            <button class="tablinks" onclick="openCity(event, 'Reviews')">Reviews</button>
                            </div>

                            <div id="Details" class="tabcontent">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.
                            Any Product types that You want - Simple, Configurable
                            Downloadable/Digital Products, Virtual Products
                            Inventory Management with Backordered items
                            Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            </p>
                            </div>

                            <div id="More Information" class="tabcontent">
                            <p>Format:DVD</p> 
                            </div>

                            <div id="Reviews" class="tabcontent">
                                <div class="block-content">
                                         <div class="field review-field-nickname required">
                                            <label for="nickname_field" class="label"><span>Nickname</span></label>
                                            <div class="control">
                                                <input type="text" name="nickname" id="nickname_field" class="input-text" data-validate="{required:true}" data-bind="value: nickname()" aria-required="true">
                                            </div>
                                        </div>
                                        <div class="field review-field-summary required">
                                            <label for="summary_field" class="label"><span>Summary</span></label>
                                            <div class="control">
                                                <input type="text" name="title" id="summary_field" class="input-text" data-validate="{required:true}" data-bind="value: review().title" aria-required="true">
                                            </div>
                                        </div>
                                        <div class="field review-field-text required">
                                            <label for="review_field" class="label"><span>Review</span></label>
                                            <div class="control">
                                                <textarea name="detail" id="review_field" cols="21" rows="3" data-validate="{required:true}" data-bind="value: review().detail" aria-required="true"></textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="actions-toolbar review-form-actions mt-3">
                                        <div class="primary actions-primary">
                                            <button type="submit" class="action submit primary"><span>Submit Review</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>

                            <div class="releted_products container">
                            <div class="mt-3 ml-3 mb-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4><b>Releted Products</b></h4>
                                            <?php
                                                $cate=new product_details();
                                                $categ=$cate->category_related($id);
                                                    $id=$categ[0][0];
                                                    $category=explode(",",$categ[0][0]);
                                                    $rows=$cate->product_Details($category[0]);
                                                ?>          
                                            <div id="carousel<?php echo $category[0]?>" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php 
                                                    $i=0;
                                                    $id=$category[0];
                                                    $productS=new product_details();
                                                    $rows=$productS->product_page($id);
                                                        if($rows != '') { 
                                                ?>
                                                <h2><a href="http://localhost/lifekart/User/View/category.php?page=category&id=<?php echo $id?>"></a></h2>
                                                    <?php
                                                        foreach($rows as $array){
                                                            if($array[9]=='Enable'){
                                                            $var=unserialize($array[4]);
                                                                        if($i<12){
                                                                        ?>
                                                                        <?php if($i==0){?><div class="carousel-item active"><div class="row"><?php }?>
                                                                        <?php if($i==6){?><div class="carousel-item"><div class="row"><?php }?>
                                                                        
                                                                        <div class="col-md-2 ">
                                                                            <div class="thumb-wrapper">
                                                                                <div class="img-box">
                                                                                <a href="http://localhost/lifekart/User/View/productDetails.php?page=array&id=<?php echo $array[0]?>"> <img src="http://localhost/lifekart/User/images/<?php echo $var[0];?>" alt="" class="img-fluid" style= "width:100%" ></a>						
                                                                                </div>
                                                                                <div class="thumb-content">
                                                                                    <h4><a href="http://localhost/lifekart/User/View/productDetails.php?page=array&id=<?php echo $array[0]?>"><?php echo $array[1];?></a></h4>									
                                                                                    <p class="item-price">Price:<?php echo $array[5];?></p>
                                                                                </div>						
                                                                            </div>
                                                                        </div>
                                                                    <?php if($i==5){?></div> </div><?php }?>
                                                                <?php if($i==count($array)-count($status)-1){?></div></div><?php }?>	
                                                            <?php $i++; }
                                                            }else{$status[]=$array[9];}
                                                        }
                                                    } ?>
                                        </div>
                                            </div>
                                        <a class="pro carousel-control-prev" href="#carousel<?php echo $category[0]?>" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="pro carousel-control-next" href="#carousel<?php echo $category[0]?>" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                    </div>
                                </div>
                            </div>	  
                        </div>
                        </div>
    </div>


        <div class="col-md-3 Recent_Products mt-4">
                <h6 class="sidebartitle ml-4">Recent Products</h6>
                <div class="col-md-12 RecentProductblock">				
                    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
                        <div class="carousel-inner imgthumb">
                        <?php
                            $i=0;
                            $view=array_reverse($savedCard);
                            foreach($view as $category){
                            $cate=new product_details();
                            $rows=$cate->product_Details($category);
                                if($rows[9]=='Enable'){
                                $var=unserialize($rows[4]);
                                            if($i<10){?>
                                            <?php if($i==0){?><div class="carousel-item active"><div class="row"><?php }?>
                                            <?php if($i==5){?><div class="carousel-item"><div class="row"><?php }?>
                                    <div class="col-md-12">
                                    <div class="thumb-wrapper">
                                        <div class="offset-md-1 row">
                                            <div class="img-box">
                                            <a href="http://localhost/lifekart/User/View/productDetails.php?page=array&id=<?php echo $rows[0]?>">
                                            <img src="http://localhost/lifekart/User/images/<?php echo $var[0];?>" alt="" class="img-fluid" >
                                        </a>						
                                        </div>
                                        <div class="infoblock">
                                            <div class="thumb-content">	
                                            <a href="http://localhost/lifekart/User/View/productDetails.php?page=array&id=<?php echo $rows[0]?>"><?php echo $rows[1];?></a>								
                                                <p class="item-price">Price:<?php echo $rows[5];?></p> 
                                            </div>						
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                    <?php if($i==4){?></div> </div><?php }?>
                                <?php if($i==count($rows)-count($status)-1){?></div></div><?php }?>	
                                <?php $i++; }
                                }else{$status[]=$rows[9];} ?>
                        <?php }?>
                    </div>
                </div>
                <a class="pro2 carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="pro2 carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                </div>
            </div>
        </div> 
            
             <div class="col-md-12">
            <div class="CUSTOMHTMLBLOCK m-3">
                <span>CUSTOM HTML BLOCK</span>
                <p>This is a custom sub-title.</p>
                <p>
                Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mi.
                </p>
            </div>
      </div>

      <div class="row col-md-10 ml-4 CUSTOMIMGBLOCK m-3 justify-content-end no-padding ">
        <div class="col-auto col-md-3-5">
          <div class="wpb_wrapper vc_column-inner">
            <h2  class="vc_custom_heading mb-1 ls-negative-03 align-left text-uppercase">Award Winners</h2>
            <p  class="vc_custom_heading align-left">12 Books</p>
            <div class="btn-container mb-0 d-inline-block">
              <button class="btn btn-md btn-primary">VIEW COLLECTION <i style="padding-left: 7px;" class="fas fa-long-arrow-alt-right"></i></button>
            </div>
          </div>
        </div>
      </div>
         

</main>

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
</div><div class="col-lg-2"><div class="widget_text widget widget_custom_html">
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
</div><div class="col-lg-3"><div class="widget widget_text">
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
</div><div class="col-lg-3"><div class="widget_text widget widget_custom_html">
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
                        <div class="custom-block f-right"><div class="widget follow-us mb-0">
  <div class="share-links">
    <a href="#" rel="nofollow" target="_blank" title="Facebook" class="share-facebook">Facebook</a> 
    <a href="#" rel="nofollow" target="_blank" title="Twitter" class="share-twitter">Twitter</a>
    <a href="#" rel="nofollow" target="_blank" title="Linkedin" class="share-linkedin">Linkedin</a>
  </div>
</div> </div>            <address>© All Rights Reserved</address>
                    </div>
    </div>
</div>
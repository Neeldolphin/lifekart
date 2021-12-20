<?php
include 'header.php';
?>
<?php
include 'navbar.php';
?> 
<div class="border p-1 m-4">
        <div class="col-lg-12 ">
            <div class="row">
                    <?php
                     $id = (int)$_GET['id'];
                     $details=new product_details();
                     $array=$details->product_Details($id);
                            $var=unserialize($array[4]);
                            $i=0;
                    ?>
                   <div id="myresult" class="img-zoom-result"></div>
            <div class="col-md-4">                    
                                    <div id="demo" class="carousel slide" data-interval="false">
                                    <div class="carousel-inner">
                                        <?php 
                                        while( $i<count($var)){ 
                                            if($i==0){?>
                                    <div class="carousel-item active proimg img-zoom-container ">
                                    <img class="img_width" id="myimage" src="http://localhost/lifekart/Admin/uploads/<?php echo $var[$i];?>">
                                </div>
                                    <?php $i++;}else{ ?>
                                        <div class="carousel-item proimg img-zoom-container ">
                                    <img class="img_width" src="http://localhost/lifekart/Admin/uploads/<?php echo $var[$i];?>">
                                        </div>
                                    <?php $i++; }} ?>
                                        <div class="carousel-item proimg">
                                        <video width="380" height="280" controls>
                                        <source src="http://localhost/lifekart/Admin/uploads/<?php echo $array[7];?>" type="video/mp4"></video>
                                    </div>
                                    </div>
                                    <div class="row ">
                                      <a class="prodetails control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                    </a>
                                    <a class="prodetails control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                    </a>   
                                    </div>
                                 
                                    <div class="row allimg">
                                    <?php 
                                        $j=0;
                                        while( $j<count($var)){ 
                                        ?>
                                     <span data-target="#demo" data-slide-to="<?php echo $j ?>" >
                                         <img class="img_width" id="target" src="http://localhost/lifekart/Admin/uploads/<?php echo $var[$j];?>">
                                        </span>
                                    <?php $j++;} ?>
                                    <span data-target="#demo" data-slide-to="<?php echo $j ?>">
                                    <video controls>
                                        <source src="http://localhost/lifekart/Admin/uploads/<?php echo $array[7];?>" type="video/mp4"></video>
                                        </span>
                                    </div>
                                    </div>

            </div>
            <div class="col-md-5 ">  
                   
                <span><h2><b><?php echo $array[1];?></b></h2></span><br> 
                <?php $cate=new product_details();
                    $rows=$cate->group_customer();
                     if(in_array($array[3],$rows)){
                     $SKU=$array[3];
                     $row=$cate->group_price($SKU);?>

            <span><b><h4>price:₹<?php echo $row[0];?></h4></b></span>    
                    <?php }else{?>
            <span><b><h4>price:₹<?php echo $array[5];?></h4></b></span>  
                    <?php }?>
            <p><h5><b>About this item:</b><?php echo $array[6];?></h5></p> 
            <div class="row">
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
            <div class="col-lg-10 mt-4">
                <div class="row">
                    <div class="col-lg-4 pb-4">
                        <form method='POST' action="../Controller/control.php">
                        <p>QTY<input type="number"  id="quantity" name="quantity" class="quantity" min="1" required=""></p>
                        <input type="hidden" value="<?php echo $array[0];?>" class="msg" id="msg" name="msg">
                        <input type="hidden" value="productdetail" name="action">
                        <p id="msg1" class="msg1"></p>
                        <input type="submit" class="btn btn-primary qtybutton">
                    </form>
                    </div>
                </div>
                </div> 
        </div>
    </div>
</div>
</div>

<div class="releted_products">
<div class="container">
	<div class="row">
<div class="col-md-12">
			<h2><b>Releted Products</b></h2>
            <?php
                $cate=new product_details();
                $ros=$cate->category_related($id);
                foreach($ros as $categ){
                    ?>
                <?php
                 $id=$categ[0];
                 $id_cate=explode(",",$categ[0]);
                  foreach($id_cate as $category){
                $cate=new product_details();
                $rows=$cate->product_Details($category);
                    ?> 
				<div>             
				<div id="carousel<?php echo $category[0]?>" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                <?php 
                $i=0;
				$id=$category[0];
				$productS=new product_details();
				$rows=$productS->product_page($id);
				if($rows != '') { ?>
					<h2><a href="http://localhost/lifekart/User/View/category.php?page=category&id=<?php echo $id?>"></a></h2>
        		<?php
				foreach($rows as $array){
					if($array[9]=='Enable'){
                     $var=unserialize($array[4]);
                                if($i<8){?>
                                <?php if($i==0){?><div class="carousel-item active"><div class="row"><?php }?>
                                <?php if($i==4){?><div class="carousel-item"><div class="row"><?php }?>
                            <div class="col-sm-3">
							<div class="thumb-wrapper">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
								<div class="img-box">
                                <img src="http://localhost/lifekart/User/images/<?php echo $var[0];?>" alt="" class="img-fluid" style= "width:100%" >						
								</div>
								<div class="thumb-content">
									<h4><a href="http://localhost/lifekart/User/View/productDetails.php?page=array&id=<?php echo $array[0]?>"><?php echo $array[1];?></a></h4>									
									<p class="item-price">Price:<?php echo $array[5];?></p>
									<a href="http://localhost/lifekart/User/View/productDetails.php?page=array&id=<?php echo $array[0]?>" class="btn btn-primary">buy </a>
								</div>						
							</div>
						</div>
					<?php if($i==3){?></div> </div><?php }?>
					<?php if($i==count($array)-count($status)-1){?></div></div><?php }?>	
					<?php $i++; }
					}else{$status[]=$array[9];}
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
			<?php } ?>
            </div>	  
                <?php
                }
                }?>
                 </div>
	</div>
</div>


<div class="footer">
<?php
include 'footer.php';
 ?>
</div>
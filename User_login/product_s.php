<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Wrapper for carousel items -->
		<div class="carousel-inner">
        <?php 
        $query="select * from Product_info where category =$category[0]"; 
				$result2=mysqli_query($con,$query);
        $i=0;
        while($array=mysqli_fetch_row($result2)): 
            $var=unserialize($array[4]);
	    if($i<8){
	    if($i==0){?><div class="item carousel-item active"><div class="row"><?php }
		 if($i==4){?><div class="item carousel-item"><div class="row"><?php }?>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
								<div class="img-box">
                                <img src="http://localhost/lifekart/User_login/images/<?php echo $var[0];?>" alt="" class="img-fluid" style= "width:100%" >						
								</div>
								<div class="thumb-content">
									<h4><a href="http://localhost/lifekart/User_login/productDetails.php?page=array&id=<?php echo $array[0]?>"><?php echo $array[1];?></a></h4>									
									<p class="item-price">Price:<?php echo $array[5];?></p>
									<a href="#" class="btn btn-primary">Add to Cart</a>
								</div>						
							</div>
						</div>
						<?php if($i==3){?></div> </div><?php }?>
			<?php if($i==count($array)-1){?></div></div><?php }?>				
		
			<!-- Carousel controls -->
			<a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control-next" href="#myCarousel" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
				 <?php $i++; }
             endwhile; ?>
			 </div>  
		</div>
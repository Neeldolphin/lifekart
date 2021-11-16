<div id="carousel<?php echo $category[0]?>" class="carousel slide" data-ride="carousel">

  <div class="carousel-inner">
  <?php 
                $i=0;
				$id=$category[0];
				$productS=new product_details();
				$rows=$productS->product_page($id);
        		foreach($rows as $array){

            $var=unserialize($array[4]);
	    if($i<8){?>
		 <?php if($i==0){?><div class="carousel-item active"><div class="row"><?php }?>
		 <?php if($i==4){?><div class="carousel-item"><div class="row"><?php }?>
	<div class="col-sm-3">
							<div class="thumb-wrapper">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
								<div class="img-box">
                                <img src="http://localhost/lifekart/User_login/images/<?php echo $var[0];?>" alt="" class="img-fluid" style= "width:100%" >						
								</div>
								<div class="thumb-content">
									<h4><a href="http://localhost/lifekart/User_login/productDetails.php?page=array&id=<?php echo $array[0]?>"><?php echo $array[1];?></a></h4>									
									<p class="item-price">Price:<?php echo $array[5];?></p>
									<a href="http://localhost/lifekart/User_login/productDetails.php?page=array&id=<?php echo $array[0]?>" class="btn btn-primary">buy </a>
								</div>						
							</div>
						</div>
					<?php if($i==3){?></div> </div><?php }?>
					<?php if($i==count($array)-1){?></div></div><?php }?>	
					<?php $i++; }
             } ?>
           </div>
		   </div>
  <a class="carousel-control-prev" href="#carousel<?php echo $category[0]?>" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel<?php echo $category[0]?>" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

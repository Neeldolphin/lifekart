<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="http://localhost/lifekart/User_login/myCarousel.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	$(".wish-icon i").click(function(){
		$(this).toggleClass("fa-heart fa-heart-o");
	});
});	
</script>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Featured <b>Category</b></h2>
        <?php

		$cate=new category_main();
        $rows=$cate->categoryMain();
        foreach($rows as $category){
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
					<h2><a href="http://localhost/lifekart/User_login/category.php?page=category&id=<?php echo $id?>"><?php echo $category[1];?></a></h2>
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
					<?php if($i==count($array)-count($status)-1){?></div></div><?php }?>	
					<?php $i++; }
					}else{$status[]=$array[9];}
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
			<?php } ?>
            </div>	  
                <?php
                }?>
        </div>
	</div>
</div>
</body>
</html>
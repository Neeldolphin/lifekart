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
				 <?php }
				 }?>
</div>
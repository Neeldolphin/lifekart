<?php 
include '../Model/class.php';
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);  
?>
<?php 
			$order = 1;
			$id=7;
			$page_id = $_POST['numItems'];
			$productM=new product_details();
			$rows=$productM->product_info($id,$order,$page_id);
			foreach ($rows as $array) {
            $var=unserialize($array[4]);
			if($array[9] =='Enable'){
	            ?>
				<div class="col-sm-3 numofprod">
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
<?php
include 'header.php';
include 'logo.php';

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
            <div class="col-lg-5">                    
                                    <div id="demo" class="carousel slide" data-ride="carousel">

                                    <!-- Indicators -->
                                    <ul class="carousel-indicators">
                                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                                    <li data-target="#demo" data-slide-to="1"></li>
                                    </ul>
                                    <!-- The slideshow -->
                                    <div class="carousel-inner">
                                        <?php 
                                        while( $i<count($var)){ 
                                            if($i==0){?>
                                    <div class="carousel-item active">
                                    <img class="img_width" src="http://localhost/lifekart/Admin/uploads/<?php echo $var[$i];?>">
                                    </div>
                                    <?php $i++;}else{ ?>
                                        <div class="carousel-item ">
                                    <img class="img_width" src="http://localhost/lifekart/Admin/uploads/<?php echo $var[$i];?>">
                                    </div>
                                    <?php $i++; }} ?>
                                        <div class="carousel-item">
                                        <video width="380" height="280" controls>
                                        <source src="http://localhost/lifekart/Admin/uploads/<?php echo $array[7];?>" type="video/mp4"></video>
                                    </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                    </a>
                                    <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                    </a>
                                    </div>

            </div>
            <div class="col-lg-6 offset-md-1 ">  
                   
                <p><b>Name :<?php echo $array[1];?></b></p> 
                <?php $cate=new product_details();
                    $rows=$cate->group_customer();
                     if(in_array($array[3],$rows)){
                     $SKU=$array[3];
                     $row=$cate->group_price($SKU);?>

            <p><b>Price :<?php echo $row[0];?></b></p>    
                    <?php }else{?>
            <p><b>Price :<?php echo $array[5];?></b></p>  
                    <?php }?>
            <p><b>Description :<?php echo $array[6];?></b></p> 
            <div class="col-lg-10 mt-4">
                <div class="row">
                    <div class="col-lg-4 pb-4">
                        <form method='POST' action="../Controller/control.php">
                        <p>QTY<input type="number"  id="quantity" name="quantity" class="quantity" min="1" required=""></p>
                        <input type="hidden" value="<?php echo $array[0];?>" class="msg" id="msg" name="msg">
                        <input type="hidden" value="productdetail" name="action">
                        <p id="msg1" class="msg1"></p>
                        <input type="submit" class="btn btn-primary qtybutton" >
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
					<h2><a href="http://localhost/lifekart/User/View/category.php?page=category&id=<?php echo $id?>"><?php echo $category[1];?></a></h2>
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
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
<div class="footer">
<?php
include 'footer.php';
 ?>
</div>
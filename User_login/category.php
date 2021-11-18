<?php
include 'header.php';
include 'logo.php';
?>
<body>
<?php
include 'navbar.php';
?> 
<div class="text-center">
 <?php
 include 'slidebar.php';
 ?>
</div>
<body>
	  
<div class="container">
	<div class="row">
		<div class="col-md-12">
        <?php
        $id = (int)$_GET['id'];
        if(isset($_GET['page_id'])){
        $pages = $_GET['page_id'];}
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
                    <option value="1">Price:low to high</option>
                    <option value="2">Price:high to low</option>
                    <option value="3">Name:ascending</option>
                    <option value="4">Name:descending</option>
                    </select>
				<?php include 'product.php';?> 
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
</body>
</html>


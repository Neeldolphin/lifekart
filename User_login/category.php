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
        $categoryGet=new category_main();
        $category=$categoryGet->category_info($id);
            ?>
				<div>           
                <h2><?php echo $category[1];?></h2>  
                <input type="hidden" id="sortBy" value="<?php echo $id?>">
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
	</div>
</div>
</body>

<div class="footer">
<?php
include 'footer.php';
 ?>
</div>
</body>
</html>


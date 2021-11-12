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


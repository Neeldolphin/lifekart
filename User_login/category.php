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
        $query="select * from category_info where id=".$id; 
				$result=mysqli_query($con,$query);
        while($category=mysqli_fetch_row($result)):
            ?>
				<div>           
                <h2><?php echo $category[1];?></h2>  
				<?php include 'product.php';?> 
            </div>	  
                <?php 
                endwhile; ?>
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


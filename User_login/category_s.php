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
        $query="select * from category_info"; 
				$result=mysqli_query($con,$query);
        while($category=mysqli_fetch_row($result)):
            ?>
				<div>
				<h2><a href="http://localhost/lifekart/User_login/category.php =' . $category->id . '"><?php echo $category[1];?></a></h2>             
				<?php include 'product_s.php';?> 
            </div>	  
                <?php
                endwhile; ?>
        </div>
	</div>
</div>
</body>
</html>
<?php 
//  ini_set('display_errors', 1);
//  ini_set('display_startup_errors', 1);
//  error_reporting(E_ALL);
?>
<div class="categorybar">
    <div class="row justify-content-center">
  <?php
		$cate=new category_main();
        $rows=$cate->categoryMain();
        foreach($rows as $category){
            ?>
    <div class="node">
        <a href="http://localhost/lifekart/User/View/category.php?page=category&id=<?php echo $category[0]?>">
            <div class="thumb-wrapper">
                <div class="img-box thumbimg">
                    <img src="http://localhost/lifekart/User/images/<?php echo $category[4];?>" alt="" class="img rounded-circle" >						
                </div>	
                <div class = "title"><?php echo $category[1];?></div>				
            </div>
    </a>
        </div>
    <?php } ?>
</div>
</div>

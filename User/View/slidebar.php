<?php
include 'header.php';
include '../Model/class.php';
?>
<body>

<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  
  <!-- The slideshow -->
  <div class="carousel-inner">
 <?php
        $i=0;
       $slide= new slider();
       $rows=$slide->slidebar();

        foreach($rows as $array){
        if($i==0){?>

    <div class="carousel-item active">
     <a href="<?php echo $array[2];?>"><img src="http://localhost/lifekart/Admin/uploads/<?php echo $array[1];?>" alt="" style= "width:100%" ></a>
    </div>
<?php $i++; }else{?> 
      <div class="carousel-item">
    <a href="<?php echo $array[2];?>"><img src="http://localhost/lifekart/Admin/uploads/<?php echo $array[1];?>" alt="" style= "width:100%" ></a>
    </div>
<?php $i++; }
   }
   ?>
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
</body>
</html> 

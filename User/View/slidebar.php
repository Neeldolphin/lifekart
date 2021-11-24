<?php
include 'header.php';
include '../Model/class.php';
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
?>
<body>
<?php
      $i=0;
      $x=0;
      $slide= new slider();
      $rows=$slide->slidebar();
?>
<div id="demo" class="carousel slide" data-ride="carousel">

<?php 
$indicat=count($rows);
?>
<ul class="carousel-indicators">
<?php while($x < $indicat){
  if ($x == 0 ) {?>
    <li data-target="#demo" data-slide-to="<?php echo $x; ?>" class="active"></li>
    <?php } else {?>
    <li data-target="#demo" data-slide-to="<?php echo $x; ?>"></li>
    <?php };
     $x++; };?>
  </ul>

  <div class="carousel-inner">
 <?php
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

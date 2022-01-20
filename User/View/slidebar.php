<div class="topbanner">
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
  <div class="carousel-inner banner">
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
  <a class="carousel-control-prev" href="#demo" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
  </a>
  <a class="carousel-control-next" href="#demo" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
  </a>
</div>
</div>
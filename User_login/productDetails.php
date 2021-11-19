<?php
include 'header.php';
include 'logo.php';
include 'class.php';
?>
<?php
include 'navbar.php';
?> 
<body>
<div class="border p-1 m-4">
        <div class="col-lg-12 ">
            <div class="row">
                    <?php
                     $id = (int)$_GET['id'];
                     $details=new product_details();
                     $array=$details->product_Details($id);
                            $var=unserialize($array[4]);
                            $i=0;
                    ?>
            <div class="col-lg-5">                    
                                    <div id="demo" class="carousel slide" data-ride="carousel">

                                    <!-- Indicators -->
                                    <ul class="carousel-indicators">
                                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                                    <li data-target="#demo" data-slide-to="1"></li>
                                    </ul>
                                    <!-- The slideshow -->
                                    <div class="carousel-inner">
                                        <?php 
                                        while( $i<count($var)){ 
                                            if($i==0){?>
                                    <div class="carousel-item active">
                                    <img class="img_width" src="http://localhost/lifekart/Admin_login/uploads/<?php echo $var[$i];?>">
                                    </div>
                                    <?php $i++;}else{ ?>
                                        <div class="carousel-item ">
                                    <img class="img_width" src="http://localhost/lifekart/Admin_login/uploads/<?php echo $var[$i];?>">
                                    </div>
                                    <?php $i++; }} ?>
                                        <div class="carousel-item">
                                        <video width="380" height="280" controls>
                                        <source src="http://localhost/lifekart/Admin_login/uploads/<?php echo $array[7];?>" type="video/mp4"></video>
                                    </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                    </a>
                                    <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                    </a>
                                    </div>

            </div>
            <div class="col-lg-6 offset-md-1 ">  
                   
                <p><b>Name :<?php echo $array[1];?></b></p> 
                <p><b>Price :<?php echo $array[5];?></b></p>
                <p><b>Description :<?php echo $array[6];?></b></p> 
            <div class="col-lg-10 mt-4">
                <div class="row">
                    <div class="col-lg-4 pb-4">
                        <form method='POST' action="control.php">
                        <p>QTY<input type="number"  id="quantity" name="quantity" class="quantity" min="1" required=""></p>
                        <input type="hidden" value="<?php echo $array[0];?>" class="msg" id="msg" name="msg">
                        <input type="hidden" value="productdetail" name="action">
                        <p id="msg1" class="msg1"></p>
                        <input type="submit" class="btn btn-primary qtybutton" >
                    </form>
                    </div>
                </div>
            </div>
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
</html>


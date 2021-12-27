
 <div class="row" >
    <div class="col-md-12">
        <div class="row">
             <div class="col-md-2 no-padding">
                <div class="no1">
                <h2><b>Top Offers</b></h2>
                <button class="btn btn-primary"><a href="http://localhost/lifekart/User/View/category.php?page=category&id=1">VIEW ALL</a>
                </button>
                </div>
             </div>
            <div class="col-md-8 topoffer-back">
                <div class="topoffer">
                <div class="row">
                     <div class="col-md-12">
                             <?php
                                $cate=new category_main();
                                $rows=$cate->category1();
                                 foreach($rows as $category){
                            ?>
                             <div>             
                            <div id="carousel<?php echo $category[0]?>" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                             <?php 
                                $i=0;
                                $id=$category[0];
                                $productS=new product_details();
                                $rows=$productS->product_page($id);
                                if($rows != '') { ?>
                                <?php
                                foreach($rows as $array){
                                if($array[9]=='Enable'){
                                 $var=unserialize($array[4]);
                                     if($i<8){?>
                                        <?php if($i==0){?><div class="carousel-item active"><div class="row"><?php }?>
                                        <?php if($i==4){?><div class="carousel-item"><div class="row"><?php }?>
                                            <div class="col-sm-3">
                                                <div class="thumb-wrapper">
                                                        <div class="img-box">
                                                        <a href="http://localhost/lifekart/User/View/productDetails.php?page=array&id=<?php echo $array[0]?>"><img src="http://localhost/lifekart/User/images/<?php echo $var[0];?>" alt="" class="img" style= "width:100%" ></a>						
                                                        </div>
                                                        <div class="thumb-content text-center">
                                                                    <h4><a href="http://localhost/lifekart/User/View/productDetails.php?page=array&id=<?php echo $array[0]?>"><?php echo $array[1];?></a></h4>									
                                                                        <p class="item-price">Price:<?php echo $array[5];?></p>
                                                    </div>						
                                                </div>
                                             </div>
                                        <?php if($i==3){?></div> </div><?php }?>
                                        <?php if($i==count($array)-count($status)-1){?></div></div><?php }?>	
                                         <?php $i++; }
                                            }else{$status[]=$array[9];}
                                        } ?>
                                        </div>
                                        </div>
                                            <a class="pro1 carousel-control-prev" href="#carousel<?php echo $category[0]?>" role="button" data-slide="prev">
                                                <span class=" carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="pro1 carousel-control-next" href="#carousel<?php echo $category[0]?>" role="button" data-slide="next">
                                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                          <span class="sr-only">Next</span>
                                        </a>
                                     </div>
                                  <?php } ?>
                              </div>	  
                            <?php
                         }?>
                     </div>                             
                </div>
            </div>
    </div>
    </div>
    <div class="adv">
             <img src="../images/336df92b25b545ca.jpeg" alt=""/>
        </div>
</div>
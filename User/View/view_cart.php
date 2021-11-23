<?php include 'header.php';
 include_once 'navbar.php';
 if(isset($_SESSION["username"])){
    include '../Model/class.php';
    ?>
    <div class="container">                
    <div class="contentbar">  
    <h1 class="page-header text-center">Cart Details</h1>              
            <!-- Start row -->
            <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <form method="POST" action="save_cart.php">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Remove</th>
                    </thead>
                    <tbody>
                    <p id="msg1" class="msg1"></p></td>
                        <?php    $sr=1;
                                 $index=0;
                                 $shipping=0;
                                $total=0;
                                $session=$_SESSION;
                                $view= new cart();
                                $rows=$view->view_cart($session);
                                if(!empty($_SESSION['cart'])){
                                 foreach($rows as $row){
                                    ?>
                                    <tr>
                                    <td><?php echo $sr; ?></td>
                                        <td><?php echo $row['pname']; ?></td>
                                        <td><?php echo number_format($row['price'], 2); ?></td>
                                        <td><input type="text" class="form-control quantity1" data-id="<?php echo $row['Id']?>" required=""  value="<?php echo $_SESSION['qty'][$index]; ?>" name="qty_<?php echo $index; ?>"></td>
                                        <input type="hidden" class="msg" >
                                        <input type="hidden" name="indexes[]"  value="<?php echo $index; ?>">
                                        <td><?php echo number_format($_SESSION['qty'][$index]*$row['price'], 2); ?></td>
                                        <?php $total+=$_SESSION['qty'][$index]*$row['price']; ?>
                                        <?php if(isset($_SESSION['coupen_discount'])){ ?>
                                        <?php $coupen =$total-($total*$_SESSION['coupen_discount'])/100; ?>
                                        <?php $discount =($total*$_SESSION['coupen_discount'])/100; ?>
                                        <?php }
                                        ?>
                                        <td>
                                        <input type="hidden" class="DeleteId" value="<?php echo $row['Id'];?>">
                                        <input type="hidden" class="indexId" value="<?php echo $index;?>">
										<a class="btn btn-danger btn-sm deleteItem"><span class="glyphicon glyphicon-trash">X</span></a>
									</td>
                                    </tr>
                                    <?php
                                    $index ++;
                                    $sr ++;
                                }
                             }
                           ?>
                        <tr>
                            <td colspan="4" align="right"><b>Total</b></td>
                            <td><b><?php echo number_format($total, 2); ?></b></td>
                        </tr>
                        <tr>
                        <?php if(isset($discount)){ ?>
                        <td colspan="4" align="right"><b>Discount</b></td>
                        <td><b><?php echo number_format($discount, 2); ?></b></td>
                        <?php }?>
                        </tr>
                        <tr>
                        <?php if(isset($coupen)){ ?>
                        <td colspan="4" align="right"><b>Paiable Amount</b></td>
                        <td><b><?php echo number_format($coupen, 2); ?></b></td>
                        <?php }?>
                        </tr>
                    </tbody>
                        </table>
                <button type="submit" class="btn btn-success qtybutton" name="save">Save Changes</button>
                <a class="btn btn-danger clearCart"><span class="glyphicon glyphicon-trash"></span> Clear Cart</a>
                </form>
            </div>
            <div class="col-sm-3 offset-md-1">
                <div class="form-group">
                <label for="promo_code"><b>Apply Promocode:</b></label> 
                <td><input type="text" class="form-control" id="coupen_code"  placeholder="Enter Promocode" name="coupen_code"></td>
                <p id="mes"></p>
                <td><button class="btn btn-success btn-sm" id="apply" >Apply</button></td>
                <?php if(isset($_SESSION['coupen_name'])){ ?>
                <label>Applied Promocode is:<?php echo $_SESSION['coupen_name']?></label> 
                <td><button id="remove" class="btn btn-danger btn-sm" >Remove</button></td>
                <?php }?>
            </div>
            </div>
        </div>
            <!-- End row -->
        </div>
        
        <?php 
 }else{
     ?>
     <div>
     <h4 align="center"><a href="http://localhost/lifekart/User/View/login.php">Login First</a> </h4>
     </div>
     <?php }?>
    
    </div>

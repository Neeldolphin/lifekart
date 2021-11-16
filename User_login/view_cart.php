<?php include 'header.php';
 include_once 'navbar.php';
 if(isset($_SESSION["username"])){
    include 'class.php';
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
                        <?php 
                                 $index=0;
                                $total=0;
                                $session=$_SESSION;
                                $view= new cart();
                                $rows=$view->view_cart($session);
                                if(!empty($_SESSION['cart'])){
                                 foreach($rows as $row){
                                     $sr=1;
                                     $shipping=0;
                                    ?>
                                    <tr>
                                    <td><?php echo $sr; ?></td>
                                        <td><?php echo $row['pname']; ?></td>
                                        <td><?php echo number_format($row['price'], 2); ?></td>
                                        <input type="hidden" name="indexes[]"  value="<?php echo $index; ?>">
                                        <td><input type="text" class="form-control" value="<?php echo $_SESSION['qty'][$index]; ?>" name="qty_<?php echo $index; ?>"></td>
                                        <td><?php echo number_format($_SESSION['qty'][$index]*$row['price'], 2); ?></td>
                                        <?php $total+=$_SESSION['qty'][$index]*$row['price']; ?>
                                        <?php if(isset($_SESSION['coupen_discount'])){ ?>
                                        <?php $coupen =$total-($total*$_SESSION['coupen_discount'])/100; ?>
                                        <?php $discount =($total*$_SESSION['coupen_discount'])/100; ?>
                                        <?php }?>
                                        <td>
										<a href="delete_item.php?id=<?php echo $row['Id']; ?>&index=<?php echo $index; ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash">X</span></a>
									</td>
                                    </tr>
                                    <?php
                                    $index ++;
                                    $sr++;
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
                <button type="submit" class="btn btn-success" name="save">Save Changes</button>
                <a href="clear_cart.php" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Clear Cart</a>
                <a href="checkout.php" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Checkout</a>
                </form>
            </div>
            <div class="col-sm-3 offset-md-1">
                <div class="form-group">
                <label for="promo_code"><b>Apply Promocode:</b></label> 
                <td><input type="text" class="form-control" id="coupen_code"  placeholder="Enter Promocode" name="coupen_code"></td>
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
     <h4 align="center"><a href="http://localhost/lifekart/User_login/login.php">Login First</a> </h4>
     </div>
     <?php }?>
    
    </div>

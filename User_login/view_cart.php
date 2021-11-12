<?php       
    include 'header.php';
    include_once 'navbar.php';
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
                                    ?>
                                    <tr>
                                    <td><?php echo $sr; ?></td>
                                        <td><?php echo $row['pname']; ?></td>
                                        <td><?php echo number_format($row['price'], 2); ?></td>
                                        <input type="hidden" name="indexes[]"  value="<?php echo $index; ?>">
                                        <td><input type="text" class="form-control" value="<?php echo $_SESSION['qty'][$index]; ?>" name="qty_<?php echo $index; ?>"></td>
                                        <td><?php echo number_format($_SESSION['qty'][$index]*$row['price'], 2); ?></td>
                                        <?php $total+=$_SESSION['qty'][$index]*$row['price']; ?>
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
                    </tbody>
                        </table>
                <button type="submit" class="btn btn-success" name="save">Save Changes</button>
                <a href="clear_cart.php" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Clear Cart</a>
                <a href="checkout.php" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Checkout</a>
                </form>
            </div>
        </div>
            <!-- End row -->
        </div>
        </div>

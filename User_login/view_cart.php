<?php
	session_start();
    include 'header.php';
    include_once 'navbar.php';
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
                            //initialize total
                            $total = 0;
                            if(!empty($_SESSION['cart'])){
                            //create array of initail qty which is 1
                             $index = 1;
                             if(!isset($_SESSION['qty'])){
                                 $_SESSION['qty'] = array_fill(0, count($_SESSION['cart']), 1);
                             }
                            $sql = "SELECT * FROM Product_info WHERE id IN (".implode(',',$_SESSION['cart']).")";
                            $query = $con->query($sql);
                                while($row = $query->fetch_assoc()){
                                    ?>
                                    <tr>
                                    <td><?php echo $index; ?></td>
                                        <td><?php echo $row['pname']; ?></td>
                                        <td><?php echo number_format($row['price'], 2); ?></td>
                                        <input type="hidden" name="indexes[]"  value="<?php echo $index; ?>">
                                        <td><input type="text" class="form-control" value="<?php echo $_SESSION['qty'][$index]; ?>" name="qty_<?php echo $index; ?>"></td>
                                        <td><?php echo number_format($_SESSION['qty'][$index]*$row['price'], 2); ?></td>
                                        <?php $total += $_SESSION['qty'][$index]*$row['price']; ?>
                                        <td>
										<a href="delete_item.php?id=<?php echo $row['Id']; ?>&index=<?php echo $index; ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash">X</span></a>
									</td>
                                    </tr>
                                    <?php
                                    $index ++;
                                }
                            }
                            else{
                                ?>
                                <tr>
                                    <td colspan="4" class="text-center">No Item in Cart</td>
                                </tr>
                                <?php
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

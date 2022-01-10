<?php 
include 'header.php';
include '../Model/class.php';
include 'sidebar.php';
?> 

<div class="container-fluid"> 
   <div class="col-md-12 offset-md-1"><h2 class="text-white bg-dark"> Order Details</h2></div>
   
            <div class="offset-md-2 mt-3 mb-3 col-md-10 ">
                <form id="Ordersearch">
                <div class="row">
                <div class="row col-md-6">
                    <div class="col-md-4">
                        <strong>Customer Name</strong>
                    </div>
                    <input type="text" id="CustomerName" class="ml-2" name="CustomerName" placeholder="Search for name..">
                </div>
                <div class="row col-md-6 ">
                    <div class="col-md-4">
                        <strong>Customer Email</strong>
                    </div>
                    <input type="text" id="CustomerEmail" name="CustomerEmail" placeholder="Search for email..">
                </div>
                </div>
                <div class="row mt-2 mb-2">
                    <div class="col-md-2">
                        <strong>Order Date</strong>
                    </div>
                    <input type="date" class="mr-2" id="OrderDateFrom" name="OrderDateFrom" placeholder="MM/DD/YYY">
                    <input type="date" id="OrderDateTo" name="OrderDateTo" placeholder="MM/DD/YYY">
                </div>
                <div class="row col-md-4">
                    <button type="submit" class="btn mr-2 btn-success searchInfo" id="searchInfo">APPLY</button>
                </div>
            </form>
            <div class="row mt-2 col-md-4">
            <button class="btn mr-2 btn-danger" id="btnclear">CLEAR</button>
            <p id="messagedis"></p>
            </div>
            </div>
   

            <div class="row offset-md-2 mr-5">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Orders Overview</h5>
                                <div class="table-responsive m-t-30">
                                    <table class="table" id="datatab1">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Order ID</th>
                                                <th>Customer</th>
                                                <th>Customer Email</th>
                                                <th>Order Date</th>
                                                <th>Order Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php 
                                                 $cate=new cart();                                                  
                                                    $rows=$cate->customerOrderInfo();
                                                    foreach($rows as $array){ 
                                                    $total=0;
                                                        $detail=$cate->OrderpriceInfo($array[0]);
                                                        foreach($detail as $item){ 
                                                        $total+=$item[1]*$item[2];
                                                        }
                                                ?>
                                            <tr class="datatogle <?php echo $array[0];?>">
                                                <td><span class="displayData" data-id="<?php echo $array[0];?>">+</span></td>
                                                <td><?php echo $array[0];?></td>
                                                <td><?php echo $array[3];?></td>
                                                <td><?php echo $array[4];?></td>
                                                <td><?php echo $array[1];?></td>
                                                <td><?php echo $total ?></td>
                                                 </tr> 
                                              <?php  }  ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


    <div class="modal fade" id="pop-modal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="OrderInfoModal"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
          </div>
          <div class="modal-body">
                 <table class="table">
                    <thead>
                        <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        </tr>
                        </thead>
                        <tbody id="displayorder" >
                        </tbody>
                </table>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
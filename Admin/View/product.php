<?php 
  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);
include('header.php');
include '../Model/class.php';
 ?>
<body>  	
  <?php
 			include 'sidebar.php';
			?>
	 <div class="container-fluid">
   <div class="col-md-12 offset-md-1"><h2 class="text-white bg-dark"> Product Details</h2></div> 
   <form action="../Controller/control.php" id="csvForm" name="csvForm" method="POST" enctype="multipart/form-data"> 
     <div class='content offset-md-2'>
                <div class="row">
                <div class="col-md-4">
                <div>
                <input type="hidden" id="Id" value="" required>  
                   <label class="control-label">Action</label>
                      <select class="div-toggle" data-target=".file-upload" name="action" id="CSV">
                       <option value="" id="select_csv" name="select_csv">Select</option>
                      <option value="import_csv" id="Import" name="Import" data-show=".import">IMPORT</option>
                      <option value="export_csv" id="Export" name="Export" data-show=".export">EXPORT</option>
                      <option value="delete_csv" id="Delete" name="Delete" data-show=".delete">DELETE</option>
                      <option value="select_delete_csv" id="Select_Delete" name="Select_Delete" data-show=".selectdelete" class="">SELECT TO DELETE</option>
                  </select>
                  <button type="submit" class="btn btn-primary selectdelete" id="btn-save" value="create" >Submit</button>
                    <div class="file-upload">
                    <div class="import hide">
                    <input type="file" id="upload-1" name="file" required >
                    <p class="file-name"></p>
                    </div>
                    </div>
                    <div class="delete hide">
                    <input type="file" id="upload-2" name="file1" required >
                    <p class="file-name"></p>
                    </div>
                    </div>
                  </div>
                    <?php if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) { ?>
                        <div class="success-message" style="margin-bottom: 20px;font-size: 20px;color: green;"><?php echo $_SESSION['success_message']; ?></div>
                        <?php
                        unset($_SESSION['success_message']);
                    }
                    ?>  
                    <div class="col-md-2"><p class="message"></p></div>
                 <div class="col-md-6">
                    <button type="button" id="addProduct" data-toggle="modal" data-target="#ajax-modal" class="btn btn-success">Add Product </button> 
                 </div>
                </div>

                <div class="col-md-12">
                  <div id="ref">
			<table class="table" id="datatab">
              <thead>
                <tr>
                  <th><input type="checkbox" id="select_all" name="select_all" value="" class="Selectall"></th>
                  <th scope="col">Name</th>
                  <th scope="col">Category</th>
                  <th scope="col">SKU</th>
                  <th scope="col">Image</th>
                  <th scope="col">Price</th>
                  <!-- <th scope="col">Description</th> -->
                  <th scope="col">Video</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
				<?php
        $cate=new product();
        $rows=$cate->productInfo();
        foreach($rows as $array){
				?>
				<?php 
          $var=unserialize($array[4]);
          ?>
                <tr>
                    <td><input type="checkbox" id="<?php echo $array[0];?>" name="select_csv[]" value="<?php echo $array[0];?>" class="Select"></td>
                    <!-- <td></td> -->
                    <td><?php echo $array[1];?></td>
                    <?php 
                    $id=$array[2];
                    $cate=new product();
                    $rows22=$cate->categoryName($id);?>
                    <td><?php echo $rows22;?></td>
                    <td><?php echo $array[3];?></td>
                    <td class="img_width2"><?php $i=0;?><?php if(!empty($var[$i])){ ?><img class="img_width" src="http://localhost/lifekart/Admin/uploads/<?php echo $var[$i];?>"><?php }else{ ?><span class="emptyspace">-</span><?php } ?></td>
                    <td><?php echo $array[5];?></td>
                    <!-- <td><?php echo $array[6];?></td> -->
                    <td class=""><?php if(!empty($array[7])){ ?><button class="btn btn-primary v_view" data-id="<?php echo $array[0];?>"><i class="fa fa-youtube-play"></i></button><?php }else{ ?><span class="empty">-</span><?php } ?></td>
                    <td><?php echo $array[8];?></td>
                    <td><?php echo $array[9];?></td>
                    <td>
                    <button class="btn btn-primary productdelete" data-id="<?php echo $array[0];?>"><i class="fa fa-trash"></i></button>
                     <button  class="btn btn-primary productchange" data-id="<?php echo $array[0];?>"><i class="fa fa-edit"></i></button>
                  </td>
                </tr> 
                <?php } ?>
              </tbody>
          </table>
            </div>
      			</div>
            </div>
            </form>
            </div>

<!--MAINFORM--> 
  <div class="modal fade" id="ajax-modal" aria-hidden="true">
      <div class="modal-dialog modal-lg" id="addForm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="custCrudModal"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="custForm" name="custForm" class="form" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="Id" value="">  
            <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="pname" name="pname" placeholder="Enter Name" value="" maxlength="50" required="">
                </div>
              </div>  
              <div class="form-group">
                <label class="col-sm-2 control-label">Category</label>
                <div class="col-sm-10">
                <?php
                              $cate=new product();
                              $rows=$cate->categoryInfo();
                              foreach($rows as $array){ 
                              ?>
                <input type="checkbox" id="a<?php echo $array[0];?>" name="acheck_list[]" value="<?php echo $array[0];?>">
                <label> <?php echo $array[1];?></label><br>
                              <?php
                              }
                           ?>
                </div>
              </div> 
              <div class="form-group">
                <label class="col-sm-2 control-label">SKU<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="sku" name="sku" placeholder="" value="" >
                </div>
              </div>
              <div class="form-group">
                <label for="file" class="col-sm-2 control-label">Image<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="image" name="image[]" multiple required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Price<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="Price" name="Price" placeholder="Price" value="" min="0" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                  <select class="form-control" name="Status" id="Status">
                      <option value=""></option>
                      <option value="Enable">Enable</option>
                      <option value="Disable">Disable</option>
                              </select>
                </div>
              </div>
              </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-8 control-label">Customer Group Price</label>  
                <div class="wrapper2">
                <div class="input-box">
                <div class="row">
                <div class="col-md-5">              
                <select class="form-control" name="CustomerGroup[]" id="CustomerGroup">
                      <?php
                              $cate=new customer();
                              $rows=$cate->customerGrp();
                              foreach($rows as $array){
                              ?>
                                 <option value="<?php echo $array[0]; ?>"><?php echo $array[1]; ?> 
                                    </option>
                          <?php
                                }
                           ?>
                      </select>
                    </div>
                      <div class="col-md-4">
                  <input type="number" class="form-control" id="CustomerGroupPrice" name="CustomerGroupPrice[]" placeholder="Customer Group Price" min="0" value="">
                </div>
                <button type="button" class="add-btn btn addCustomerGroupPrice" data-id="<?php echo $array[0];?>"><i class="fa fa-plus" aria-hidden="true"></i></button>
                <button type="button" class="btn remove-lnk" data-id="<?php echo $array[0];?>"><i class="fa fa-trash"></i></button> 
                </div>
               </div>
               </div>
               </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Description</label>
                <div class="col-sm-12">
                  <textarea class="form-control" id="Description" name="Description" rows="4" cols="50" placeholder=" Description" value="" required="">
                  </textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">QTY<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="QTY" name="QTY" placeholder="Enter Quantity" value="" min="1" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Video<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="Video" name="Video" placeholder="" value="" required="">
                </div>
              </div>
              </div>            
              <div class="col-sm-12">
                <button type="submit" class="btn btn-primary productadd" id="btn-save" value="create">Add Product
                </button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    </div>
          </div>

<!-- EditForm -->
<div class="modal fade" id="edit-modal" aria-hidden="true">
      <div class="modal-dialog modal-lg" id="EditForm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="editModal"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="editForm" name="editForm" class="form" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="eid" name="eid" value="">  
            <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-sm-6 control-label">Name<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="epname" name="epname" placeholder="Enter Name" value="" maxlength="50" required="">
                </div>
              </div>  
              <div class="form-group">
                <label class="col-sm-6 control-label">Category</label>
                <div class="col-sm-9">
                <?php
                              $cate=new product();
                              $rows=$cate->categoryInfo();
                              foreach($rows as $array){ 
                              ?>
                <input type="checkbox" id="<?php echo $array[0];?>" name="check_list[]" value="<?php echo $array[0];?>">
                <label> <?php echo $array[1];?></label><br>
                              <?php
                              }
                           ?>
                </div>
              </div> 
              <div class="form-group">
                <label class="col-sm-6 control-label">SKU<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="esku" name="esku" placeholder="" value="">
                </div>
              </div>
              <div class="form-group">
                <label for="file" class="col-sm-6 control-label">Image<span style=" color:red;" id="star">*</span></label>
                <div class="img_width" id="displayimg"></div>
                <div class="col-sm-9">
                  <input type="file" class="form-control" id="eimage" name="eimage[]" multiple >
                </div>
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-6 control-label">Price<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" id="ePrice" name="ePrice" placeholder="Price" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-8 control-label">Customer Group Price</label>  
                <div class="wrapper1">
                <div class="input-box1">
                <div class="row">
                <div class="col-sm-4">              
                <select class="form-control" name="eCustomerGroup[]" id="eCustomerGroup">
                      <?php
                              $cate=new customer();
                              $rows=$cate->customerGrp();
                              foreach($rows as $array){
                              ?>
                                 <option value="<?php echo $array[0]; ?>"><?php echo $array[1]; ?> 
                                    </option>
                          <?php
                                }
                           ?>
                      </select>
                    </div>
                      <div class="col-md-4">
                  <input type="number" class="form-control" id="eCustomerGroupPrice" name="eCustomerGroupPrice[]" placeholder="Customer Group Price" min="0" value="">
                </div>
                <button type="button" id="aed" class="add-btn1 btn addCustomerGroupPrice" data-id="<?php echo $array[0];?>"><i class="fa fa-plus" aria-hidden="true"></i></button>
                <button type="button" id="tras" class="btn remove-lnk1" data-id="<?php echo $array[0];?>"><i class="fa fa-trash"></i></button> 
                </div>
               </div>
               </div>
               </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Description<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-12">
                  <textarea class="form-control" id="eDescription" name="eDescription" rows="4" cols="50" placeholder=" Description" value="" required=""></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">QTY<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" id="eQTY" name="eQTY" placeholder="Enter Quantity" value="" min="1" required="">
                </div>
              </div>
              <div class="form-group">
                <button class="btn btn-primary" id="disvideo" ><i class="fa fa-eye"></i></button>
                <label class="col-sm-2 control-label">Video<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-10">
                     <div id="displayvideo"></div>
                  <input type="file" class="form-control" id="eVideo" name="eVideo"  >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Status<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-9">
                  <select class="form-control" name="eStatus" id="eStatus">
                      <option value=""></option>
                      <option value="Enable">Enable</option>
                      <option value="Disable">Disable</option>
                              </select>
                </div>
              </div>
              </div> 
              <div class="col-sm-12">
                <button type="submit" class="btn btn-primary change" id="ebtn-save" value="create">Edit Product
                </button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    </div>
          </div>


<div class="modal fade" id="DescModal" role="dialog">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
         <h3 class="modal-title">Details</h3>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
         </div>
         <div class="modal-body">
            <div class="text-center">
         </div>
         <div class="text-center-video">
         </div>
         </div>
      </div>
   </div>
</div>


</body>
</html>

<?php 
include('header.php');
include '../Model/class.php';
 ?>
<body>            	
  	<?php
 					include 'sidebar.php';
					?>
	 <div class="container-fluid">  
     <div class="col-md-12 offset-md-1"><h2 class="text-white bg-dark"> Customer</h2></div>
            <div class="row">
                 <div class="col-md-12 datatables "><button type="button" id="addProduct" data-toggle="modal" data-target="#ajax-modal" class="btn btn-success">Add Customer </button></div> 
                <div class="col-md-10 offset-md-2 ">
			<table class="table" id="datatab">
              <thead>
                <tr>  
                  <th scope="col">FirstName</th>
                  <th scope="col">LastName</th>
                  <th scope="col">Email</th>
                  <th scope="col">country</th>
                  <th scope="col">Customer Group</th>
                  <th scope="col" style="width:160px;">Action</th>
                </tr>
              </thead>
              <tbody>

				<?php
          $cate=new customer();
          $rows=$cate->customerInfo();
          foreach($rows as $array){
				?>
                <tr>
                    <td><?php echo $array[1];?></td>
                    <td><?php echo $array[2];?></td>
                    <td><?php echo $array[5];?></td>
                    <td><?php echo $array[6];?></td>
                    <?php 
                    $id=$array[7];
                    $cate=new customer();
                    $rows=$cate->groupName($id);?>
                    <td><?php echo $rows;?></td>
                    <td>
                    <a href="javascript:void(0)" class="btn btn-primary customerview" data-id="<?php echo $array[0];?>"><i class="fa fa-eye"></i></a>
                    <a href="javascript:void(0)" class="btn btn-primary customerdelete" data-id="<?php echo $array[0];?>"><i class="fa fa-trash"></i></a>
                    <a href="javascript:void(0)" class="btn btn-primary customeredit" data-id="<?php echo $array[0];?>"><i class="fa fa-edit"></i></a>
                  </td>
                </tr>

                <?php } ?>
              </tbody>
          </table>
      			</div>
            </div>
        </div>



<!--MAINFORM--> 
  <div class="modal fade" id="ajax-modal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="custCrudModal"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="custForm" name="custForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="Id" value="">  
            <div class="form-group">
                <label for="name" class="col-sm-6 control-label">First Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="Enter Name" value="" maxlength="50" required="">
                </div>
              </div>  
              <div class="form-group">
                <label class="col-sm-6 control-label">Last Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="LastName" name="LastName" placeholder="Enter Last Name" value="" maxlength="50" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Email</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control" id="Email" name="Email" placeholder="" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="phone_number" class="col-sm-6 control-label">Phone Number</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="" value="" min="7111111110" max="9999999999" required="" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Address</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="Address" name="Address" rows="4" cols="50" placeholder="Address" value="" required="">
                  </textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Country</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="country" name="country" placeholder="country " value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Customer Group</label>
                <div class="col-sm-9">
                <select class="form-control" name="customerGroup" id="customerGroup" required="">
                      <option value=""></option>
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
              </div>
              <div class="col-sm-offset-2 col-sm-9">
                <button type="submit" class="btn btn-primary customeradd" id="btn-save" value="create">Add Customer
                </button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>


<!--EDITFORM--> 
  <div class="modal fade" id="edit-modal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="editModal"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="editForm" name="editForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="eid" value="">  
            <div class="form-group">
                <label for="name" class="col-sm-6 control-label">First Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="eFirstName" name="eFirstName" placeholder="Enter Name" value="" maxlength="50" required="">
                </div>
              </div>  
              <div class="form-group">
                <label class="col-sm-6 control-label">Last Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="eLastName" name="eLastName" placeholder="Enter Last Name" value="" maxlength="50" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Email</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control" id="eEmail" name="eEmail" placeholder="" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="phone_number" class="col-sm-6 control-label">Phone Number</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" id="ephone_number" name="ephone_number" placeholder="" value=""  min="7111111110" max="9999999999"  required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Address</label>
                <div class="col-sm-9">
                  <textarea type="text" class="form-control" id="eAddress" name="eAddress"  rows="4" cols="50" placeholder="Address" value="" required="">
                  </textarea></div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Country</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="ecountry" name="ecountry" placeholder="country " value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Customer Group</label>
                <div class="col-sm-9">
                <select class="form-control" name="ecustomerGroup" id="ecustomerGroup" required="">
                      <option value=""></option>
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
              </div>
              <div class="col-sm-offset-2 col-sm-9">
                <button type="submit" class="btn btn-primary edit" id="ebtn-save" value="create">Edit Customer
                </button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="DescModal" role="dialog">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
         <h3 class="modal-title"><span id="vFirstName1"></span>&nbsp;<span id="vLastName1"></span></h3>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
         </div>
         <div class="modal-body">
           <div class="col-md-12 VIEW" >
             <div class="row">
             <div class="col-md-6">
           <label ><b>First Name:</b></label><span id="vFirstName"></span><br>
           <label ><b>Last Name:</b></label><span id="vLastName"></span><br>
           <label ><b>Email:</b></label><span id="vEmail"></span><br>
           <label ><b>Phone Number:</b></label><span id="vphone_number"></span><br></div>
           <div class="col-md-6">
           <label ><b>Address:</b></label><span id="vAddress"></span><br>
           <label ><b>Country:</b></label><span id="vcountry"></span><br>
           <label ><b>Customer Group:</b></label><span id="vcustomerGroup"></span></div>
           </div></div>
         </div>
      </div>
   </div>
</div>

</body>
</html>

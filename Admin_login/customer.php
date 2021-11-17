<?php 
include('header.php');
include 'class.php';
 ?>
<body>
<div class="w3-top">
	 <div class="container-fluid"> 
            <div class="row">
            	<div class="col-md-2">
            		<?php
 					include 'sidebar.php';
					?>
            	</div>
                <div class="col-md-10 mt-1 offset-md-2"><h2 class="text-white bg-dark"> Customer Details</h2></div>
                 <div class="col-md-12 datatables "><button type="button" id="addProduct" data-toggle="modal" data-target="#ajax-modal" class="btn btn-success">Add Customer </button></div> 
                <div class="col-md-10 offset-md-2 ">
			<table class="table" id="datatab">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">FirstName</th>
                  <th scope="col">LastName</th>
                  <th scope="col">Email</th>
                  <th scope="col">phone_number</th>
                  <th scope="col">Address</th>
                  <th scope="col">country</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>

				<?php
          $cate=new customer();
          $rows=$cate->customerInfo();
          foreach($rows as $array){
				?>
                <tr>
                    <th scope="row"><?php echo $array[0];?></th>
                    <td><?php echo $array[1];?></td>
                    <td><?php echo $array[2];?></td>
                    <td><?php echo $array[3];?></td>
                    <td><?php echo $array[4];?></td>
                    <td><?php echo $array[5];?></td>
                    <td><?php echo $array[6];?></td>
                    <td>
                    <a href="javascript:void(0)" class="btn btn-primary customerdelete" data-id="<?php echo $array[0];?>">Delete</a>
                    <a href="javascript:void(0)" class="btn btn-primary customeredit" data-id="<?php echo $array[0];?>">Edit</a>
                  </td>
                </tr>

                <?php mysqli_free_result($result); ?>
                <?php } ?>
              </tbody>
          </table>
      			</div>
            </div>
        </div>
 	</div>



<!--MAINFORM--> 
  <div class="modal fade" id="ajax-modal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="custCrudModal"></h4>
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
                  <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Address</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="Address" name="Address" placeholder="Address" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Country</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="country" name="country" placeholder="country " value="" required="">
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
                  <input type="number" class="form-control" id="ephone_number" name="ephone_number" placeholder="" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Address</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="eAddress" name="eAddress" placeholder="Address" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Country</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="ecountry" name="ecountry" placeholder="country " value="" required="">
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

</body>
</html>

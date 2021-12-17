<?php 
include('header.php');
include '../Model/class.php';
 ?>
<body>
<?php	include 'sidebar.php';
					?>
	 <div class="container-fluid"> 
   <!-- <div class="loader"></div> -->
   <div class="col-md-12 offset-md-1"><h2 class="text-white bg-dark"> Customer Group</h2></div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3 offset-1">
                  <form action="javascript:void(0)" id="CustomerGroupForm" name="CustomerGroupForm" class="form-horizontal" method="POST" enctype="multipart/form-data"> 
                <label class="control-label">Add Customer Group<span style="display: none; color:red;" id="star">*</span></label>
                 <input type="text" class="form-control" id="CustomerGroup" name="CustomerGroup" placeholder="Enter Name" value="" maxlength="50" >
                 <p class="message2"></p>
                 <button type="submit" class="btn btn-primary addcustomerGroup" id="addcustomerGroup" value="">Add Group</button>
                </form>
      			  </div>
              <div class="col-md-8">
              <div class="col-md-12" >
                <input type="hidden" id="id" value="" required> 
                      <select class="div-toggle" data-target=".file-upload" name="action" id="Action">
                       <option value="" id="select_group" name="select_group">Select</option>
                      <option value="select_delete_group" id="Submit_Delete" name="Submit_Delete" data-show=".submitdelete" class="">SELECT TO DELETE</option>
                  </select>
                  <button type="submit" class="btn btn-primary submitdelete" id="submitdelete" value="" >Submit</button>
                        <p class="message1"></p>   
                  </div>
                  <div class="col-md-12">
                    <div id="ref">
            <table class="table" id="datatab" >
              <thead>
                <tr>
                  <th scope="col">Select</th>
                  <th scope="col">Group Name</th>
                  <th scope="col" style="width:150px;">Action</th>
                </tr>
              </thead>
              <tbody>
				<?php
          $cate=new customer();
          $rows=$cate->customerGrp();
          foreach($rows as $array){
				?>
                <tr>
                <td><input type="checkbox" id="<?php echo $array[0];?>" name="select_field[]" value="<?php echo $array[0];?>" class="Select"></td>
                    <td><?php echo $array[1];?></td>
                    <td>
                    <a href="javascript:void(0)" class="btn btn-primary groupdelete" data-id="<?php echo $array[0];?>"><i class="fa fa-trash"></i></a>
                    <a href="javascript:void(0)" class="btn btn-primary groupedit" data-id="<?php echo $array[0];?>"><i class="fa fa-edit"></i></a>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
                </table>
          </div>
             </div>
            </div>
     </div>
   </div>


<!--EDITFORM--> 
  <div class="modal fade" id="edit-modal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="editCustomerGroupModal"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="editCustomerGroupForm" name="editCustomerGroupForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="eid" value="">  
            <div class="form-group">
                <label for="name" class="col-sm-6 control-label">Customer Group<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="eCustomerGroup" name="eCustomerGroup" placeholder="Enter Name" value="" maxlength="50" required="">
                </div>
              </div>
              <div class="col-sm-offset-2 col-sm-9">
                <button type="submit" class="btn btn-primary editcustomerGroup" id="editcustomerGroup" value="">Edit Group
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

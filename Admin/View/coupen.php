<?php 
include 'header.php';
include '../Model/class.php';  
 ?>
	 <div class="container-fluid"> 
   <div class="col-md-12 offset-md-1"><h2 class="text-white bg-dark"> Coupen Details</h2></div>
            <div class="row">
            	<div class="col-md-2">
            		<?php
 					include 'sidebar.php';
					?>
            	</div>
                <div class="col-md-9"><p class="message"></p></div> 
                 <div class="col-md-12 datatables "><button type="button" id="addcoupen" data-toggle="modal" data-target="#ajax-modal" class="btn btn-success">Add Coupen </button></div> 
                <div class="col-md-10 offset-md-2 ">
                  <div id="ref">
			<table class="table" id="datatab">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Coupen Code</th>
                  <th scope="col">Coupen Discount</th>
                  <th scope="col" style="width:160px;">Action</th>
                </tr>
              </thead>
              <tbody>

				<?php
	    $cate=new coupen();
      $rows=$cate->coupenInfo();
      foreach($rows as $array){
				?>
                <tr>
                    <th scope="row"><?php echo $array[0];?></th>
                    <td><?php echo $array[1];?></td>
                    <td><?php echo $array[2];?></td>
                    <td>
                    <a href="javascript:void(0)" class="btn btn-primary coupendelete" data-id="<?php echo $array[0];?>"><i class="fa fa-trash"></i></a>
                    <a href="javascript:void(0)" class="btn btn-primary coupenedit" data-id="<?php echo $array[0];?>"><i class="fa fa-edit"></i></a>
                  </td>
                </tr>
              
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
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="custForm" name="custForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="id" value="">  
            <div class="form-group">
                <label for="name" class="col-sm-4 control-label">Coupen Code<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="CoupenCode" name="CoupenCode" placeholder="Enter code" value="" maxlength="10" required="">
                </div>
              </div>  
              <div class="form-group">
                <label class="col-sm-4 control-label">Discount<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="CoupenDiscount" name="CoupenDiscount" placeholder="" value="" maxlength="50" required="">
                </div>
              </div>
              <div class="col-sm-offset-2 col-sm-9">
                <button type="submit" class="btn btn-primary coupenadd" id="btn-save" value="create">Add Coupen
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
                <label for="name" class="col-sm-6 control-label">Coupen Code<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="eCoupenCode" name="eCoupenCode" placeholder="Enter code" value="" maxlength="10" required="">
                </div>
              </div>  
              <div class="form-group">
                <label class="col-sm-6 control-label">Coupen Discount<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="eCoupenDiscount" name="eCoupenDiscount" placeholder="" value="" maxlength="50" required="">
                </div>
              </div>
              <div class="col-sm-offset-2 col-sm-9">
                <button type="submit" class="btn btn-primary edit" id="ebtn-save" value="create">Edit Coupen
                </button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>


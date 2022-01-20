<?php 
include 'header.php';
include '../Model/class.php';  
 ?>
	 <div class="container-fluid"> 
   <div class="col-md-12 offset-md-1"><h2 class="text-white bg-dark"> Blog category</h2></div>
            <div class="row">
            	<div class="col-md-2">
            		<?php
 					include 'sidebar.php';
					?>
            	</div>
                <div class="col-md-9"><p class="message"></p></div> 
                 <div class="col-md-12 datatables "><button type="button" id="addblogCategory" data-toggle="modal" data-target="#ajax-modal" class="btn btn-success">Add Category </button></div> 
                <div class="col-md-10 offset-md-2 ">
                  <div id="ref">
			<table class="table" id="datatab">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Category</th>
                  <th scope="col">Sub Category</th>
                  <th scope="col" style="width:160px;">Action</th>
                </tr>
              </thead>
              <tbody>

				<?php
	    $cate=new Blog();
      $rows=$cate->BlogcategoryInfo();
      foreach($rows as $array){
				?>
                <tr>
                    <th scope="row"><?php echo $array[0];?></th>
                    <td><?php echo $array[2];?></td>
                    <td><?php echo $array[1];?></td>
                    <td>
                    <a href="javascript:void(0)" class="btn btn-primary blogCategorydelete" data-id="<?php echo $array[0];?>"><i class="fa fa-trash"></i></a>
                    <a href="javascript:void(0)" class="btn btn-primary blogCategoryedit" data-id="<?php echo $array[0];?>"><i class="fa fa-edit"></i></a>
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
            <h4 class="modal-title" id="categoryblogModal"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="categoryblogForm" name="categoryblogForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="id" value="">  
            <div class="form-group">
                <label for="name" class="col-sm-4 control-label">Category<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="Category_blog" name="Category_blog" placeholder="Enter Name" value="" required="">
                </div>
              </div>  
              <div class="form-group">
                <label class="col-sm-5 control-label">Sub Category<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" id="Sub_Category" name="Sub_Category" placeholder="" min="0" value="" required="">
                </div>
              </div>
              <div class="col-sm-offset-2 col-sm-9">
                <button type="submit" class="btn btn-primary blogCategoryadd" id="btn-save" value="create">Add Category
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
            <h4 class="modal-title" id="editcategoryblogModal"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="ecategoryblogForm" name="ecategoryblogForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="eid" value="">  
            <div class="form-group">
                <label for="name" class="col-sm-4 control-label">Category<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="eCategory_blog" name="eCategory_blog" placeholder="Enter Name" value="" required="">
                </div>
              </div>  
              <div class="form-group">
                <label class="col-sm-5 control-label">Sub Category<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" id="eSub_Category" name="eSub_Category" placeholder="" min="0" value="" required="">
                </div>
              </div>
              <div class="col-sm-offset-2 col-sm-9">
                <button type="submit" class="btn btn-primary blogCategoryedit" id="ebtn-save" value="create">Add Category
                </button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>


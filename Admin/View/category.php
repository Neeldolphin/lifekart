<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include('header.php');
include '../Model/class.php';
 ?>
<body>
	 <div class="container-fluid"> 
   <div class="col-md-12 offset-md-1"><h2 class="text-white bg-dark"> Category Details</h2></div>
            <div class="row">
              <div class="col-md-2">
                <?php
          include 'sidebar.php';
          ?>
              </div>
                <div class="offset-md-2 col-md-12 row">
                <div class="col-md-9"><p class="message"></p></div> 
               <div class="datatables"> <button type="button" id="addCategory" data-toggle="modal" data-target="#ajax-modal" class="btn btn-success">Add Category </button></div>
                </div>
                <div class="col-md-10 offset-md-2 ">
                  <div id="ref">
			<table class="table" id="datatab">
              <thead>
                <tr>
                  <th scope="col">Categoryid</th>
                  <th scope="col">Name</th>
                  <th scope="col">Image</th>
                  <th scope="col">Description</th>
                  <!-- <th scope="col">Thumbnails</th> -->
                  <th scope="col" style="width:160px;">Action</th>
                </tr>
              </thead>
              <tbody>

				<?php 
         $cate=new category();
         $rows=$cate->categoryInfo();
         foreach($rows as $array){
				?>
                <tr>
                    <th scope="row"><?php echo $array[0];?></th>
                    <td><?php echo $array[1];?></td>
                    <td><img class="img_width" src="http://localhost/lifekart/Admin/uploads/<?php echo $array[2];?>"></td>
                    <td><?php echo $array[3];?></td>
                    <!-- <td><img class="img_width" src="http://localhost/lifekart/Admin/uploads/<?php echo $array[4];?>"></td> -->
                    <td>
                    <a href="javascript:void(0)" class="btn btn-primary categorydelete" data-id="<?php echo $array[0];?>"><i class="fa fa-trash"></i></a>
                  <a href="javascript:void(0)" class="btn btn-primary categorychange" data-id="<?php echo $array[0];?>"><i class="fa fa-edit"></i></a>
                  </td>
                </tr>
                <?php }?>
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
                <label for="name" class="col-sm-6 control-label">Name<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="cname" name="cname" placeholder="Enter Name" value="" maxlength="50" required="">
                </div>
              </div>  
              <div class="form-group">
                <label for="file" class="col-sm-6 control-label">Image<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-12">
                  <input type="file" class="form-control" id="image" name="image" placeholder="" value="" required="">
                </div>
              </div>
              <!-- <div class="form-group">
                <label for="file" class="col-sm-6 control-label">Thumbnail<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-12">
                  <input type="file" class="form-control" id="thumbnail" name="thumbnail" placeholder="" value="" required="">
                </div>
              </div> -->
              <div class="form-group">
                <label class="col-sm-6 control-label">Description</label>
                <div class="col-sm-12">
                  <textarea type="text" class="form-control" id="description" rows="4" cols="50" name="description" placeholder=" Description" value="" required="">
                  </textarea>
                </div>
              </div>
              <div class="col-sm-offset-2 col-sm-10">
              
                <button type="submit" class="btn btn-primary categoeryadd" id="btn-save" value="create">Add Product
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
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="editModal"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="editForm" name="editForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
              <input type="hidden" id="eid" name="eid" value=""> 
              <div class="col-md-12">
          <div class="row">
            <div class="col-md-4">
            <div class="form-group">
                <label for="name" class="col-sm-6 control-label">Name<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="ecname" name="ecname" placeholder="Enter Name" value="" maxlength="50" required="">
                </div>
              </div>  
              <div class="form-group">
              <div class="img_width" id="showimg"></div>
                <label for="file" class="col-sm-6 control-label mt-5">Image<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-12">
                  <input type="file" class="form-control" id="eimage" name="eimage" placeholder="" value="" >
                </div>
              </div>
              <!-- <div class="img_width" id="showimg"></div>
                <label for="file" class="col-sm-6 control-label">Thumbnail<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-12">
                  <input type="file" class="form-control" id="ethumbnail" name="ethumbnail" placeholder="" value="" >
                </div>
              </div> -->
              <div class="form-group">
                <label class="col-sm-6 control-label">Description</label>
                <div class="col-sm-12">
                  <textarea class="form-control" id="edescription" rows="4" cols="50" name="edescription" ></textarea>
                </div>
              </div>
              </div>
            <div class="col-md-8">
              <div>
              <table class="table" id="datatab1">
              <thead>
                <tr>
                  <th scope="col">ProductId</th>
                  <th scope="col">Name</th>
                  <th scope="col">Select</th>
                  <th scope="col">Position</th>
                </tr>
              </thead>
              <tbody>
				<?php 
         $cate=new product();
         $rows=$cate->ProductInfo();
         foreach($rows as $array){
				?>
                <tr> 
                <td scope="row"><?php echo $array[0];?></td>
                <td><?php echo $array[1];?></td>
                <td>
                    <input type="checkbox" id="<?php echo $array[0];?>" name="check_list[]" value="<?php echo $array[0];?>">
                   </td> 
                    <td><input type="number" id="<?php echo $array[0];?>" min="0" name="Position[]" class="position" value="<?php echo $array[12];?>">
                  <input type="hidden" value="<?php echo $array[0];?>" name="posid[]"></td>
                </tr>
                <?php }?>
              </tbody>
              </table>
              </div>
            </div>
              </div>
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary edit" id="ebtn-save" value="create">Edit Category
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

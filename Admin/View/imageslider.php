<?php 
include('header.php');
include '../Model/class.php';
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
                <div class="col-md-10 offset-md-2"><h2 class="text-white bg-dark"> Image Slider</h2></div>
                <div class="col-md-12 datatables"><button type="button" id="addSlider" data-toggle="modal" data-target="#ajax-modal" class="btn btn-success">Add Image </button></div>
                <div class="col-md-10 offset-md-2 ">
			<table class="table" id="datatab">
              <thead>
                <tr>
                  <th scope="col">id</th>
                  <th scope="col">imageName</th>
                  <th scope="col">Link</th>
                  <th scope="col" style="width:160px;">Action</th>
                </tr>
              </thead>
              <tbody>

				<?php
        $cate=new carousel();
        $rows=$cate->carouselInfo();
        foreach($rows as $array){
				?>
                <tr>
                    <th scope="row"><?php echo $array[0];?></th>
                    <td><img class="img_width" src="http://localhost/lifekart/Admin/uploads/<?php echo $array[1];?>"></td>
                    <td><?php echo $array[2];?></td>
                    <td>
                    <a href="javascript:void(0)" class="btn btn-primary imagesdelete" data-id="<?php echo $array[0];?>"><i class="fa fa-trash"></i></a>
                  <a href="javascript:void(0)" class="btn btn-primary imageschange" data-id="<?php echo $array[0];?>"><i class="fa fa-edit"></i></a>
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
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="custForm" name="custForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
              <input type="hidden" id="id" value=""> 
            <div class="form-group">
                <label for="name" class="col-sm-6 control-label">Image Name</label>
                <div class="col-sm-12">
                  <input type="file" class="form-control" id="imageName" name="imageName" placeholder="Enter Name" value="" maxlength="50" required="">
                </div>
              </div>  
              <div class="form-group">
                <label for="file" class="col-sm-6 control-label">Link</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="link" name="link" placeholder="" value="" required="">
                </div>
              </div>
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary imagesadd" id="btn-save" value="create">Add Image
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
              <input type="hidden" id="eid" name="eid" value=""> 
              <div class="img_width" id="showimg"></div>
            <div class="form-group">
                <label for="name" class="col-sm-6 control-label">Image Name</label>
                <div class="col-sm-12">
                  <input type="file" class="form-control" id="eimageName" name="eimageName" placeholder="Enter Name" value="" maxlength="50" >
                </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Link</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="elink" name="elink" >
                </div>
              </div>
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary edit" id="ebtn-save" value="create">Edit Image
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

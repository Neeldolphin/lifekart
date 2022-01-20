<?php 
include('header.php');
include '../Model/class.php';
 ?>
<body>
	 <div class="container-fluid"> 
   <div class="col-md-12 offset-md-1"><h2 class="text-white bg-dark">AUTHOR</h2></div>
            <div class="row">
              <div class="col-md-2">
                <?php
          include 'sidebar.php';
          ?>
              </div>
                <div class="col-md-9"><p class="message"></p></div> 
                <div class="col-md-12 datatables"><button type="button" id="addWriter" data-toggle="modal" data-target="#ajax-modal" class="btn btn-success">Add writer </button></div>
                <div class="col-md-10 offset-md-2 ">
                <div id="ref">
			<table class="table" id="datatab">
              <thead>
                <tr>
                  <th scope="col">Author Name</th>
                  <th scope="col" style="width:160px;">Action</th>
                </tr>
              </thead>
              <tbody>

				<?php
        $cate=new blog();
        $rows=$cate->WriterInfo();
        foreach($rows as $array){
				?>
                <tr>
                    <td><?php echo $array[2];?></td>
                    <td>
                    <a href="javascript:void(0)" class="btn btn-primary authorsdelete" data-id="<?php echo $array[0];?>"><i class="fa fa-trash"></i></a>
                  <a href="javascript:void(0)" class="btn btn-primary authorchange" data-id="<?php echo $array[0];?>"><i class="fa fa-edit"></i></a>
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
            <h4 class="modal-title" id="WriterModal"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="writerForm" name="writerForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
              <input type="hidden" id="id" value=""> 
            <div class="form-group">
                <label for="name" class="col-sm-6 control-label">Author Image<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-12">
                  <input type="file" class="form-control" id="imageName" name="imageName" placeholder="Enter Image" value="" maxlength="50" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="name" class="col-sm-6 control-label">Author Name<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="AuthorName" name="AuthorName" placeholder="Enter Name" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="name" class="col-sm-6 control-label">Author Info<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-12">
                  <textarea class="form-control" id="AuthorInfo" name="Authorinfo" placeholder="" value="" required="">Enter Info</textarea>
                </div>
              </div>    
              <div class="form-group">
                <label for="file" class="col-sm-6 control-label">Facebook Link</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="Facebooklink" name="Facebooklink">
                </div>
              </div>
              <div class="form-group">
                <label for="file" class="col-sm-6 control-label">Linkedin Link</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="Linkedinlink" name="Linkedinlink">
                </div>
              </div>
              <div class="form-group">
                <label for="file" class="col-sm-6 control-label">Tweeter Link</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="Tweeterlink" name="Tweeterlink">
                </div>
              </div>
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary Writeradd" id="btn-save" value="create">Add writer
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
            <h4 class="modal-title" id="editWriterModal"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="editWriterForm" name="editWriterForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
              <input type="hidden" id="eid" name="eid" value=""> 
              <div class="img_width" id="showimg"></div>
              <div class="form-group">
                <label for="name" class="col-sm-6 control-label">Image<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-12">
                  <input type="file" class="form-control" id="eimageName" name="eimageName" placeholder="Enter Image" value="" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Author Name<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="eAuthorName" name="eAuthorName" placeholder="Enter Name" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Author Info<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-12">
                  <textarea class="form-control" id="eAuthorInfo" name="eAuthorinfo" placeholder="" value="" required="">Enter Info</textarea>
                </div>
              </div>    
              <div class="form-group">
                <label class="col-sm-6 control-label">Facebook Link</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="eFacebooklink" name="eFacebooklink">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Linkedin Link</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="eLinkedinlink" name="eLinkedinlink">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Tweeter Link</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="eTweeterlink" name="eTweeterlink">
                </div>
              </div>
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary edit" id="ebtn-save" value="create">Edit writer
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

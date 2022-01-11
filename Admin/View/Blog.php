<?php 
include('header.php');
include '../Model/class.php';
 ?>
<body>
	 <div class="container-fluid"> 
   <div class="col-md-12 offset-md-1"><h2 class="text-white bg-dark"> Blog</h2></div>
            <div class="row">
              <div class="col-md-2">
                <?php
          include 'sidebar.php';
          ?>
              </div>
                <div class="col-md-9"><p class="message"></p></div> 
                <div class="col-md-12 datatables"><button type="button" id="addBloginfo" data-toggle="modal" data-target="#ajax-modal" class="btn btn-success">Add Blog </button></div>
                <div class="col-md-10 offset-md-2 ">
                <div id="ref">
			<table class="table" id="datatab">
              <thead>
                <tr>
                  <th scope="col">Blog Name</th>
                  <th scope="col">Tags</th>
                  <th scope="col">Blog Author</th>
                  <th scope="col">Blog Category</th>
                  
                  <th scope="col" style="width:160px;">Action</th>
                </tr>
              </thead>
              <tbody>

				<?php
        $cate=new blog();
        $rows=$cate->BlogInfo();
        foreach($rows as $array){
				?>
                <tr>
                    <td><?php echo $array[1];?></td>  
                    <td>
                    <?php 
                    $id=$array[4];
                    $rows0=$cate->BlogTagsdetail($id);
                     echo $rows0 ;
                    ?>
                    </td>
                    <?php $id=$array[5];
                    $rows1=$cate->WriterAuthorinfo($id); ?>
                    <td><?php echo $rows1[0][0];?></td>
                        <?php 
                        $id=$array[6];
                        $rows2=$cate->Blogcategorydetail($id);?>
                    <td><?php echo $rows2[0][0];?></td>
                    <td>
                    <a href="javascript:void(0)" class="btn btn-primary Blogdelete" data-id="<?php echo $array[0];?>"><i class="fa fa-trash"></i></a>
                  <a href="javascript:void(0)" class="btn btn-primary Blogchange" data-id="<?php echo $array[0];?>"><i class="fa fa-edit"></i></a>
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
            <h4 class="modal-title" id="BloginfoModal"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="BlogForm" name="BlogForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
              <input type="hidden" id="id" value=""> 
            <div class="form-group">
                <label for="name" class="col-sm-6 control-label">Blog Image<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-12">
                  <input type="file" class="form-control" id="imageName" name="imageName" placeholder="Enter Image" value="" maxlength="50" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="name" class="col-sm-6 control-label">Blog Name<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="BlogName" name="BlogName" placeholder="Enter Name" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="name" class="col-sm-6 control-label">Blog Info<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-12">
                  <textarea class="form-control" id="BlogInfo" name="Bloginfo" placeholder="" value="" required="">Enter Info</textarea>
                </div>
              </div>    
              <div class="form-group">
                <label class="col-sm-6 control-label">Tags</label>
                <div class="col-sm-12">
                  <select class="form-control" id="Tags" name="Tags[]" multiple>
                  <option value=""></option>
                          <?php
                              $cate=new blog();
                              $rows=$cate->TagInfo();
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
              <div class="form-group">
                <label class="col-sm-6 control-label">Author</label>
                <div class="col-sm-12">
                  <select class="form-control" id="Author" name="Author">
                  <option value=""></option>
                          <?php
                              $cate=new blog();
                              $rows=$cate->WriterInfo();
                              foreach($rows as $array){
                              ?>
                                  <option value="<?php echo $array[0]; ?>"><?php echo $array[2]; ?>
                                    </option>
                          <?php
                                }
                           ?>
                              </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">category</label>
                <div class="col-sm-12">
                  <select class="form-control" id="category" name="category">
                  <option value=""></option>
                          <?php
                              $cate=new blog();
                              $rows=$cate->BlogcategoryInfo();
                              foreach($rows as $array){
                              ?>
                                  <option value="<?php echo $array[0]; ?>"><?php echo $array[2]; ?>
                                    </option>
                          <?php
                                }
                           ?>
                              </select>
                </div>
              </div>
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary Blogadd" id="btn-save" value="create">Add Blog
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
            <h4 class="modal-title" id="editBloginfoModal"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="editBloginfoForm" name="editBloginfoForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
              <input type="hidden" id="eid" name="eid" value=""> 
              <div class="img_width" id="showimg"></div>
              <div class="form-group">
                <label for="name" class="col-sm-6 control-label">Blog Image<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-12">
                  <input type="file" class="form-control" id="eimageName" name="eimageName" placeholder="Enter Image" value="" maxlength="50" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="name" class="col-sm-6 control-label">Blog Name<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="eBlogName" name="eBlogName" placeholder="Enter Name" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="name" class="col-sm-6 control-label">Blog Description<span style=" color:red;" id="star">*</span></label>
                <div class="col-sm-12">
                  <textarea class="form-control" id="eBlogInfo" name="eBloginfo" placeholder="" value="" required="">Enter Info</textarea>
                </div>
              </div>    
              <div class="form-group">
                <label class="col-sm-6 control-label">Tags</label>
                <div class="col-sm-12">
                <select class="form-control" id="eTags" name="eTags[]" multiple>
                  <option value=""></option>
                          <?php
                              $cate=new blog();
                              $rows=$cate->TagInfo();
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
              <div class="form-group">
                <label class="col-sm-6 control-label">Author</label>
                <div class="col-sm-12">
                  <select class="form-control" id="eAuthor" name="eAuthor">
                  <option value=""></option>
                          <?php
                              $cate=new blog();
                              $rows=$cate->WriterInfo();
                              foreach($rows as $array){
                              ?>
                                  <option value="<?php echo $array[0]; ?>"><?php echo $array[2]; ?>
                                    </option>
                          <?php
                                }
                           ?>
                              </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">category</label>
                <div class="col-sm-12">
                  <select class="form-control" id="ecategory" name="ecategory">
                  <option value=""></option>
                          <?php
                              $cate=new blog();
                              $rows=$cate->BlogcategoryInfo();
                              foreach($rows as $array){
                              ?>
                                  <option value="<?php echo $array[0]; ?>"><?php echo $array[2]; ?>
                                    </option>
                          <?php
                                }
                           ?>
                              </select>
                </div>
              </div>
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary edit" id="ebtn-save" value="create">Edit Bloginfo
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

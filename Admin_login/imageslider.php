<?php 
include('header.php');
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
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>

				<?php
				include('connection.php');  
				$query="select * from slider"; 
				$result=mysqli_query($con,$query);
				?>

				<?php if ($result->num_rows > 0): ?>
				<?php while($array=mysqli_fetch_row($result)): ?>

                <tr>
                    <th scope="row"><?php echo $array[0];?></th>
                    <td><img class="img_width" src="http://localhost/lifekart/Admin_login/uploads/<?php echo $array[1];?>"></td>
                    <td><?php echo $array[2];?></td>
                    <td>
                    <a href="javascript:void(0)" class="btn btn-primary delete" data-id="<?php echo $array[0];?>">Delete</a>
                  <a href="javascript:void(0)" class="btn btn-primary change" data-id="<?php echo $array[0];?>">Edit</a>
                  </td>
                </tr>

                <?php endwhile; ?>
                <?php endif; ?>
                <?php mysqli_free_result($result); ?>
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
                <button type="submit" class="btn btn-primary add" id="btn-save" value="create">Add Image
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

<script type="text/javascript">
$(document).ready( function () {
    $('#datatab').DataTable();
} );
</script>

<script type="text/javascript">
$(document).ready(function(){
      $('#create').click(function () {
       $('#custForm').trigger("reset");
       $('#custCrudModal').html("Add New Image");
       $('#ajax-modal').modal('show');
    });
        
     $('body').on('click', '.add', function () {
    $("#custForm").validate({
        rules: {
            imageName: "required"
           },
        messages: {
            imageName: "Enter your Image",
        },
        submitHandler: function(form) { 
        $('#custForm').submit(function() { 
          var data=new FormData(this);
          var action='image_details';
          data.append('action',action);
        $.ajax({
            type:"POST",
            url: "action.php",
            data: data, 
            mimeType:"multipart/form-data",
            contentType: false, cache: false, processData:false,
            dataType: 'json',
            success: function(result){
              if (result == 1) {
             window.location.reload(true);
            }else
             alert('Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.');
             }
          });
          });
               form.submit();
              }
            });
          });
       });
</script>


<script type="text/javascript">
$(document).ready(function(){

$('body').on('click', '.change', function () {
        var id = $(this).data('id');
        var action='image_edit';
       $('#editModal').html("Edit Image");
       $('#edit-modal').modal('show');
   
    $.ajax({
            type:"POST",
            url: "action.php",
            data: { id:id,action:action },
            dataType: 'json', 
            success: function(result){
              $('#eid').val(result[0].id);
              $('#showimg').html("<img src='http://localhost/lifekart/Admin_login/uploads/" + result[0].imageName +"'>");
              $('#elink').val(result[0].link);
           }
        });

    $("#editForm").on('submit',function(){
        var id = $(this).data('id');
        var action='image_update';
        var data=new FormData(this);
          data.append('action',action);

        $.ajax({
            type:"POST",
            url: "action.php",
            data: data,
            mimeType:"multipart/form-data",
            contentType: false, cache: false, processData:false,
            dataType: 'json',
            success: function(result){
              if (result == 1) {
             window.location.reload(true);
            }else{
             alert('Sorry,unable update.');
             }
           }
          });
            });
          });
       });

</script>

<script type="text/javascript">
$(document).ready(function($){

 $('body').on('click', '.delete', function () {
       if (confirm("Delete Record?") == true) {
        var id = $(this).data('id');
        var action='image_delete';
        $.ajax({
            type:"POST",
            url: "action.php",
            data: { id: id,action:action},
            dataType: 'json',
            success: function(result){
            if (result == 1) {
             window.location.reload(true);
            }
           }
        }); 
       }
    });
});
</script>

</body>
</html>

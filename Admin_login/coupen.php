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
                <div class="col-md-10 mt-1 offset-md-2"><h2 class="text-white bg-dark"> Coupen Details</h2></div>
                 <div class="col-md-12 datatables "><button type="button" id="addcoupen" data-toggle="modal" data-target="#ajax-modal" class="btn btn-success">Add Coupen </button></div> 
                <div class="col-md-10 offset-md-2 ">
			<table class="table" id="datatab">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Coupen Code</th>
                  <th scope="col">Coupen Discount</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>

				<?php
				include('connection.php');  
				$query="select * from coupen_code"; 
				$result=mysqli_query($con,$query);
				?>

				<?php if ($result->num_rows > 0): ?>
				<?php while($array=mysqli_fetch_row($result)): ?>

                <tr>
                    <th scope="row"><?php echo $array[0];?></th>
                    <td><?php echo $array[1];?></td>
                    <td><?php echo $array[2];?></td>
                    <td>
                    <a href="javascript:void(0)" class="btn btn-primary delete" data-id="<?php echo $array[0];?>">Delete</a>
                    <a href="javascript:void(0)" class="btn btn-primary edit" data-id="<?php echo $array[0];?>">Edit</a>
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
                <label for="name" class="col-sm-4 control-label">Coupen Code</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="CoupenCode" name="CoupenCode" placeholder="Enter code" value="" maxlength="10" required="">
                </div>
              </div>  
              <div class="form-group">
                <label class="col-sm-4 control-label">Discount</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="CoupenDiscount" name="CoupenDiscount" placeholder="" value="" maxlength="50" required="">
                </div>
              </div>
              <div class="col-sm-offset-2 col-sm-9">
                <button type="submit" class="btn btn-primary add" id="btn-save" value="create">Add Coupen
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
                <label for="name" class="col-sm-6 control-label">Coupen Code</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="eCoupenCode" name="eCoupenCode" placeholder="Enter code" value="" maxlength="10" required="">
                </div>
              </div>  
              <div class="form-group">
                <label class="col-sm-6 control-label">Coupen Discount</label>
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


<script type="text/javascript">
$(document).ready( function () {
    $('#datatab').DataTable({
    "scrollY":"400px",
    "scrollCollapse": true
    });
} );
</script>


<script type="text/javascript">  
$(document).ready(function(){
      $('#create').click(function () {
       $('#custForm').trigger("reset");
       $('#custCrudModal').html("Add New Coupen");
       $('#ajax-modal').modal('show');
    });
        
     $('body').on('click', '.add', function(){
        $('#custForm').submit(function(){ 
          var data=new FormData(this);
          var action='coupen_details';
          data.append('action',action);

        $.ajax({
            type:"POST",
            url: "action.php",
            data: data,
            dataType: 'json',
            mimeType:"multipart/form-data",
            contentType: false, cache: false, processData:false,
            success: function(result){
             window.location.reload(true);
             }
          });
          });
          });
       });

</script>

<script type="text/javascript">  
$(document).ready(function(){

     $('body').on('click', '.edit', function () {
             $('#editModal').html("Edit Coupen");
              $('#edit-modal').modal('show');
              var id = $(this).data('id');
              var action='coupen_edit';
   
      $.ajax({
            type:"POST",
            url: "action.php",
            data: { id:id,action:action},
            dataType: 'json',
            ContentType: 'multipart/form-data', 
            success: function(result){
              $('#eid').val(result.coupen_id);
              $('#eCoupenCode').val(result.coupen_name);
              $('#eCoupenDiscount').val(result.coupen_discount);
           }
        });

    $("#editForm").submit(function(){

        var id = $(this).data('id');
        var action='coupen_update';

        $.ajax({
            type:"POST",
            url: "action.php",
            data: {
                coupen_id: $('#eid').val(),
                coupen_name: $('#eCoupenCode').val(),
                coupen_discount: $('#eCoupenDiscount').val(),
                 action:action
            },
            dataType: 'json',
            success: function(result){
             window.location.reload(true);
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
        var action='coupen_delete';
         
        $.ajax({
            type:"POST",
            url: "action.php",
            data: { id: id,action:action },
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

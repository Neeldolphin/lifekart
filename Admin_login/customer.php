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
				include('connection.php');  
				$query="select * from customer_info"; 
				$result=mysqli_query($con,$query);
				?>

				<?php if ($result->num_rows > 0): ?>
				<?php while($array=mysqli_fetch_row($result)): ?>

                <tr>
                    <th scope="row"><?php echo $array[0];?></th>
                    <td><?php echo $array[1];?></td>
                    <td><?php echo $array[2];?></td>
                    <td><?php echo $array[3];?></td>
                    <td><?php echo $array[4];?></td>
                    <td><?php echo $array[5];?></td>
                    <td><?php echo $array[6];?></td>
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
                <button type="submit" class="btn btn-primary add" id="btn-save" value="create">Add Customer
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


<script type="text/javascript">
$(document).ready( function () {
    $('#datatab').DataTable();
} );
</script>


<script type="text/javascript">  
$(document).ready(function(){
      $('#create').click(function () {
       $('#custForm').trigger("reset");
       $('#custCrudModal').html("Add New customer");
       $('#ajax-modal').modal('show');
    });
        
     $('body').on('click', '.add', function(){
        $('#custForm').submit(function(){ 
          var data = $(this).serialize();
        $.ajax({
            type:"POST",
            url: "action.php",
            data: data,
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
$(document).ready(function(){

     $('body').on('click', '.edit', function () {
      var id = $(this).data('id');
      var action='customer_edit';
             $('#editModal').html("Edit Customer");
              $('#edit-modal').modal('show');
   
      $.ajax({
            type:"POST",
            url: "action.php",
            data: { id:id,action:action},
            dataType: 'json', 
            success: function(result){
              $('#eid').val(result[0].Id);
              $('#eFirstName').val(result[0].FirstName);
              $('#eLastName').val(result[0].LastName);
              $('#eEmail').val(result[0].Email);
              $('#ephone_number').val(result[0].phone_number);
              $('#eAddress').val(result[0].Address);
              $('#ecountry').val(result[0].country);
           }
        });

    $("#editForm").validate({
        rules: {
            FirstName: "required",
            LastName: "required",
            Address:"required",
            phone_number: {
              required: true,
                digits:true,
                minlength:10,
                maxlength:10
            }
           },
        messages: {
            FirstName: "Enter your Name",
        },
        submitHandler: function(form) { 
        var id = $(this).data('id');
        var action='customer_update';

        $.ajax({
            type:"POST",
            url: "action.php",
            data: {
              Id: $('#eid').val(),
               FirstName: $('#eFirstName').val(),
               LastName: $('#eLastName').val(),
                Email: $('#eEmail').val(),
                 phone_number: $('#ephone_number').val(),
                 Address: $('#eAddress').val(),
                 country: $('#ecountry').val(),
                 action:action
            },
            dataType: 'json',
            success: function(result){
             window.location.reload(true);
             }
          });
               form.submit();
              }
            });
          });
       });

</script>


<script type="text/javascript">
$(document).ready(function($){

 $('body').on('click', '.delete', function () {
       if (confirm("Delete Record?") == true) {
        var id = $(this).data('id');
        var action='customer_delete';
         
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

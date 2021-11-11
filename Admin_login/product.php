<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
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
                <div class="col-md-10 mt-1 offset-md-2"><h2 class="text-white bg-dark"> Product Details</h2></div>
                <div class="col-md-12 datatables "><button type="button" id="addProduct" data-toggle="modal" data-target="#ajax-modal" class="btn btn-success">Add Product </button></div>
                <div class="col-md-10  offset-md-2 ">
			<table class="table " id="datatab">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Name</th>
                  <th scope="col">Category</th>
                  <th scope="col">SKU</th>
                  <th scope="col">Image</th>
                  <th scope="col">Price</th>
                  <th scope="col">Description</th>
                  <th scope="col">Video</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
				<?php
        include('connection.php');
      //  $query="select * from Product_info"; 
     $query="select * from Product_info INNER JOIN category_info ON Product_info.category=category_info.id "; 
				$result=mysqli_query($con,$query);
				?>

				<?php if ($result->num_rows > 0): ?>
				<?php while($array=mysqli_fetch_row($result)): 
          $var=unserialize($array[4]);
          ?>
                <tr>
                    <td scope="row"><?php echo $array[0];?></td>
                    <td><?php echo $array[1];?></td>
                    <td><?php echo $array[13];?></td>
                    <td><?php echo $array[3];?></td>
                    <td><?php for($i=0; $i<count($var); $i++){ ?><img class="img_width" src="http://localhost/lifekart/Admin_login/uploads/<?php echo $var[$i];?>"><?php } ?></td>
                    <td><?php echo $array[5];?></td>
                    <td><?php echo $array[6];?></td>
                    <td><video width="180" height="90" controls>
                    <source src="http://localhost/lifekart/Admin_login/uploads/<?php echo $array[7];?>" type="video/mp4"></video></td>
                    <td><?php echo $array[8];?></td>
                    <td><?php echo $array[9];?></td>
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
            <input type="hidden" id="Id" value="">  
            <div class="form-group">
                <label for="name" class="col-sm-6 control-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="pname" name="pname" placeholder="Enter Name" value="" maxlength="50" required="">
                </div>
              </div>  
              <div class="form-group">
                <label class="col-sm-6 control-label">Category</label>
                <div class="col-sm-9">
                  <select class="form-control" name="category" id="category">
                      <option value=""></option>
                          <?php
                              $query="SELECT * FROM category_info";
                              $result = mysqli_query($con,$query);
                                 while($array = mysqli_fetch_array($result))
                                {
                          ?>
                                  <option value="<?php echo $array['id']; ?>"><?php echo $array['CName']; ?>
                                    </option>
                          <?php
                                }
                           ?>
                              </select>
                </div>
              </div> 
              <div class="form-group">
                <label class="col-sm-6 control-label">SKU</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" id="sku" name="sku" placeholder="" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="file" class="col-sm-6 control-label">Image</label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" id="image" name="image[]" multiple required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Price</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" id="Price" name="Price" placeholder="Price" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Description</label>
                <div class="col-sm-9">
                  <input type="textarea" class="form-control" id="Description" name="Description" placeholder=" Description" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">QTY</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" id="QTY" name="QTY" placeholder="Enter Quantity" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Video</label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" id="Video" name="Video" placeholder="" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Status</label>
                <div class="col-sm-9">
                  <select class="form-control" name="Status" id="Status">
                      <option value=""></option>
                      <option value="Enable">Enable</option>
                      <option value="Disable">Disable</option>
                              </select>
                </div>
              </div>
              <div class="col-sm-offset-2 col-sm-9">
                <button type="submit" class="btn btn-primary add" id="btn-save" value="create">Add Product
                </button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>

<!-- EditForm -->
<div class="modal fade" id="edit-modal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="editModal"></h4>
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="editForm" name="editForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="eid" name="eid" value="">  
            <div class="form-group">
                <label for="name" class="col-sm-6 control-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="epname" name="epname" placeholder="Enter Name" value="" maxlength="50" required="">
                </div>
              </div>  
              <div class="form-group">
                <label class="col-sm-6 control-label">Category</label>
                <div class="col-sm-9">
                  <select class="form-control" name="ecategory" id="ecategory">
                      <option value=""></option>
                          <?php
                              $query="SELECT * FROM category_info";
                              $result = mysqli_query($con,$query);
                                 while($array = mysqli_fetch_array($result))
                                {
                          ?>
                                  <option value="<?php echo $array['id']; ?>"><?php echo $array['CName']; ?>
                                    </option>
                          <?php
                                }
                           ?>
                              </select>
                </div>
              </div> 
              <div class="form-group">
                <label class="col-sm-6 control-label">SKU</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" id="esku" name="esku" placeholder="" value="" required="">
                </div>
              </div>
              <div class="img_width" id="displayimg"></div>
              <div class="form-group">
                <label for="file" class="col-sm-6 control-label">Image</label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" id="eimage" name="eimage[]" multiple required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Price</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" id="ePrice" name="ePrice" placeholder="Price" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Description</label>
                <div class="col-sm-9">
                  <input type="textarea" class="form-control" id="eDescription" name="eDescription" placeholder=" Description" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">QTY</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" id="eQTY" name="eQTY" placeholder="Enter Quantity" value="" required="">
                </div>
              </div>
              <div id="displayvideo"></div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Video</label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" id="eVideo" name="eVideo" placeholder="" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Status</label>
                <div class="col-sm-9">
                  <select class="form-control" name="eStatus" id="eStatus">
                      <option value=""></option>
                      <option value="Enable">Enable</option>
                      <option value="Disable">Disable</option>
                              </select>
                </div>
              </div>
              <div class="col-sm-offset-2 col-sm-9">
                <button type="submit" class="btn btn-primary change" id="ebtn-save" value="create">Edit Product
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
    "scrollY":"500px",
    "scrollCollapse": true
    });
} );
</script>

<script type="text/javascript"> 
$(document).ready(function(){
      $('#create').click(function () {
       $('#custForm').trigger("reset");
       $('#custCrudModal').html("Add New product");
       $('#ajax-modal').modal('show');
    });

     $('body').on('click', '.add', function () {
    $("#custForm").validate({
        rules: {
            pname: "required",
            sku:"required"
           },
        messages: {
            pname: "Enter your product",
        },
        submitHandler: function(form) { 
        $('#custForm').submit(function() { 
          var data=new FormData(this);
          var action='product_details';
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
                alert('Sorry, only JPG, JPEG, PNG, GIF files are allowed to upload.');
            }
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
      var action='product_change';
       $('#editModal').html("Edit Product");
       $('#edit-modal').modal('show');

        $.ajax({
            type:"POST",
            url: "action.php",
            data: { id:id,action:action },
            dataType: 'json', 
            success: function(result){
              $('#eid').val(result.data[0].Id);
              $('#epname').val(result.data[0].pname);
              $('#ecategory').val(result.data[0].category);
              $('#esku').val(result.data[0].SKU);
              $('#ePrice').val(result.data[0].price);
              $('#eDescription').val(result.data[0].description);
              $('#eQTY').val(result.data[0].qty);
              $('#displayvideo').html("<video width='180' height='90' controls><source src='http://localhost/lifekart/Admin_login/uploads/" + result.data[0].video +"'type='video/mp4'></video>");
              $('#eStatus').val(result.data[0].Status);
                var show = [];
                for(i=0;i<result.img.length;i++){
                  show.push("<img src='http://localhost/lifekart/Admin_login/uploads/" + result.img[i] +"'>");              
                }
                $("#displayimg").html(show.join(''));
          }
        });

    $("#editForm").on('submit',function(){
        var id = $(this).data('id');
        var data=new FormData(this);
          var action='product_update';
          data.append('action',action);

        $.ajax({
            type:"POST",
            url: "action.php",
            data:data,
            mimeType:"multipart/form-data",
            contentType: false, cache: false, processData:false,
            dataType: 'json',
            success: function(result){
              if (result == 1) {
             window.location.reload(true);
            }else{
                alert('Sorry, unable update.');
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
        var action='product_delete';
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

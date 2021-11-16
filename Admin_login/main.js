//////////////categoery////////////////

$(document).ready( function () {
  $('#datatab').DataTable({
    "scrollY":"600px",
    "scrollCollapse": true
    });
} );


$(document).ready(function(){
      $('#create').click(function () {
       $('#custForm').trigger("reset");
       $('#custCrudModal').html("Add New Category");
       $('#ajax-modal').modal('show');
    });
$('body').on('click', '.categoeryadd', function () {
    $("#custForm").validate({
        rules: {
          cname: "required"
           },
        messages: {
          cname: "Enter your Category",
        },
        submitHandler: function(form) { 
        $('#custForm').submit(function() { 
          var data=new FormData(this);
          var action='category_details';
          data.append('action',action);

        $.ajax({
            type:"POST",
            url: "action.php",
            data: data, // get all form field value in 
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


$(document).ready(function(){
$('body').on('click', '.categorychange', function () {
          var action='category_edit';
        var id = $(this).data('id');
       $('#editModal').html("Edit Category");
       $('#edit-modal').modal('show');
   
    $.ajax({
            type:"POST",
            url: "action.php",
            data: { id:id,action:action },
            dataType: 'json', 
            success: function(result){
              $('#eid').val(result[0].id);
              $('#ecname').val(result[0].CName);
              $('#showimg').html("<img src='http://localhost/lifekart/Admin_login/uploads/" + result[0].image +"'>");
              $('#edescription').val(result[0].description);
           }
        });

    $("#editForm").on('submit',function(){
        var id = $(this).data('id');
        var data=new FormData(this);
          var action='category_update';
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

$(document).ready(function($){
 $('body').on('click', '.categorydelete', function () {
       if (confirm("Delete Record?") == true) {
        var id = $(this).data('id');
        var action='category_delete';
         
        $.ajax({
            type:"POST",
            url: "action.php",
            data: { id:id,action:action },
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

//////////////categoery////////////////


////////////////////////customer////////////////////////////////


$(document).ready(function(){
      $('#create').click(function () {
       $('#custForm').trigger("reset");
       $('#custCrudModal').html("Add New customer");
       $('#ajax-modal').modal('show');
    });
$('body').on('click', '.customeradd', function(){
        $('#custForm').submit(function(){ 
          var data=new FormData(this);
          var action='customer_details';
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


$(document).ready(function(){

     $('body').on('click', '.customeredit', function () {
             $('#editModal').html("Edit Customer");
              $('#edit-modal').modal('show');
              var id = $(this).data('id');
              var action='customer_edit';
   
      $.ajax({
            type:"POST",
            url: "action.php",
            data: { id:id,action:action},
            dataType: 'json',
            ContentType: 'multipart/form-data', 
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

$(document).ready(function($){

 $('body').on('click', '.customerdelete', function () {
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

////////////////////////customer////////////////////////////////


////////////////////product////////////////////////////


$(document).ready(function(){
      $('#create').click(function () {
       $('#custForm').trigger("reset");
       $('#custCrudModal').html("Add New product");
       $('#ajax-modal').modal('show');
    });

     $('body').on('click', '.productadd', function () {
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


$(document).ready(function(){

     $('body').on('click', '.productchange', function () {
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
                  show.push("<img src='http://localhost/lifekart/Admin_login/uploads/" + result.img[i] +"'><span class='single_remove' data-id='"+ result.img[i] +"'>X</span>");              
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


$(document).ready(function($){

 $('body').on('click', '.productdelete', function () {
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


$(document).ready(function(){
  $('#displayimg').on('click','span',function(){
    var action ='single_remove';
    var id = $('#eid').val();
    var imgname = $(this).data('id');
        $.ajax({
                    type: "POST",
                    url: "Action/productAction.php",
                    data:{id:id,
                      imgname:imgname,
                      action:action
                    },
                    success: function(){
                    window.location.reload(true);
                    }
        });
}); 
}); 

////////////////////product////////////////////////////


/////////////////image slider////////////////////////

$(document).ready(function(){
      $('#create').click(function () {
       $('#custForm').trigger("reset");
       $('#custCrudModal').html("Add New Image");
       $('#ajax-modal').modal('show');
    });
        
     $('body').on('click', '.imagesadd', function () {
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

$(document).ready(function(){

$('body').on('click', '.imageschange', function () {
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


$(document).ready(function($){

 $('body').on('click', '.imagesdelete', function () {
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
/////////////////image slider////////////////////////

//////////////////coupen//////////////////////////////////////
$(document).ready(function(){
      $('#create').click(function () {
       $('#custForm').trigger("reset");
       $('#custCrudModal').html("Add New Coupen");
       $('#ajax-modal').modal('show');
    });
        
     $('body').on('click', '.coupenadd', function(){
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


$(document).ready(function(){

     $('body').on('click', '.coupenedit', function () {
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


$(document).ready(function($){

 $('body').on('click', '.coupendelete', function () {
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
//////////////////coupen//////////////////////////////////////
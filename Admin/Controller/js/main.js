//////////////categoery////////////////
// let example = $('#datatab').DataTable({
//   columnDefs: [{
//     orderable: false,
//     className: 'selectall',
//     targets: 0
//   }],
//   select: {
//     style: 'os',
//     selector: 'td:first-child'
//   },
//   order: [
//     [1, 'asc']
//   ]
// });
// example.on("click", "th.select", function() {
//   if ($("th.select").hasClass("selected")) {
//     example.rows().deselect();
//     $("th.select").removeClass("selected");
//   } else {
//     example.rows().select();
//     $("th.select").addClass("selected");
//   }
// }).on("select deselect", function() {
//   ("Some selection or deselection going on")
//   if (example.rows({
//       selected: true
//     }).count() !== example.rows().count()) {
//     $("th.select").removeClass("selected");
//   } else {
//     $("th.select").addClass("selected");
//   }
// });

///////////////////////////////////////////////////////////////////////////
$(document).ready( function () {
   CKEDITOR.replace( 'Description' );
   $('#datatab1').dataTable({searching: false ,paging:false});
  
  $('#datatab').DataTable({
    columnDefs: [{
      orderable: false,
      className: 'selectall',
      targets: 0
    }],
    select: {
      style: 'os',
      selector: 'td:first-child'
    },
    order: [
      [5, 'asc']
    ]
    //"scrollCollapse": true,
    //"searching":false,
    //"paging":false,
    //"ordering":false,       
    });
} );

$(document).ready(function() {
  $('#datatab').DataTable();
  $('#datatab').on('click', '.img_width2', function() {
     var val = $(this).html();
     $('#DescModal').modal("show");
     $('.text-center').html(val);
  });
});


$(document).ready(function(){
  $(document).on('click','.v_view',function () {
            var action='video_pop';
          var id = $(this).data('id');
         $('#DescModal').modal('show');

      $.ajax({
              type:"POST",
              url: "../Controller/control.php",
              data: { id:id,action:action },
              dataType: 'json', 
              success: function(result){
                $('.text-center').html("<video class='videoremove' width='650' height='220' controls><source src='http://localhost/lifekart/Admin/uploads/" + result +"'type='video/mp4'></video>");
             }
          });
            });
         });

$(document).ready(function(){
      $('#create').click(function () {
       $('#custForm').trigger("reset");
       $('#custCrudModal').html("Add New Category");
       $('#ajax-modal').modal('show');
    });
$(document ).on('click','.categoeryadd', function () {
    $("#custForm").validate({
        rules: {
          cname: "required",
          image: "required"
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
            url: "../Controller/control.php",
            data: data, 
            mimeType:"multipart/form-data",
            contentType: false, cache: false, processData:false,
            dataType: 'json',
            success: function(result){
              if (result == 1) {
                location.reload();
                $(".close").click();
                $('.message').text("successfully added").show().delay(3000).fadeOut();
            }else if(result == 5){
              alert('Already exist!!!!!!!!!!')
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
$(document).on('click','.categorychange', function () {
          var action='category_edit';
        var id = $(this).data('id');
        $('#editForm').trigger("reset");
       $('#editModal').html("Edit Category");
       $('#edit-modal').modal('show');

    $.ajax({
            type:"POST",
            url: "../Controller/control.php",
            data: { id:id,action:action },
            dataType: 'json', 
            success: function(result){
              $('#eid').val(result[0].id);
              $('#ecname').val(result[0].CName);
              $('#showimg').html("<img src='http://localhost/lifekart/Admin/uploads/" + result[0].image +"'>");
              $('#edescription').val(result[0].description);
              for(i=0;i<result[1].length;i++){
                $('#'+result[1][i][0]).prop('checked', true);
              }
           }
        });

        $("#editForm").validate({
          rules: {
            cname: "required",
            image: "required"
             },
          messages: {
            cname: "Enter your Category",
          },
          submitHandler: function(form) { 
    $("#editForm").submit(function() { 
        var id = $(this).data('id');
        var data=new FormData(this);
          var action='category_update';
          data.append('action',action);
          
        $.ajax({
            type:"POST",
            url: "../Controller/control.php",
            data: data,
            mimeType:"multipart/form-data",
            contentType: false, cache: false, processData:false,
            dataType: 'json',
            success: function(result){
              if (result == 1) {
                location.reload();
                $(".close").click();
                $('.message').text("successfully update").show().delay(3000).fadeOut();
            }else{
             alert('Sorry,unable update.');
             }
           }
          });
            });
            form.submit();
          }
        });
          });
       });

$(document).ready(function($){
 $(document ).on('click','.categorydelete', function () {
       if (confirm("Delete Record?") == true) {
        var id = $(this).data('id');
        var action='category_delete';
         
        $.ajax({
            type:"POST",
            url: "../Controller/control.php",
            data: { id:id,action:action },
            dataType: 'json',
            success: function(result){
            if (result == 1) {
              location.reload();
              $('.message').text("successfully delete").show().delay(3000).fadeOut();
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

    $(document).on('click','.customeradd', function(){
      $("#custForm").validate({
        rules: {
            FirstName: "required",
            LastName: "required",
            Address:"required",
            phone_number: {
              required: true,
                digits:true,
                minlength:10,
                maxlength:10
            },
            customerGroup:"required"
           },
        messages: {
            FirstName: "Enter your Name",
        },
          submitHandler: function(form) { 
            $('#custForm').submit(function() { 
            var data=new FormData(this);
            var action='customer_details';
            data.append('action',action);
  
          $.ajax({
              type:"POST",
              url: "../Controller/control.php",
              data: data,
              dataType: 'json',
              mimeType:"multipart/form-data",
              contentType: false, cache: false, processData:false,
              success: function(result){
                if (result == 1) {
                  location.reload();
                  $(".close").click();
                  $('.message2').text("successfully added").show().delay(3000).fadeOut();
                 }else if(result == 5){
                   alert('Already exist!!!!!!!!!!')
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

     $(document).on('click','.customeredit', function () {
             $('#editModal').html("Edit Customer");
              $('#edit-modal').modal('show');
              var id = $(this).data('id');
              var action='customer_edit';
   
      $.ajax({
            type:"POST",
            url: "../Controller/control.php",
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
              $('#ecustomerGroup').val(result[0].customerGroup);
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
            },
            customerGroup:"required"
           },
        messages: {
            FirstName: "Enter your Name",
        },
        submitHandler: function(form) { 
        var id = $(this).data('id');
        var action='customer_update';

        $.ajax({
            type:"POST",
            url: "../Controller/control.php",
            data: {
              Id: $('#eid').val(),
               FirstName: $('#eFirstName').val(),
               LastName: $('#eLastName').val(),
                Email: $('#eEmail').val(),
                 phone_number: $('#ephone_number').val(),
                 Address: $('#eAddress').val(),
                 country: $('#ecountry').val(),
                 customerGroup:$('#ecustomerGroup').val(),
                 action:action
            },
            dataType: 'json',
            success: function(result){
              location.reload();
              $(".close").click();
              $('.message2').text("successfully update").show().delay(3000).fadeOut();
             }
          });
               form.submit();
              }
            });
          });
       });

$(document).ready(function($){

 $(document).on('click','.customerdelete',function () {
       if (confirm("Delete Record?") == true) {
        var id = $(this).data('id');
        var action='customer_delete';
         
        $.ajax({
            type:"POST",
            url: "../Controller/control.php",
            data: { id: id,action:action },
            dataType: 'json',
            success: function(result){
            if (result == 1) {
              location.reload();
              $('.message2').text("successfully delete").show().delay(3000).fadeOut();
            }
           }
        }); 
       }
    });
});


$(document).ready(function(){
    $('#CustomerGroupForm').submit (function (e) {  
       e.preventDefault();  
       var CustomerGroup = $('#CustomerGroup').val();  
     $(".error").remove();  
   if (CustomerGroup.length < 1) {  
         $('#CustomerGroup').after('<span class="error" style="color:red">This field is required</span>');  
         $('#star').show();
       }else{  
      var data=new FormData(this);
      var action='customer_group_insert';
      data.append('action',action);

    $.ajax({
        type:"POST",
        url: "../Controller/control.php",
        data: data,
        dataType: 'json',
         contentType: false, cache: false, processData:false,
        success: function(result){
          if (result == 1) {
            location.reload();
            $('.message2').text("successfully added").show().delay(3000).fadeOut();
           }else if(result == 5){
            $('.message2').text("already exists!!!").show().delay(3000).fadeOut();
         }
          }
      });
    }
      });
    });

   $(document).ready(function(){

    $(document).on('click','.groupedit', function () {
            $('#editCustomerGroupModal').html("Edit Group");
             $('#edit-modal').modal('show');
             var id = $(this).data('id');
             var action='customer_group_edit';
  
     $.ajax({
           type:"POST",
           url: "../Controller/control.php",
           data: { id:id,action:action},
           dataType: 'json',
           ContentType: 'multipart/form-data', 
           success: function(result){
             $('#eid').val(result[0].id);
             $('#eCustomerGroup').val(result[0].customer_group);
          }
       });

   $("#editCustomerGroupForm").validate({
       rules: {
        eCustomerGroup: "required"
          },
       messages: {
        eCustomerGroup: "Enter Name",
       },
       submitHandler: function(form) { 
       var id = $(this).data('id');
       var action='customer_group_update';

       $.ajax({
           type:"POST",
           url: "../Controller/control.php",
           data: {
             id: $('#eid').val(),
             customer_group: $('#eCustomerGroup').val(),
                action:action
           },
           dataType: 'json',
           success: function(result){
            location.reload();
            $(".close").click();
            $('.message2').text("successfully update").show().delay(3000).fadeOut();
            }
         });
              form.submit();
             }
           });
         });
      });


$(document).ready(function($){

  $(document).on('click','.groupdelete',function () {
        if (confirm("Delete Record?") == true) {
         var id = $(this).data('id');
         var action='customer_group_delete';
          
         $.ajax({
             type:"POST",
             url: "../Controller/control.php",
             data: { id: id,action:action },
             dataType: 'json',
             success: function(result){
             if (result == 1) {
              location.reload();
              $('.message2').text("successfully deleted").show().delay(3000).fadeOut();
             }
            }
         }); 
        }
     });
 });

 $(document).ready(function(){
  $('#submitdelete').click(function(e) {
   var data=$('#Action').find(":selected").text();
   if(data=='Select'||data=='SELECT TO DELETE'){
   var atLeastOneIsChecked = $('input[name="select_field[]"]:checked').length > 0;
   if (atLeastOneIsChecked == false) {
     e.preventDefault();
     $('.message1').text("select any one").show().delay(3000).fadeOut();
     return false;
     }else{
      $('.message1').text("successfully deleted").show().delay(3000).fadeOut();
       return true;
       }
     }
     });
   });

   $(document).ready(function(){
   
    $(document).on('click','#submitdelete', function (e) {
      $('#groupForm').validate();
      const myArray = [];
     var data=$('#Action').find(":selected").text();
     var atLeastOneIsChecked = $('input[name="select_field[]"]:checked').each(function(){
       myArray.push($(this).val());
     });
     if(data=='SELECT TO DELETE'){
       if(myArray==''){
        alert("please select any one");
       }
      else{
        if(confirm('Are you sure?'+myArray)){
          var id = $(this).data('id');
      var action='select_delete_group';
      const myArray = [];
      var data=$('#Action').find(":selected").text();
      var atLeastOneIsChecked = $('input[name="select_field[]"]:checked').each(function(){
        myArray.push($(this).val());
      });
      $.ajax({
          type:"POST",
          url: "../Controller/control.php",
          data: { action:action,select_field:myArray},
          dataType: 'json',
          success: function(result){
            location.reload();
            $('.message').text("successfully deleted").show().delay(3000).fadeOut();
         }
      });
      e.preventDefault();
            return false;
      }
    }
          return true;
    }
  });
  });  

  $(document).ready(function(){
    $('.customerview').on('click', function () {
              var action='customer_pop';
            var id = $(this).data('id');
           $('#DescModal').modal('show');
  
        $.ajax({
                type:"POST",
                url: "../Controller/control.php",
                data: { id:id,action:action },
                dataType: 'json', 
                success: function(result){
                  $('#vFirstName1').text(result.data[0].FirstName);
                  $('#vLastName1').text(result.data[0].LastName);
                  $('#vFirstName').text(result.data[0].FirstName);
                  $('#vLastName').text(result.data[0].LastName);
                  $('#vEmail').text(result.data[0].Email);
                  $('#vphone_number').text(result.data[0].phone_number);
                  $('#vAddress').text(result.data[0].Address);
                  $('#vcountry').text(result.data[0].country);
                  $('#vcustomerGroup').text(result.data[0].customer_group);
               }
            });
              });
           });
                
          // $(document).ready(function(){
          // var $loading = $('.loader').hide();
          // $(document)
          //   .ajaxStart(function () {
          //     $loading.show();
          //   })
          //   .ajaxStop(function () {
          //     $loading.hide();
          //   });
          // });
////////////////////////customer////////////////////////////////




////////////////////product////////////////////////////

$(document).ready(function(){
  $('#select_all').on('click',function(){
      if(this.checked){
          $('.Select').each(function(){
              this.checked = true;
          });
      }else{
           $('.Select').each(function(){
              this.checked = false;
          });
      }
  });
  $('.Select').on('click',function(){
    if($('.Select:checked').length == $('.Select').length){
        $('#select_all').prop('checked',true);
    }else{
        $('#select_all').prop('checked',false);
    }
});
});

$(document).ready(function () {

  var max_input = 5;
  var x = 1;
  var clone = $(".input-box").eq(0).clone();

  $('body').on('click', '.add-btn', function (e){
    e.preventDefault();
    if (x < max_input) {
      x++; 
      $('.wrapper2').append(clone);
    }
  });
  
$('.wrapper2').on("click",'.remove-lnk', function (e) {
  e.preventDefault();
  $(this).parent('div').remove(); 
  x--; 
  var id = $(this).data('id');
  var action='deletecustomer_group_price';
  $.ajax({
      type:"POST",
      url: "../Controller/control.php",
      data: { id: id,action:action },
      dataType: 'json',
      success: function(result){
      if (result == 1) {
        location.reload();

      }
     }
  });
})

});

$(document).ready(function () {

  var max_input = 5;
  var x = 1;
  var i=0;
  var clone = $(".input-box1").eq(i).clone();

  $(this).on('click', '.add-btn1', function (e){
    e.preventDefault();
    if (x < max_input) {
      x++; 
      $('.wrapper1').append(clone);
    }
  });
  
$(this).on("click",'.remove-lnk1', function (e) {
  e.preventDefault();
  $(this).parent('div').remove(); 
  x--; 
})

});

$(document).ready(function(){
      $('#create').click(function () {
       $('#custForm').trigger("reset");
       $('#custCrudModal').html("Add New product");
       $('#ajax-modal').modal('show');
    });

     $(document).on('click','.productadd', function () {
    $("#custForm").validate({
        rules: {
            pname: "required",
            sku:"required",
            image:"required",
            Price:"required",
            QTY:"required",
            Video:"required"
           },
        messages: {
            pname: "Enter your product",
            sku:"sku required"
        },
        
        submitHandler: function(form) { 
        $('#custForm').submit(function() { 
          var data=new FormData(this);
          var action='product_details';
          data.append('action',action);
        $.ajax({
            type:"POST",
            url: "../Controller/control.php",
            data: data, 
            mimeType:"multipart/form-data",
            contentType: false, cache: false, processData:false,
            dataType: 'json',
            success: function(result){
              if (result == 1) {
                location.reload();
                $(".close").click();
                $('.message').text("successfully added").show().delay(3000).fadeOut();
            }else if(result == 5){ alert('already exist !!!!!!!!!!');
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

     $('#datatab').on('click','.productchange',function () {
      var id = $(this).data('id');
      $('#eDescription').empty();
      var action='product_change';
       $('#editModal').html("Edit Product");
       $('#edit-modal').modal('show');

        $.ajax({
            type:"POST",
            url: "../Controller/control.php",
            data: { id:id,action:action },
            dataType: 'json', 
            success: function(result){
              $('#editForm')[0].reset();
              $('#eid').val(result.data[0].Id);
              $('#epname').val(result.data[0].pname);
              $('#ecategory').val(result.data[0].category);
              var text=result.data[0].category;
              const checkCategory =text.split(",");
              for (i= 0;i<checkCategory.length;i++) { 
                $('#'+checkCategory[i]).prop('checked', true);
              }
              $('#esku').val(result.data[0].SKU);
              $('#ePrice').val(result.data[0].price);
              $('.wrapper1').html(result.data3);
              $('#eDescription').val(result.data[0].description);
              CKEDITOR.replace( 'eDescription' );
              $('#eQTY').val(result.data[0].qty);
              $('#displayvideo').html("<div class='row'><video class='videoremove' width='120' height='65' controls><source src='http://localhost/lifekart/Admin/uploads/" + result.data[0].video +"'type='video/mp4'></video><span class='video_remove' data-id='"+result.data[0].video+"'><div class='wrapper'><div class='arrow'><div class='line'></div><div class='line'></div></div></div></span></div>");  
              $('#eStatus').val(result.data[0].Status);
                 var show = [];
                 for(i=0;i<result.img.length;i++){
                   show.push("<div class='row'><img class='imgdisplay' id='7' width='120' height='65' src='http://localhost/lifekart/Admin/uploads/" + result.img[i] +"'><span class='single_remove' data-id='"+ result.img[i] +"'><div class='wrapper'><div class='arrow'><div class='line'></div><div class='line'></div></div></div></span></div>");              
                 }
                 $("#displayimg").html(show.join(''));
                 if(result.data[0].video ==''){
                  $('#disvideo').addClass('hide'); 
                  $('#displayvideo').addClass('hide');
               }else{
                 $('#disvideo').removeClass('hide'); 
                  $('#displayvideo').removeClass('hide'); 
                }
                //CKEDITOR.instances.eDescription.destroy();
                //CKEDITOR.replace( 'eDescription' );
                // CKEDITOR.remove(); 
                // for(eDescription in CKEDITOR.instances)
                // {
                //   CKEDITOR.instances['eDescription'].destroy(true);
                // }    
        }
        });
        
        
      $("#editForm").validate({
        rules: {
            epname: "required",
            esku:"required",
            ePrice:"required",
            eDescription:"required",
            eQTY:"required",
            eStatus:"required"
           },
        messages: {
            epname: "Enter product name",
            esku: "Enter SKU",
            ePrice:"price required",
            eDescription:"description required",
            eQTY:"quantity required",
            eStatus:"status required"
        },
      submitHandler: function(form) { 
        $('#editForm').submit(function() { 
        var id = $(this).data('id');
        var vidrget=$('.videoremove').attr('width');
        var data=new FormData(this);
          var action='product_update';
          data.append('id',id);
          data.append('vidrget',vidrget);
          data.append('action',action);

        $.ajax({
            type:"POST",
            url: "../Controller/control.php",
            data:data,
            mimeType:"multipart/form-data",
            contentType: false, cache: false, processData:false,
            dataType: 'json',
            success: function(result){
              if (result == 1) {
                location.reload();
                // $("#datatab").DataTable().clear().destroy();
               $(".close").click();
               $('.message').text("successfully update").show().delay(3000).fadeOut();
            }else if(result == 5){
              alert('Sku required');
          }else{
              alert('Sorry, unable update.something improper');
            }
            }
          });  
        });
          form.submit();
        }
      });
     });
   });



$(document).ready(function($){

 $(document).on('click','.productdelete', function () {
       if (confirm("Delete Record?") == true) {
        var id = $(this).data('id');
        var action='product_delete';
        $.ajax({
            type:"POST",
            url: "../Controller/control.php",
            data: { id: id,action:action },
            dataType: 'json',
            success: function(result){
            if (result == 1) {
              $('.message').text("successfully deleted").show().delay(3000).fadeOut();
              location.reload();
            }
           }
        }); 
       }
    });
});


$(document).ready(function(){
 $('.selectdelete').click(function(e) {
  var data=$('#CSV').find(":selected").text();
  if(data=='EXPORT'||data=='Select'||data=='SELECT TO DELETE'){
  var atLeastOneIsChecked = $('input[name="select_csv[]"]:checked').length > 0;
  if (atLeastOneIsChecked == false) {
    e.preventDefault();
    $('.message').text("select any one").show().delay(3000).fadeOut();
    return false;
    }else{
      return true;
      }
    }
    });
  });


  $(document).ready(function(){
   
    $('.selectdelete').on('click', function (e) {
      $('#csvForm').validate();
      const myArray = [];
     var data=$('#CSV').find(":selected").text();
     var atLeastOneIsChecked = $('input[name="select_csv[]"]:checked').each(function(){
       myArray.push($(this).val());
     });
     if(data=='SELECT TO DELETE'){
      if(!confirm('Are you sure?  '+myArray)){
      e.preventDefault();
            return false;
      }
      return true;
    }
   });
  });

  
$(document).ready(function(){
  $('#displayimg').on('click','span',function(e){
   var ab=this;
    var action ='single_remove';
    var id = $('#eid').val();
    var imgname = $(this).data('id');
        $.ajax({
                    type: "POST",
                    url: "../Controller/control.php",
                    data:{id:id,
                      imgname:imgname,
                      action:action
                    },
                    success: function(){
                       $(ab).prev('.imgdisplay').remove();
                       $(ab).remove();
                    }
        });
}); 
}); 

$(document).ready(function(){
$('.img_width').on('click','img', function() {
  $('#DescModal').modal("show");
  var abc=$(this).html('#displayimg').clone();
   $('.text-center').html(abc);
});
});

$(document).ready(function(){ 
  $('#disvideo').on('click', function() {
    var jk=$('#displayvideo').html();
     $('#DescModal').modal("show");
     $('.text-center').html(jk);
     $('.text-center').find("span").remove();
  });
  });


$(document).ready(function(){
  $('#displayvideo').on('click','span',function(e){
   var ab=this;
    var action ='video_remove';
    var id = $('#eid').val();
    var videoname = $(this).data('id');
        $.ajax({
                    type: "POST",
                    url: "../Controller/control.php",
                    data:{id:id,
                      videoname:videoname,
                      action:action
                    },
                    success: function(){
                       $(ab).prev('.videoremove').remove();
                       $(ab).remove();
                       $('#disvideo').remove(); 
                    }
        });
}); 
}); 


$(document).on('change', '.div-toggle',function(){
  var target = $(this).data('target');
  var show = $("option:selected", this).data('show');
  $(target).children().addClass('hide');
  $(show).removeClass('hide');
});
$(document).ready(function(){
  $('.div-toggle').trigger('change');
});

////////////////////product////////////////////////////





/////////////////image slider////////////////////////
$(document).ready(function(){
      $('#create').click(function () {
       $('#custForm').trigger("reset");
       $('#custCrudModal').html("Add New Image");
       $('#ajax-modal').modal('show');
    });
        
     $(document).on('click','.imagesadd', function () {
    $("#custForm").validate({
        rules: {
            imageName: "required",
            link: "required"
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
            url: "../Controller/control.php",
            data: data, 
            mimeType:"multipart/form-data",
            contentType: false, cache: false, processData:false,
            dataType: 'json',
            success: function(result){
              if (result == 1) {
                location.reload();
                $(".close").click();
                $('.message').text("successfully added").show().delay(3000).fadeOut();
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

$(document).on('click','.imageschange', function () {
        var id = $(this).data('id');
        var action='image_edit';
       $('#editModal').html("Edit Image");
       $('#edit-modal').modal('show');
   
    $.ajax({
            type:"POST",
            url: "../Controller/control.php",
            data: { id:id,action:action },
            dataType: 'json', 
            success: function(result){
              $('#eid').val(result[0].id);
              $('#showimg').html("<img src='http://localhost/lifekart/Admin/uploads/" + result[0].imageName +"'>");
              $('#elink').val(result[0].link);
           }
        });

    $("#editForm").validate({
      rules: {
        link: "required",
        imageName: "required"
       },
    messages: {
      imageName: "Enter Name",
      link: "Enter link"
    },
      submitHandler: function(form) { 
        $('#editForm').submit(function() { 
        var id = $(this).data('id');
        var action='image_update';
        var data=new FormData(this);
          data.append('action',action);

        $.ajax({
            type:"POST",
            url: "../Controller/control.php",
            data: data,
            mimeType:"multipart/form-data",
            contentType: false, cache: false, processData:false,
            dataType: 'json',
            success: function(result){
              if (result == 1) {
                location.reload();
                $(".close").click();
                $('.message').text("successfully update").show().delay(3000).fadeOut();
            }else{
             alert('Sorry,unable update.');
             }
           }
          });
        });
          form.submit();
        }
            });
          });
       });


$(document).ready(function($){

 $(document).on('click','.imagesdelete', function () {
       if (confirm("Delete Record?") == true) {
        var id = $(this).data('id');
        var action='image_delete';
        $.ajax({
            type:"POST",
            url: "../Controller/control.php",
            data: { id: id,action:action},
            dataType: 'json',
            success: function(result){
            if (result == 1) {
              location.reload();
              $('.message').text("successfully delete").show().delay(3000).fadeOut();
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
        
     $(document).on('click','.coupenadd', function(){
        $('#custForm').validate({
          rules: {
            coupen_name: "required",
            coupen_discount: "required"
          },
          messages: {
            coupen_name: "Enter your Name",
        }, 
          submitHandler: function(form) { 
            $('#custForm').submit(function() { 
          var data=new FormData(this);
          var action='coupen_details';
          data.append('action',action);

        $.ajax({
            type:"POST",
            url: "../Controller/control.php",
            data: data,
            dataType: 'json',
            mimeType:"multipart/form-data",
            contentType: false, cache: false, processData:false,
            success: function(result){
              if (result == 1) {
                location.reload();
                $(".close").click();
                $('.message').text("successfully added").show().delay(3000).fadeOut();
               }else if(result == 5){
                 alert('Already exist!!!!!!!!!!')
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

     $(document).on('click','.coupenedit',function () {
             $('#editModal').html("Edit Coupen");
              $('#edit-modal').modal('show');
              var id = $(this).data('id');
              var action='coupen_edit';
   
      $.ajax({
            type:"POST",
            url: "../Controller/control.php",
            data: { id:id,action:action},
            dataType: 'json',
            ContentType: 'multipart/form-data', 
            success: function(result){
              $('#eid').val(result.coupen_id);
              $('#eCoupenCode').val(result.coupen_name);
              $('#eCoupenDiscount').val(result.coupen_discount);
           }
        });

    $("#editForm").validate({
      rules: {
        coupen_name: "required",
        coupen_discount: "required"
      },
      messages: {
        coupen_name: "Enter your Name",
    },   
    submitHandler: function(form) { 
        var id = $(this).data('id');
        var action='coupen_update';

        $.ajax({
            type:"POST",
            url: "../Controller/control.php",
            data: {
                coupen_id: $('#eid').val(),
                coupen_name: $('#eCoupenCode').val(),
                coupen_discount: $('#eCoupenDiscount').val(),
                 action:action
            },
            dataType: 'json',
            success: function(result){
              location.reload();
              $(".close").click();
              $('.message').text("successfully update").show().delay(3000).fadeOut();
             }
          });
          form.submit();
        }
            });
          });
       });


$(document).ready(function($){

 $(document).on('click','.coupendelete', function () {
       if (confirm("Delete Record?") == true) {
        var id = $(this).data('id');
        var action='coupen_delete';
         
        $.ajax({
            type:"POST",
            url: "../Controller/control.php",
            data: { id: id,action:action },
            dataType: 'json',
            success: function(result){
            if (result == 1) {
              location.reload();
              $('.message').text("successfully deleted").show().delay(3000).fadeOut();
            }
           }
        }); 
       }
    });
});
//////////////////coupen//////////////////////////////////////
$(document).ready(function() {
  $('.displayData').on('click',function () {
                $('#OrderInfoModal').html("Order Info");
                 $('#pop-modal').modal('show');
                 var id = $(this).data('id');
                 var action='order_pop';
   
                 $.ajax({
                       type:"POST",
                       url: "../Controller/control.php",
                       data: { id:id,action:action},
                       dataType: 'json',
                       ContentType: 'multipart/form-data', 
                       success: function(result){
                     var show = [];
                 for(i=0;i<result.length;i++){
                   show.push("<tr><td id='Product'>"+result[i][0]+"</td><td id='Quantity'>"+result[i][1]+"</td><td id='Price'>"+result[i][2]+"</td></tr>");              }
                 $("#displayorder").html(show.join(''));
                      }
                   });
  } );
} );

$(document).ready(function(){
  $('#btnclear').click(function(){				
    if(confirm("Want to clear?")){
      /*Clear all input type="text" box*/
      $('#Ordersearch input[type="text"]').val('');
      $('#Ordersearch input[type="number"]').val('');
      $('#Ordersearch input[type="date"]').val('');
      $('.datatogle').show();
    }					
  });
});

$(document).ready(function(){
  
  $('#Ordersearch').submit (function (e) {  
     e.preventDefault();  
    var data=new FormData(this);
    var action='order_search_info';
    data.append('action',action);

  $.ajax({
      type:"POST",
      url: "../Controller/control.php",
      data: data,
      dataType: 'json',
       contentType: false, cache: false, processData:false,
      success: function(result){
          if (result==5) {
            $('#messagedis').text('Please Enter Some Input').show().delay(3000).fadeOut();  
          }
          if (result==3) {
            $('#messagedis').text('No Match Found!!!!!').show().delay(3000).fadeOut();  
          }
        $('.datatogle').hide();
        for(i=0;i<result.length;i++){
                 $("."+result[i]).show();
      }
      }
    });
    });
  });

  ///////////////////Blog//////////////////////////
  $(document).ready(function(){
    $('#create').click(function () {
     $('#categoryblogForm').trigger("reset");
     $('#categoryblogModal').html("Add New Category");
     $('#ajax-modal').modal('show');
  });
      
   $(document).on('click','.blogCategoryadd', function(){
      $('#categoryblogForm').validate({
        rules: {
          Category_blog: "required"
        },
        messages: {
          Category_blog: "Enter your Name"
      }, 
        submitHandler: function(form) { 
          $('#categoryblogForm').submit(function() { 
        var data=new FormData(this);
        var action='Category_blog_details';
        data.append('action',action);

      $.ajax({
          type:"POST",
          url: "../Controller/control.php",
          data: data,
          dataType: 'json',
          mimeType:"multipart/form-data",
          contentType: false, cache: false, processData:false,
          success: function(result){
            if (result = 1) {
              // $("#datatab").load("B_category.php #ref");
              $(".close").click();
              $('.message').text("successfully added").show().delay(3000).fadeOut();
              // $('#categoryblogForm').trigger("reset");
              location.reload();
             }else if(result == 5){
               alert('Already exist!!!!!!!!!!')
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

   $(document).on('click','.blogCategoryedit',function () {
           $('#editcategoryblogModal').html("Edit Coupen");
            $('#edit-modal').modal('show');
            var id = $(this).data('id');
            var action='Category_blog_edit';
 
    $.ajax({
          type:"POST",
          url: "../Controller/control.php",
          data: { id:id,action:action},
          dataType: 'json',
          ContentType: 'multipart/form-data', 
          success: function(result){
            $('#eid').val(result.id);
            $('#eCategory_blog').val(result.category);
            $('#eSub_Category').val(result.parent_id);
         }
      });

  $("#ecategoryblogForm").validate({
    rules: {
      category: "required"
    },
    messages: {
      category: "Enter your Name"
  },   
  submitHandler: function(form) { 
      var id = $(this).data('id');
      var action='Category_blog_update';

      $.ajax({
          type:"POST",
          url: "../Controller/control.php",
          data: {
              id: $('#eid').val(),
              category: $('#eCategory_blog').val(),
              parent_id: $('#eSub_Category').val(),
               action:action
          },
          dataType: 'json',
          success: function(result){
            location.reload();
            $(".close").click();
            $('.message').text("successfully update").show().delay(3000).fadeOut();
           }
        });
        form.submit();
      }
          });
        });
     });


$(document).ready(function($){

$(document).on('click','.blogCategorydelete', function () {
     if (confirm("Delete Record?") == true) {
      var id = $(this).data('id');
      var action='blogCategory_delete';
       
      $.ajax({
          type:"POST",
          url: "../Controller/control.php",
          data: { id: id,action:action },
          dataType: 'json',
          success: function(result){
          if (result == 1) {
            location.reload();
            $('.message').text("successfully deleted").show().delay(3000).fadeOut();
          }
         }
      }); 
     }
  });
});


$(document).ready(function(){
  $('#create').click(function () {
   $('#writerForm').trigger("reset");
   $('#WriterModal').html("Add Author");
   $('#ajax-modal').modal('show');
});
    
 $(document).on('click','.Writeradd', function () {
$("#writerForm").validate({
    rules: {
        imageName: "required",
        AuthorName: "required",
        Authorinfo:"required"
       },
    messages: {
        imageName: "Enter your Image",
    },
    submitHandler: function(form) { 
    $('#writerForm').submit(function() { 
      var data=new FormData(this);
      var action='writer_details';
      data.append('action',action);
    $.ajax({
        type:"POST",
        url: "../Controller/control.php",
        data: data, 
        mimeType:"multipart/form-data",
        contentType: false, cache: false, processData:false,
        dataType: 'json',
        success: function(result){
          if (result == 1) {
            location.reload();
            $(".close").click();
            $('.message').text("successfully added").show().delay(3000).fadeOut();
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

$(document).on('click','.authorchange', function () {
    var id = $(this).data('id');
    var action='author_edit';
   $('#editWriterModal').html("Edit Author");
   $('#edit-modal').modal('show');

$.ajax({
        type:"POST",
        url: "../Controller/control.php",
        data: { id:id,action:action },
        dataType: 'json', 
        success: function(result){
          $('#eid').val(result[0].id);
          $('#showimg').html("<img src='http://localhost/lifekart/Admin/uploads/" + result[0].Thumb_img +"'>");
          $('#eAuthorName').val(result[0].Author);
          $('#eAuthorInfo').val(result[0].A_description);
          $('#eFacebooklink').val(result[0].Facebook);
          $('#eLinkedinlink').val(result[0].Linkedin);
          $('#eTweeterlink').val(result[0].Tweeter);
       }
    });

$("#editWriterForm").validate({
  rules: {
    AuthorName: "required",
    Authorinfo:"required"
   },
messages: {
  AuthorName: "Enter Name"
},
  submitHandler: function(form) { 
    $('#editWriterForm').submit(function() { 
    var id = $(this).data('id');
    var action='author_update';
    var data=new FormData(this);
      data.append('action',action);

    $.ajax({
        type:"POST",
        url: "../Controller/control.php",
        data: data,
        mimeType:"multipart/form-data",
        contentType: false, cache: false, processData:false,
        dataType: 'json',
        success: function(result){
          if (result == 1) {
            location.reload();
            $(".close").click();
            $('.message').text("successfully update").show().delay(3000).fadeOut();
        }else{
         alert('Sorry,unable update.');
         }
       }
      });
    });
      form.submit();
    }
        });
      });
   });


$(document).ready(function($){

$(document).on('click','.authorsdelete', function () {
   if (confirm("Delete Record?") == true) {
    var id = $(this).data('id');
    var action='authors_delete';
    $.ajax({
        type:"POST",
        url: "../Controller/control.php",
        data: { id: id,action:action},
        dataType: 'json',
        success: function(result){
        if (result == 1) {
          location.reload();
          $('.message').text("successfully delete").show().delay(3000).fadeOut();
        }
       }
    }); 
   }
});
});

//////////////////////////////////////////////////////////////////////

$(document).ready(function(){
  CKEDITOR.replace( 'BlogName' );
  $('#create').click(function () {
   $('#BlogForm').trigger("reset");
   $('#BloginfoModal').html("Add Blog");
   $('#ajax-modal').modal('show');
});
    
 $(document).on('click','.Blogadd', function () {
$("#BlogForm").validate({
    rules: {
        imageName: "required",
        BlogName: "required",
        Bloginfo:"required",
        Author:"required",
        category:"required"
       },
    messages: {
        imageName: "Enter your Image",
    },
    submitHandler: function(form) { 
    $('#BlogForm').submit(function() { 
      var data=new FormData(this);
      var action='Blog_details';
      data.append('action',action);
    $.ajax({
        type:"POST",
        url: "../Controller/control.php",
        data: data, 
        mimeType:"multipart/form-data",
        contentType: false, cache: false, processData:false,
        dataType: 'json',
        success: function(result){
          if (result == 1) {
            location.reload();
            $(".close").click();
            $('.message').text("successfully added").show().delay(3000).fadeOut();
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
  CKEDITOR.replace( 'eBlogInfo' );

$(document).on('click','.Blogchange', function () {
    var id = $(this).data('id');
    var action='blog_edit';
   $('#editBlogModal').html("Edit Blog");
   $('#edit-modal').modal('show');

$.ajax({
        type:"POST",
        url: "../Controller/control.php",
        data: { id:id,action:action },
        dataType: 'json', 
        success: function(result){
          $('#eid').val(result[0].id);
          $('#showimg').html("<img src='http://localhost/lifekart/Admin/uploads/" + result[0].B_image +"'>");
          $('#eBlogName').val(result[0].B_name);
          $('#eBlogInfo').val(result[0].Description);
          $('#eBinfo').val(result[0].info);
          $('#eTags').val(result[0].tags);
          $('#eAuthor').val(result[0].Author);
          $('#ecategory').val(result[0].category);
       }
    });

$("#editBloginfoForm").validate({
  rules: {
    BlogName: "required",
        Bloginfo:"required",
        Author:"required",
        category:"required"
   },
messages: {
  BlogName: "Enter Name"
},
  submitHandler: function(form) { 
    $('#editBloginfoForm').submit(function() { 
    var id = $(this).data('id');
    var action='blog_update';
    var data=new FormData(this);
      data.append('action',action);

    $.ajax({
        type:"POST",
        url: "../Controller/control.php",
        data: data,
        mimeType:"multipart/form-data",
        contentType: false, cache: false, processData:false,
        dataType: 'json',
        success: function(result){
          if (result == 1) {
            location.reload();
            $(".close").click();
            $('.message').text("successfully update").show().delay(3000).fadeOut();
        }else{
         alert('Sorry,unable update.');
         }
       }
      });
    });
      form.submit();
    }
        });
      });
   });


$(document).ready(function($){

$(document).on('click','.Blogdelete', function () {
   if (confirm("Delete Record?") == true) {
    var id = $(this).data('id');
    var action='blog_delete';
    $.ajax({
        type:"POST",
        url: "../Controller/control.php",
        data: { id: id,action:action},
        dataType: 'json',
        success: function(result){
        if (result == 1) {
          location.reload();
          $('.message').text("successfully delete").show().delay(3000).fadeOut();
        }
       }
    }); 
   }
});
});
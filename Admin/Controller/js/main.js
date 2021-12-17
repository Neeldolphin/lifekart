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
  $('.v_view').on('click', function () {
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
$( '.categoeryadd').on('click', function () {
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
                $("#datatab").load("category.php #ref");
                $(".close").click();
                $('.message').text("successfully added");
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
$('.categorychange').on('click', function () {
          var action='category_edit';
        var id = $(this).data('id');
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
                $("#datatab").load("category.php #ref");
                $(".close").click();
                $('.message').text("successfully update");
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
 $( '.categorydelete').on('click', function () {
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
              $("#datatab").load("category.php #datatab");
              $('.message').text("successfully delete");
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

    $('.customeradd').on('click', function(){
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
                  $("#datatab").load("customer.php #ref");
                  $(".close").click();
                  $('.message2').text("successfully added");
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

     $('.customeredit').on('click', function () {
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
              $("#datatab").load("customer.php #ref");
              $(".close").click();
              $('.message2').text("successfully update");
             }
          });
               form.submit();
              }
            });
          });
       });

$(document).ready(function($){

 $('.customerdelete').on('click',function () {
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
              $("#datatab").load("customer.php #datatab");
              $('.message2').text("successfully delete");
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
            $("#datatab").load("custom_grp.php #ref");
            $('.message2').text("successfully added");
           }else if(result == 5){
            $('.message2').text("already exists!!!");
         }
          }
      });
    }
      });
    });

   $(document).ready(function(){

    $('.groupedit').on('click', function () {
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
            $("#datatab").load("custom_grp.php #ref");
            $(".close").click();
            $('.message2').text("successfully update");
            }
         });
              form.submit();
             }
           });
         });
      });


$(document).ready(function($){

  $('.groupdelete').on('click',function () {
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
              $("#datatab").load("custom_grp.php #datatab");
              $('.message2').text("successfully deleted");
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
     $('.message1').text("select any one");
     return false;
     }else{
      $('.message1').text("successfully deleted");
       return true;
       }
     }
     });
   });

   $(document).ready(function(){
   
    $('#submitdelete').on('click', function (e) {
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
            $("#datatab").load("custom_grp.php #datatab");
            $('.message').text("successfully deleted");
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
        $("#datatab").load("product.php #datatab");

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

     $('.productadd').on('click', function () {
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
                $("#datatab").load("product.php #ref");
                $(".close").click();
                $('.message').text("successfully added");
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
                $("#datatab").load("product.php #ref");
               $(".close").click();
               $('.message').text("successfully update");
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

 $('.productdelete').on('click', function () {
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
              $('.message').text("successfully deleted");
              $("#ref").load("product.php");
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
    $('.message').text("select any one");
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
        
     $('.imagesadd').on('click', function () {
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
                $("#datatab").load("imageslider.php #ref");
                $(".close").click();
                $('.message').text("successfully added");
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

$('.imageschange').on('click', function () {
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
                $("#datatab").load("imageslider.php #ref");
                $(".close").click();
                $('.message').text("successfully update");
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

 $('.imagesdelete',).on('click', function () {
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
              $("#datatab").load("imageslider.php #datatab");
              $('.message').text("successfully delete");
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
        
     $('.coupenadd').on('click', function(){
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
                $("#datatab").load("coupen.php #ref");
                $(".close").click();
                $('.message').text("successfully added");
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

     $('.coupenedit').on('click',function () {
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
              $("#datatab").load("coupen.php #ref");
              $(".close").click();
              $('.message').text("successfully update");
             }
          });
          form.submit();
        }
            });
          });
       });


$(document).ready(function($){

 $('.coupendelete').on('click', function () {
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
              $("#datatab").load("coupen.php #datatab");
              $('.message').text("successfully deleted");
            }
           }
        }); 
       }
    });
});
//////////////////coupen//////////////////////////////////////
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }
  
$(document).ready(function(){
    $(".xzoom, .xzoom-gallery").xzoom({tint: '#333', Xoffset: 15});
}); 

$(document).ready(function() {
    $('.displayData').on('click',function () {
        var id = $(this).data('id');
        $('.'+id).toggle();
    } );
} );

$(document).ready(function(){
    $('#pricerange').click(function() {
        var startprice=$( "#amount1" ).val();
        var endprice=$( "#amount2" ).val();
        var datasend = $('#datasend').val();
        var id =$('#sortBy').val();
        var page_id =$('#pageId').val();
        window.location.href = 'http://localhost/lifekart/User/View/category.php?page=category&id='+id+'&datasend='+datasend+'&page_id='+page_id+'&startprice='+startprice+'&endprice='+endprice; 
    });
});

    $(function() {
        var startprice=$( "#amount1" ).val();
        var endprice=$( "#amount2" ).val();
        var minprice=$( "#minprice" ).val();
        var maxprice=$( "#maxprice" ).val();
        $("#slider-range" ).slider({
        range: true,
        min:  Number(minprice),
        max: Number(maxprice),
        values: [ startprice, endprice ],
        slide: function( event, ui ) {
        $( "#amount" ).html( "₹" + ui.values[ 0 ] + " - ₹" + ui.values[ 1 ] );
		$( "#amount1" ).val(ui.values[ 0 ]);
		$( "#amount2" ).val(ui.values[ 1 ]);
      }
    });
    $( "#amount" ).html( "₹" + $( "#slider-range" ).slider( "values", 0 ) +
     " - ₹" + $( "#slider-range" ).slider( "values", 1 ) );
  });


$(window).scroll(function() {
    var startprice=$( "#amount1" ).val();
    var endprice=$( "#amount2" ).val();
    var datasend=$( "#datasend" ).val();
    var sortBy=$( "#sortBy" ).val();
    if ($(window).scrollTop() >= $(window).height() - 1100) {
            var numItems = $('.numofprod').length/8;
                if (numItems<5) {
                    $.ajax({
                    method: "POST",
                    data:{numItems:numItems,startprice:startprice,endprice:endprice,sortBy:sortBy,datasend:datasend},
                    url: "infinite.php",
                    cache: false, //avoid browser cache ajax requests
                    success: function(data) {
                    $('#addon').append(data);
                    if (data=='') {
                        $('#loader').hide();
                    }   
                    },
                    error: function(data) {
                        console.log("Something went wrong!")
                    }
                });
                }
        }
    });


$(document).ready(function(){
    $("#signup").validate({
        rules: {
            FirstName: "required",
            username:"required",
            Email:{required: true,
                email: true},
            phone_number:"required",
            country:"required",
            password:"required"
           },
        messages: {
            FirstName: "Enter your name",
            username: "Enter username",
            Email:"Email required",
            phone_number:"Enter 10 digit number",
            country:"required",
            password:"required"
        },
        submitHandler: function(form) { 
            form.submit();
          }
      });
    });

    $(document).ready(function(){
    $("#customerInfo").validate({
        rules: {
            FirstName: "required",
            username:"required",
            Email:{required: true,
                email: true},
            phone_number:"required",
            country:"required"
           },
        messages: {
            FirstName: "Enter your name",
            username: "Enter username",
            Email:"Email required",
            phone_number:"Enter 10 digit number",
            country:"required"
        },
        submitHandler: function(form) { 
            form.submit();
        }
});
});

    $(document).ready(function(){
        $('#save').on('click', function() {
      
            var id = $(this).data('id');
            var action='customer_update';
    
            $.ajax({
                type:"POST",
                url: "../Controller/control.php",
                data: {
                  Id: $('#id').val(),
                   FirstName: $('#FirstName').val(),
                   LastName: $('#LastName').val(),
                   username:$('#username').val(),
                    Email: $('#Email').val(),
                     phone_number: $('#phone_number').val(),
                     Address: $('#Address').val(),
                     country: $('#country').val(),
                     action:action
                },
                dataType: 'json'
              });
            });
        });


    $(document).ready(function(){
        $("#signin").validate({
            rules: {
                username:"required",
                password:"required"
               },
            messages: {
                username: "Enter username",
                password:"required"
            },
            submitHandler: function(form) { 
                form.submit();
              }
          });
        });

        $(document).ready(function(){
        $("#customeredit").click(function(){
            $("#customerInfo").toggle();
        });
    });

$(document).ready(function(){
$('.minus').on('click', function() {
    var num = +$("#quantity").val() - 1;
    if(num>0){
    $("#quantity").val(num);
    }
  })
  $('.plus').on('click', function() {
    var id=$("input:hidden.msg").val();
    var value= $(".quantity").val();
    var action='qty_check';
    $('#msg').value;

    $.ajax({
        type:"POST",
        url: "../Controller/control.php",
        data: {id:id,value:value,action:action},
        dataType: 'json',
        success: function(result){
        if (result == 1) { 
         $(".msg1").text('Not available');
         $('.qtybutton').attr('disabled', true);
        }else{
            $(".msg1").text('');
            var num = +$("#quantity").val() + 1;
            $("#quantity").val(num);
            $('.qtybutton').attr('disabled', false);
        }
       }
    }); 
  });
}); 
   
  $(document).ready(function(){
    $('.quantity').on('change paste keyup', function() {
        var id=$("input:hidden.msg").val();
        var value=this.value;
        var action='qty_check';
        $('#msg').value;

        $.ajax({
            type:"POST",
            url: "../Controller/control.php",
            data: {id:id,value:value,action:action},
            dataType: 'json',
            success: function(result){
            if (result == 1) { 
             $(".msg1").text('Not available');
             $('.qtybutton').attr('disabled', true);
            }else{
                $(".msg1").text('');
                $('.qtybutton').attr('disabled', false);
            }
           }
        }); 
      }); 

      $('.quantity1').on('change paste keyup', function() {
        var id=$(this).data('id');
        var value=this.value;
        var action='qty_check2';
        $('#msg').value;
        $.ajax({
            type:"POST",    
            url: "../Controller/control.php",
            data: {id:id,value:value,action:action},
            dataType: 'json',
            success: function(result){
            if (result == 1) { 
             $(".msg1").text('Not available');
             $('.qtybutton').attr('disabled', true);
            }else{
                $(".msg1").text('');
                $('.qtybutton').attr('disabled', false);
            }
           }
        }); 
      }); 

      $("#apply").click(function(){
        var action ='coupen_apply';
        if($('#promo_code').val()!=''){
            $.ajax({
                type: "POST",
                url: "../Controller/control.php",
                data:{
                    coupen_code: $('#coupen_code').val(),
                    action:action
                },
                success: function(result){
                    if (result == 1) { 
                        window.location.reload(true);
                       }else{
                        $("#messagedis").text('wrong input!');
                       }
                
                }
             });
        }
    });   

    $("#remove").click(function(){
        var action ='coupen_remove';
        
            $.ajax({
                        type: "POST",
                        url: "../Controller/control.php",
                        data:{
                            action:action
                        },
                        success: function(){
                        window.location.reload(true);
                        }
            });
    });   

    $("#dropdown").on('change', function(){
        var datasend = $(this).val();
        var id =$('#sortBy').val();
        var page_id =$('#pageId').val();
        window.location.href = 'http://localhost/lifekart/User/View/category.php?page=category&id='+id+'&datasend='+datasend+'&page_id='+page_id; 
        
    });  


    $(".totalPages").on('click', function(){
        var category_id =$('#sortBy').val();
        var orderby = $('#page').val();
        var id =$(this).html();
         window.location.href = 'http://localhost/lifekart/User/View/category.php?id='+category_id+'&datasend='+orderby+'&page_id='+id;
    });  

        $("#search_button").click(function() {
            var name = $('#search').val();
            var action='on_search';
            if($('#search').val()!=''){
                $.ajax({
                    type: "POST",
                    url: "../Controller/control.php",
                    data: {
                        search:name,action:action
                    },
                    dataType: 'json', 
                    success: function(html) {
                      if(html.pid!= null){
                        window.location.href = 'http://localhost/lifekart/User/View/productDetails.php?page=array&id='+html.pid;
                      }
                      else if(html.cid!= null){
                      window.location.href = 'http://localhost/lifekart/User/View/category.php?page=category&id='+html.cid;
                    }else{$('#message').html("Enter a Valid Search!");}
     
                   }
                });
               }else{$('#message').html("Enter a Valid Search!");}
              });


              $(".clearCart").on('click', function(){
            var action='clear_cart';
            $.ajax({
                type: "POST",
                url: "../Controller/control.php",
                data:{
                    action:action
                },
                success: function(){
                window.location.reload(true);
                }
                });
               
            }); 

            $(".deleteItem").on('click', function(){
                var action='delete_Item';
                var id=$(this).siblings('.DeleteId').val();
                var index=$(this).siblings('.indexId').val();
                console.log(id);
                console.log(index);
                $.ajax({
                    type: "POST",
                    url: "../Controller/control.php",
                    data:{
                        action:action,id:id,index:index
                    },
                    success: function(){
                    window.location.reload(true);
                    }
                    });
                   
                }); 
               
});


$(document).ready(function(){
$("#blogsearchbtn").click(function() {
    var name = $('#search-blog').val();
    var action='on_search_blog';
    if($('#search-blog').val()!=''){
        $.ajax({
            type: "POST",
            url: "../Controller/control.php",
            data: {
                search:name,action:action
            },
            dataType: 'json', 
            success: function(html) {
                window.location.href = 'http://localhost/lifekart/User/View/search_blog.php?id='+html+'&name='+name;
           }
        });
       }else{$('#message').html("Enter a Valid Search!");}
      });

           
            $('#submit_comment').click(function() { 
                
              var name = $('#name_field').val();;
              var email = $('#email_field').val();;
              var comment = $('#message_field').val();
              var user_id = $('#user_id').val();
              var blog_id = $('#blog_id').val();
              var action='Comment_blog';              

            $.ajax({
                type: "POST",
                url: "../Controller/control.php",
                data: {
                    name:name,email:email,comment:comment,user_id:user_id,blog_id:blog_id,action:action
                },
                dataType: 'json', 
                success: function(result) {
                if (result==1) {
                    $('#success').html("thanks for comment");
                    }
                }
            });
        });

          
      
});

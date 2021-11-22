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
                           alert('wrong input!');
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




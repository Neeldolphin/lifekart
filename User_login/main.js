$(document).ready(function(){
    $('.quantity').on('change paste keyup', function() {
        var id=$("input:hidden.msg").val();
        var value=this.value;
        $('#msg').value;

        $.ajax({
            type:"POST",
            url: "addtocart.php",
            data: {id:id,value:value},
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
        $('#msg').value;

        $.ajax({
            type:"POST",
            url: "addtocart.php",
            data: {id:id,value:value},
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
                        url: "action.php",
                        data:{
                            coupen_code: $('#coupen_code').val(),
                            action:action
                        },
                        success: function(){
                        window.location.reload(true);
                        }
            });
        }else{
            $('#message').html("Promocode can not be blank .Enter a Valid Promocode !");
        }
    });   

    $("#remove").click(function(){
        var action ='coupen_remove';
        
            $.ajax({
                        type: "POST",
                        url: "action.php",
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

        window.location.href = 'http://localhost/lifekart/User_login/category.php?page=category&id='+id+'&datasend='+datasend+'&page_id='+page_id; 
        
    });  


    $(".totalPages").on('click', function(){
        var category_id =$('#sortBy').val();
        var orderby = $('#page').val();
        var id =$(this).html();
         window.location.href = 'http://localhost/lifekart/User_login/category.php?id='+category_id+'&datasend='+orderby+'&page_id='+id;
    });  

        $("#search_button").click(function() {
            var name = $('#search').val();
            if($('#search').val()!=''){
                $.ajax({
                    type: "POST",
                    url: "livesearch.php",
                    data: {
                        search: name
                    },
                    dataType: 'json', 
                    success: function(html) {
                      if(html.pid!= null){
                        window.location.href = 'http://localhost/lifekart/User_login/productDetails.php?page=array&id='+html.pid;
                      }
                      else if(html.cid!= null){
                      window.location.href = 'http://localhost/lifekart/User_login/category.php?page=category&id='+html.cid;
                    }else{$('#message').html("Enter a Valid Search!");}
     
                   }
                });
               }else{$('#message').html("Enter a Valid Search!");}
              });
           
});




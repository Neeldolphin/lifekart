$(document).ready(function(){
    $('.quantity').on('change paste keyup', function() {
        var id=$("input:hidden#msg").val();
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
});

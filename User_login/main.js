$(document).ready(function(){
    $('#quantity').on('change paste keyup', function() {
        var value=this.value;
        var id=$('#message').value;

        $.ajax({
            type:"POST",
            url: "addtocart.php",
            data: { id: id ,value:value },
            dataType: 'json',
            success: function(result){
            if (result == 1) { 
             $("message1").text('warning');
            }else{
                $("message1").text('');
            }
           }
        }); 
      });    
});

function imageZoom(imgID, resultID) {
  var img, lens, result, cx, cy;
  img = document.getElementById(imgID);
  result = document.getElementById(resultID);
  /*create lens:*/
  lens = document.createElement("DIV");
  lens.setAttribute("class", "img-zoom-lens");
  /*insert lens:*/
  img.parentElement.insertBefore(lens, img);
  /*calculate the ratio between result DIV and lens:*/
  cx = result.offsetWidth / lens.offsetWidth;
  cy = result.offsetHeight / lens.offsetHeight;
  /*set background properties for the result DIV:*/
  result.style.backgroundImage = "url('" + img.src + "')";
  result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
  /*execute a function when someone moves the cursor over the image, or the lens:*/
  lens.addEventListener("mousemove", moveLens);
  img.addEventListener("mousemove", moveLens);
  /*and also for touch screens:*/
  lens.addEventListener("touchmove", moveLens);
  img.addEventListener("touchmove", moveLens);
  
  /*initialise and hide lens result*/
  result.style.display = "none";
  /*Reveal and hide on mouseover or out*/
  lens.onmouseover = function(){result.style.display = "block";};
  lens.onmouseout = function(){result.style.display = "none";};
  
  function moveLens(e) {
    var pos, x, y;
    /*prevent any other actions that may occur when moving over the image:*/
    e.preventDefault();
    /*get the cursor's x and y positions:*/
    pos = getCursorPos(e);
    /*calculate the position of the lens:*/
    x = pos.x - (lens.offsetWidth / 2);
    y = pos.y - (lens.offsetHeight / 2);
    /*prevent the lens from being positioned outside the image:*/
    if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
    if (x < 0) {x = 0;}
    if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
    if (y < 0) {y = 0;}
    /*set the position of the lens:*/
    lens.style.left = x + "px";
    lens.style.top = y + "px";
    /*display what the lens "sees":*/
    result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
  }
  function getCursorPos(e) {
    var a, x = 0, y = 0;
    e = e || window.event;
    /*get the x and y positions of the image:*/
    a = img.getBoundingClientRect();
    /*calculate the cursor's x and y coordinates, relative to the image:*/
    x = e.pageX - a.left;
    y = e.pageY - a.top;
    /*consider any page scrolling:*/
    x = x - window.pageXOffset;
    y = y - window.pageYOffset;
    return {x : x, y : y};
  }
};

$(document).ready(function(){
imageZoom("myimage", "myresult");

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



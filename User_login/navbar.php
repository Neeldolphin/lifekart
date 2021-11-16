
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <a class="navbar-brand" href="http://localhost/lifekart/User_login/home.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
  <ul class="nav navbar-nav ml-auto">
  <form class="navbar-form form-inline ml-auto">
			<div class="input-group search-box">
				<input type="text" class="form-control" id="search">
				<div class="input-group-append">
					<button type="button" class="btn btn-danger" id="search_button"><span>Search</span></button>
				</div>
			</div>
		</form>	
</ul>
  <?php
  session_start();
  if(!isset($_SESSION['username'])){
    ?>
      <ul class="nav navbar-nav ml-auto">
      <li class="nav-item account">
      <a class="nav-link" href="http://localhost/lifekart/User_login/login.php">Login</a>
      </li>
      <li class="nav-item account">
      <a class="nav-link" href="http://localhost/lifekart/User_login/signUp.php">Sign Up</a>
      </li>
          </ul>
   <?php }else
          {?> 
<ul class="nav navbar-nav ml-auto">
<p style="color: white;">Welcome to Home page!
   <a class="nav-link" href="http://localhost/lifekart/User_login/logout.php">Logout</a></p>
   <a href="view_cart.php?id=<?php echo $_SESSION['id']?>" >Cart <?php if(isset($_SESSION['cart'])){ echo count($_SESSION['cart']);} ?><i class="fas fa-shopping-cart"></i></a>
</ul>
<?php } ?>
  </div>  
</nav>

<script>
$(document).ready(function() {
   $("#search_button").click(function() {
       var name = $('#search').val();
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
                 if(html.cid!= null){
                 window.location.href = 'http://localhost/lifekart/User_login/category.php?page=category&id='+html.cid;
               }
              }
           });
         });
      });
</script>
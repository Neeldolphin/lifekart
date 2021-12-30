
<nav class="navbar navbar-expand-lg bg-light navbar-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class=" navbar-collapse" id="navbarNav">
  <a class="navbar-brand" href="http://localhost/lifekart/User/View/index.php"><img src="../images/logo1.png" class="logo" alt="logo"/></a>
  <?php
  if(!isset($_SESSION['username'])){
    ?>
      <ul class="nav navbar-nav ml-auto">
      <ul class="nav navbar-nav searchbox">
  <form class="navbar-form mt-1 form-inline">
    <p id="message" style="color:red;"></p>
			<div class="input-group search-box">
				<input type="text" class="form-control" id="search">
				<div class="input-group-append">
					<button type="button" class="btn btn-danger" id="search_button"><span>Search</span></button>
				</div>
			</div>
      
		</form>	
</ul>
      <li class="nav-item account">
      <a class="nav-link" href="http://localhost/lifekart/User/View/login.php">Login</a>
      </li>
      <li class="nav-item account">
      <a class="nav-link" href="http://localhost/lifekart/User/View/signUp.php">Sign Up</a>
      </li>
          </ul>
   <?php }else
          {?> 
<ul class="nav navbar-nav ml-auto">
<ul class="nav navbar-nav searchbox">
  <form class="navbar-form mt-1 form-inline">
    <p id="message" style="color:red;"></p>
			<div class="input-group search-box">
				<input type="text" class="form-control" id="search">
				<div class="input-group-append">
					<button type="button" class="btn btn-danger" id="search_button"><span>Search</span></button>
				</div>
			</div>
      
		</form>	
</ul>
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i width="100" height="100" class="rounded-circle fas fa-user"></i> 
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="http://localhost/lifekart/User/View/dashbord.php">Dashbord</a>
          <a class="dropdown-item" href="http://localhost/lifekart/User/View/profile.php">Profile</a>
          <a class="dropdown-item" href="http://localhost/lifekart/User/View/logout.php">Logout</a>
        </div>
      </li>   
    </ul>
    <a  class="nav-link" href="view_cart.php?id=<?php echo $_SESSION['id']?>" >Cart <?php if(isset($_SESSION['cart'])){ echo count($_SESSION['cart']);} ?><i class="fas fa-shopping-cart"></i></a>
    </ul>
<?php } ?>
  </div>  
</nav>
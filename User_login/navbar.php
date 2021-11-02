
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <a class="navbar-brand" href="http://localhost/lifekart/User_login/home.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
  <ul class="nav navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href="http://localhost/lifekart/User_login/category.php">Category</a>
      </li>   
  </ul>
  <?php
  include("auth_session.php");
  if(!isset($_SESSION['username'])){?>
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
<li class="nav-item account">
<p style="color: white;">Welcome to Home page!</p>
   <a class="nav-link" href="http://localhost/lifekart/User_login/logout.php">Logout</a>
          </li>
<?php } ?>
  </div>  
</nav>

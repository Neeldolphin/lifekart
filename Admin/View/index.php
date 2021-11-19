<html>
  <head>
  <link rel = "stylesheet" type = "text/css" href = "../Controller/css/style.css"> 
  </head>
<body>
<?php
 include 'auth_session.php';
 if(!isset($_SESSION['username'])){?>
<a href="login.php">Login</a>
<?php }else
          {?> 
      <p style="color: white;">Welcome to Dashboard!
   <a  href="logout.php">Logout</a></p>
   <?php } ?>
</body>
</html> 
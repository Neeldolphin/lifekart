<html>
  <head>
  <link rel = "stylesheet" type = "text/css" href = "style.css"> 
  </head>
<body>
<?php
 include("auth_session.php");
 if(!isset($_SESSION['username'])){?>
<a href="http://localhost/lifekart/Admin_login/login.php">Login</a>
<?php }else
          {?> 
      <p style="color: white;">Welcome to Dashboard!
   <a  href="http://localhost/lifekart/Admin_login/logout.php">Logout</a></p>
   <?php } ?>
</body>
</html> 
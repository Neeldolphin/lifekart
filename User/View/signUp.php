<?php
include '../Model/class.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Sign Up</title>
    <link rel="stylesheet" href="../Controller/css/style.css"/>
</head>
<body>
<?php
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
         $FirstName = stripslashes($_REQUEST['FirstName']);
         $FirstName = mysqli_real_escape_string($con, $FirstName);
         $LastName = stripslashes($_REQUEST['LastName']);
         $LastName = mysqli_real_escape_string($con, $LastName);
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $sign_up=new log_in();
        $sign_up->signUp($FirstName,$LastName,$username,$password,$email);

    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Sign Up</h1>
         <input type="text" class="login-input" name="FirstName" placeholder="FirstName" required />
          <input type="text" class="login-input" name="LastName" placeholder="LastName" required /> 
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress">
        <input type="password" class="login-input" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login.php">Click to Login</a></p>
    </form>
<?php
    }
?>
</body>
</html>
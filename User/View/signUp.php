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
        $request=$_REQUEST;
        $sign_up=new log_in();
        $sign_up->signUp($request);
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
</body>
</html>
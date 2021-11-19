<?php include '../Model/class.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="../Controller/css/style.css"/>
</head>
<body>
<?php

    session_start();
    // When form submitted, check and create user session.
    $post=$_POST;
    $request=$_REQUEST;
    $cate=new login();
    $rows=$cate->admin($post,$request);
?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
  </form>
</body>
</html>
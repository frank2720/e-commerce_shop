<?php
include_once 'models/user.php';
?>
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="utf-8">
    <meta nname="viewport" content="width=device-width, initial-scale=1">
    <title>Pudfra-login</title>

        <!-- Favicons -->
    <link href="../images/7660092.jpg" rel="icon">
    <link href="../images/7660092.jpg" rel="apple-touch-icon">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="login.css">
</head>
 
<body>
    <form action="" method="post">
        <div class="login-box">
            <h1>Login</h1>
 
            <div class="textbox">
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="text" placeholder="Username"
                         name="username" value="">
            </div>
 
            <div class="textbox">
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="password" placeholder="Password"
                         name="password" value="">
            </div>
 
            <input class="button" type="submit"
                     name="login" value="Sign In">
        </div>
    </form>
</body>
 
</html>
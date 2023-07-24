<?php
if(isset($_COOKIE['username']))
{
    $rememberuser=$_COOKIE['username'];
    $rememberpassword=$_COOKIE['password'];
}
else{
    $rememberuser="";
    $rememberpassword="";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>

        body {
            background-color: #5940ba;
            font-family: "Open Sans", sans-serif;
            display: block;
            margin: 8px;
        }
        h1{
            display: block;
            font-size: 8vmax;
            margin-block-start: 0.4em;
            margin-block-end: 0.4em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
        }
        h5{
            display: block;
            font-size: 4.5vmax;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
        }
        p{
            display: block;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
        }
        hr{
            margin-top: 30px;
        }
        input{
            padding: 10px;
            margin-top: 25px;
            font-size: 16px;
            border: none!important;
            border-bottom: 2px solid #B0B3B9!important;
        }
        .login-box {
            margin: 30px auto;
            background: white;
            width: 80%;
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            flex: 1 1 100%;
            align-items: stretch;
            justify-content: space-between;
            box-shadow: 0 0 20px 6px #090b6f85;
        }
        .left{
            color: #FFFFFF;
            background-size: cover;
            background-repeat: no-repeat;
            background-image: url("bg.jpg");
            overflow: hidden;
        }
        .leftoverlay{
            padding: 30px;
            width: 100%;
            height: 100%;
            background: #5961f9ad;
            overflow: hidden;
            box-sizing: border-box;
        }
        .right{
            width: 50%;
            padding: 40px;
            overflow: hidden;
        }
        .remember{
            margin-top: 0 !important;
        }
        .center {
            display: flex;
            justify-content: center;
        }

        .btn.btn-primary{
            font-weight: bold!important;
        }


    </style>
</head>
<body>
<div class="login-box">

    <div class="left">
        <div class="leftoverlay">
            <h1>Student Portal</h1>
            <p>Connecting Education, Empowering Growth: Welcome to Your Student Portal.</p>
        </div>
    </div>

    <div class="right">
    <h5>Log in</h5><br>
        <p style="color: #8b8b8b;">Don't have an account? <a href="signup.php">Create an account</a><br>It takes less than a minute.</p>
    <form method="post">
        <div class="form-group">
            <input type="email" class="form-control" id="username" name="username" value="<?=$rememberuser?>" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" value="<?= $rememberpassword?>" placeholder="Password" required>
            <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()">
            <label for="showPassword">Show Password</label>
        </div>
        <input type="checkbox" id="remember" name="remember" class="remember" >
        <label for="remember">Remember Me</label>
        <?php

        if(isset($_POST['remember']))
        {
            setcookie("username", $_POST['username']);
            setcookie("password", $_POST['password']);
        }

        if (isset($_POST['username']))
        {
            // Get form values
            $username = $_POST['username'];
            $password = $_POST['password'];

            require 'application.php';
            $db = new application();
            $result = $db->get_data_login($username, $password);

            require 'session.php';
            $session = new session();
            $session->login($result, $username);
        }
        ?>
        <div class="center">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById("password");
        var showPasswordCheckbox = document.getElementById("showPassword");

        if (showPasswordCheckbox.checked) {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
</script>
</body>
</html>
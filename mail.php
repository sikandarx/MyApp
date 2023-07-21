<!DOCTYPE html>
<html>
<head>
    <title>Mail</title>
</head>
<body>
<div class="container mt-5">
<form method="post" action="mail.php">
    <div class="form-group">
        <label for="name">Email</label>
        <input type="text" class="form-control" id="email"  name="email" placeholder="Enter your Email" required>
    </div>
</form>
</div>
</body>
</html>

<?php
$username=$_POST['email'];
$token='';
require 'application.php';
$mail=new application();
$mail->sendVerificationEmail($username,$token);
?>
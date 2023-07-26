<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
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

        <h5>Sign up</h5><br>

        <form method="post">
            <div class="form-group">
                <input type="email" class="form-control" id="newusername" name="newusername" placeholder="Enter Your Student Email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Enter New Password" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm New Password" required>
                <input type="checkbox" id="sPassword" onclick="sPasswordVisibility()">
                <label class="spass" for="sPassword">Show Password</label>
            </div>
            <input type="hidden" name="type" value="student">
            <?php
            session_start();

            if (isset($_POST['type'])) {
                $type = $_POST['type'];
                $newusername = $_POST['newusername'];
                $_SESSION['newusername'] = $newusername;
                $newpassword = $_POST['newpassword'];
                require 'application.php';
                $db = new application();
                $check_repeat = $db->check_email_repeat($newusername);
                $check = $db->check_email($newusername);
                if ($check->num_rows > 0) {
                    if ($check_repeat->num_rows > 0) {
                        echo "<p class='p-2 text-white bg-danger opacity text-center mt-4' >Account on this email Already Exists!!</p>";
                    } else {
                        $db->signup_users($newusername, $newpassword, $type);
                    }
                }
                else{
                    echo "<p class='p-2 text-white bg-danger opacity text-center mt-4' >Student does not exist!!</p>";
                }
            }
            ?>
            <div class="center">
                <button id="submit" type="submit" class="btn btn-primary" >Next</button>
            </div>
        </form>
    </div>
</div>

<script>
    function sPasswordVisibility() {
        var newpasswordField = document.getElementById("newpassword");
        var confirmpasswordField = document.getElementById("confirmpassword");
        var sPasswordCheckbox = document.getElementById("sPassword");

        if (sPasswordCheckbox.checked) {
            newpasswordField.type = "text";
            confirmpasswordField.type = "text";
        } else {
            newpasswordField.type = "password";
            confirmpasswordField.type = "password";
        }
    }


    function validateForm() {
        var password = document.getElementById("newpassword").value;
        var confirmPassword = document.getElementById("confirmpassword").value;

        if (password !== confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }

        return true;
    }
    const submitBtn = document.getElementById('submit');
    submitBtn.addEventListener('click', function(event){
        if (!validateForm()) {
            event.preventDefault();
        }
    });
</script>
</body>
</html>
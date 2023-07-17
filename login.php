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
            background-color: rgba(0, 0, 255, 0.5) !important;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            transition: height 0.1s ease;
        }
        hr{
            margin-top: 30px;
        }
        .login-box {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            margin: 20px 0;
        }
        .center {
            display: flex;
            justify-content: center;
        }

        .btn.dropdown-toggle {
            border: black solid 1px;
        }

        .btn.btn-primary{
            font-weight: bold!important;
        }
        @media screen and (max-width:980px) {

            h2 {
                font-size: 80px !important;
            }

            hr{
                margin-top: 50px!important;
            }

            .login-box {
                font-size: 50px !important;
                border-radius: 50px !important;
                padding: 50px !important;
                margin: 50px 0!important;
            }

            input[type="text"], [type="password"], [type="email"] {
                font-size: 50px !important;
            }
            input[type="checkbox"] {
                transform: scale(2) !important;
            }

            .btn{
                font-size: 50px!important;
                border-radius: 20px !important;
                padding: 8px 25px !important;
            }
            .btn.btn-primary {
                margin-top: 30px !important;
            }
            .form-group{
                margin-top: 40px !important;
            }
            .spass{
                margin-top: 25px !important;
            }
        }

    </style>
</head>
<body>
<div class="login-box col-lg-4 col-md-11">
    <?php
    //this is my code
    if (isset($_POST['type']))
    {
        $type=$_POST['type'];
        $newusername = $_POST['newusername'];
        $newpassword = $_POST['newpassword'];
        require 'application.php';
        $db = new application();
        $db->signup_users($newusername, $newpassword, $type);
    }
    ?>
    <h2 class="text-center">Log in</h2><br>
    <form method="post">
        <div class="form-group">
            <label for="username">Email:</label>
            <input type="email" class="form-control" id="username" name="username" placeholder="Enter Email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
            <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()">
            <label class="spass" for="showPassword">Show Password</label>
        </div>
        <?php
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
    <div class="text-center font-weight-bold mt-3 mb-3">Or</div>
    <div class="dropdown">
        <div class="center">
            <button class="btn dropdown-toggle" type="button" id="signupDropdown" data-toggle="collapse" data-target="#signupForm" aria-expanded="false" aria-controls="signupForm">
                Create Account
            </button>
        </div>
    </div>

<div class="collapse" id="signupForm" onmouseleave="restoreBodyHeight()">
    <!-- Signup form -->
    <hr>
    <form method="post">
        <h2 class="text-center mt-4">Sign Up</h2>
        <div class="form-group">
            <label for="newusername">Email:</label>
            <input type="email" class="form-control" id="newusername" name="newusername" placeholder="Enter Your Email" required>
        </div>
        <div class="form-group">
            <label for="newpassword">New Password:</label>
            <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Enter New Password" required>
        </div>
        <div class="form-group">
            <label for="confirmpassword"> Confirm New Password:</label>
            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm New Password" required>
            <input type="checkbox" id="sPassword" onclick="sPasswordVisibility()">
            <label class="spass" for="sPassword">Show Password</label>
        </div>
        <input type="hidden" name="type" value="student">
        <div class="center">
            <button type="submit" class="btn btn-primary">Sign Up</button>
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

    document.addEventListener("DOMContentLoaded", function() {
        var dropdown = document.querySelector("#signupDropdown");
        var body = document.body;
        var isExpanded = false;

        dropdown.addEventListener("click", function(event) {
            isExpanded = !isExpanded;
            body.style.height = isExpanded ? "100%" : "100vh";
        });

        var signupForm = document.querySelector("#signupForm form");
        signupForm.addEventListener("submit", function(event) {
            event.preventDefault();
            if (!validateForm()) {
                return;
            }
            signupForm.submit();
        });
    });
</script>
</body>
</html>

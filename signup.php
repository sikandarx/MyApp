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
            background-color: #5940ba!important;
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

    </style>
</head>
<body>
<div class="login-box col-lg-4 col-md-11">

    <?php
    //this is my code
    if (isset($_POST['type'])) {
        $type = $_POST['type'];
        $newusername = $_POST['newusername'];
        $newpassword = $_POST['newpassword'];
        require 'application.php';
        $db = new application();
        $check = $db->check_email($newusername);

        if ($check->num_rows > 0) {
            echo "<p class='p-2 text-white bg-danger opacity text-center mt-4' >Email Already Exists!!</p>";
        }
        else {
            $db->signup_users($newusername, $newpassword, $type);
        }
    }
    ?>
        <form method="post">
            <h2 class="text-center mt-4">Sign Up</h2>
            <div class="form-group">
                <label for="newusername">Email:</label>
                <input type="email" class="form-control" id="newusername" name="newusername" placeholder="Enter Your Email" required>
            </div>
            <div class="form-group">
                <label for="newpassword">Password:</label>
                <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Enter New Password" required>
            </div>
            <div class="form-group">
                <label for="confirmpassword"> Confirm Password:</label>
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

<script>}
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

</script>
</body>
</html>

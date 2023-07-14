

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body{
            background-color: rgba(0, 0, 255, 0.5) !important;
        }
        .login-box{
            background-color: white;
            max-width: 500px;
            padding: 25px;
            margin: 200px auto;
        }
    </style>
</head>
<body>
<div class="container">
<div class="login-box">
    <h2 class="text-center">Sign in</h2><br>
<form method="post" >
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username"  name="username" placeholder="Enter Username" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
        <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()">
        <label for="showPassword">Show Password</label>
    </div>
    <?php
        if ($_POST) {
            // Get form values
            $username = $_POST['username'];
            $password = $_POST['password'];

            require 'application.php';
            $db = new application();
            $result = $db->get_data_login($username, $password);

            if ($result->num_rows > 0) {
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['type'] = $result->fetch_row()[3];
                header("Location: home.php");
            }
            else {
                echo "<p class='p-2 text-white bg-danger opacity text-center ' >Incorrect credentials!!</p>";
            }
        }
    ?>
    <button type="submit" class="btn btn-primary">Login</button>
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
<?php
require 'session.php';
$session = new session();
$session->student();
$username=$_SESSION['username'];
if(isset($_POST['logout']))
{
    session_destroy();
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        .nav-item{
            margin: auto!important;
        }
        .nav-link{
            padding: 8px 0!important;
            margin-right: 20px!important;
            margin-left: 20px!important;
        }
        .nav-link.active{
            margin: 0!important;
        }
        .active{
            padding: 16px 20px!important;
            border-radius: 0!important;
        }
        .navbar{
            padding: 0;
        }

        .btn.logout{
            position: absolute;
            top: 0;
            right: 0;
        }
        .logout{

            color: white!important;
            background-color: dodgerblue!important;
            padding: 8px 12px!important;
            margin: 7px 40PX;
            border-radius: 4px;
        }
        .img{
            max-width: 20px;
        }
        .bg-primary{
            background-color: #7f7fff!important;
        }
    </style>
</head>
<body>
<nav class="navbar nav-pills navbar-expand-sm bg-dark navbar-dark">

    <!-- Links -->
    <ul class="navbar-nav ml-5">
        <li class="nav-item">
            <a class="nav-link" href="student_home.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active bg-primary" href="student_registered_courses.php">Registered Courses</a>
        </li>

        <form method="POST" action="admin_home.php">
            <input type="hidden" name="logout">
            <button type="submit" class="btn logout" >
                <img src="icons/logout_icon.png" alt="Power Sign" class="img">
                Log Out</button>
        </form>
    </ul>
</nav>
<h1 class="p-4 text-center text-white bg-primary">Your Registered Courses</h1>

</body>
</html>
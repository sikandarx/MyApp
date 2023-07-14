<?php
require 'session.php';
$session = new session();
$session->student();
$username=$_SESSION['username'];

require 'application.php';
$db= new application();
$result=$db->get_username_info($username);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        p{
            font-size: 25px!important;
        }
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
            background-color: #800080!important;
            padding: 16px 20px!important;
            border-radius: 0!important;
        }
        .navbar{
            padding: 0;
        }
        .bg-primary{
            background-color: #800080!important;
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
        .d-flex{
            gap: 100px;
        }
        .d-flex>*{
            max-width: 1000px;
        }
        .img{
            max-width: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar nav-pills navbar-expand-sm bg-dark navbar-dark">

    <!-- Links -->
    <ul class="navbar-nav ml-5">
        <li class="nav-item">
            <a class="nav-link active" href="student_home.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="student_registered_courses.php">Registered Courses</a>
        </li>

        <form method="POST" action="admin_home.php">
            <input type="hidden" name="logout">
            <button type="submit" class="btn logout" >
                <img src="icons/logout_icon.png" alt="Power Sign" class="img">
                Log Out</button>
        </form>
    </ul>
</nav>
<h1 class="p-4 text-center text-white bg-primary">Home Page</h1>

<div class="container my-5">
    <?php
    $data= $result->fetch_row()?>
    <div class="d-flex flex-wrap">
        <div><h2>Name:</h2><p><?php echo $data[1];?></p></div>
        <div><h2>Roll Number:</h2><p><?php echo $data[2];?></p></div>
        <div><h2>Batch:</h2><p><?php echo $data[3];?></p></div>
        <div><h2>Email:</h2><p><?php echo $data[4];?></p></div>
        <div><h2>Gender:</h2><p><?php echo $data[5];?></p></div>
        <div><h2>About Yourself:</h2><p><?php echo $data[6];?></p></div>
    </div>

</div>
</body>
</html>
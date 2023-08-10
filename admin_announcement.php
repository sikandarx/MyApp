<?php
require 'session.php';
$session=new session();
$session->admin();
if(isset($_POST['logout']))
{
    session_destroy();
    header("Location: login.php");
}
require "application.php";
$db=new application();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Announcements</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .nav-item{
            margin: auto 0!important;
        }
        .nav-link{
            padding: 8px 0!important;
            margin-right: 20px!important;
            margin-left: 20px!important;
        }
        .nav-item.active{
            padding: 8px 0 !important;
        }
        .nav-link.active{
            margin: 0!important;
        }
        .active{
            background-color: #800080!important;
            padding: 16px 20px!important;
            border-radius: 0!important;
        }
        .dropdown-toggle{
            background-color: transparent!important;
            padding: 8px 0!important;
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
        .img{
            max-width: 20px;
        }
        .course{
            background-color: #d8d8d8;
            padding: 20px;
            margin: 10px 0;
        }
        .d-flex{
            gap: 30px;
        }
        .d-flex>*{
            max-width: 1000px;
        }
        .navbar-nav{
            margin-left: 40px;
        }
        @media screen and (max-width:980px) {
            .mtop{
                margin-top: 150px !important;
            }
            .logout{
                font-size: 45px;
                margin: 25px 40PX!important;
                padding: 15px !important;
                border-radius: 10px!important;
            }
            .img{
                max-width: 0px!important;
            }
            .course{
                width: 800px !important;
            }
            h1{
                font-size: 85px !important;
            }
            h2{
                font-size: 50px !important;
            }
            h4{
                font-size: 40px !important;
            }
            .navbar-nav{
                margin: 0!important;
            }
            .nav-link{
                margin-left: 0!important;
                padding: 16px 20px!important;
                font-size: 40px!important;
            }
            .dropdown-item{
                font-size: 40px !important;
            }
            .navbar-toggler-icon {
                font-size: 3.5rem;
            }
            .navbar-toggler{
                margin: 25px;
            }
            .nav-item{
                margin: 20px 0!important;
            }
            .navbar-collapse {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                width: 50%;
                background-color: #343a40; /* Adjust the background color as needed */
                padding: 1rem;
                z-index: 1000;
                transition-duration: 0s;
                animation: slideIn 0.3s forwards;
                transform: translateX(-100%);
            }
            @keyframes slideIn {
                from {
                    transform: translateX(-100%);
                }
                to {
                    transform: translateX(0);
                }
            }

        }
    </style>
</head>
<body>

<nav class="navbar nav-pills navbar-expand-lg bg-dark navbar-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Links -->
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="admin_home.php">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="admin_announcement.php">Announcements</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_create_account.php">Create Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_student.php">Student</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_teacher.php">Teacher</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_course.php">Course</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_student_enroll.php">Student Enroll</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_teacher_enroll.php">Teacher Enroll</a>
            </li>

            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Data Tables
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="admin_student_table.php">Students</a>
                    <a class="dropdown-item" href="admin_teacher_table.php">Teachers</a>
                    <a class="dropdown-item" href="admin_course_table.php">Courses</a>
                    <a class="dropdown-item" href="admin_student_enroll_table.php">Student Enrollment</a>
                    <a class="dropdown-item" href="admin_teacher_enroll_table.php">Teacher Enrollment</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<form method="POST" action="admin_home.php">
    <input type="hidden" name="logout">
    <button type="submit" class="btn logout" >
        <img src="logout_icon.png" alt="Power Sign" class="img">
        Log Out</button>
</form>


<h1 class="p-4 text-center text-white bg-primary">Announcement</h1>


<div class="container my-5">
    <form method="post" action="admin_announcement.php">
        <div class="form-group">
            <label for="type">Audience<span class="text-danger"> *</span></label>
            <select class="form-control" id="type" name="type">
                <option value="">(Select the audience)</option>
                <option value="all">All</option>
                <option value="student">Students</option>
                <option value="teacher">Teachers</option>
            </select>
        </div>
        <div class="form-group">
            <label for="message">Message<span class="text-danger"> *</span></label>
            <textarea class="form-control" rows="4" id="message" name="message" placeholder="Enter the Message" required></textarea>
        </div>
        <?php
        if(isset($_POST['type']))
        {
            if($_POST['type'] != "")
            {
                $type=$_POST['type'];
                $message=$_POST['message'];
                $db->admin_notification($type,$message);
            }
            else{
                echo "<p class='p-2 text-white bg-danger text-center' >Select the type!!</p>";
            }
        }
        ?>
        <button class="btn btn-primary" type="submit">Send</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var navbarToggler = document.querySelector('.navbar-toggler');
        var navbarCollapse = document.querySelector('.navbar-collapse');
        var body = document.querySelector('body');

        navbarToggler.addEventListener('click', function() {
            navbarCollapse.classList.toggle('show');
        });

        body.addEventListener('click', function(e) {
            if (!navbarCollapse.contains(e.target) && navbarCollapse.classList.contains('show')) {
                navbarCollapse.classList.remove('show');
            }
        });
    });
</script>
</body>
</html>
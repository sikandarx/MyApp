<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .nav-item{
            margin: auto 0!important;
            padding-right:20px!important;
            padding-left:20px!important;
        }

        .active{
            background-color: #976fd7!important;
            padding: 16px 20px!important;
            border-radius: 0!important;
        }
        .dropdown-toggle{
            padding: 16px 20px!important;
            border-radius: 0!important;
        }
        .navbar{
            padding: 0;
        }
        .bg-primary{
            background-color: #976fd7!important;
        }
    </style>
</head>
<body>

<nav class="navbar nav-pills navbar-expand-sm bg-dark navbar-dark">

    <!-- Links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link active" href="home.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="student_info.php">Student</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="course_info.php">Course</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="enroll.php">Enroll</a>
        </li>

        <!-- Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                Data Tables
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="student_info_table.php">Students</a>
                <a class="dropdown-item" href="course_info_table.php">Courses</a>
                <a class="dropdown-item" href="enroll_info_table.php">Enrollment</a>
            </div>
        </li>
    </ul>
</nav>
<h1 class="p-4 text-center text-white bg-primary">Home Page</h1>

</body>
</html>
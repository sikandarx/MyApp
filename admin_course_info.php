<!DOCTYPE html>
<html>
<head>
    <title>Course</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
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
    </style>
</head>
<body>
<nav class="navbar nav-pills navbar-expand-sm bg-dark navbar-dark">

    <!-- Links -->
    <ul class="navbar-nav ml-5">
        <li class="nav-item">
            <a class="nav-link" href="admin_home.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="admin_student_info.php">Student</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="admin_course_info.php">Course</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="admin_enroll.php">Enroll</a>
        </li>

        <!-- Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                Data Tables
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="admin_student_info_table.php">Students</a>
                <a class="dropdown-item" href="admin_course_info_table.php">Courses</a>
                <a class="dropdown-item" href="admin_enroll_info_table.php">Enrollment</a>
            </div>
        </li>
        <form method="POST" action="admin_home.php">
            <input type="hidden" name="logout">
            <button type="submit" class="btn logout" >
                <img src="icons/logout_icon.png" alt="Power Sign" class="img">
                Log Out</button>
        </form>
    </ul>
</nav>
<h1 class="p-4 text-center text-white bg-primary">Enter Course Info</h1>

<?php
require 'session.php';
$session=new session();
$session->admin();
if(isset($_POST['logout']))
{
    session_destroy();
    header("Location: login.php");
}
require 'application.php';
if($_POST)
{

    if($_POST['course_title'] != "" && $_POST['credit_hours'] != ""&& $_POST['semester_number'] != "")
    {
        $connection = new application();
        $connection->insert_course($_POST['course_title'], $_POST['credit_hours'], $_POST['course_teacher'], $_POST['semester_number'], $_POST['curriculum'], $_POST['course_info']);
    }
    else{
        echo "<p class='p-2 text-white bg-danger text-center' >Incomplete credentials</p>";
    }
}
?>
<div class="container my-5">
    <form name ="bio" method="POST" action="admin_course_info.php">
        <div class="form-group">
            <label for="course_title">Course Title<span class="text-danger"> *</span></label>
            <input type="text" class="form-control" id="course_title"  name="course_title" placeholder="Enter the course title" required>
        </div>
        <div class="form-group">
            <label for="credit_hours">Credit Hours<span class="text-danger"> *</span></label>
            <select class="form-control" id="credit_hours" name="credit_hours">
                <option value="">(Select Credit Hours)</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>
        <div class="form-group">
            <label for="course_teacher">Course Teacher<span class="text-danger"> *</span></label>
            <input type="text" class="form-control" id="course_teacher"  name="course_teacher" placeholder="Enter the name of the course teacher" required>
        </div>
        <div class="form-group">
            <label for="semester_number">Semester Number<span class="text-danger"> *</span></label>
            <select class="form-control" id="semester_number" name="semester_number">
                <option value="">(Select Semester Number)</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>

            </select>
        </div>
        <div class="form-group">
            <label for="curriculum">Curriculum</label>
            <select class="form-control" id="curriculum" name="curriculum">
                <option value="core">Core</option>
                <option value="elective">Elective</option>
            </select>
        </div>
        <div class="form-group">
            <label for="course_info">Course Info</label>
            <textarea class="form-control" id="course_info" name="course_info" rows="4" placeholder="Enter additional course info"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" >Submit</button>
    </form>
</div>
</body>
</html>
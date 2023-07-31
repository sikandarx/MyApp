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
$db = new application();

$student_data = $db->get_data_student();
$course_data = $db->get_data_course();

if($_POST)
{

    if($_POST['student_id'] != "" && $_POST['course_id'] != "")
    {
        $student_id = $_POST['student_id'];
        $course_id = $_POST['course_id'];
        $grade="-";
        $db->enroll_student($student_id, $course_id,$grade);
    }
    else{
        echo "<p class='p-2 text-white bg-danger text-center' >Incomplete credentials</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enrollment</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            h1{
                font-size: 85px !important;
            }
            h2{
                font-size: 50px !important;
            }
            h4{
                font-size: 40px !important;
            }
            .form-group{
                margin-top: 50px !important;
            }
            form{
                font-size: 50px !important;
            }
            .sel{
                font-size: 40px !important;
            }
            .sel option{
                font-size: 12px !important
            }
            textarea{
                font-size: 40px !important;
            }
            .btn.btn-secondary {
                margin-top: 30px !important;
                font-size: 50px!important;
                border-radius: 20px !important;
                padding: 8px 25px !important;
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
            <li class="nav-item">
                <a class="nav-link" href="create_account.php">Create Account</a>
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
                <a class="nav-link active" href="admin_student_enroll.php">Student Enroll</a>
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
<form method="POST" action="admin_student_enroll.php">
    <input type="hidden" name="logout">
    <button type="submit" class="btn logout" >
        <img src="logout_icon.png" alt="Power Sign" class="img">
        Log Out</button>
</form>


<h1 class="p-4 text-center text-white bg-primary">Student Course Enrollment</h1>


<div class="container my-5 mtop">
    <form name ="bio" method="POST" action="admin_student_enroll.php">
        <div class="form-group">
            <label for="course_id">Course Title<span class="text-danger"> *</span></label>
            <select class="form-control sel" id="course_id" name="course_id">
                <option value="">(Select Course's Title)</option>
                <?php foreach($course_data as $row): ?>
                    <option value="<?= $row['course_id'] ?>"><?= $row['course_title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="student_id">Student Name<span class="text-danger"> *</span></label>
            <select class="form-control sel" data-display="auto" id="student_id" name="student_id">
                <option value="">(Select Student's Name)</option>
                <?php foreach($student_data as $row): ?>
                    <option value="<?= $row['student_id'] ?>">
                        <?= $row['name'] ?>
                        <p><?= $row['roll_number'] ?></p>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-secondary" >Enroll</button>
    </form>
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
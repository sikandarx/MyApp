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
$result = $db->get_data_course();

if(isset($_POST['delete'])) {

    $id = $_POST['delete'];

    $db->delete_course($id);  // Delete item

    header("Location: admin_course_info_table.php");  // Then redirect page
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Course Info</title>
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

        .dropdown-toggle{
            background-color: transparent!important;
            padding: 16px 0!important;
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
                font-size: 3rem;
            }
            .navbar-toggler{
                margin: 20px;
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
                <a class="nav-link" href="admin_student_info.php">Student</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_course_info.php">Course</a>
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
        </ul>
    </div>
</nav>
<form method="POST" action="admin_course_info_table.php.php">
    <input type="hidden" name="logout">
    <button type="submit" class="btn logout" >
        <img src="icons/logout_icon.png" alt="Power Sign" class="img">
        Log Out</button>
</form>


<h1 class="p-4 text-center text-white bg-primary">Course Info Table</h1>


<div class="container">
<form method="post">
    <table class="table table-striped table-bordered my-5">

        <tr>
            <th>ID</th>
            <th>Course Title</th>
            <th>Credit Hours</th>
            <th>Course Teacher</th>
            <th>Semester Number</th>
            <th>Curriculum</th>
            <th>Course Info</th>
            <th>Delete Button</th>
        </tr>

        <?php foreach($result as $row): ?>

            <tr>
                <td class="text-nowrap"><?= $row['course_id'] ?></td>
                <td class="text-nowrap"><?= $row['course_title'] ?></td>
                <td class="text-nowrap"><?= $row['credit_hours'] ?></td>
                <td class="text-nowrap"><?= $row['course_teacher'] ?></td>
                <td class="text-nowrap"><?= $row['semester_number'] ?></td>
                <td class="text-nowrap"><?= $row['curriculum'] ?></td>
                <td class="text-nowrap"><?= $row['course_info'] ?></td>
                <td class="text-nowrap"><button class="btn btn-danger ml-5" type="submit" name= "delete" value="<?= $row['course_id'] ?>">Delete</button></td>

            </tr>

        <?php endforeach; ?>

    </table>
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
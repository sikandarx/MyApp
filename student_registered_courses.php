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
require 'application.php';
$db = new application();
$result=$db->get_data_student_course($username);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
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
            background-color: #5840ba!important;
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
            background-color: #5840ba!important;
        }
        .navbar-nav{
            margin-left: 40px;
        }
        .table-wrapper {
            overflow-x: auto;
        }
        @media screen and (max-width:980px) {
            .mtop{
                margin-top: 150px !important;
            }

            .table-wrapper {
                width: 100%;
                -webkit-overflow-scrolling: touch;
            }

            table {
                font-size: 40px !important;
                width: 100%;
            }
            td{
                padding-top: 50px !important;
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
            .navbar-nav{
                margin: 0!important;
            }
            .nav-link{
                margin-left: 0!important;
                padding: 16px 20px!important;
                font-size: 40px!important;
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
                <a class="nav-link" href="student_home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="student_registered_courses.php">Registered Courses</a>
            </li>
        </ul>
    </div>
</nav>
<form method="POST" action="student_registered_courses.php">
    <input type="hidden" name="logout">
    <button type="submit" class="btn logout" >
        <img src="logout_icon.png" alt="Power Sign" class="img">
        Log Out</button>
</form>

<h1 class="p-4 text-center text-white bg-primary">Your Registered Courses</h1>
<div class="container table-wrapper mtop">
        <table class="table table-striped table-bordered mt-5">

            <tr>
                <th>No.</th>
                <th>Course Title</th>
                <th>Course Teacher</th>
                <th>Curriculum</th>
                <th>Credit Hours</th>
            </tr>


            <?php
            $num=1;
             foreach($result as $row):
             ?>

                <tr>
                    <td class="text-nowrap"><?= $num ?></td>
                    <td class="text-nowrap"><?= $row['course_title'] ?></td>
                    <td class="text-nowrap"><?= $row['course_teacher'] ?></td>
                    <td class="text-nowrap"><?= $row['curriculum'] ?></td>
                    <td class="text-nowrap"><?= $row['credit_hours'] ?></td>
                </tr>

            <?php $num++;
             endforeach; ?>

        </table>
</div>
</body>
</html>
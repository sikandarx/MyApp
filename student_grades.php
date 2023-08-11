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
$result=$db->get_data_student_grades($username);

$si=$db->get_student_id($username);
$student_id = $si->fetch_row()[0];
$notification=$db->get_student_course_notification($student_id);
$notification_all=$db->get_all_notification();
$notification_student=$db->get_student_notification();

$folderPath = 'profile_picture/';
$fileName = $username.'.jpg';
$file=$folderPath.$fileName;
if(file_exists($file))
{
    $name= $username;
}
else{
    $name="man";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Grades</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        p{
            font-size: 25px!important;
        }
        .nav-item{
            margin: auto 0!important;
        }
        .nav-link{
            padding: 8px 0!important;
            margin-right: 20px!important;
            margin-left: 20px!important;
        }
        .active{
            background-color: #5840ba!important;
            padding: 16px 20px!important;
            border-radius: 0!important;
            margin: 0!important;
        }
        .navbar{
            padding: 0;
        }
        .bg-primary{
            background-color: #5840ba!important;
        }
        .img{
            max-width: 20px;
        }
        .info>*{
            background-color: #d8d8d8;
            padding: 20px;
            margin: 10px 0;
        }
        .d-flex{
            gap: 50px;
        }
        .d-flex>*{
            max-width: 1000px;
        }
        .navbar-nav{
            margin-left: 40px;
        }
        .mini-container{
            border: #d9d9d9 1px solid;
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 70%;
            border-radius: 10px;
            overflow: hidden;
            margin: 20px auto;
        }
        .font-weight-medium{
            font-weight: 350;
        }
        .font-weight-heavy{
            font-weight: 600;
        }
        .container{
            border-radius: 15px;
            border: #d9d9d9 1px solid;
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }
        @media screen and (max-width:738px) {
            .navbar-collapse {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                width: 50%;
                background-color: #343a40;
                padding: 20px 0;
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
            .navbar-toggler{
                margin:15px;
            }
            .navbar-nav{
                margin:0;
            }
            .container{
                width:90%;
                overflow:auto;
            }
            .nav-item{
                font-size:25px;
            }
            .dropdown-menu{
                left:-100px !important;
            }
            .btn-group{
                margin-right: 15px !important;
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
                <a class="nav-link" href="student_registered_courses.php">Registered Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="student_grades.php">Grades</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="student_assignments.php">Assignments</a>
            </li>
        </ul>
    </div>

    <div class="btn-group mr-5" style="position: absolute; right: 0;">
        <button class="btn-lg"
                style="width: 50px;
                    height: 50px;
                    border-radius: 50%;
                    background-image: url(profile_picture/<?= $name?>.jpg);
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-position:center;"
                type="button"
                class="dropdown-toggle"
                data-bs-toggle="dropdown">
        </button>
        <div class="dropdown-menu" style="left: -75px;">
            <div class="dropdown-item">
                <button onclick="window.location.href='student_profile.php';" class="btn"><img src="profile_icon.png" alt="profile icon" class="img mr-1">Profile</button>
            </div>
            <div class="dropdown-item">
                <button onclick="window.location.href='student_settings.php';" class="btn settings"><img src="settings_icon.png" alt="settings icon" class="img mr-1">Settings</button>
            </div>
            <form method="POST" action="student_home.php" class="dropdown-item">
                <input type="hidden" name="logout">
                <button type="submit" class="btn" >
                    <img src="logout_icon1.png" alt="Power Sign" class="img">
                    Log Out</button>
            </form>
        </div>
    </div>
</nav>


<h1 class="p-4 text-center text-white bg-primary">Grades</h1>

<div class="container table-wrapper mt-5 mtop">
    <table class="table table-striped table-bordered mt-3">

        <tr>
            <th>No.</th>
            <th>Course Title</th>
            <th>Grade</th>
            <th>Points</th>
        </tr>
        <?php
        $num=1;$index=0;
        foreach($result as $row):
            ?>

            <tr>
                <td class="text-nowrap"><?= $num ?></td>
                <td class="text-nowrap"><?= $row['course_title'] ?></td>
            <td class="text-nowrap font-weight-heavy"><?= $row['grade'] ?></td>
            <?php
            $percentage=$db->grade_percentage($row['grade']);
            $array[$index]=$percentage;
            ?>
            <td class="text-nowrap"><?= $percentage ?></td>
            </tr>

            <?php $num++;$index++;
        endforeach;?>
        <tr>
            <th colspan="3"></th>
            <th class="mr-3" >GPA: <span><?= $db->gpa($array);?></span></th>
        </tr>
    </table>
</div>

<script>
        document.addEventListener('DOMContentLoaded', function() {
        var navbarToggler = document.querySelector('.navbar-toggler');
        var navbarCollapse = document.querySelector('.navbar-collapse');
        var body = document.querySelector('html');

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
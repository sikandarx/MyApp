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

require "application.php";
$db=new application();
$assignments=$db->get_teacher_assignments($username);

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
    <title>Assignments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
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
            margin: 50px 0;
        }
        .cont{

            width: 70%;
            border: #d9d9d9 1px solid;
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
        }
        .cont:hover{
            cursor: pointer;
            background-color: #5840ba;
            color: white;
        }
        .no_assignments{
            width: 70%;
            border: #d9d9d9 1px solid;
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
        }
        .font-weight-heavy{
            font-weight: 600;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            align-items: center;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            border-radius: 15px;
            background-color: #fff;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #888;
            width: 90%;
        }
        .modal-con{
            margin: 30px 10px;
            padding: 0 10px;
        }
        .close {
            color: #868686;
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 30px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .deadline{
            font-size: 16px!important;
            font-weight: 500;
            text-align: right!important;
        }
        .d-flex.detail{
            justify-content: space-between;
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
            .nav-item{
                font-size:25px;
            }
            .cont{
                width:90%;
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
                <a class="nav-link" href="student_grades.php">Grades</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="student_assignments.php">Assignments</a>
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


<h1 class="p-4 text-center text-white bg-primary">Assignments</h1>

<form id="myForm" action="student_assignments_description.php" method="post">
  <input type="hidden" id="divIdInput" name="divId" value="">
</form>

<div class="mini-container" id="container">
    <?php
    if ($assignments->num_rows > 0)
    {
    foreach($assignments as $row):
    ?>
    <div class="cont"  id="<?=$row['id']?>">

        <h4>    <?php
            $course_name=$db->get_title_course($row['course_id']);
            $course = $course_name->fetch_row()[0];
            echo $course;
            ?></h4>
        <div class="d-flex detail">
        <h5 class="font-weight-light"><?=$row['title']?></h5>
            <p class="deadline">Deadline: <span class="font-weight-light"><?=$row['deadline']?></span></p>
        </div>

    </div>


    <?php 
    endforeach;}
    else{
        echo "<h5 class='no_assignments text-center'>You have no Assignments.</h5>";
    }
    ?>
</div>
<script>

const container = document.getElementById("container");
const divIdInput = document.getElementById("divIdInput");
const myForm = document.getElementById("myForm");

container.addEventListener("click", function(event) {
  let clickedDiv = event.target;
  while (clickedDiv !== container && !clickedDiv.classList.contains("cont")) {
    clickedDiv = clickedDiv.parentElement;
  }
  if (clickedDiv.classList.contains("cont")) {
    const divId = clickedDiv.id;

    divIdInput.value = divId;
    myForm.submit();
  }
});
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

<?php
require 'session.php';
$session = new session();
$session->teacher();
$username=$_SESSION['username'];
if(isset($_POST['logout']))
{
    session_destroy();
    header("Location: login.php");
}


$folderPath = 'uploads/';
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
    <title>Courses</title>
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
            padding: 16px 0!important;
            margin-right: 20px!important;
            margin-left: 20px!important;
        }
        .navbar{
            padding: 0;
        }
        .active{
            background-color: #5840ba!important;
            border-radius: 0!important;
        }
        .bg-primary{
            background-color: #5840ba!important;
        }
        .img{
            max-width: 20px;
        }
        .img2{
            max-width: 250px;
            border: #5840ba 5px solid;
            border-radius: 50%;
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
            background-color: #eae5e5;
            padding: 20px;
            width: 45%;
            border-radius: 10px;
            overflow: hidden;
            margin: 20px auto;
        }
        .mini-container>*{
            text-align: center;
            color: white;
            background-color: #5840ba;
            padding: 15px;
            border-radius: 5px;
            margin:20px;
        }
        .font-weight-heavy{
            font-weight: bolder;
        }
        .camera-icon {
            position: absolute;
            left: 20px;
            bottom: 0;
        }
        .center {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .camera-icon img {
            width: 55px;
            height: 50px;
            border-radius: 50%;
            padding: 5px;
            background-color: #5840ba;
            cursor: pointer;
        }
        .img-container {
            position: relative;
            display: inline-block;
        }
        /* Hide the default file input */
        #fileInput {
            display: none;
        }
        .btn.btn-upload{
            position: absolute;
            right: 0!important;

        }
        @media screen and (max-width:980px) {
            .mtop{
                margin-top: 150px !important;
            }
            .img{
                max-width: 0px!important;
            }
            .info>*{
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
                <a class="nav-link" href="teacher_home.php">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="teacher_courses.php">Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="teacher_grades.php">Grading</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="teacher_assignments.php">Assignments</a>
            </li>
        </ul>
    </div>
    <div class="btn-group mr-5" style="position: absolute; right: 0;">
        <button class="btn-lg"
                style="width: 50px;
                    height: 50px;
                    border-radius: 50%;
                    background-image: url(uploads/<?= $name?>.jpg);
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-position:center;"
                type="button"
                class="dropdown-toggle"
                data-bs-toggle="dropdown">
        </button>
        <div class="dropdown-menu p-3" style="left: -100px;">
            <div class="dropdown-item">
                <button onclick="window.location.href='teacher_profile.php';" class="btn"><img src="profile_icon.png" alt="profile icon" class="img mr-1">Profile</button>
            </div>
            <div class="dropdown-item">
                <button onclick="window.location.href='teacher_settings.php';" class="btn settings"><img src="settings_icon.png" alt="settings icon" class="img mr-1">Settings</button>
            </div>
            <form method="POST" action="teacher_profile.php" class="dropdown-item">
                <input type="hidden" name="logout">
                <button type="submit" class="btn" >
                    <img src="logout_icon1.png" alt="Power Sign" class="img">
                    Log Out</button>
            </form>
        </div>
    </div>
</nav>

<h1 class="p-4 text-center text-white bg-primary">Courses</h1>

<div class="container">
    <table class="table table-striped table-bordered my-5" id="myTable">

        <tr>
            <th>Course Title</th>
            <th>Credit Hours</th>
            <th>Curriculum</th>
            <th>Semester Number</th>
        </tr>

        <?php
        require 'application.php';
        $db= new application();
        $teacherId = $db->get_teacher_id($username);
        $result=$db->get_teacher_enroll_data($teacherId);
        foreach($result as $row):?>

            <tr>
                <td class="text-nowrap"><?= $row['Course Title'] ?></td>
                <td class="text-nowrap"><?= $row['Credit Hours'] ?></td>
                <td class="text-nowrap"><?= $row['Curriculum'] ?></td>
                <td class="text-nowrap"><?= $row['Semester Number'] ?></td>

            </tr>

        <?php endforeach; ?>

    </table>
</div>

<script>
</script>
</body>
</html>

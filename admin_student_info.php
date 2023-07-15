
<!DOCTYPE html>
<html>
<head>
    <title>Student</title>
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
            <a class="nav-link " href="admin_home.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="admin_student_info.php">Student</a>
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
        <form method="POST" action="admin_home.php">
            <input type="hidden" name="logout">
            <button type="submit" class="btn logout" >
                <img src="icons/logout_icon.png" alt="Power Sign" class="img">
                Log Out</button>
        </form>
    </ul>
</nav>
<h1 class="p-4 text-center text-white bg-primary">Enter Student Info</h1>

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

    if($_POST['email'] != "" && $_POST['number'] != "" && $_POST['batch'] != ""&& $_POST['email'] != ""&& $_POST['gender'] != "")
    {
        $connection = new application();
        $connection->insert_student($_POST['name'], $_POST['number'], $_POST['batch'],$_POST['email'], $_POST['gender']);
    }
    else{
        echo "<p class='p-2 text-white bg-danger text-center' >Incomplete credentials</p>";
    }

}
?>


<div class="container my-5">
    <form name ="bio" method="POST" action="admin_student_info.php">
        <div class="form-group">
            <label for="name">Name<span class="text-danger"> *</span></label>
            <input type="text" class="form-control" id="name"  name="name" placeholder="Enter your name" required>
        </div>
        <div class="form-group">
            <label for="roll_number">Roll number<span class="text-danger"> *</span></label>
            <input type="text" class="form-control" id="roll_number" name="number" placeholder="Enter your Roll number" required>
        </div>
        <div class="form-group">
            <label for="batch">Batch<span class="text-danger"> *</span></label>
            <select class="form-control" id="batch" name="batch">
                <option value="">(Select your Batch)</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email address<span class="text-danger"> *</span></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="gender">Gender<span class="text-danger"> *</span></label>
            <select class="form-control" id="gender" name="gender">
                <option value="">(Select your Gender)</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" >Submit</button>
    </form>

</div>
</body>
</html>
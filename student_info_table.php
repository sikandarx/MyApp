<!DOCTYPE html>
<html>
<head>
    <title>Student Info</title>
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
    </style>
</head>
<body>
<nav class="navbar nav-pills navbar-expand-sm bg-dark navbar-dark">

    <!-- Links -->
    <ul class="navbar-nav ml-5">
        <li class="nav-item">
            <a class="nav-link " href="home.php">Home</a>
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
        <form method="POST" action="home.php">
            <input type="hidden" name="test">
            <button type="submit" class="btn logout" >Log Out</button>
        </form>
    </ul>
</nav>

<h1 class="p-4 text-center text-white bg-primary">Student Info Table</h1>

<?php
require 'session.php';
$session=new session();

require 'application.php';
$db = new application();
$result = $db->get_data_student();


if(isset($_POST['delete']))
{

    $id = $_POST['delete'];

    $db->delete_student($id);  // Delete item

    header("Location: student_info_table.php");  // Then redirect page
}
?>
<div class="container">
<form method="post">
  <table class="table table-striped table-bordered mt-5">

    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Roll Number</th>
        <th>Batch Number</th>
        <th>Email</th>
        <th>Gender</th>
        <th>About Yourself</th>
        <th>Delete Button</th>
    </tr>

    <?php foreach($result as $row): ?>

       <tr>
           <td class="text-nowrap"><?= $row['student_id'] ?></td>
           <td class="text-nowrap"><?= $row['name'] ?></td>
           <td class="text-nowrap"><?= $row['roll_number'] ?></td>
           <td class="text-nowrap"><?= $row['batch'] ?></td>
           <td class="text-nowrap"><?= $row['email'] ?></td>
           <td class="text-nowrap"><?= $row['gender'] ?></td>
           <td class="text-nowrap"><?= $row['about_yourself'] ?></td>
           <td class="text-nowrap"><button class="btn btn-danger ml-5" type="submit" name= "delete" value="<?= $row['student_id'] ?>">Delete</button></td>
       </tr>

    <?php endforeach; ?>

  </table>
</form>
</div>
</body>
</html>
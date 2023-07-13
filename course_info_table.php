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
            padding-right:20px!important;
            padding-left:20px!important;
        }

        .dropdown-toggle{
            padding: 16px 20px!important;
            border-radius: 0!important;
        }
        .navbar{
            padding: 0;
        }
    </style>
</head>
<body>
<nav class="navbar nav-pills navbar-expand-sm bg-dark navbar-dark">

    <!-- Links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="home.php">Home</a>
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

<h1 class="p-4 text-center text-white bg-success">Course Info Table</h1>

<?php
require 'application.php';

$db = new application();
$result = $db->get_data_course();


if(isset($_POST['delete'])) {

    $id = $_POST['delete'];

    $db->delete_course($id);  // Delete item

    header("Location: course_info_table.php");  // Then redirect page
}
?>
<div class="container">
<form method="post">
    <table class="table table-striped table-bordered mt-5">

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
</body>
</html>
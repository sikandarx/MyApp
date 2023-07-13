

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
            padding-right:20px!important;
            padding-left:20px!important;
        }

        .active{
            padding: 16px 20px!important;
            border-radius: 0!important;
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
            <a class="nav-link active bg-secondary" href="enroll.php">Enroll</a>
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

<?php
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
        $db->enroll_student($student_id, $course_id);
    }
    else{
        echo "<p class='p-2 text-white bg-danger text-center' >Incomplete credentials</p>";
    }
}
?>
<h1 class="p-4 text-center text-white bg-secondary">Course Enrollment</h1>
<div class="container my-5">
    <form name ="bio" method="POST" action="enroll.php">
        <div class="form-group">
            <label for="course_id">Course Title<span class="text-danger"> *</span></label>
            <select class="form-control" id="course_id" name="course_id">
                <option value="">(Select Course's Title)</option>
                <?php foreach($course_data as $row): ?>
                    <option value="<?= $row['course_id'] ?>"><?= $row['course_title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="student_id">Student Name<span class="text-danger"> *</span></label>
            <select class="form-control" data-display="auto" id="student_id" name="student_id">
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

</script>



</body>
</html>
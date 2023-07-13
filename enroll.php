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

<!DOCTYPE html>
<html>
<head>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


</head>
<body>
<h1 class="p-4 text-center text-white bg-secondary">Course Enrollment</h1>
<div class="container mt-5">
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
    <a href="enroll_info_table.php" target="_blank">
        <button class="btn btn-dark mt-3">Enrollment Data Table</button>
    </a><br>
    <a href="student_info_table.php" target="_blank">
        <button class="btn btn-primary mt-3">Student Data Table</button>
    </a><br>
    <a href="course_info_table.php" target="_blank">
        <button class="btn btn-success mt-3">Course Data Table</button>
    </a>
</div>
<script>

</script>



</body>
</html>
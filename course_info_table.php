<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
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

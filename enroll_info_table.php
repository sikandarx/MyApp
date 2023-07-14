<!DOCTYPE html>
<html>
<head>
    <title>Enrollment Info</title>
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
        <form method="POST" action="home.php">
            <input type="hidden" name="test">
            <button type="submit" class="btn logout" >Log Out</button>
        </form>
    </ul>
</nav>

<h1 class="p-4 text-center text-white bg-primary">Course Info Table</h1>

<?php
require 'session.php';
$session=new session();

require 'application.php';

$db = new application();
$course_id= $db->get_data_course();

if(isset($_POST['course_title']))
{
if($_POST['course_title'] != "" && $_POST['course_title'] != "")
{
    $cid = $_POST['course_title'];
    $enroll_data = $db->get_enroll_data($cid);
}
else{
    echo "<p class='p-2 text-white bg-danger text-center' >Select The Course Title</p>";
}
}

if(isset($_POST['delete'])) {

    $id = $_POST['delete'];
    $db->delete_enroll($id);  // Delete item

}
?>
     <div class="container mt-5">
    <form name ="course_name" method="POST" action="enroll_info_table.php">
    <div class="form-group">
    <label for="course_title">Course Title</label>
    <select class="form-control" id="course_title" name="course_title">
        <option value="">Select Course Title</option>
        <?php foreach($course_id as $row): ?>
            <option value="<?= $row['course_id'] ?>"><?= $row['course_title'] ?></option>
        <?php endforeach; ?>
    </select>
    </div>
        <button type="submit" class="btn btn-primary" >Get Data</button>
    </form>
    </div>

<?php if(isset($_POST['course_title']))
{
    if($_POST['course_title'] != "" && $_POST['course_title'] != "")
    {
    $course_name=$db->get_title_course($_POST['course_title']);
    $course = $course_name->fetch_row()[0];
    ?>
<div class="container">

    <form method="post" id="myForm" action="enroll_info_table.php">
    <table class="table table-striped table-bordered mt-5" id="myTable">

        <tr>
            <th>Student Name</th>
            <th>Roll Number</th>
            <th>Email</th>
            <th>Delete Button</th>
        </tr>

        <h2 class="mt-5"><?=$course?>:</h2>
        <?php
        foreach($enroll_data as $row): ?>

            <tr>
                <td class="text-nowrap"><?= $row['Student Name'] ?></td>
                <td class="text-nowrap"><?= $row['Student Roll Number'] ?></td>
                <td class="text-nowrap"><?= $row['Student Email'] ?></td>

                <td class="text-nowrap"><button class="btn btn-danger ml-5 delete-button" type="submit" id= "delete" name="delete" value="<?= $row['ID'] ?>">Unenroll</button></td>

            </tr>

        <?php endforeach; ?>

    </table>
</form>
</div>
<?php } } ?>

<script>
/*    const form = document.getElementById("myForm");
    const table = document.getElementById("myTable");
    const btn = document.getElementById("delete");

    btn.addEventListener("click", submitForm);

    function submitForm(e) {
        e.preventDefault();

        // Submit the form via Ajax
        fetch(form.action, {
            method: form.method,
            body: new FormData(form)
        })
            .then(()=> {
                // Refresh the table
                refreshTable();
            });
    }

    function refreshTable() {
        let tableHTML = table.innerHTML;
        table.innerHTML = tableHTML;
    }*/
</script>

</body>
</html>
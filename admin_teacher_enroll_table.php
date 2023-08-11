<?php
require 'session.php';
$session=new session();
$session->admin();
if(isset($_POST['logout']))
{
    session_destroy();
    header("Location: login.php");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Enrollment Info</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .nav-item{
            margin: auto 0!important;
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
        .img{
            max-width: 20px;
        }
        .navbar-nav{
            margin-left: 40px;
        }
        .table-wrapper {
            overflow-x: auto;
        }
        @media screen and (max-width:738px) {
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
                <a class="nav-link" href="admin_home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_announcement.php">Announcements</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_create_account.php">Create Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_student.php">Student</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_teacher.php">Teacher</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_course.php">Course</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_student_enroll.php">Student Enroll</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_teacher_enroll.php">Teacher Enroll</a>
            </li>

            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Data Tables
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="admin_student_table.php">Students</a>
                    <a class="dropdown-item" href="admin_teacher_table.php">Teachers</a>
                    <a class="dropdown-item" href="admin_course_table.php">Courses</a>
                    <a class="dropdown-item" href="admin_student_enroll_table.php">Student Enrollment</a>
                    <a class="dropdown-item" href="admin_teacher_enroll_table.php">Teacher Enrollment</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<form method="POST" action="admin_teacher_enroll_table.php">
    <input type="hidden" name="logout">
    <button type="submit" class="btn logout" >
        <img src="logout_icon.png" alt="Power Sign" class="img">
        Log Out</button>
</form>

<h1 class="p-4 text-center text-white bg-primary">Teacher Enroll Table</h1>


<div class="container mt-5 mtop">
    <form name ="name" method="POST" action="admin_teacher_enroll_table.php">
        <div class="form-group">
            <label for="name">Teacher Name</label>
            <select class="form-control sel" id="name" name="name">
                <option value="">Select Teacher's Name</option>
                <?php
                require 'application.php';

                $db = new application();
                $teacher_id= $db->get_data_teacher();

                if(isset($_POST['delete'])) {

                    $id = $_POST['delete'];
                    $db->delete_teacher_enroll($id);  // Delete item

                }

                foreach($teacher_id as $row): ?>
                    <option value="<?= $row['teacher_id'] ?>"><?= $row['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" >Get Data</button>
    </form>
</div>

<?php
if(isset($_POST['name']))
{
    if($_POST['name'] != "")
    {
        $tid = $_POST['name'];
        $enroll_data = $db->get_teacher_enroll_data($tid);

        $t_name=$db->get_teacher_name($_POST['name']);
        $name = $t_name->fetch_row()[0];
        ?>
        <div class="container table-wrapper">

            <form method="post" id="myForm" action="admin_teacher_enroll_table.php">
                <table class="table table-striped table-bordered my-5" id="myTable">

                    <tr>
                        <th>Course Title</th>
                        <th>Credit Hours</th>
                        <th>Curriculum</th>
                        <th>Semester Number</th>
                        <th>Delete Button</th>
                    </tr>

                    <h2 class="mt-5"><?=$name?>:</h2>
                    <?php
                    foreach($enroll_data as $row):?>

                        <tr>
                            <td class="text-nowrap"><?= $row['Course Title'] ?></td>
                            <td class="text-nowrap"><?= $row['Credit Hours'] ?></td>
                            <td class="text-nowrap"><?= $row['Curriculum'] ?></td>
                            <td class="text-nowrap"><?= $row['Semester Number'] ?></td>


                            <td class="text-nowrap"><button class="btn btn-danger ml-5 delete-button" type="submit" id= "delete" name="delete" value="<?= $row['ID'] ?>">Unenroll</button></td>

                        </tr>

                    <?php endforeach; ?>

                </table>
            </form>
        </div>
    <?php }
    else{
        echo "<p class='p-2 text-white bg-danger text-center' >Select Teacher's Name</p>";
    }
} ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var navbarToggler = document.querySelector('.navbar-toggler');
        var navbarCollapse = document.querySelector('.navbar-collapse');
        var body = document.querySelector('body');

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
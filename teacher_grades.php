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

require 'application.php';
$db = new application();
$tid = $db->get_teacher_id($username);
$course_id= $db->get_teacher_enroll_data($tid);

$notification_all=$db->get_all_notification();
$notification_teacher=$db->get_teacher_notification();






if(isset($_POST['course_title'])) {
    if ($_POST['course_title'] != "" && $_POST['course_title'] != "") {
        $cid = $_POST['course_title'];
        $enroll_data = $db->get_student_enroll_data($cid);
    } else {
        echo "<p class='p-2 text-white bg-danger text-center' >Select The Course Title</p>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Grades</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        .nav-link.active{
            margin: 0 !important;
        }
        .active{
            background-color: #5840ba!important;
            padding: 16px 20px!important;
            border-radius: 0!important;
        }
        .navbar{
            padding: 0;
        }
        .mini-container{
            border-radius: 15px;
            border: #d9d9d9 1px solid;
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
            padding: 15px;
            margin-bottom:15px;
        }
        .table-wrapper{
            overflow-y:auto;
        }
        .bg-primary{
            background-color: #5840ba!important;
        }
        .img{
            max-width: 20px;
        }
        .navbar-nav{
            margin-left: 40px;
        }
        .font-weight-heavy{
            font-weight: bolder;
        }
        .center {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        @media screen and (max-width:738px) {
            .navbar-collapse {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                width: 50%;
                background-color: #343a40; /* Adjust the background color as needed */
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
                <a class="nav-link" href="teacher_home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="teacher_courses.php">Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="teacher_grades.php">Grading</a>
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

<h1 class="p-4 text-center text-white bg-primary">Grades</h1>

<div class="container mt-5">
    <form name ="course_name" method="POST" action="teacher_grades.php">
        <div class="form-group">
            <label for="course_title">Course Title</label>
            <select class="form-control sel" id="course_title" name="course_title">
                <option value="">Select Course Title</option>
                <?php foreach($course_id as $row): ?>
                    <option value="<?= $row['Course ID'] ?>"><?= $row['Course Title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" >Grades</button>
    </form>

<?php
if(isset($_POST['course_title']))
{
if($_POST['course_title'] != "" && $_POST['course_title'] != "")
{
$course_name=$db->get_title_course($_POST['course_title']);
$course = $course_name->fetch_row()[0];
?>
<h2 class="mt-4"><?=$course?>:</h2>
<form method="post" class="my-5" id="save_table">
<div class="mini-container table-wrapper">
        <table class="table table-striped table-bordered" id="myTable">

            <tr>
                <th>Student Name</th>
                <th>Roll Number</th>
                <th>Email</th>
                <th>Grade</th>
            </tr>

            <?php
            foreach($enroll_data as $row):?>

                <tr>
                    <td class="text-nowrap"><?= $row['Student Name'] ?></td>
                    <td class="text-nowrap"><?= $row['Student Roll Number'] ?></td>
                    <td class="text-nowrap"><?= $row['Student Email'] ?></td>
                    <td class="text-nowrap">
                        <input type="text" class="inputField" name="grade"  value="<?=$row['Grade']?>">
                        <input type="hidden" class="grade_id" value="<?=$row['Id']?>">
                    </td>
                </tr>

            <?php
            endforeach;
            ?>

        </table>
        </div>
    <input type="hidden" name="array1" id="array1Input">
    <input type="hidden" name="array2" id="array2Input">
    <button type="submit" name="save_button" id="save_button" class="btn btn-success">Save</button>
</form>
</div>
<?php } }
if (isset($_POST["array1"]) && isset($_POST["array2"])){
    $jsonArray1 = $_POST["array1"];
    $array1 = json_decode($jsonArray1, true);

    $jsonArray2 = $_POST["array2"];
    $array2 = json_decode($jsonArray2, true);

    foreach ($array1 as $index => $gradeValue) {
        $idValue = $array2[$index];

        $test=$db->teacher_grade($gradeValue,$idValue);

    }
    if (!$test)
    {
        echo "<p class='p-2 m-5 text-white bg-danger text-center' >There was some issue while saving the Grades</p>";
    }
    else{
        echo "<p class='p-2 m-5 text-white bg-success text-center' >Saved Successfully</p>";
    }
}
?>

<script>

    const form = document.getElementById('save_table');
    const submitButton = document.getElementById('save');
    const inputFields = document.querySelectorAll('.inputField');
    const gradeIds = document.querySelectorAll('.grade_id');

    var valuesArray = [];
    var idsArray = [];

    function updateArray() {

        valuesArray.length = 0;
        inputFields.forEach(inputField => {
            valuesArray.push(inputField.value);
        });

        idsArray.length = 0;
        gradeIds.forEach(grade_id => {
            idsArray.push(grade_id.value);
        });

    }

    form.addEventListener('change', updateArray);

    form.addEventListener('submit', function(event) {

        if (valuesArray.length === 0)
        {
            alert("Cannot Save!!!\nNo Changes were made in the Grades.");
            event.preventDefault();
        }
        else
        {
            saveArrays();
        }
    });

    function saveArrays() {
        // Convert the JavaScript arrays to JSON strings
        var json1 = JSON.stringify(valuesArray);
        var json2 = JSON.stringify(idsArray);

        // Set the values of the hidden inputs to the JSON strings
        document.getElementById("array1Input").value = json1;
        document.getElementById("array2Input").value = json2;
    }

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
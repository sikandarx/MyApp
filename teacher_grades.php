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
            border: #d9d9d9 1px solid;
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
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
        .inputField{
            width: 35px!important;
        }
        .custom-dropdown-btn {
            border: none;
            background: none;
            padding: 0;
            margin: 10px 110px;
        }

        .custom-dropdown-btn:focus {
            outline: none;
            box-shadow: none;
        }

        .custom-dropdown-icon {
            display: block;
            width: 32px; /* Set the width and height of your custom icon */
            height: 32px; /* Adjust as needed */
            /* Add any custom icon styles here */
            transition: transform 0.3s ease-in-out; /* Transition for the rotation animation */
        }

        .rotate-right {
            transform: rotate(20deg);
        }

        .rotate-left {
            transform: rotate(-20deg);
        }
        .dropdown-menu.dropdown-menu-right{
            margin-right: 20px!important;
            border-radius: 20px;
            width: 650px;
            max-height: 700px!important;
            padding: 20px;
            overflow-y: auto;
        }
        .notification_all{
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
            color: white;
            background-color: #ff6969;
            max-width: 600px;
            padding: 10px;
            margin: 15px 25px!important;
            border-radius: 10px;
        }
        .notification_all:hover{
            color: white!important;
            background-color: #5840ba!important;
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
    <div class="dropdown">
        <button class="custom-dropdown-btn" type="button" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="custom-dropdown-icon" src="notification_icon.png" alt="Notification Icon">
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown">
            <h5 class="mb-4 font-weight-heavy">Notifications:</h5>
            <?php
            if($notification_teacher->num_rows > 0 || $notification_all->num_rows > 0)
            {
                if ($notification_all->num_rows > 0)
                {
                    foreach ($notification_all as $row):
                        if($row['type']=="all"){
                            ?>
                            <div class="notification_all"><?= $row['message']?>
                                <div><?= $row['created_at']?></div></div>
                        <?php } endforeach;
                }
                if ($notification_teacher->num_rows > 0)
                {
                    foreach ($notification_teacher as $row):
                        if($row['type']=="teacher"){
                            ?>
                            <div class="notification_all"><?= $row['message']?>
                                <div><?= $row['created_at']?></div></div>
                        <?php } endforeach;
                }
            }
            else
            {
                echo "<h6 class='text-center m-5'>No notifications to show.</h6>";
            } ?>
        </div>
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
<form method="post" class="my-5" id="save_table">
        <table class="table table-striped table-bordered my-5" id="myTable">

            <tr>
                <th>Student Name</th>
                <th>Roll Number</th>
                <th>Email</th>
                <th>Grade</th>
            </tr>

            <h2 class="mt-5"><?=$course?>:</h2>
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
    $(document).ready(function () {
        var icon = $('.custom-dropdown-icon');

        $('#notificationDropdown').on('click', function () {
            if (!icon.hasClass('rotate-right') && !icon.hasClass('rotate-left')) {
                icon.addClass('rotate-right');

                setTimeout(function () {
                    icon.removeClass('rotate-right');
                    icon.addClass('rotate-left');

                    setTimeout(function () {
                        icon.removeClass('rotate-left');
                    }, 300); // Delay for the left rotation animation (0.3s)
                }, 300); // Delay before starting the left rotation animation (0.3s)
            }
        });
    });

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
</script>

</body>
</html>

<?php
require 'session.php';
$session = new session();
$session->student();
$username=$_SESSION['username'];
if(isset($_POST['logout']))
{
    session_destroy();
    header("Location: login.php");
}

require 'application.php';
$db= new application();
$result=$db->get_username_info($username);

$si=$db->get_student_id($username);
$student_id = $si->fetch_row()[0];
$notification=$db->get_student_course_notification($student_id);
$notification_all=$db->get_all_notification();
$notification_student=$db->get_student_notification();

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
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
        .navbar{
            padding: 0;
        }
        .bg-primary{
            background-color: #5840ba!important;
        }
        .img{
            max-width: 20px;
        }
        .img2 {
            width: 250px;
            height: 250px;
            border: #5840ba 5px solid;
            border-radius: 50%;
            object-fit: cover;
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
        .notification{
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
            background-color: white;
            max-width: 600px;
            padding: 10px;
            margin: 15px 25px!important;
            border-radius: 10px;
        }
        .notification:hover{
            color: white!important;
            background-color: #5840ba!important;
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
                <a class="nav-link" href="student_home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="student_registered_courses.php">Registered Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="student_grades.php">Grades</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="student_assignments.php">Assignments</a>
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
        <div class="dropdown-menu p-3" style="left: -100px;">
            <div class="dropdown-item">
                <button onclick="window.location.href='student_profile.php';" class="btn"><img src="profile_icon.png" alt="profile icon" class="img mr-1">Profile</button>
            </div>
            <div class="dropdown-item">
                <button onclick="window.location.href='student_settings.php';" class="btn settings"><img src="settings_icon.png" alt="settings icon" class="img mr-1">Settings</button>
            </div>
            <form method="POST" action="student_home.php" class="dropdown-item">
                <input type="hidden" name="logout">
                <button type="submit" class="btn" >
                    <img src="logout_icon1.png" alt="Power Sign" class="img">
                    Log Out</button>
            </form>
        </div>
    </div>
</nav>

<h1 class="p-4 text-center text-white bg-primary">Profile</h1>

<div class="center">
    <div class="img-container">
    <img src="profile_picture/<?=$username?>.jpg" alt="" class="img2">
        <div class="camera-icon">
            <form action="student_profile.php" method="post" enctype="multipart/form-data">
                <div><input type="file" id="fileInput" name="image" accept="image/*"></div>
                <br>
                <input class="btn btn-upload mt-3" style="display: none;" type="submit" value="" name="submit" id="submitButton">
                <label for="fileInput">
                    <img src="camera_icon.png" alt="Change Profile Photo">
                </label>
            </form>
        </div>
</div>
</div>


<?php
if (isset($_POST["submit"])) {

$targetDir = "profile_picture/";
$originalFileName = $_FILES["image"]["name"];
$imageFileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));

$newFileName = $username . "." . $imageFileType;
$targetFile = $targetDir . $newFileName;

$check = getimagesize($_FILES["image"]["tmp_name"]);
if ($check === false) {
echo "File is not an image.";
$uploadOk = 0;
} else {
$uploadOk = 1;
}

if ($_FILES["image"]["size"] > 500000) {
    echo "<p class='p-1 text-white bg-danger text-center' style='width: 50%; margin: 20px auto;'>Sorry, your file is too large!!</p>";
$uploadOk = 0;
}

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "<p class='p-1 text-white bg-danger text-center' style='width: 50%; margin: 20px auto;'>Sorry, only JPG, JPEG & PNG files are allowed!!</p>";
$uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "<p class='p-1 text-white bg-danger text-center' style='width: 50%; margin: 20px auto;'>Sorry, there was an error changing your Profile Picture!!</p>";
} else {
// Check if the file already exists, and if so, delete it
if (file_exists($targetFile)) {
unlink($targetFile); // Delete the existing file
}

// Move the uploaded file to the target directory
if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
    echo "<p class='p1 text-white bg-success text-center' style='width: 50%; margin: 20px auto;'>Your Profile Picture will be changed after some time.</p>";
} else {
    echo "<p class='p-1 text-white bg-danger text-center' style='width: 50%; margin: 20px auto;'>Sorry, there was an error changing your Profile Picture!!</p>";
}
}
}


$data= $result->fetch_row()?>
<h2 class="text-center font-weight-heavy mt-2"><?=$data[1]?></h2>
<h2 class="text-center font-weight-light mt-1"><?=$data[2]?></h2>
<div class="mini-container">
<h5>Batch: <?=$data[3]?></h5>
<h5>Email: <?=$data[4]?></h5>
<h5>Gender: <?=$data[5]?></h5>
</div>
<script>
    // Get references to the file input and submit button
    const fileInput = document.getElementById("fileInput");
    const submitButton = document.getElementById("submitButton");

    // Listen for the change event on the file input
    fileInput.addEventListener("change", () => {
        // Trigger the click event on the submit button
        submitButton.click();
    });
</script>
</body>
</html>

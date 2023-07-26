
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile</title>
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
        .img2{
            max-width: 200px;
            border: #5840ba 2px solid;
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
            background-color: #eae5e5;
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
        </ul>
    </div>
    <div class="btn-group mr-5" style="position: absolute; right: 0;">
        <button class="btn-lg"
                style="width: 50px;
                    height: 50px;
                    border-radius: 50%;
                    background-image: url(uploads/<?= $username?>.jpg);
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
    <img src="uploads/<?=$username?>.jpg" alt="" class="img2">
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

$targetDir = "uploads/";
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
echo "Sorry, your file is too large.";
$uploadOk = 0;
}

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
echo "Sorry, only JPG, JPEG & PNG files are allowed.";
$uploadOk = 0;
}

if ($uploadOk == 0) {
echo "Sorry, your file was not uploaded.";
} else {
// Check if the file already exists, and if so, delete it
if (file_exists($targetFile)) {
unlink($targetFile); // Delete the existing file
}

// Move the uploaded file to the target directory
if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
    echo "<p class='p1 my-5 text-white bg-success text-center' style='width: 50%;'>Your Profile Picture has been changed successfully.</p>";
} else {
    echo "<p class='p-1 my-5 text-white bg-danger text-center' >Sorry, there was an error changing your Profile Picture!!</p>";
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

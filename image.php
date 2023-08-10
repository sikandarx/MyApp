<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>

        body {
            background-color: #5940ba;
            font-family: "Open Sans", sans-serif;
            display: block;
            margin: 8px;
        }
        h1{
            display: block;
            font-size: 8vmax;
            margin-block-start: 0.4em;
            margin-block-end: 0.4em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
        }
        h5{
            display: block;
            font-size: 4.5vmax;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
        }
        p{
            display: block;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
        }
        hr{
            margin-top: 30px;
        }
        .login-box {
            margin: 30px auto;
            background: white;
            width: 80%;
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            flex: 1 1 100%;
            align-items: stretch;
            justify-content: space-between;
            box-shadow: 0 0 20px 6px #090b6f85;
        }
        .left{
            color: #FFFFFF;
            background-size: cover;
            background-repeat: no-repeat;
            background-image: url("bg.jpg");
            overflow: hidden;
        }
        .leftoverlay{
            padding: 30px;
            width: 100%;
            height: 100%;
            background: #5961f9ad;
            overflow: hidden;
            box-sizing: border-box;
        }
        .right{
            width: 50%;
            padding: 40px;
            overflow: hidden;
        }
        .imagebox{
            padding: 30px;
            border-radius: 15px;
            background: rgba(89, 97, 249, 0.8);
            color: white;
        }
        .center {
            display: flex;
            justify-content: center;
        }

        .btn.btn-primary{
            font-weight: bold!important;
        }
        @media screen and (max-width:738px) {
            h1{
                margin:10px 0;
            }
            h5{
                text-align:center;
                font-size:35px;
                margin: 10px;
            }
            p{
                margin: 10px;
            }
            .login-box{
                flex-wrap:wrap;
                width:90%;
                justify-content:space-around;
                margin:20px auto;
            }
            .right{
                width:100%;
                padding:20px;
            }
            .leftoverlay{
                padding:20px;
            }
            .btn-primary{
                margin-top:20px;
            }
        }


    </style>
</head>
<body>
<div class="login-box">

    <div class="left">
        <div class="leftoverlay">
            <h1>Student Portal</h1>
            <p>Connecting Education, Empowering Growth: Welcome to Your Student Portal.</p>
        </div>
    </div>

    <div class="right">

        <h5>Sign up</h5><br>

        <h2 class="mb-5">Upload your profile photo</h2>
        <form action="image.php" method="post" enctype="multipart/form-data">
            <div class="imagebox"><input type="file" id="image" name="image" accept="image/*"></div>
            <br>
            <input class="btn btn-primary mt-3" type="submit" value="Upload Image" name="submit">
        </form>
        <form method="get">
            <input type="hidden" name="done" value="done">
        <button type="submit" class="btn btn-secondary mt-3">Skip</button>
        </form>
        <?php
        session_start();
        if(isset($_GET['done'])){
            echo "<p class='p-2 m-5 text-white bg-success text-center' >Account created, Now <a href='login.php'>Go to Login Page</a>.</p>";
        }
        if (isset($_POST["submit"])) {

            $targetDir = "profile_picture/";
            $originalFileName = $_FILES["image"]["name"];
            $imageFileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));

            $newusername = $_SESSION['newusername'];
            $newFileName = $newusername . "." . $imageFileType;
            $targetFile = $targetDir . $newFileName;

            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check === false) {
                echo "File is not an image.";
                $uploadOk = 0;
            } else {
                $uploadOk = 1;
            }

            if (file_exists($targetFile)) {
                echo "Sorry, the file already exists.";
                $uploadOk = 0;
            }

            if ($_FILES["image"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
                echo "Sorry, only JPG, JPEG & PNG  files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    echo "The file has been uploaded as successfully.";
                    echo "<p class='p-2 m-5 text-white bg-success text-center' >Account created, Now <a href='login.php'>Go to Login Page</a>.</p>";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
        ?>
    </div>
</div>

<script>
</script>
</body>
</html>
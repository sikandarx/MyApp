<!DOCTYPE html>
<html>
<head>
    <title>Image Upload</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Upload an Image</h2>
    <form action="image.php" method="post" enctype="multipart/form-data">
        <input type="file" id="image" name="image" accept="image/*">
        <br>
        <input class="btn btn-primary mt-3" type="submit" value="Upload Image" name="submit">
    </form>

</div>
<script>
</script>

</body>
</html>


<?php
if (isset($_POST["submit"])) {
    $targetDir = "/uploads";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the image file is an actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, the file already exists.";
        $uploadOk = 0;
    }

    // Check file size (optional)
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only specific image formats (optional)
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    }
    else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

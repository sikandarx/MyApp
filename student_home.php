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
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        p{
            font-size: 25px!important;
        }
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
        .active{
            padding: 16px 20px!important;
            border-radius: 0!important;
        }
        .navbar{
            padding: 0;
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
        .d-flex{
            gap: 50px;
            justify-content: space-around;
        }
        .d-flex>*{
            max-width: 1000px;
        }
        .img{
            max-width: 20px;
        }
        .bg-primary{
            background-color: #7f7fff!important;
        }
    </style>
</head>
<body>
<nav class="navbar nav-pills navbar-expand-sm bg-dark navbar-dark">

    <!-- Links -->
    <ul class="navbar-nav ml-5">
        <li class="nav-item">
            <a class="nav-link active bg-primary" href="student_home.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="student_registered_courses.php">Registered Courses</a>
        </li>

        <form method="POST" action="admin_home.php">
            <input type="hidden" name="logout">
            <button type="submit" class="btn logout" >
                <img src="logout_icon.png" alt="Power Sign" class="img">
                Log Out</button>
        </form>
    </ul>
</nav>
<h1 class="p-4 text-center text-white bg-primary">Home Page</h1>
<?php
$data= $result->fetch_row()?>

<h2 class="text-center my-5"><span class="font-weight-light">Welcome </span><?php echo $data[1];?></h2>
<div class="container my-5">
    <div class="d-flex flex-wrap">
        <div><h2>Roll Number: <span class="font-weight-light"><?php echo $data[2];?></span></div>
        <div><h2>Email: <span class="font-weight-light"><?php echo $data[4];?></span></div>
    </div>
    <div class="d-flex flex-wrap mt-5">
        <div><h2>Batch: <span class="font-weight-light"><?php echo $data[3];?></span></div>
        <div><h2>Gender: <span class="font-weight-light"><?php echo $data[5];?></span></div>
    </div>

</div>
</body>
</html>
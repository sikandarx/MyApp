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
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        p{
            font-size: 18px!important;
            margin: 0!important;
        }
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
        .active{
            border-radius: 0!important;
            background-color: #5840ba!important;
            padding: 16px 20px!important;
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

        .d-flex{
            gap: 50px;
            justify-content: space-evenly;
        }
        .mini-container{
            border: #d9d9d9 1px solid;
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 45%;
            max-height: 450px!important;
            border-radius: 10px;
            overflow-x: hidden;
        }
        .info>*{
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
        .navbar-nav{
            margin-left: 40px;
        }
        .calendar {
            max-width: 450px;
            margin: 0 auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #5840ba;
            color: #fff;
            padding: 10px;
        }

        #prevBtn,
        #nextBtn {
            background-color: transparent;
            border: none;
            cursor: pointer;
            font-size: 18px;
        }

        #prevBtn:focus,
        #nextBtn:focus {
            outline: none;
        }

        #monthYear {
            margin: 0;
            font-size: 18px;
        }

        .days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            background-color: #fff;
            padding: 10px;
        }

        .day-name {
            text-align: center;
            font-weight: bold;
            padding: 5px;
            background-color: #f1f1f1;
            border-radius: 5px;
        }

        .day {
            text-align: center;
            border-radius: 5px;
            padding: 5px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .prevMonth {
            color: #ccc;
        }

        .nextMonth {
            color: #ccc;
        }

        .today {
            background-color: #5840ba;
            color: #fff;
        }

        /* Add some hover effects for better user interaction */
        .day:hover {
            background-color: #f1f1f1;
        }

        #prevBtn:hover,
        #nextBtn:hover {
            color: #f1f1f1;
        }
        /* The modal container */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 9999; /* Sit on top */
            top: 0;
            left: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.4); /* Black background with transparency */
        }

        /* Modal content */
        .modal-content {
            border-radius: 15px;
            background-color: #fff;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 50%; /* Could be modified to your preferred width */
            max-height: 50%;
        }
        .modal-con{
            overflow: auto;
            margin: 30px 10px;
            padding: 0 10px;
        }
        /* Close button */
        .close {
            color: #868686;
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 30px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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
            box-shadow: 0 1px 8px rgba(0, 0, 0, 0.2);
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
            box-shadow: 0 1px 8px rgba(0, 0, 0, 0.2);
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
            p{
                font-size: 40px!important;
            }
            h1{
                font-size: 85px !important;
            }
            h2{
                font-size: 50px !important;
            }
            h4{
                font-size: 45px !important;
            }
            h5{
                font-size: 40px!important;
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
            .mini-container{
                max-width: 100% !important;
            }
            .calendar{
                font-size: 40px !important;
                width: 100%!important;
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
                <a class="nav-link active" href="student_home.php">Home</a>
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
    <div class="dropdown">
        <button class="custom-dropdown-btn" type="button" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="custom-dropdown-icon" src="notification_icon.png" alt="Notification Icon">
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown">
            <h5 class="mb-4 font-weight-heavy">Notifications:</h5>
            <?php
            if($notification->num_rows > 0 || $notification_all->num_rows > 0)
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
                if ($notification_student->num_rows > 0)
                {
                    foreach ($notification_student as $row):
                        if($row['type']=="student"){
                            ?>
                            <div class="notification_all"><?= $row['message']?>
                                <div><?= $row['created_at']?></div></div>
                        <?php } endforeach;
                }
                if ($notification->num_rows > 0)
                {
                    foreach ($notification as $row):
                        if($row['type']==""){
                            ?>
                            <div class="notification"><?= $row['message']?>
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
                <button onclick="window.location.href='student_settings.php';" class="btn"><img src="settings_icon.png" alt="settings icon" class="img mr-1">Settings</button>
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


<h1 class="p-4 text-center text-white bg-primary">Home Page</h1>

<?php
$data= $result->fetch_row()?>

<div class="container">
<h3 class=" my-5 mtop font-weight-heavy"><span class="font-weight-light">Hello, </span><?php echo $data[1];?>👋</h3>
</div>

<div class="container d-flex flex-wrap my-5">
    <div class="mini-container">
        <h5 class="mb-4 font-weight-heavy">Personal Information:</h5>
        <div class="info">
        <div><p class="font-weight-heavy">Roll Number: <span class="font-weight-light"><?php echo $data[2];?></span></div>
        <div><p class="font-weight-heavy">Email: <span class="font-weight-light"><?php echo $data[4];?></span></div>
        <div><p class="font-weight-heavy">Batch: <span class="font-weight-light"><?php echo $data[3];?></span></div>
        <div><p class="font-weight-heavy">Gender: <span class="font-weight-light"><?php echo $data[5];?></span></div>
        </div>
    </div>
    <div class="mini-container">
        <h5 class="mb-4 font-weight-heavy">Calender:</h5>
        <div class="calendar">
            <div class="header">
                <button id="prevBtn">&lt;</button>
                <h2 id="monthYear"></h2>
                <button id="nextBtn">&gt;</button>
            </div>
            <div class="days">
                <div class="day-name">Sun</div>
                <div class="day-name">Mon</div>
                <div class="day-name">Tue</div>
                <div class="day-name">Wed</div>
                <div class="day-name">Thu</div>
                <div class="day-name">Fri</div>
                <div class="day-name">Sat</div>
            </div>
        </div>
    </div>

</div>


<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="modal-con">
        <p id="modalText"></p>
        </div>
    </div>
</div>
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

    // Your existing JavaScript code

    // Get the current date
    const today = new Date();

    // Initialize the current month and year
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();

    // Array of day names
    const dayNames = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

    // Function to render the calendar
    function renderCalendar() {
        // Get the first day of the current month
        const firstDay = new Date(currentYear, currentMonth, 1);

        // Get the number of days in the current month
        const lastDay = new Date(currentYear, currentMonth + 1, 0);

        // Get the day of the week (0 - Sunday, 1 - Monday, ..., 6 - Saturday) for the first day of the month
        const firstDayOfWeek = firstDay.getDay();

        // Get the number of days in the previous month
        const prevMonthDays = new Date(currentYear, currentMonth, 0).getDate();

        // Get the reference to the days container
        const daysContainer = document.querySelector(".days");

        // Clear the previous content
        daysContainer.innerHTML = "";

        // Set the month and year in the header
        const monthYearHeader = document.getElementById("monthYear");
        monthYearHeader.textContent = new Intl.DateTimeFormat("en-US", {
            year: "numeric",
            month: "long",
        }).format(firstDay);

        // Create the day name elements
        dayNames.forEach((dayName) => {
            const dayNameElement = createDayNameElement(dayName);
            daysContainer.appendChild(dayNameElement);
        });

        // Create the day elements for the previous month
        for (let i = firstDayOfWeek - 1; i >= 0; i--) {
            const dayElement = createDayElement(prevMonthDays - i, "prevMonth");
            daysContainer.appendChild(dayElement);
        }

        // Create the day elements for the current month
        for (let i = 1; i <= lastDay.getDate(); i++) {
            const dayElement = createDayElement(i, "currentMonth");
            daysContainer.appendChild(dayElement);

            // Check if the current day is today and add the 'today' class
            const todayDate = new Date();
            if (
                currentMonth === todayDate.getMonth() &&
                currentYear === todayDate.getFullYear() &&
                i === todayDate.getDate()
            ) {
                dayElement.classList.add("today");
            }
        }

        // Create the day elements for the next month
        const daysToAdd = 7 - (daysContainer.children.length % 7);
        for (let i = 1; i <= daysToAdd; i++) {
            const dayElement = createDayElement(i, "nextMonth");
            daysContainer.appendChild(dayElement);
        }
    }

    // Function to create a day name element
    function createDayNameElement(dayName) {
        const dayNameElement = document.createElement("div");
        dayNameElement.textContent = dayName;
        dayNameElement.classList.add("day-name");
        return dayNameElement;
    }

    // Function to create a day element
    function createDayElement(dayNumber, className) {
        const dayElement = document.createElement("div");
        dayElement.textContent = dayNumber;
        dayElement.classList.add("day", className);
        dayElement.addEventListener("click", () => {
            // Handle click event for the day element (optional)
            // You can add your custom logic here, like displaying events or tasks for the clicked day.
            // For example, you could show an alert with the date when a day is clicked:
            // Function to open the modal
            function openModal(content) {
                const modal = document.getElementById("myModal");
                const modalText = document.getElementById("modalText");
                modalText.textContent = content;
                modal.style.display = "block";
            }

            // Function to close the modal
            function closeModal() {
                const modal = document.getElementById("myModal");
                modal.style.display = "none";
            }

            // Close the modal if clicked outside of it
            window.onclick = function (event) {
                const modal = document.getElementById("myModal");
                if (event.target === modal) {
                    closeModal();
                }
            };

            // Attach a click event to the close button
            document.querySelector(".close").addEventListener("click", closeModal);

            const content = `You clicked on ${dayNumber}-${currentMonth + 1}-${currentYear}`;
            openModal(content);
        });
        return dayElement;
    }

    // Event listener for the previous month button
    document.getElementById("prevBtn").addEventListener("click", function () {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar();
    });

    // Event listener for the next month button
    document.getElementById("nextBtn").addEventListener("click", function () {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar();
    });

    // Render the initial calendar
    renderCalendar();

</script>

</body>
</html>
<?php
// Assuming $grade and $id arrays have the same length
$grade = [80, 95, 70, 85];
$id = [101, 102, 103, 104];

// Function that takes two parameters and does something with them
function processValues($gradeValue, $idValue) {
    echo "ID: $idValue, Grade: $gradeValue ||||| ";
    // Your function logic here...
}

// Check if both arrays have the same length
if (count($grade) === count($id)) {
    // Iterate over both arrays correspondingly
    foreach ($grade as $index => $gradeValue) {
        $idValue = $id[$index];
        processValues($gradeValue, $idValue);
    }
} else {
    echo "Arrays do not have the same length, cannot iterate correspondingly." . PHP_EOL;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Dropdown</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Custom CSS to remove all styling from the dropdown button */
        .custom-dropdown-btn {
            border: none;
            background: none;
            padding: 0;
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
        .container{
            background-color: #5840ba;
        }
        .dropdown-menu{
            width: 500px!important;
        }
    </style>
</head>
<body>
<!-- Your content goes here -->

<div class="container mt-4">
    <div class="dropdown">
        <button class="custom-dropdown-btn" type="button" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="custom-dropdown-icon" src="notification_icon.png" alt="Notification Icon">
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown">
            <!-- Notification items will be added here -->
            <a class="dropdown-item" href="#">Notification 1</a>
            <a class="dropdown-item" href="#">Notification 2</a>
            <a class="dropdown-item" href="#">Notification 3</a>
            <!-- Add more items as needed -->
        </div>
    </div>
</div>


<!-- Bootstrap JS and jQuery -->


<script>
    // JavaScript to handle the icon animation on click
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
</script>


</body>
</html>


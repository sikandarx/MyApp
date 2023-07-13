

<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php
    require 'application.php';
    if($_POST)
    {

    if($_POST['course_title'] != "" && $_POST['credit_hours'] != ""&& $_POST['semester_number'] != "")
    {
        $connection = new application();
        $connection->insert_course($_POST['course_title'], $_POST['credit_hours'], $_POST['course_teacher'], $_POST['semester_number'], $_POST['curriculum'], $_POST['course_info']);
    }
    else{
        echo "<p class='p-2 text-white bg-danger text-center' >Incomplete credentials</p>";
    }
    }
    ?>
</head>
<body>
<h1 class="p-4 text-center text-white bg-success">Enter Course Info</h1>
<div class="container mt-5">
    <form name ="bio" method="POST" action="course_info.php">
        <div class="form-group">
            <label for="course_title">Course Title<span class="text-danger"> *</span></label>
            <input type="text" class="form-control" id="course_title"  name="course_title" placeholder="Enter the course title" required>
        </div>
        <div class="form-group">
            <label for="credit_hours">Credit Hours<span class="text-danger"> *</span></label>
            <select class="form-control" id="credit_hours" name="credit_hours">
                <option value="">(Select Credit Hours)</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>
        <div class="form-group">
            <label for="course_teacher">Course Teacher<span class="text-danger"> *</span></label>
            <input type="text" class="form-control" id="course_teacher"  name="course_teacher" placeholder="Enter the name of the course teacher" required>
        </div>
        <div class="form-group">
            <label for="semester_number">Semester Number<span class="text-danger"> *</span></label>
            <select class="form-control" id="semester_number" name="semester_number">
                <option value="">(Select Semester Number)</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>

            </select>
        </div>
        <div class="form-group">
            <label for="curriculum">Curriculum</label>
            <select class="form-control" id="curriculum" name="curriculum">
                <option value="core">Core</option>
                <option value="elective">Elective</option>
            </select>
        </div>
        <div class="form-group">
            <label for="course_info">Course Info</label>
            <textarea class="form-control" id="course_info" name="course_info" rows="4" placeholder="Enter additional course info"></textarea>
        </div>
        <button type="submit" class="btn btn-success" >Submit</button>
    </form>
    <a href="course_info_table.php" target="_blank">
        <button class="btn btn-secondary my-3">Course Data Table</button>
    </a>
</div>
</body>
</html>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php'; // If you are not using autoloading, adjust the path accordingly.
class application
{
    public $conn;
    public function __construct()
    {
        $host = "localhost";
        $db_name = "my_app";
        $username = "root";
        $password = "83110";
        $this->conn = new mysqli($host, $username, $password, $db_name);
        if ($this->conn->connect_error)
        {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    //-------------//
    //User Functions
    //-------------//
    public function insert_student($name, $number,$batch,$email,$gender)
    {
        $sql = "INSERT INTO student (`name`, `roll_number`,`batch`, `email`,`gender`) VALUES ('$name', '$number','$batch','$email','$gender')";
        $result = mysqli_query($this->conn, $sql);
        if(!$result)
        {
            echo "<p class='p-2 mx-5 text-white bg-success text-center' >There is some issue with record creation</p>";
        }
        else
        {
            echo "<p class='p-2 mx-5 text-white text-center bg-success'>Data submitted</p>";
        }
    }
    public function get_data_student()
    {

        $result = $this->conn->query("SELECT * FROM `student`");
        return $result;
    }
    public function delete_student($id) {
        $sql = "DELETE FROM `student` WHERE student_id = $id";
        $this->conn->query($sql);
    }

    //----------------//
    //Course Functions
    //---------------//
    public function insert_course($course_title, $credit_hours,$course_teacher,$semester_number,$curriculum, $course_info)
    {
        $sql = "INSERT INTO course (`course_title`, `credit_hours`, `course_teacher`,`semester_number`,`curriculum`, `course_info`) VALUES ('$course_title', '$credit_hours','$course_teacher','$semester_number','$curriculum','$course_info')";
        $result = mysqli_query($this->conn, $sql);
        if(!$result)
        {
            echo "<p class='p-2 mx-5 text-white bg-danger text-center mx-5' >There is some issue with record creation</p>";
        }
        else
        {
            echo "<p class='p-2 mx-5 text-white bg-success text-center mx-5' >Data submitted</p>";
        }
    }
    public function get_data_course()
    {
        $result = $this->conn->query("SELECT * FROM `course`");
        return $result;
    }
    public function delete_course($id) {
        $sql = "DELETE FROM `course` WHERE course_id = $id";
        $this->conn->query($sql);
    }

    public function enroll_student($student_id, $course_id) {
        $sql = "INSERT INTO student_course (student_id, course_id) VALUES ($student_id, $course_id)";
        $enroll=$this->conn->query($sql);
        if(!$enroll)
        {
            echo "<p class='p-2 mx-5 text-white bg-danger text-center' >There is some issue with record creation</p>";
        }
        else
        {
            echo "<p class='p-2 mx-5 text-white bg-success text-center' >Enrollment Successfull</p>";
        }
    }
    public function delete_enroll($id) {
        $sql = "DELETE FROM `student_course` WHERE id = $id";
        $this->conn->query($sql);
    }
    public function get_enroll_data($course_id)
    {
        $data = array();
        $sql="SELECT c.id as 'ID',  b.name as 'Student Name', b.email as 'Student Email' , b.roll_number as 'Student Roll Number' FROM `student_course` c JOIN student b on c.student_id = b.student_id JOIN course a on c.course_id = a.course_id WHERE a.course_id = ". $course_id;
        $result = $this->conn->query($sql);
        return $result;
    }
    public function get_title_course($id)
    {
        $result = $this->conn->query("SELECT course_title FROM `course` WHERE course_id=".$id);
         return $result;
    }
    public function get_data_login($username,$password)
    {
        $result = $this->conn->query("SELECT * FROM `users` WHERE username = '$username' AND password = '$password'");
        return $result;
    }
    public function check_email($username)
    {
        $result = $this->conn->query("SELECT * FROM `users` WHERE username = '$username'");
        return $result;
    }

    public function get_username_info($username)
    {
        $result = $this->conn->query("SELECT * FROM `student` WHERE email = '$username'");
        return $result;
    }

    public function get_data_student_course($username){
        $result = $this->conn->query("SELECT s.student_id, sc.course_id, c.* FROM `student` s JOIN `student_course` sc ON s.student_id = sc.student_id JOIN `course` c ON sc.course_id = c.course_id WHERE s.email = '$username'");
        return $result;
    }

    public function signup_users($username,$password,$type){
        $sql = "INSERT INTO users (`username`,`password`,`type`) VALUES ('$username','$password','$type')";
        $result = mysqli_query($this->conn, $sql);
        if(!$result)
        {
            echo "<p class='p-2 mx-5 text-white bg-danger text-center mx-5' >There is some issue with creating account!!</p>";
        }
        else
        {
            echo "<p class='p-2 mx-5 text-white bg-success text-center mx-5' >Account created, Now login below.</p>";
        }
    }

    public function get_course_count($course_id){
        $result = $this->conn->query("SELECT COUNT(*) AS count FROM student_course WHERE course_id='$course_id'");
        return $result;
    }

   public function sendVerificationEmail($toEmail, $verificationToken)
    {
        $mail = new PHPMailer(true);

        try {
            // SMTP Configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Set your SMTP host here
            $mail->SMTPAuth = true;
            $mail->Username = 'arhabhb@gmail.com'; // Set your SMTP username here
            $mail->Password = 'Veryeasy12!'; // Set your SMTP password here
            $mail->SMTPSecure = 'tls'; // Use 'tls' or 'ssl' based on your SMTP configuration
            $mail->Port = 587; // Use the appropriate SMTP port

            // Email Content
            $mail->setFrom('arhab@gmail.com', 'Arhab Habib'); // Set the sender's email and name
            $mail->addAddress($toEmail); // Set the recipient's email
            $mail->Subject = 'Email Verification';
            $mail->Body = "Hello,\n\nPlease click on the link below to verify your email address:\n\nhttps://your-website.com/verify_email.php?token=$verificationToken\n\nThank you!";

            // Send the email
            $mail->send();
            echo "Verification email sent successfully!";
        } catch (Exception $e) {
            echo "Failed to send the verification email. Error: " . $mail->ErrorInfo;
        }
    }


}
?>
<?php
class session
{

    public function login($result,$username)
    {
        if ($result->num_rows > 0) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['type'] = $result->fetch_row()[3];
            if($_SESSION['type']=="admin") {
                header("Location: admin_home.php");
            }
            else if($_SESSION['type']=="student")
            {
                header("Location: student_home.php");
            }

        }
        else {
            echo "<p class='p-2 text-white bg-danger opacity text-center ' >Incorrect credentials!!</p>";
        }
    }

    public function admin()
    {
        session_start();
        if(isset($_SESSION['username'])) {
            if($_SESSION['type']=="student")
            {
                header("Location: login.php");
                exit;
            }
        }
        else{
            header("Location: login.php");
            exit;
        }

    }
        public function student()
        {
            session_start();
            if(isset($_SESSION['username'])) {
                if($_SESSION['type']=="admin")
                {
                    header("Location: login.php");
                    exit;
                }
            }
            else{
                header("Location: login.php");
                exit;
            }
        }


}
?>

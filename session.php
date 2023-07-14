<?php
class session
{
    public function __construct()
    {
        session_start();

        if(!isset($_SESSION['username'])) {
            header("Location: login.php");
            exit;
        }
    }
}
?>

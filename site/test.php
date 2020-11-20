<?php
include 'init.php';
session_start();
if (isset($_SESSION['email']) == true) {
    $email = $_SESSION['email'];
    echo "WELCOMEEEEE" . $email;
}else{
    header("location: signup.php");
}



?>
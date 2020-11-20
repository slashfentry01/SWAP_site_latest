<?php
include 'init.php';
/////////////////////////////////////////////////
session_start();
if (isset($_SESSION['email'] ) && $_SESSION['role'] == 'admin') {
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];
    //echo $_SESSION['role'];
    // echo "WELCOMEEEEE" . $email;
}else{
    header("location: signup.php");
}
//CHECK IF VALID USER
//////////////////////////////////////////////////
$userToRevokeAdmin = $_REQUEST['userToRevokeAdmin'];
$query = "UPDATE users SET role='users', zone='normaluser' WHERE username='$userToRevokeAdmin' ";
if (mysqli_query($conn, $query)) {
    echo "Record updated successfully";
    header("location: plogindexAdmin.php");
}else {
    echo "Error updating record: " . mysqli_error($conn);
    }
?>


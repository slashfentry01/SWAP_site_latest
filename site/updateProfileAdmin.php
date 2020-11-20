<?php
include 'init.php';
/////////////////////////////////////////////////
session_start();
if (isset($_SESSION['email']) == true) {
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];
    // echo "WELCOMEEEEE" . $email;
}else{
    header("location: signup.php");
}
//CHECK IF VALID USER
//////////////////////////////////////////////////
$newEmail = $_REQUEST['emailnew'];
$newUsername = $_REQUEST['usernamenew'];
//$password1 = $_REQUEST['password'];
$number = $_REQUEST['numbernew'];
$usernameold = $_REQUEST['usernameold'];    
//$hash = password_hash($password1, PASSWORD_BCRYPT);
// echo $username;
// echo $email;
// echo $password;
// echo $number;

$query = "UPDATE users SET email='$newEmail', number='$number', username='$newUsername' WHERE username='$usernameold' ";
//$query = "UPDATE users SET email='$newEmail', password='$hash', number='$number', username='$newUsername' WHERE username='$username' ";
// mysqli_query($conn,$query);
if (mysqli_query($conn, $query)) {
    echo "Record updated successfully";
    header("location: logout.php");
}else {
    echo "Error updating record: " . mysqli_error($conn);
    }
?>

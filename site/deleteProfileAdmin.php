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

$usernameold = $_REQUEST['usernameold'];    
$query = "DELETE FROM users WHERE username='$usernameold' ";
// mysqli_query($conn,$query);
if (mysqli_query($conn, $query)) {
    echo "Record updated successfully";
    header("location: logout.php");
}else {
    echo "Error updating record: " . mysqli_error($conn);
    }

?>

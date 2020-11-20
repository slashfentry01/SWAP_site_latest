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
$newpassword = $_REQUEST['newpassword'];    
$newpasswordrepeat = $_REQUEST['newpasswordrepeat'];   
$newpassword1 = mysqli_real_escape_string($conn, $newpassword); //escape strings
$newpasswordrepeat1 = mysqli_real_escape_string($conn, $newpasswordrepeat); //escape strings
if ($newpassword1 == $newpasswordrepeat1){
    $hash = password_hash($newpasswordrepeat1, PASSWORD_BCRYPT);
    // echo $username;
    // echo $email;
    // echo $password;
    // echo $number;

    $query = "UPDATE users SET password='$hash'WHERE username='$usernameold' ";
    // mysqli_query($conn,$query);
    if (mysqli_query($conn, $query)) {
        echo "Record updated successfully";
        header("location: logout.php");
    }else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

?>

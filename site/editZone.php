<?php
include 'init.php';
/////////////////////////////////////////////////
session_start();
if (isset($_SESSION['email'] ) && $_SESSION['role'] == 'admin') {
    if($_SESSION['zone'] == 'all'){
        $email = $_SESSION['email'];
        $username = $_SESSION['username'];
        //echo $_SESSION['role'];
        // echo "WELCOMEEEEE" . $email;
    }
    else{
        header("location: signup.php");
    }
}else{
    header("location: signup.php");
}
//CHECK IF VALID USER
//////////////////////////////////////////////////

$newzone = $_REQUEST['newzone'];    
$userToEditZone = $_REQUEST['userToEditZone'];
echo $newzone;
echo $userToEditZone;
$query = "UPDATE users SET zone='$newzone'WHERE username='$userToEditZone' ";
// mysqli_query($conn,$query);
if (mysqli_query($conn, $query)) {
    echo "Record updated successfully";
    header("location: plogindexAdmin.php");
}else {
    echo "Error updating record: " . mysqli_error($conn);
}


?>

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
$emailToEdit = $_REQUEST['emailToEdit'];
$usernameToEdit = $_REQUEST['userToEdit'];
//$query = "select * from users where email='$email'";
$query = "SELECT * FROM users WHERE email = '$emailToEdit'";
$result = mysqli_query($conn, $query);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $email1 = $row["email"];
        $username1 = $row["username"];
        $password = $row["password"];
        $imagesrc = $row["image"];
        $number = $row["number"];
        //header("Location: " .  $row['link'] . " ");
        // echo "name: " . $username. "<br>";
        // echo "email: " . $email. "<br>";
        // echo "password: " . $row["password"]. "<br>";
        // echo "image: " . $row["image"]. "<br>";
    }
    } else {
     echo "0 results";
    //header('Location: ../cdenoexst');
    }

    if(isset($_POST['but_update'])){
        $newEmail = $_REQUEST['email'];
        $newUsername = $_REQUEST['username'];
        //$password1 = $_REQUEST['password'];
        $number = $_REQUEST['number'];    
        //$hash = password_hash($password1, PASSWORD_BCRYPT);
        echo $username;
        echo $email;
        echo $password;
        echo $number;

        $query = "UPDATE users SET email='$newEmail', number='$number', username='$newUsername' WHERE username='$username' ";
        //$query = "UPDATE users SET email='$newEmail', password='$hash', number='$number', username='$newUsername' WHERE username='$username' ";
        // mysqli_query($conn,$query);
        if (mysqli_query($conn, $query)) {
            echo "Record updated successfully";
            header("location: logout.php");
        }else {
            echo "Error updating record: " . mysqli_error($conn);
          }

        // $name = $_FILES['file']['name'];
        // $target_dir = "upload/";
        // $target_file = $target_dir . basename($_FILES["file"]["name"]);
    
        // // Select file type
        // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
        // // Valid file extensions
        // $extensions_arr = array("jpg","jpeg","png","gif");
    
        // // Check extension
        // if( in_array($imageFileType,$extensions_arr) ){
    
        //     // Insert record
        //     $query = "UPDATE users SET email='$email', password='$password', number='$number', image='".$name."' WHERE id='$username' ";
        //     mysqli_query($conn,$query);
    
        //     // Upload file
        //     move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
        //     header("location: logout.php");
    
        // }
     
    }
    if(isset($_POST['but_delete'])){

        $query = "DELETE FROM users WHERE username='$username' ";
        // mysqli_query($conn,$query);
        if (mysqli_query($conn, $query)) {
            echo "Record updated successfully";
            header("location: logout.php");
        }else {
            echo "Error updating record: " . mysqli_error($conn);
          }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Insert Website name here</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">Start Bootstrap</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="plogindex.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container d-flex h-100 align-items-center">
                <div class="mx-auto text-center">
                    <!-- <h1 class="mx-auto my-0 text-uppercase">MY PROFILE</h1> -->
                    <h1 class="text-white-50 mx-auto mt-2 mb-5">My Profile</h1>
                    <!-- <a class="btn btn-primary js-scroll-trigger" href="#about">Get Started</a> -->
                    <form action="updateProfileAdmin.php" method="POST" >
                    <p class="text-white-50">
                        Name
                    </p>
                    <input class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" name="usernamenew"  type="text" value="<?php echo $username1?>" />
                    <br>
                    <p class="text-white-50">
                        Email
                    </p>
                    <input class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" name="emailnew"  type="email" value="<?php echo $email1?>" />
                    <br>
                    <p class="text-white-50">
                        Number
                    </p>
                    <input class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" name="numbernew"  type="text" value="<?php echo $number?>" />
                    <input type='hidden' name='usernameold' id='hiddenField' value='<?php echo $username1?>' />
                    <br>
                    <p class="text-white-50">
                        Profile Photo
                    </p>
                    <img width="30%" src='<?php print_r("upload/" . $imagesrc) ?>' >
                    <br>
                    <br>
                    <!-- <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1"> -->
                    <br>
                    <button class="btn btn-primary " name='but_update' type="submit">Update Profile!</button>
                    
                    </form>
                    <form action="deleteProfileAdmin.php" method="POST">
                        <input type='hidden' name='usernameold' id='hiddenField' value='<?php echo $username1?>' />
                        <button class="btn btn-primary " name='but_updatePassword' type="submit">Delete Profile!</button> 
                    </form>
                    <br>
                    <form action="updatePasswordAdminFrontEnd.php" method="POST">
                        <input type='hidden' name='usernameold' id='hiddenField' value='<?php echo $username1?>' />
                        <button class="btn btn-primary " name='but_updatePassword' type="submit">Update Password!</button> 
                    </form>
                    <br>
                </div>
            </div>
        </header>
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>

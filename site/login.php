<?php
include 'init.php';
session_start();

if(isset($_POST['but_upload'])){
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $email = mysqli_real_escape_string($conn, $email); //escape strings
    $password1 = mysqli_real_escape_string($conn, $password); //escape strings
    //echo $email;
    //echo $password;
    $query = "select * from users where email='$email'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);
    if($count == 1) {
        $passwordInDb = $row['password'];
        $role = $row['role'];
        $zone = $row['zone'];
        //echo $passwordInDb;
        
        if (password_verify($password1, $passwordInDb)) {
            //echo 'Password is valid!';
            //echo $password1;
            $_SESSION['email'] = $email;
            $username = $row['username'];
            $_SESSION['username'] = $username;
            if($role == "admin"){
                $_SESSION['role'] = 'admin';
                header("location: plogindexAdmin.php");
                if($zone == "all"){
                    $_SESSION['role'] = 'admin';
                    $_SESSION['zone'] = 'all';
                    header("location: plogindexAdmin.php");
                }
                elseif($zone == "stores"){
                    $_SESSION['role'] = 'admin';
                    $_SESSION['zone'] = 'stores';
                    header("location: plogindexAdminStore.php");
                }
                elseif($zone == "reviews"){
                    $_SESSION['role'] = 'admin';
                    $_SESSION['zone'] = 'reviews';
                    header("location: plogindexAdminReviews.php");
                }
                elseif($zone == "inventory"){
                    $_SESSION['role'] = 'admin';
                    $_SESSION['zone'] = 'inventory';
                    header("location: plogindexAdminInventory.php");
                }
                elseif($zone == "staff"){
                    $_SESSION['role'] = 'admin';
                    $_SESSION['zone'] = 'staff';
                    header("location: plogindexAdminStaff.php");
                }
                elseif($zone == "users"){
                    $_SESSION['role'] = 'admin';
                    $_SESSION['zone'] = 'users';
                    header("location: plogindexAdminUsers.php");
                }
            }
            elseif ($role == "users") {
                $_SESSION['role'] = 'users';
                header("location: plogindex.php");
            }
            
            //header("location: plogindex.php");
        }else {
            $error = "Your Login Name or Password is invalid";
            header("location: errorlogin.php");
            
        }
        
    }else {
        $error = "Your Login Name or Password is invalid";
        header("location: signup.php");
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
                <a class="navbar-brand js-scroll-trigger" href="#page-top">Website Name here</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php">Home</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container d-flex h-100 align-items-center">
                <div class="mx-auto text-center">
                    <h1 class="mx-auto my-0 text-uppercase">LOGIN</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">Where you journey begins...</h2>
                    <!-- <a class="btn btn-primary js-scroll-trigger" href="#about">Get Started</a> -->
                    <form action="" method="POST" >
                        <input class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" name="email"  type="email" placeholder="Enter Email..." />
                        <br>
                        <input class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" name="password"  type="password" placeholder="Enter Password..." />
                        <br>
                        <button class="btn btn-primary " name='but_upload' type="submit">Login</button>
                    </form>
                    <br>
                    <p class="text-white-50">
                        Not signed up? Click
                        <a href="signup.php">here</a>
                        to sign up!
                    </p>
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

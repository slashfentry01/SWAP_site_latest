<?php
include 'init.php';
/////////////////////////////////////////////////
session_start();
if (isset($_SESSION['email'] ) && $_SESSION['role'] == 'admin') {
    if($_SESSION['zone'] == 'users'){
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
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#projects">Projects</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#signup">Contact</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="profile.php">My Profile -- <?php echo $username?> </a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container d-flex h-100 align-items-center">
                <div class="mx-auto text-center">
                    <h1 class="mx-auto my-0 text-uppercase">WELCOME ADMIN!</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">This is your admin pannel.</h2>
                 <a class="btn btn-primary js-scroll-trigger" href="#projects">User Panel</a> 
                </div>
            </div>
        </header>
        <!-- About-->
        <!-- Projects-->
        <section class="projects-section bg-light" id="projects">
            <div class="container">
            <!-- <h1 class="mx-auto my-0 text-uppercase">USERS!</h1>
            <br> -->
            <!-- <table class="table table-bordered table-dark">
                <thead>
                    <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Number</th>
                    <th scope="col">Role</th>
                    <th scope="col">Reset</th>
                    <th scope="col">Admin</th>
                    </tr>
                </thead>
                <tbody> -->
                <?php
                $query = "SELECT * FROM users";
                $result = mysqli_query($conn, $query); 
                echo "<h1 class='mx-auto my-0 text-uppercase'>USERS!</h1>";
                echo"<br>";
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $username1 = $row["username"];
                        $email1 = $row["email"];
                        $password1 = $row["password"];
                        $imagesrc1 = $row["image"];
                        $number1 = $row["number"];
                        $role1 = $row["role"];
                        $zone1 = $row["zone"];
                        //echo $zone1;
                        //header("Location: " .  $row['link'] . " ");
                        //echo
                        //echo "number: " . $number1. "<br>";
                        // echo "email: " . $email. "<br>";
                        // echo "password: " . $row["password"]. "<br>";
                        // echo "image: " . $row["image"]. "<br>";
                        
                        echo "<table class='table table-bordered table-dark'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th scope='col'>Username</th>";
                        echo "<th scope='col'>Email</th>";
                        echo "<th scope='col'>Number</th>";
                        echo "<th scope='col'>Role</th>";
                        echo "<th scope='col'>Reset</th>";
                        echo "<th scope='col'>Admin</th>";
                        echo "<th scope='col'>Zone</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        echo "<form action='profileAdmin.php' method='POST' >";
                        echo "<tr>";
                        echo "<td>$username1</th>";
                        echo "<td>$email1</td>";
                        echo "<td>$number1</td>";
                        echo "<td>$role1</td>";
                        // echo "<td>$zone1</td>";
                        echo "<input type='hidden' name='emailToEdit' id='hiddenField' value='$email1' />";
                        echo "<input type='hidden' name='userToEdit' id='hiddenField' value='$username1' />";
                        echo "<td><button type='submit' class='btn btn-primary btn-sm'>Reset</button></td>";
                        if($role1 == 'admin'){
                        echo "</form>";
                        echo "<form action='revokeAdmin.php' method='POST' >";
                        echo "<input type='hidden' name='userToRevokeAdmin' id='hiddenField' value='$username1' />";
                        echo "<td><button type='submit' class='btn btn-primary btn-sm'>Revoke Admin</button></td>";
                        echo "</form>";
                        }
                        else{
                        echo "</form>";
                        echo "<form action='makeAdmin.php' method='POST' >";
                        echo "<input type='hidden' name='userToMakeAdmin' id='hiddenField' value='$username1' />";
                        echo "<td><button type='submit' class='btn btn-primary btn-sm'>Make Admin</button></td>";
                        echo "</form>";
                        }
                        echo "<td>";
                        echo "<form action='editZone.php' method='POST' >";
                        echo "<select value='stores' class='form-control' name='newzone' id='exampleFormControlSelect1'>";
                        echo "<option ";
                        if($zone1 == 'all'){echo("selected");}
                        echo ">all</option>";

                        echo "<option ";
                        if($zone1 == 'stores'){echo("selected");}
                        echo ">stores</option>";

                        echo "<option ";
                        if($zone1 == 'reviews'){echo("selected");}
                        echo ">reviews</option>";
                        
                        echo "<option ";
                        if($zone1 == 'inventory'){echo("selected");}
                        echo ">inventory</option>";

                        echo "<option ";
                        if($zone1 == 'staff'){echo("selected");}
                        echo ">staff</option>";

                        echo "<option ";
                        if($zone1 == 'users'){echo("selected");}
                        echo ">users</option>";

                        echo "<option ";
                        if($zone1 == 'normaluser'){echo("selected");}
                        echo ">normal user</option>";

                        echo "</select>";
                        echo "</div>";
                        echo "<button type='submit' class='btn btn-primary btn-sm'>Edit</button>";
                        echo "<input type='hidden' name='userToEditZone' id='hiddenField' value='$username1' />";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                        echo "</tbody>";
                        echo "</table>";
                        //cant display password; data exposure vuln!
                    }
                    } else {
                    echo "0 results";
                    //header('Location: ../cdenoexst');
                    }
                    
                ?>
                
            

<br>
<br>
<br>
                <!-- Featured Project Row-->
                <div class="row align-items-center no-gutters mb-4 mb-lg-5">
                    <div class="col-xl-8 col-lg-7"><img class="img-fluid mb-3 mb-lg-0" src="assets/img/bg-masthead.jpg" alt="" /></div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
                            <h4>Shoreline</h4>
                            <p class="text-black-50 mb-0">You can change the design here and add words accordingly</p>
                        </div>
                    </div>
                </div>
                <!-- Project One Row-->
                <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
                    <div class="col-lg-6"><img class="img-fluid" src="assets/img/demo-image-01.jpg" alt="" /></div>
                    <div class="col-lg-6">
                        <div class="bg-black text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-left">
                                    <h4 class="text-white">Misty</h4>
                                    <p class="mb-0 text-white-50">An example of where you can put an image of a project, or anything else, along with a description.</p>
                                    <hr class="d-none d-lg-block mb-0 ml-0" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Project Two Row-->
                <div class="row justify-content-center no-gutters">
                    <div class="col-lg-6"><img class="img-fluid" src="assets/img/demo-image-02.jpg" alt="" /></div>
                    <div class="col-lg-6 order-lg-first">
                        <div class="bg-black text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-right">
                                    <h4 class="text-white">Mountains</h4>
                                    <p class="mb-0 text-white-50">Another example of a project with its respective description. These sections work well responsively as well, try this theme on a small screen!</p>
                                    <hr class="d-none d-lg-block mb-0 mr-0" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Signup-->
        <section class="signup-section" id="signup">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-lg-8 mx-auto text-center">
                        <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                        <h2 class="text-white mb-5">Subscribe to receive updates!</h2>
                        <form class="form-inline d-flex">
                            <input class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" id="inputEmail" type="email" placeholder="Enter email address..." />
                            <button class="btn btn-primary mx-auto" type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact-->
        <section class="contact-section bg-black">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Address</h4>
                                <hr class="my-4" />
                                <div class="small text-black-50">4923 Singaporean-Indian-Yusuf's house</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-envelope text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Email</h4>
                                <hr class="my-4" />
                                <div class="small text-black-50"><a href="#!">hello@yourdomain.com</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Phone</h4>
                                <hr class="my-4" />
                                <div class="small text-black-50">+1 (555) 902-8832</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="social d-flex justify-content-center">
                    <a class="mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer bg-black small text-center text-white-50"><div class="container">Copyright Group 5's Website 2020</div></footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>

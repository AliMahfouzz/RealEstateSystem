<?php
ob_start();
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Kontrol Real Estate Management System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>


  <!--/ Nav Star /-->
  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
        aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="#">K<span class="color-b">ontrol </span></span></a>
      <button type="button" class="btn btn-link nav-search navbar-toggle-box-collapse d-md-none" data-toggle="collapse"
        data-target="#navbarTogglerDemo01" aria-expanded="false">
        <span class="fa fa-search" aria-hidden="true"></span>
      </button>
      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Property</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="register.php">Register</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!--/ Nav End /-->

    <!--/ Intro Single star /-->
    <section class="intro-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="title-single-box">
                        <h1 class="title-single">Register a new user</h1>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Register
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!--/ Intro Single End /-->

    <!--/ About Star /-->
    <section class="section-about">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    
                            <?php
                            
                            if(isset($_SESSION['message'])){
                                echo '<div class="alert alert-success">'.$_SESSION['message'].'</div>';
                            }
                            ?>

                    <form class="form-a" action="register.php" method="post" enctype="multipart/form-data">
                        
                        <div id="errormessage"></div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="fname" required class="form-control form-control-lg form-control-a" placeholder="Your First Name">
                                    <div class="validation"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Last Name</label>

                                    <input type="text" name="lname" required class="form-control form-control-lg form-control-a" placeholder="Your Last Name">
                                    <div class="validation"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Email Address</label>

                                    <input name="email" type="email" required class="form-control form-control-lg form-control-a" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email">
                                    <div class="validation"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Password</label>

                                    <input name="password" type="password" required class="form-control form-control-lg form-control-a" placeholder="Your Password">
                                    <div class="validation"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Phone</label>

                                    <input name="phone" type="text" required class="form-control form-control-lg form-control-a" placeholder="Your Phone">
                                    <div class="validation"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Profile Picture</label>
                                    <input name="fileToUpload" type="file" required class="form-control form-control-lg form-control-a">
                                    <div class="validation"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" name="submit" class="btn btn-a">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--/ About End /-->


    <?php
    include('footer.php');
    ?>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/popper/popper.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="lib/easing/easing.min.js"></script> -->
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/scrollreveal/scrollreveal.min.js"></script>

    <!-- Template Main Javascript File -->
    <script src="js/main.js"></script>

</body>

</html>


<?php

include('connection.php');

if (isset($_POST["submit"])) {

    $email = $_POST["email"];

    $emails = [];

    $query1 = "
    SELECT email from users
  ";

    $result = mysqli_query($con, $query1);

    while ($row = mysqli_fetch_assoc($result)) {
        $emails[] = $row['email'];
    }


    if (!in_array($email, $emails)) {

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        $role = 1;

        $profile_pic = "";

        $target_dir = "uploads/";
        $target_file = $target_dir . time() . basename($_FILES["fileToUpload"]["name"]);



        if (isset($_FILES["fileToUpload"]["tmp_name"]) && $_FILES["fileToUpload"]["tmp_name"] != "") {
           
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $profile_pic = time() . basename($_FILES["fileToUpload"]["name"]);
            } else {
                $error_msg = "Sorry, there was an error uploading your file.";
            }
        }

        $query = "insert into users (fname,lname,email,password,phone,image,role) values ('$fname','$lname','$email','$password','$phone','$profile_pic','$role')";
                $result = mysqli_query($con, $query);

                if ($result) {
                    $_SESSION['message'] = 'Your account is registered successfully';
                    header('Location: register.php');
                } else {
                    $_SESSION['message'] = 'Your account is not registered, try again !!!!';
                    header('Location: register.php');
                }

    }

}

?>
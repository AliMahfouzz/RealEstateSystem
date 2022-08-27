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

   
<?php
    
    if($_SESSION["usertype"] == "admin"){
        include('adminnavbar.php');
    }
    else{
        include('brokernavbar.php');
    }

?>

    <!--/ Intro Single star /-->
    <section class="intro-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="title-single-box">
                        <h1 class="title-single">Add a new project</h1>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Add Project
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

                    <form class="form-a" action="project.php" method="post" enctype="multipart/form-data">
                        
                        <div id="errormessage"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Project Name</label>
                                    <input type="text" name="name" required class="form-control form-control-lg form-control-a" required placeholder="Project Name">
                                    <div class="validation"></div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                <label>Project Description</label>
                                <textarea name="description" placeholder="Project Description" class="form-control" name="description" cols="45" rows="8" required></textarea>
                                <div class="validation"></div>
                                </div>
                            </div>
                            <div id="dates" class="row col-md-12">

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Start Date</label>

                                    <input type="date" id="sdate" name="sdate" required class="form-control form-control-lg form-control-a">
                                    <div class="validation"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>End Date</label>

                                    <input name="edate" id="edate" type="date" required class="form-control form-control-lg form-control-a">
                                    <div class="validation"></div>
                                </div>
                            </div>
                        </div>
                        <div id="error_message" class="col-md-12"></div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Project Image</label>
                                    <input type="file" name="fileToUpload" required class="form-control form-control-lg form-control-a" required>
                                    <div class="validation"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" name="submit" id="submit" class="btn btn-a">Create</button>
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


    <script>
        $(document).ready(function(){
            $("#dates").change(function(e){
                var element_id = e.target.id;

                var from_date = $("#sdate").val();
                var to_date = $("#edate").val();

                if(new Date(from_date) <= new Date(to_date))
                {//compare end <=, not >=
                    //your code here
                    $("#error_message").html("");
                    $("#submit").prop('disabled', false);
                }
                else{
                    $("#submit").prop('disabled', true);
                    $("#error_message").html("<span class='text-danger'>Start date should be less than end date</span>");
                }
            });
        });
    </script>

</body>

</html>


<?php

include('connection.php');

if (isset($_POST["submit"])) {


        $name = $_POST['name'];
        $description = $_POST['description'];
        $sdate = $_POST['sdate'];
        $edate = $_POST['edate'];

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

        $query = "insert into projects (pname,description,startdate,enddate,image) values ('$name','$description','$sdate','$edate','$profile_pic')";
                $result = mysqli_query($con, $query);

                if ($result) {
                    $_SESSION['p_message'] = 'Your project is created successfully';
                    header('Location: projects.php');
                } else {
                    $_SESSION['ep_message'] = 'Your project is not created, try again !!!!';
                    header('Location: projects.php');
                }


}

?>
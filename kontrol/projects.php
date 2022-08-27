<?php

ob_start();

session_start();

include('connection.php');
include('editproject.php');

$query = "select * from projects";

$result = mysqli_query($con, $query);

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
    <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/select.bootstrap4.min.css" rel="stylesheet">

</head>

<body>



    <?php

    if ($_SESSION["usertype"] == "admin") {
        include('adminnavbar.php');
    } else {
        include('brokernavbar.php');
    }

    ?>


    <!--/ Intro Single star /-->
    <section class="intro-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="title-single-box">
                        <h1 class="title-single">All Projects</h1>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                All Projects
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!--/ Intro Single End /-->

    <!--/ Services Star /-->
    <section class="section-about">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    if (isset($_SESSION["p_message"])) {
                        echo "<div class='alert alert-success'>" . $_SESSION["p_message"] . "</div>";
                    } else if (isset($_SESSION["ep_message"])) {
                        echo "<div class='alert alert-danger'>" . $_SESSION["ep_message"] . "</div>";
                    }

                    ?>
                    <div class="row">
                        <?php
                        // Fetch one and one row
                        while ($row = mysqli_fetch_row($result)) {
                            echo "
                        <div class='card shadow col-md-4 d-flex m-3' style='flex-direction:column;border-radius:15px;'>
                            <div class='w-100 p-2 h-100'>
                                <img src='uploads/".$row[5]."' class='w-100 h-100' style='border-radius:15px;'>
                            </div>
                            <div>
                               
                                <a class='btn btn-success text-white editproject m-1' style='float:right;' type='button'><i class='fa fa-pencil'></i></a>
                                    <input type='hidden' class='d-none' name='id' value='".$row[0]."'/>
                                    <input type='hidden' class='d-none' value='".$row[1]."'/>
                                    <input type='hidden' class='d-none' value='".$row[2]."'/>
                                    <input type='hidden' class='d-none' value='".$row[3]."'/>
                                    <input type='hidden' class='d-none' value='".$row[4]."'/>

                            </div>
                            <div class='row p-4' style='flex-direction:column;align-items:center;'>
                                <div>
                                    <span class='color-b mr-1'><b>Project Name: </b></span><span>".$row[1]."</span>
                                </div>
                                <div>
                                <span class='color-b mr-1'><b>Project Description: </b></span><span>".$row[2]."</span>
                                </div>
                                <div>
                                <span class='color-b mr-1'><b>Start Date: </b></span><span>".$row[3]."</span>
                                </div>
                                <div>
                                <span class='color-b mr-1'><b>End Date: </b></span><span>".$row[4]."</span>
                                </div>
                            </div>
                        </div>
                        ";

                       
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Services End /-->




    <?php include('footer.php') ?>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/popper/popper.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="lib/easing/easing.min.js"></script> -->
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/scrollreveal/scrollreveal.min.js"></script>
    <!-- Contact Form JavaScript File -->
    <!-- <script src="contactform/contactform.js"></script> -->

    <!-- Template Main Javascript File -->
    <script src="js/main.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <script src="js/dataTables.select.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                select: false
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $('.editproject').on('click', function() {

                $('#editprojectmodal').modal('show');

                $tr = $(this).next('input');


                var data = $(this).nextAll().map(function() {
                    return $(this).val();
                }).get();
                //console.log(data);

                $('#p_id').val(data[0].replaceAll(' ', ''));
                $('#p_name').val(data[1]);
                $('#p_description').val(data[2]);
                $('#sdate').val(data[3]);
                $('#edate').val(data[4]);
            });
        });
    </script>

</body>

</html>
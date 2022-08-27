<?php

ob_start();

session_start();

include('connection.php');
include('reply.php');

if($_SESSION["usertype"] == "admin"){
    $query = "select q.*, CONCAT(u.fname,' ', u.lname) as broker_name, CONCAT(u1.fname,' ', u1.lname) as admin_name  from questions q
    left join users u on u.idusers = q.idusers
    left join users u1 on u1.idusers = q.replied_user";
}
else{
    $query = "select q.*, CONCAT(u.fname,' ', u.lname) as broker_name, CONCAT(u1.fname,' ', u1.lname) as admin_name  from questions q
        left join users u on u.idusers = q.idusers
        left join users u1 on u1.idusers = q.replied_user
        WHERE u.idusers = '".$_SESSION["userid"]."'";
}



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
                        <h1 class="title-single">All Questions</h1>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                All Questions
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
            if(isset($_SESSION["q_message"])){
                echo "<div class='alert alert-success'>".$_SESSION["q_message"]."</div>";
            }
            else if(isset($_SESSION["eq_message"])){
                echo "<div class='alert alert-danger'>".$_SESSION["eq_message"]."</div>";
            }
          
          ?>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Broker User</th>
                                    <th>Question Title</th>
                                    <th>Question Description</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Question Reply Admin User</th>
                                    <th>Question Reply</th>
                                    <th>Question Reply File</th>
                                    <th>#</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                                // Fetch one and one row
                                while ($row = mysqli_fetch_row($result)) {
                                    echo "<tr>
                                    <td>".$row[0]."</td>
                                    <td>".$row[9]."</td>
                                    <td>".$row[1]."</td>
                                    <td>".$row[2]."</td>";
                                    if($row[4] != "" && isset($row[4])){

                                        echo "<td><img src='uploads/".$row[4]."' width='250px' height='150px'></td>";
                                    }
                                    else{
                                        echo "<td></td>";
                                    }
                                    if((int)$row[8] == 0){
                                        echo '<td><button class="btn btn-warning text-white" type="button" disabled>
                                        <i class="fa fa-spinner fa-pulse"></i>Pending
                                      </button></td>';
                                    }
                                    else{
                                        echo "<td><span class='badge badge-success'>Replied</span></td>";
                                    }
                                    echo "<td>".$row[10]."</td>";
                                    echo "<td>".$row[6]."</td>";
                                    if($row[7] != "" && isset($row[7])){
                                        echo "<td><a href='uploads/".$row[7]."' download><i class='fa fa-download text-info'></i></a></td>";
                                    }
                                    else{
                                        echo "<td></td>";
                                    }

                                    if($_SESSION["usertype"] == "admin"){
                                        echo "
                                    <td>
                                        <a class='btn btn-success text-white reply' type='button'><i class='fa fa-reply'></i></a></td>";
                                    
                                    }
                                    else{
                                        echo "<td></td>";
                                    }
                                        
                                        
                                        echo "
                                </tr>"; 
                                }
                                
                            ?>
                            </tbody>
                        </table>
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
            $('#example').DataTable( {
                select: false
            } );
        } );
    </script>
 <script>
        $(document).ready(function() {

            $('.reply').on('click', function() {

                $('#replymodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();


                $('#q_id').val(data[0].replaceAll(' ', ''));
            });
        });
    </script>
   
</body>

</html>
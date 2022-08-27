<?php

ob_start();

session_start();

include('connection.php');
include('editunit.php');

$query = "select CASE WHEN r.rentprice IS NULL
THEN
(
  CASE WHEN s.saleinstallment IS NULL
  THEN(
	SELECT u.price as price
  )
  ELSE(
	SELECT s.saleinstallment as price
  )
  END
)ELSE(
SELECT r.rentprice as price
) END AS price,  CASE WHEN r.rentprice IS NULL
THEN
(
  CASE WHEN s.saleinstallment IS NULL
  THEN(
	SELECT NULL as period
  )
  ELSE(
	SELECT s.saleperiod as period
  )
  END
)ELSE(
SELECT r.rentperiod as period
) END AS period, p.*, u.idunits, u.uname ,u.udescription as udescription, u.unittype as unittype, u.paymentmethod as paymentmethod, u.image as image   
from units u 
left join projects p on p.idprojects = u.idprojects
left join rent r on r.idunits = u.idunits
left join sale s on s.idunits = u.idunits";


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
                        <h1 class="title-single">All Units</h1>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                All Units
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
                    if (isset($_SESSION["u_message"])) {
                        echo "<div class='alert alert-success col-md-12 mb-3'>" . $_SESSION["u_message"] . "</div>";
                    } else if (isset($_SESSION["eu_message"])) {
                        echo "<div class='alert alert-danger col-md-12 mb-3'>" . $_SESSION["eu_message"] . "</div>";
                    }

                    ?>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="d-none">Project Id</th>
                                    <th>Project Name</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>Payment Method</th>
                                    <th>Period</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>#</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                                // Fetch one and one row
                                while ($row = mysqli_fetch_row($result)) {
                                    echo "<tr>
                                    <td>".$row[8]."</td>
                                    <td class='d-none'>".$row[2]."</td>
                                    <td>".$row[3]."</td>
                                    <td>".$row[9]."</td>
                                    <td>".$row[10]."</td>
                                    <td>".$row[11]."</td>
                                    <td>".$row[12]."</td>
                                    <td>".$row[1]."</td>
                                    <td>".$row[0]."</td>
                                    <td><img src='uploads/".$row[13]."' width='250px' height='150px'></td>
                                    <td><a class='btn btn-success text-white editunit' type='button'><i class='fa fa-pencil'></i></a></td>
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

            $('.editunit').on('click', function() {

                $('#editunitmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();


                $('#u_id').val(data[0].replaceAll(' ', ''));
                $('#u_projects').val(data[1]);
                // console.log(data[1]);
                $('#u_name').val(data[3]);
                $('#u_description').val(data[4]);
                $('#u_type').val(data[5]);
                $('#u_paymentmethod').val(data[6]);
                $('#u_period').val(data[7]);
                $('#u_price').val(data[8]);

                var payment_method = data[6];
                var payment_period = data[7];
                var payment_price = data[8];

                if(payment_method == 'sale'){
                var s = `
                                <div class="form-group col">
                                    <label>Sale Installment Period</label>

                                    <input type="text" name="speriod" id="speriod" placeholder="Sale Installment Period" class="form-control">
                                    <div class="validation"></div>
                                </div>

                                <div class="form-group col">
                                    <label>Sale Price</label>

                                    <input type="number" step="any" id="sprice" name="sprice" placeholder="Sale Price" class="form-control">
                                    <div class="validation"></div>
                                </div>
                    `;
                    $("#price2").html(s);
                    $("#speriod").val(payment_period);
                    $("#sprice").val(payment_price);
                    $("#sale").prop('checked', true);
            }
            else if(payment_method == 'rent'){
                var s = `
                                <div class="form-group col">
                                    <label>Rent Period</label>

                                    <input type="text" id="rperiod" name="rperiod" placeholder="Rent Period" required class="form-control">
                                    <div class="validation"></div>
                                </div>

                                <div class="form-group col">
                                    <label>Rent Price</label>

                                    <input type="number" id="rprice" step="any" name="rprice" placeholder="Rent Price" required class="form-control">
                                    <div class="validation"></div>
                                </div>
                    `;
                    $("#price2").html(s);
                    $("#rperiod").val(payment_period);
                    $("#rprice").val(payment_price);
                    $("#rent").prop('checked', true);
            }
            else{
                var s = `
                                <div class="form-group col">
                                    <label>Price</label>

                                    <input type="number" id="price3" step="any" name="price" placeholder="Price" required class="form-control">
                                    <div class="validation"></div>
                                </div>
                    `;
                    $("#price2").html(s);
                    $("#price3").val(payment_price);
                    $("#default").prop('checked', true);

            }

            });
        });
    </script>
</body>

</html>
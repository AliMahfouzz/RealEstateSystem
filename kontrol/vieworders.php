<?php

ob_start();

session_start();

include('connection.php');

if ($_SESSION['usertype'] == 'admin') {
    $query = "SELECT CASE WHEN r.rentprice IS NULL
    THEN
    (
      CASE WHEN s.saleinstallment IS NULL
      THEN(
        SELECT un.price as price
      )
      ELSE(
        SELECT s.saleinstallment as price
      )
      END
    )ELSE(
    SELECT r.rentprice as price
    ) END AS uprice,un.*, CONCAT(u.fname, ' ', u.lname) as broker_name, ba.*, ba.price as bprice FROM kontrol.broker_applies ba
    left join users u on u.idusers = ba.idusers
    left join units un on un.idunits = ba.idunits
    left join projects p on p.idprojects = un.idprojects
left join rent r on r.idunits = un.idunits
left join sale s on s.idunits = un.idunits
";
} else {
    $query = "SELECT CASE WHEN r.rentprice IS NULL
    THEN
    (
      CASE WHEN s.saleinstallment IS NULL
      THEN(
        SELECT un.price as price
      )
      ELSE(
        SELECT s.saleinstallment as price
      )
      END
    )ELSE(
    SELECT r.rentprice as price
    ) END AS uprice, un.*, CONCAT(u.fname, ' ', u.lname) as broker_name, ba.*, ba.price as bprice FROM kontrol.broker_applies ba
    left join users u on u.idusers = ba.idusers
    left join units un on un.idunits = ba.idunits
    left join projects p on p.idprojects = un.idprojects
left join rent r on r.idunits = un.idunits
left join sale s on s.idunits = un.idunits
    WHERE u.idusers = '" . $_SESSION["userid"] . "'
    ";
}


$result = mysqli_query($con, $query);

include('approvepayment.php');
include('viewpayments.php');

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
                        <h1 class="title-single">All Brokers applies</h1>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                All Brokers applies
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
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Broker Name</th>
                                    <th>Unit Name</th>
                                    <th>Unit Description</th>
                                    <th>Unit Type</th>
                                    <th>Unit Payment Method</th>
                                    <th>Unit Price</th>
                                    <th>Unit Image</th>
                                    <th>Date</th>
                                    <th>Broker Payment Method</th>
                                    <th>Installment Duration</th>
                                    <th>Client Name</th>
                                    <th>Client Phone 1</th>
                                    <th>Client Phone 2</th>
                                    <th>Client Email</th>
                                    <th>Client Address</th>
                                    <th>Client Class</th>
                                    <th>Client Job</th>
                                    <th>Client Average Monthly Income</th>
                                    <th>Client Budget</th>
                                    <th>Client Preferences</th>
                                    <th>Client Notes</th>
                                    <th>Paid</th>
                                    <th>Commission (5%)</th>
                                    <th>#</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sum = 0.0;
                                // Fetch one and one row
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                                    <td>" . $row["idbroker_applies"] . "</td>
                                    <td>" . $row["broker_name"] . "</td>
                                    <td>" . $row["uname"] . "</td>
                                    <td>" . $row["udescription"] . "</td>
                                    <td>" . $row["unittype"] . "</td>
                                    <td>" . $row["paymentmethod"] . "</td>
                                    <td>" . $row["uprice"] . "</td>
                                    <td><img src='uploads/" . $row["image"] . "' width='250px' height='150px'></td>
                                    <td>" . $row["date"] . "</td>
                                    <td>" . $row["typeofpayment"] . "</td>
                                    <td>" . $row["duration_of_installment"] . "</td>
                                    <td>" . $row["name"] . "</td>
                                    <td>" . $row["phone1"] . "</td>
                                    <td>" . $row["phone2"] . "</td>
                                    <td>" . $row["email"] . "</td>
                                    <td>" . $row["address"] . "</td>
                                    <td>" . $row["class"] . "</td>
                                    <td>" . $row["job"] . "</td>
                                    <td>" . $row["monthly_income"] . "</td>
                                    <td>" . $row["budget"] . "</td>
                                    <td>" . $row["preferences"] . "</td>
                                    <td>" . $row["notes"] . "</td>";

                                    if ((int)$row["paid"] == 1) {
                                        echo "<td><span class='badge badge-success'>Paid</span></td>";
                                        echo "<td>" . $row["bprice"] . "</td>";
                                        echo "<td>";
                                        echo "</td>";
                                        $sum += (float)$row["bprice"];
                                    } else {
                                        echo "<td><span class='badge badge-warning'>Pending</span></td>";
                                        echo "<td></td>";
                                        echo "<td>";
                                        if ($_SESSION['usertype'] == 'admin') {
                                            echo '
                                                <button type="button" class="btn btn-success approvepayment"> <i class="fa fa-check-circle" aria-hidden="true"></i> </button>
                                            ';
                                        }

                                        if(isset($row["duration_of_installment"]) && !empty($row["duration_of_installment"]) && $row["duration_of_installment"] != ""){
                                            echo '<button type="button" class="btn btn-success viewinstallment m-2"> <i class="fa fa-eye" aria-hidden="true"></i> </button>';
                                        }


                                        echo "</td>";
                                    }


                                    echo "</tr>";
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="form-group mb-3">
                        <strong><label>Total Payments: </label></strong><span class="ml-1" style="color:#2eca6a;font-weight:bolder;"><?php echo $sum ?></span>
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

            $('.approvepayment').on('click', function() {

                $('#approvepaymentmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

               // console.log(data);
                $('#pp_id').val(data[0].replaceAll(' ', ''));
            });
        });
    </script>


    <script>
        $(document).ready(function() {

            $('.viewinstallment').on('click', function() {

                $('#viewinstallmentmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                var unitprice = parseFloat(data[6].replaceAll(' ', ''));

                var duration_of_installment = parseFloat(data[10].replaceAll(' ', ''));


                console.log(unitprice);
                console.log(duration_of_installment);

                var html = '';

                if (duration_of_installment != "") {
                    var element = unitprice / duration_of_installment;

                    var check_modulo = unitprice % duration_of_installment;

                    console.log(unitprice);
                    console.log(duration_of_installment);

                    html = `<table class='table table-bordered table-striped dataTable2'>
    <thead>
        <tr>
            <th>Year</th>
            <th>Payment</th>
        </tr>
    </thead>
    <tbody>`;


                    if (check_modulo == 0) {
                        for (var i = 0; i < duration_of_installment; i++) {
                            html += `
            <tr>
                <td>` + i + `</td>
                <td>` + element + ` L.E.</td>
            </tr>
        `;
                        }
                    } else {
                        element = parseInt(unitprice / (duration_of_installment));

                        var last_element = unitprice - (element * (duration_of_installment - 1));

                        for (var i = 0; i < (duration_of_installment - 1); i++) {
                            html += `
            <tr>
                <td>` + i + `</td>
                <td>` + element + ` L.E.</td>
            </tr>
        `;


                        }

                        html += `<tr><td>` + i + `</td><td>` + last_element + ` L.E.</td>`;
                        html += `</tr>`;
                    }


                    html += `
    </tbody>
</table>`;
                }

                $('#paymentstable').html(html);

                $('.dataTable2').DataTable({
            select: false
        });
               
            });
        });
    </script>

</body>

</html>
<?php

ob_start();

session_start();

include('connection.php');

$idunits = $_GET['idunits'];

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
left join sale s on s.idunits = u.idunits
WHERE u.idunits = '" . $idunits . "'
";

$result = mysqli_query($con, $query);


$uname = "";
$uperiod = "";
$uprice = "";
$udescription = "";
$uprojectname = "";
$utype = "";
$upayment = "";
$uimage = "";

while ($row = mysqli_fetch_row($result)) {
    $upayment = isset($row[12]) && $row[12] != "" ? $row[12] : "-";
    $uname =  $row[9];
    $uperiod =  $row[1];
    $uprice =  $row[0];
    $udescription =  $row[10];
    $uprojectname =  $row[3];
    $utype =  $row[11];
    $uimage =  $row[13];
}

$newprice = 0.0;
if ($uprice != "") {
    $newprice = (float) $uprice * 0.05;
}


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

    <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/select.bootstrap4.min.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="css/style.css" rel="stylesheet">
    <style>

        .asterisk{
            color: #2eca6a;
            margin-left: 2px;
        }

        .card-bounding {
            width: 90%;
            max-width: 500px;
            margin: 0 auto;
            position: relative;
            /* top:50%; */
            /* transform: translateY(-50%); */
            padding: 30px;
            border: 1px solid #2eca6a;
            border-radius: 6px;
            font-family: 'Roboto';
            background: #ffffff;
        }

        .card-bounding aside {
            font-size: 24px;
            padding-bottom: 8px;
        }

        .card-container {
            width: 100%;
            padding-left: 80px;
            padding-right: 40px;
            position: relative;
            box-sizing: border-box;
            border: 1px solid #ccc;
            margin: 0 auto 30px auto;
        }

        .card-container input {
            width: 100%;
            letter-spacing: 1px;
            font-size: 30px;
            padding: 15px 15px 15px 25px;
            border: 0;
            outline: none;
            box-sizing: border-box;
        }

        .card-type {
            width: 80px;
            height: 56px;
            background: url("cards.png");
            background-position: 0 -291px;
            background-repeat: no-repeat;
            position: absolute;
            top: 3px;
            left: 4px;
        }

        .card-type.mastercard {
            background-position: 0 0;
        }

        .card-type.visa {
            background-position: 0 -115px;
        }

        .card-type.amex {
            background-position: 0 -57px;
        }

        .card-type.discover {
            background-position: 0 -174px;
        }

        .card-valid {
            position: absolute;
            top: 0;
            right: 15px;
            line-height: 60px;
            font-size: 40px;
            font-family: 'icons';
            color: #ccc;
        }

        .card-valid.active {
            color: green;
        }

        .card-details {
            width: 100%;
            text-align: left;
            margin-bottom: 30px;
            transition: 300ms ease;
        }

        .card-details input {
            font-size: 30px;
            padding: 15px;
            box-sizing: border-box;
            width: 100%;
        }

        .card-details input.error {
            border: 1px solid #2eca6a;
            box-shadow: 0 4px 8px 0 rgba(238, 76, 87, 0.3);
            outline: none;
        }

        .card-details .expiration {
            width: 50%;
            float: left;
            padding-right: 5%;
        }

        .card-details .cvv {
            width: 45%;
            float: left;
        }
    </style>
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
                        <h1 class="title-single"><?php echo $uname; ?></h1>
                        <span class="color-text-a"><?php echo $uprojectname; ?></span>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Units</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <?php echo $uname; ?>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!--/ Intro Single End /-->

    <!--/ Agent Single Star /-->
    <section class="agent-single">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="agent-avatar-box">
                                <img src="uploads/<?php echo $uimage; ?>" alt="" class="agent-avatar img-fluid">
                            </div>
                        </div>
                        <div class="col-md-5 section-md-t3">
                            <div class="agent-info-box">
                                <div class="agent-title">
                                    <div class="title-box-d">
                                        <h3 class="title-d"><?php echo $uname; ?></h3>
                                    </div>
                                </div>
                                <div class="agent-content mb-3">
                                    <p class="content-d color-text-a">
                                        <?php echo $udescription; ?>
                                    </p>
                                    <div class="info-agents color-a">
                                        <p>
                                            <strong>Price: </strong>
                                            <span class="color-text-a"> <?php echo $uprice; ?> L.E</span>
                                        </p>
                                        <p>
                                            <strong>Period: </strong>
                                            <span class="color-text-a"> <?php echo $uperiod; ?></span>
                                        </p>
                                        <p>
                                            <strong>Type: </strong>
                                            <span class="color-text-a"> <?php echo $utype; ?></span>
                                        </p>
                                        <p>
                                            <strong>Payment Method: </strong>
                                            <span class="color-text-a"> <?php echo $upayment; ?></span>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 m-3">
                    <div class="row m-3">
                        <div class="col-sm-12 card shadow-sm p-2" style="border:2px solid #2eca6a;">

                            <form method="POST" action="singleunit.php">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Name<span class="asterisk">*</span></label>
                                        <input type="text" required class="form-control" name="uname">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Phone<span class="asterisk">*</span></label>
                                        <input type="text" name="phone1" class="form-control" required></input>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Phone2</label>
                                        <input type="text" name="phone2" class="form-control"></input>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label>Email<span class="asterisk">*</span></label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Address<span class="asterisk">*</span></label>
                                        <textarea name="address" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label>Class</label>
                                        <input name="class" type="text" class="form-control"></input>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Job</label>
                                        <input name="job" type="text" class="form-control"></input>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label>Average monthly income</label>
                                        <input name="monthy_income" type="number" step="any" class="form-control"></input>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Budget</label>
                                        <input name="budget" type="number" step="any" class="form-control"></input>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label>Preferences</label>
                                        <textarea name="preferences" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Notes</label>
                                        <textarea name="notes" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label>Choose Type Of Payment<span class="asterisk">*</span></label>
                                        <select name="typeofp" class="form-control" id="typeofp">
                                            <option value="cash">Cash</option>
                                            <option value="installments">Installments</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6" style="display: none;" id="visacard">
                                        <label>Duration of installments (Nb Of Years)</label>
                                        <input type="number" class="form-control" id="duration_of_installment" name="duration_of_installmentt">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" id="installments">

                                    </div>
                                </div>


                                <input type="hidden" name="idunits" value="<?php echo $idunits; ?>">
                                <input type="hidden" name="price" value="<?php echo $newprice; ?>">


                                <input type="submit" class="btn btn-success m-1" value="Reserve" name="submit">

                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--/ Agent Single End /-->

    <?php include('footer.php') ?>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/popper/popper.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/scrollreveal/scrollreveal.min.js"></script>
    <!-- Contact Form JavaScript File -->
    <script src="contactform/contactform.js"></script>
    <script src="js-CreditCardValidator-master/creditCardValidator.js"></script>

    <!-- Template Main Javascript File -->
    <script src="js/main.js"></script>

    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#typeofp").on('change', function() {
                var typeofp = $("#typeofp").val();
                if (typeofp == "cash") {
                    $("#visacard").css('display', 'none');
                    $("#duration_of_installment").prop('required',false);
                    $("#installments").css('display', 'none');
                } else {
                    $("#visacard").css('display', 'block');
                    $("#duration_of_installment").prop('required',true);
                }
            });

            $("#duration_of_installment").on('change', function(){
                var duration_of_installment = $("#duration_of_installment").val();

                var price = parseFloat("<?php echo $uprice; ?>");

                var element = price / duration_of_installment;

                var check_modulo = price % duration_of_installment;

                var html = `<table class='table table-bordered table-striped dataTable'>
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Payment</th>
                        </tr>
                    </thead>
                    <tbody>`;

                
                if(check_modulo == 0){
                    for(var i=0;i<duration_of_installment;i++){
                        html += `
                            <tr>
                                <td>`+i+`</td>
                                <td>`+element+` L.E.</td>
                            </tr>
                        `;
                    }
                }
                else{
                    element = parseInt(price / (duration_of_installment));
                    
                    var last_element = price - (element * (duration_of_installment-1));
                    
                    for(var i=0;i<(duration_of_installment-1);i++){
                        html += `
                            <tr>
                                <td>`+i+`</td>
                                <td>`+element+` L.E.</td>
                            </tr>
                        `;

                       
                    }

                    html += `<tr><td>`+i+`</td><td>`+last_element+` L.E.</td>`;
                        html +=`</tr>`; 
                }

                
                html +=    `
                    </tbody>
                </table>`;

                $("#installments").html(html);
                $("#installments").css('display','block');

                $(".dataTable").dataTable();

            });

        });
    </script>

</body>

</html>


<?php

if (isset($_POST['submit'])) {
    session_start();

    $idusers = $_SESSION['userid'];
    $newprice = $_POST['price'];
    $idunits = $_POST['idunits'];
    $typeofp = $_POST['typeofp'];
    $duration_of_installment = $_POST['duration_of_installmentt'];


    $name = $_POST['uname'];
    $phone1 = $_POST['phone1'];
    $phone2 = $_POST['phone2'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $class = $_POST['class'];
    $job = $_POST['job'];
    $monthy_income = $_POST['monthy_income'];
    $budget = $_POST['budget'];
    $preferences = $_POST['preferences'];
    $notes = $_POST['notes'];


    $date = date('Y-m-d H:i:s');


    //echo $duration_of_installment;

    $query = "insert into broker_applies (idusers,idunits,price,date,typeofpayment,name,phone1,phone2,email,
    address,class,job,monthly_income,budget,preferences,notes,duration_of_installment) values 
    ('$idusers','$idunits','$newprice','$date','$typeofp','$name','$phone1','$phone2','$email','$address',
    '$class','$job','$monthy_income','$budget','$preferences','$notes','$duration_of_installment')";
    
    
        // echo $query;
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['tu_message'] = 'Your are applied successfully';
        header('Location: vprojects.php');
    } else {
        $_SESSION['etu_message'] = 'Your are not applied, try again !!!!';
        header('Location: vprojects.php');
    }
}


?>
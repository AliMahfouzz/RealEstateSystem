<?php
ob_start();
session_start();

include('connection.php');

$idproject = $_GET["idproject"];

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
WHERE u.idprojects = '" . $idproject . "'
";


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

</head>

<body>


  <?php

  if ($_SESSION["usertype"] == "admin") {
    include('adminnavbar.php');
  } else {
    include('brokernavbar.php');
  }

  ?>

  <!--/ Agent Single Star /-->
  <section class="agent-single">
    <div class="container">

      <div class="row">
        <div class="col-md-12 section-t8">

          <?php
          if (isset($_SESSION["tu_message"])) {
            echo "<div class='alert alert-success col-md-12 mb-3'>" . $_SESSION["tu_message"] . "</div>";
          } else if (isset($_SESSION["etu_message"])) {
            echo "<div class='alert alert-danger col-md-12 mb-3'>" . $_SESSION["etu_message"] . "</div>";
          }

          ?>
        </div>
      </div>

      <div class="col-md-12 section-t8">
        <div class="title-box-d">
          <h3 class="title-d">Units</h3>
        </div>
      </div>
      <div class="row">
        <div class="col d-flex">
          <span>Filter By Payment Method</span>
          <select id="filter1" class="form-control">
          <option value="" selected disabled>Select an Option</option>
            <option value="sale">Sale</option>
            <option value="rent">Rent</option>
            <option value="default">Default</option>
          </select>
        </div>
        <div class="col d-flex">
          <span>Filter By Unit Type</span>
          <select id="filter2" class="form-control">
            <option value="" selected disabled>Select an Option</option>
            <option value="Appartment">Appartment</option>
            <option value="Town house">Town house</option>
            <option value="Bent house">Bent house
            </option>
            <option value="Chalet">Chalet
            </option>
            <option value="Villa">Villa
            </option>
          </select>
        </div>
      </div>
      <input id="project" class="d-none" value="<?php echo $idproject ?>">
      <div class="row property-grid grid mt-4" id="units">
        <?php while ($row = mysqli_fetch_row($result)) {
          $payment_method = isset($row[12]) && $row[12] != "" ? $row[12] : "-";
          echo '
            <div class="col-md-4">
              <div class="card-box-a card-shadow" style="width:300px;height:400px;">
                <div class="img-box-a" style="width:300px;height:400px;">
                  <img src="uploads/' . $row[13] . '" alt="" class="img-a img-fluid" style="width:300px;height:400px;">
                </div>
                <div class="card-overlay">
                  <div class="card-overlay-a-content">
                    <div class="card-header-a">
                      <h2 class="card-title-a">
                        <a href="#">' . $row[9] . '</a>
                      </h2>
                    </div>
                    <div class="card-body-a">
                      <div class="price-box d-flex">
                        <span class="price-a">' . $payment_method . ' | $ ' . $row[0] . '</span>
                      </div>
                      <a href="singleunit.php?idunits=' . $row[8] . '" class="link-a">Click here to apply
                        <span class="ion-ios-arrow-forward"></span>
                      </a>
                    </div>
                    <div class="card-footer-a">
                      <ul class="card-info d-flex justify-content-around" style="flex-direction:column;">
                        <li>
                          <span class="card-info-title p-3"><b>Payment Method:</b> <span class="text-white">' . $row[12]
            . '</span></span>
                          
                        </li>
                        <li>
                        <span class="card-info-title  p-3">
                           <b>Unit Type:</b> <span class="text-white">' . $row[11] . '</span>
                          </span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
        } ?>
      </div>
    </div>
    </div>
  </section>
  <!--/ Agent Single End /-->

  <?php include('footer.php'); ?>

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/popper/popper.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/scrollreveal/scrollreveal.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>

  <script>
        $(document).ready(function(){
            $("#filter1").change(function(){
                $.ajax({
                type: "post",
                url : "unitsfilter1.php?idfilter="+$("#filter1").val()+"&idproject="+$("#project").val(),
                contentType : "html",
                success : function(response){
                    $("#units").html(JSON.parse(response));
                }
            })
            });
            

            $("#filter2").change(function(){
                $.ajax({
                type: "post",
                url : "unitsfilter2.php?idfilter="+$("#filter2").val()+"&idproject="+$("#project").val(),
                contentType : "html",
                success : function(response){
                    $("#units").html(JSON.parse(response));
                }
            })
            });
            
        })
    </script>

</body>

</html>
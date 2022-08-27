<?php

//payment method

ob_start();
session_start();

include('connection.php');

$idfilter = trim($_GET["idfilter"]);

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
WHERE u.idprojects = '" . $idproject . "' AND  u.paymentmethod = '".$idfilter."'
";


$result = mysqli_query($con, $query);


$html = "";

while ($row = mysqli_fetch_row($result)) {
    $payment_method = isset($row[12]) && $row[12] != "" ? $row[12] : "-";
    $html .= '
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
  }







echo json_encode($html);
?>
<?php
ob_start();
session_start();

include('connection.php');

$query = "SELECT idprojects, pname FROM projects";

$projects_dropdownlist = "<select name='projects' class='form-control form-control-lg form-control-a'>";

if ($result = mysqli_query($con, $query)) {
    // Fetch one and one row
    while ($row = mysqli_fetch_row($result)) {
        $projects_dropdownlist .= "<option value='" .$row[0]. "'>".$row[1]."</option>"; 
    }
  }

$projects_dropdownlist .= "</select>"


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
                        <h1 class="title-single">Add a new Unit</h1>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Add Unit
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

                    <form class="form-a" action="unit.php" method="post" enctype="multipart/form-data">
                        
                        <div id="errormessage"></div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Project Name</label>
                                    <?php echo $projects_dropdownlist  ;?>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Unit Name</label>

                                    <input type="text" name="uname" placeholder="Unit Name" required class="form-control form-control-lg form-control-a">
                                    <div class="validation"></div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                <label>Unit Description</label>
                                <textarea name="description" placeholder="Unit Description" class="form-control" name="description" cols="45" rows="8" required></textarea>
                                <div class="validation"></div>
                                </div>
                            </div>
                           <div class="col-md-12" id="radios">
                           <label>Unit Payment Method</label>
                           <br>

                           <div class="form-check form-check-inline mb-3">
                            <input class="form-check-input" required type="radio" name="paymentmethod" id="inlineRadio1" value="sale">
                            <label class="form-check-label" for="inlineRadio1">Sale</label>
                            </div>
                            <div class="form-check form-check-inline mb-3">
                            <input class="form-check-input" required type="radio" name="paymentmethod" id="inlineRadio2" value="rent">
                            <label class="form-check-label" for="inlineRadio2">Rent</label>
                            </div>
                            <div class="form-check form-check-inline mb-3">
                            <input class="form-check-input" required type="radio" name="paymentmethod" id="inlineRadio3" value="defaultprice">
                            <label class="form-check-label" for="inlineRadio3">Default Price</label>
                            </div>
                           </div>
                           <div id="price2" class="row col-md-12 mb-3">
                                
                           </div>

                           <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Unit Type</label>
                                    <select name="unittype" required class="form-control form-control-lg form-control-a">
                                        <option>Appartment</option>
                                        <option>Town house</option>
                                        <option>Bent house
</option>
                                    
                                        <option>Chalet
</option>
<option>Villa
</option>
</select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Unit Image</label>
                                    <input type="file" name="fileToUpload" required class="form-control form-control-lg form-control-a">
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
            $("#radios").change(function(e){
                
                element_value = e.target.value;

                if(element_value == "sale"){
                    //console.log("s");
                    var s = `
                    <div class="col">
                                <div class="form-group">
                                    <label>Sale Installment Period</label>

                                    <input type="text" name="speriod" placeholder="Sale Installment Period" required class="form-control form-control-lg form-control-a">
                                    <div class="validation"></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Sale Price</label>

                                    <input type="number" step="any" name="sprice" placeholder="Sale Price" required class="form-control form-control-lg form-control-a">
                                    <div class="validation"></div>
                                </div>
                            </div>
                    `;
                    $("#price2").html(s);
                }
                else if(element_value == "rent"){
                    var s = `
                    <div class="col">
                                <div class="form-group">
                                    <label>Rent Period</label>

                                    <input type="text" name="rperiod" placeholder="Rent Period" required class="form-control form-control-lg form-control-a">
                                    <div class="validation"></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Rent Price</label>

                                    <input type="number" step="any" name="rprice" placeholder="Rent Price" required class="form-control form-control-lg form-control-a">
                                    <div class="validation"></div>
                                </div>
                            </div>
                    `;
                    $("#price2").html(s);
                }
                else{
                    //default
                    var s = `
                            <div class="col">
                                <div class="form-group">
                                    <label>Price</label>

                                    <input type="number" step="any" name="price" placeholder="Price" required class="form-control form-control-lg form-control-a">
                                    <div class="validation"></div>
                                </div>
                            </div>
                    `;
                    $("#price2").html(s);
                }
                
            });
        });
    </script>

</body>

</html>


<?php


if (isset($_POST["submit"])) {


        $name = $_POST['uname'];
        $description = $_POST['description'];
        $type = $_POST['unittype'];
        $paymentmethod = $_POST['paymentmethod'];
        //sale
        $speriod = $_POST['speriod'];
        $sprice = $_POST['sprice'];
        //rent
        $rperiod = $_POST['rperiod'];
        $rprice = $_POST['rprice'];
        //default
        $price = $_POST['price'];


        $idprojects = $_POST['projects'];

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

        if($paymentmethod == "sale"){
            $query = "insert into units (idprojects,uname,udescription,unittype,paymentmethod,image) values ('$idprojects','$name','$description','$type','$paymentmethod','$profile_pic')";
            $result = mysqli_query($con, $query);

            $lastid = mysqli_insert_id($con);
            $query2 = "insert into sale (idunits,saleinstallment,saleperiod) values ('$lastid','$sprice','$speriod')";
            $result2 = mysqli_query($con, $query2);


            if ($result && $result2) {
                $_SESSION['u_message'] = 'Your unit is created successfully';
                header('Location: allunits.php');
            } else {
                $_SESSION['eu_message'] = 'Your unit is not created, try again !!!!';
                header('Location: allunits.php');
            }

        }
        else if($paymentmethod == "rent"){

            $query = "insert into units (idprojects,uname,udescription,unittype,paymentmethod,image) values ('$idprojects','$name','$description','$type','$paymentmethod','$profile_pic')";
            $result = mysqli_query($con, $query);

            $lastid = mysqli_insert_id($con);
            $query2 = "insert into rent (idunits,rentprice,rentperiod) values ('$lastid','$rprice','$rperiod')";
            $result2 = mysqli_query($con, $query2);


            if ($result && $result2) {
                $_SESSION['u_message'] = 'Your unit is created successfully';
                header('Location: allunits.php');
            } else {
                $_SESSION['eu_message'] = 'Your unit is not created, try again !!!!';
                header('Location: allunits.php');
            }

        }
        else{

            $query = "insert into units (idprojects,uname,udescription,unittype,paymentmethod,image,price) values ('$idprojects','$name','$description','$type','$paymentmethod','$profile_pic','$price')";
            $result = mysqli_query($con, $query);

            if ($result) {
                $_SESSION['u_message'] = 'Your unit is created successfully';
                header('Location: allunits.php');
            } else {
                $_SESSION['eu_message'] = 'Your unit is not created, try again !!!!';
                header('Location: allunits.php');
            }
        }

        
    
                


}

?>
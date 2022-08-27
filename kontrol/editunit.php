<?php
ob_start();

include('connection.php');

$query = "SELECT idprojects, pname FROM projects";

$projects_dropdownlist = "<select name='projects' id='u_projects' required class='form-control'>";

if ($result = mysqli_query($con, $query)) {
    // Fetch one and one row
    while ($row = mysqli_fetch_row($result)) {
        $projects_dropdownlist .= "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
    }
}

$projects_dropdownlist .= "</select>"

?>
<div class="modal fade" id="editunitmodal" tabindex="-1" role="dialog" aria-labelledby="editunitmodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editunitmodalLabel"> Edit Unit </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="editunit.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <input type="hidden" name="u_id" id="u_id">
                    <input type="hidden" name="u_paymentmethod" id="u_paymentmethod">
                    <input type="hidden" name="u_price" id="u_price">
                    <input type="hidden" name="u_period" id="u_period">

                    <div class="row">
                        <div class="form-group col">
                            <label>Project</label>
                            <?php echo $projects_dropdownlist ?>
                        </div>

                        <div class="form-group col">
                            <label>Unit Name</label>
                            <input type="text" name="uname" required id="u_name" class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Unit Description</label>
                        <input type="text" name="udescription" required id="u_description" class="form-control">
                    </div>

                    <div class="form-group" id="radios">
                        <label>Unit Payment Method</label>
                        <br>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" required type="radio" name="paymentmethod" id="sale" value="sale">
                            <label class="form-check-label" for="sale">Sale</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" required type="radio" name="paymentmethod" id="rent" value="rent">
                            <label class="form-check-label" for="rent">Rent</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" required type="radio" name="paymentmethod" id="default" value="defaultprice">
                            <label class="form-check-label" for="default">Default Price</label>
                        </div>
                    </div>
                    <div id="price2" class="row">

                    </div>

                    <div class="row">

                        <div class="form-group col">
                            <label>Unit Type</label>
                            <!-- <select name="unittype" id="u_type" required class="form-control">
                                        <option>Appartment</option>
                                        <option>mixed</option>
                                        <option>Double</option>
                                    </select> -->

                            <select name="unittype" id="u_type" required class="form-control">
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

                        <div class="form-group col">
                            <label>Unit Image</label>
                            <input type="file" name="fileToUpload" class="form-control">
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-dark" type="submit" name="editunit">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>

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
    $(document).ready(function() {





        $("#radios").change(function(e) {

            element_value = e.target.value;

            if (element_value == "sale") {
                //console.log("s");
                var s = `
                    <div class="col">
                                <div class="form-group">
                                    <label>Sale Installment Period</label>

                                    <input type="text" name="speriod" placeholder="Sale Installment Period" required class="form-control">
                                    <div class="validation"></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Sale Price</label>

                                    <input type="number" step="any" name="sprice" placeholder="Sale Price" required class="form-control">
                                    <div class="validation"></div>
                                </div>
                            </div>
                    `;
                $("#price2").html(s);
            } else if (element_value == "rent") {
                var s = `
                    <div class="col">
                                <div class="form-group">
                                    <label>Rent Period</label>

                                    <input type="text" name="rperiod" placeholder="Rent Period" required class="form-control">
                                    <div class="validation"></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Rent Price</label>

                                    <input type="number" step="any" name="rprice" placeholder="Rent Price" required class="form-control">
                                    <div class="validation"></div>
                                </div>
                            </div>
                    `;
                $("#price2").html(s);
            } else {
                //default
                var s = `
                            <div class="col">
                                <div class="form-group">
                                    <label>Price</label>

                                    <input type="number" step="any" name="price" placeholder="Price" required class="form-control">
                                    <div class="validation"></div>
                                </div>
                            </div>
                    `;
                $("#price2").html(s);
            }

        });
    });
</script>

<?php

include("connection.php");

if (isset($_POST["editunit"])) {

    session_start();

    $name = $_POST['uname'];
    $description = $_POST['udescription'];
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

    $idunits = $_POST['u_id'];

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

    if ($paymentmethod == "sale") {

        if ($profile_pic == "") {

            $query = "UPDATE units SET idprojects = '$idprojects', price = 0,
            uname = '$name',udescription = '$description',unittype = '$type',paymentmethod = '$paymentmethod' WHERE idunits = '$idunits'";
            $result = mysqli_query($con, $query);
        } else {
            $query = "UPDATE units SET idprojects = '$idprojects', price = 0,
            uname = '$name',udescription = '$description',unittype = '$type',paymentmethod = '$paymentmethod', image = '$profile_pic' WHERE idunits = '$idunits'";
            $result = mysqli_query($con, $query);
        }

        $query3 = "DELETE FROM sale WHERE idunits = '$idunits' and idsale>0 ";
        $result3 = mysqli_query($con, $query3);

        $query3 = "DELETE FROM rent WHERE idunits = '$idunits' and idrent>0 ";
        $result3 = mysqli_query($con, $query3);

        $query2 = "insert into sale (idunits,saleinstallment,saleperiod) values ('$idunits','$sprice','$speriod')";
        $result2 = mysqli_query($con, $query2);


        if ($result && $result2) {
            $_SESSION['u_message'] = 'Your unit is updated successfully';
            header('Location: allunits.php');
        } else {
            $_SESSION['eu_message'] = 'Your unit is not updated, try again !!!!';
            header('Location: allunits.php');
        }
    } else if ($paymentmethod == "rent") {

        if ($profile_pic == "") {

            $query = "UPDATE units SET idprojects = '$idprojects', price = 0,
            uname = '$name',udescription = '$description',unittype = '$type',paymentmethod = '$paymentmethod' WHERE idunits = '$idunits'";
            $result = mysqli_query($con, $query);
        } else {
            $query = "UPDATE units SET idprojects = '$idprojects', price = 0,
            uname = '$name',udescription = '$description',unittype = '$type',paymentmethod = '$paymentmethod', image = '$profile_pic' WHERE idunits = '$idunits'";
            $result = mysqli_query($con, $query);
        }


        $query3 = "DELETE FROM sale WHERE idunits = '$idunits' and idsale>0 ";
        $result3 = mysqli_query($con, $query3);

        $query3 = "DELETE FROM rent WHERE idunits = '$idunits' and idrent>0 ";
        $result3 = mysqli_query($con, $query3);

        $query2 = "insert into rent (idunits,rentprice,rentperiod) values ('$idunits','$rprice','$rperiod')";
        $result2 = mysqli_query($con, $query2);

        if ($result && $result2) {
            $_SESSION['u_message'] = 'Your unit is updated successfully';
            header('Location: allunits.php');
        } else {
            $_SESSION['eu_message'] = 'Your unit is not updated, try again !!!!';
            header('Location: allunits.php');
        }
    } else {

        if ($profile_pic == "") {

            $query = "UPDATE units SET idprojects = '$idprojects', price = '$price',
            uname = '$name',udescription = '$description',unittype = '$type',paymentmethod = '$paymentmethod' WHERE idunits = '$idunits'";
            $result = mysqli_query($con, $query);
        } else {
            $query = "UPDATE units SET idprojects = '$idprojects', price = '$price',
            uname = '$name',udescription = '$description',unittype = '$type',paymentmethod = '$paymentmethod', image = '$profile_pic' WHERE idunits = '$idunits'";
            $result = mysqli_query($con, $query);
        }

        $query3 = "DELETE FROM sale WHERE idunits = '$idunits' and idsale>0 ";
        $result3 = mysqli_query($con, $query3);

        $query3 = "DELETE FROM rent WHERE idunits = '$idunits' and idrent>0 ";
        $result3 = mysqli_query($con, $query3);

        if ($result) {
            $_SESSION['u_message'] = 'Your unit is updated successfully';
            header('Location: allunits.php');
        } else {
            $_SESSION['eu_message'] = 'Your unit is not updated, try again !!!!';
            header('Location: allunits.php');
        }
    }
}


?>
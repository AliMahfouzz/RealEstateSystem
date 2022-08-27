<div class="modal fade" id="editprojectmodal" tabindex="-1" role="dialog" aria-labelledby="editprojectmodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editprojectmodalLabel"> Edit Project </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="editproject.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <input type="hidden" name="p_id" id="p_id">

                    <div class="form-group">
                        <label>Project Name</label>
                        <input type="text" name="name" required id="p_name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Project Description</label>
                        <input type="text" name="description" required id="p_description" class="form-control">
                    </div>

                    <div id="dates" class="row">

                        <div class="form-group col">
                            <label>Start Date</label>

                            <input type="date" id="sdate" required name="sdate" class="form-control">
                            <div class="validation"></div>
                        </div>
                        <div class="form-group col">
                            <label>End Date</label>

                            <input name="edate" id="edate" required type="date" class="form-control">
                            <div class="validation"></div>
                        </div>
                    </div>

                    <div id="error_messages">

                    </div>



                    <div class="form-group">
                        <label>Project Image</label>
                        <input type="file" name="fileToUpload" class="form-control">
                    </div>


                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
                    <input class="btn btn-success" type="submit" id="submit1" name="editproject" value="Update">
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
        $(document).ready(function(){
            $("#dates").change(function(e){
                var element_id = e.target.id;
                var from_date = $("#sdate").val();
                var to_date = $("#edate").val();


                if(new Date(from_date) <= new Date(to_date))
                {//compare end <=, not >=
                    //your code here
                    $("#error_messages").html("");
                    $("#submit1").prop('disabled', false);
                }
                else{
                    $("#submit1").prop('disabled', true);
                    $("#error_messages").html("<span class='text-danger'>Start date should be less than end date</span>");
                }
            });
        });
    </script>

<?php
    include('connection.php');

    if(isset($_POST["editproject"])){
        $name = $_POST['name'];
        $description = $_POST['description'];
        $sdate = $_POST['sdate'];
        $edate = $_POST['edate'];

        $idprojects = $_POST["p_id"];

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

        if($profile_pic != ""){
            $query = "UPDATE projects SET pname = '$name', description = '$description',startdate = '$sdate',enddate = '$edate',image = '$profile_pic' WHERE idprojects = '$idprojects'";
            $result = mysqli_query($con, $query);
        }
        else{
            $query = "UPDATE projects SET pname = '$name', description = '$description',startdate = '$sdate',enddate = '$edate' WHERE idprojects = '$idprojects'";
            $result = mysqli_query($con, $query);
        }
        
        if ($result) {
            $_SESSION['p_message'] = 'Your project is created successfully';
            header('Location: projects.php');
        } else {
            $_SESSION['ep_message'] = 'Your project is not created, try again !!!!';
            header('Location: projects.php');
        }

    }
?>
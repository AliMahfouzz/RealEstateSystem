
 <div class="modal fade" id="approvepaymentmodal" tabindex="-1" role="dialog" aria-labelledby="approvepaymentmodalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="approvepaymentmodalLabel"> Approve Client Payment </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="approvepayment.php" method="POST">

                    <div class="modal-body">
                        <input type="hidden" name="pp_id" id="pp_id">

                        <h4> Do you want to Approve this payment ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit" name="approveuser">Yes !! Approve it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


 <?php


        if (isset($_POST["approveuser"])) {
            include("connection.php");

            $pp_id = $_POST["pp_id"];

            // echo var_dump($_POST);
            

            if($pp_id != ""){
                $query = "UPDATE broker_applies SET paid = ? WHERE idbroker_applies = ?";

                $stmt = $con->prepare($query);

                $approved = 1;

                $id = (int)$_POST["pp_id"];

                $stmt->bind_param('ii', $approved, $id);

                $stmt->execute();

                if ($stmt) {
                    header("Location: vieworders.php");
                    exit();
                } else {
                    header("Location: vieworders.php");
                    exit();
                }
            }
            
            
            
        }


    ?>
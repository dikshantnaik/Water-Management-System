<?php
 session_start();
    include('connection.php');
    include('utils.php');
include 'includes/auth_validate.php';

if(isset($_GET['edit_customer'])){
    error_log("helo");
    try{    
        $sql = "UPDATE customer SET customer_name = ? , customer_phone = ?  WHERE customer_id = ".$_GET['id'];
        $stmt = $con->prepare($sql);
        $stmt->bind_param("si", $_GET['customer_name'], $_GET['customer_phone']);
        $stmt->execute();
        
       $_SESSION['success'] = "Edited Success";
        redirect("customer.php");
        
    }
    catch(mysqli_sql_exception $err){
        if(mysqli_errno($con)===1062){
            alert_box("Phone no. Exists");
        }
        alert_box(mysqli_error($con));
    } 

}
    
    $sql = "SELECT* from customer WHERE customer_id = ".$_GET['id'];
    $result = $con->query($sql);
    
include_once('includes/header.php'); 

?>



<section id="page-wrapper">
    <div class="container">
        <h2>Edit customer Details </h2>
        <hr>
        <form class="form" action="edit_customer.php">
            <?php while($row = $result->fetch_assoc()) { ?>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">customer Name:</label>
                <div class="col-sm-10">
                    <input style="width:40%" type="text" value="<?php echo $row['customer_name'] ?>"
                        class="form-control" placeholder="customer Name" name="customer_name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Contact :</label>
                <div class="col-sm-10">
                    <input style="width:40%" type="number" value="<?php echo $row['customer_phone'] ?>"
                        class="form-control" placeholder="Contact" name="customer_phone">
                </div>
            </div>

    </div>
    <div class="form-group">
        <input type="hidden" name="id" value="<?php echo $row['customer_id'] ?>">
        <div class=" col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default" name="edit_customer" value="add_customer">Submit</button>
        </div>
    </div>
    <?php } ?>
    </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
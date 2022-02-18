<?php
session_start();
include('connection.php');
include('utils.php');
include 'includes/auth_validate.php';
 if(isset($_GET['add_customer'])){
    
    try{    
        $sql = "INSERT INTO customer VALUES (NULL,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $_GET['customer_name'], $_GET['customer_phone']);
        $stmt->execute();
        // alert_box("Vendors Data Added");
       $_SESSION['success'] = "Added Success";
        redirect('customer.php');
        exit;
        
    }
    catch(mysqli_sql_exception $err){
        if(mysqli_errno($con)===1062){
            alert_box("Phone no. Exists".mysqli_error($con));
        }else{
        alert_box(mysqli_error($con));}
    } finally{
        $stmt->close;
        $con->close;
    }
    
    
    
}
include_once('includes/header.php'); 

?>


<style>
.form-group {
    padding-bottom: 2%;
}
</style>
<section id="page-wrapper">
    <div class="container">
        <h2>Add Vendor Details </h2>
        <hr>
        <form class="form" action="add_customer.php">
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Customer Name:</label>
                <div class="col-sm-10">
                    <input style="width:40%" type="text" class="form-control" placeholder="Vendor Name"
                        name="customer_name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Contact :</label>
                <div class="col-sm-10">
                    <input style="width:40%" type="number" class="form-control" placeholder="Contact"
                        name="customer_phone">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="add_customer"
                        value="add_customer">Submit</button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php include '/includes/footer.php'; ?>
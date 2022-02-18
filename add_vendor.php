<?php
session_start();
include('connection.php');
include('utils.php');
include 'includes/auth_validate.php';

 if(isset($_GET['add_vendor'])){
    
    try{    
        $sql = "INSERT INTO vendor VALUES (NULL,?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssss", $_GET['vendor_name'], $_GET['vendor_phone'],$_GET['product_id'],
                                   $_GET['vendor_quantity'],$_GET['vendor_price']);
        $stmt->execute();
        // alert_box("Vendors Data Added");
        // header('Location:vendors.php');
       $_SESSION['success'] = "Added Success";
        redirect("vendors.php");
        
    }
    catch(mysqli_sql_exception $err){
        if(mysqli_errno($con)===1062){
            alert_box("Phone no. Exists".mysqli_error($con));
        }
        // alert_box(mysqli_errno($con));
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
        <form class="form" action="add_vendor.php">
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Vendor Name:</label>
                <div class="col-sm-10">
                    <input style="width:40%" type="text" class="form-control" placeholder="Vendor Name"
                        name="vendor_name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Contact :</label>
                <div class="col-sm-10">
                    <input style="width:40%" type="number" class="form-control" placeholder="Contact"
                        name="vendor_phone">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Product</label>
                    <div class="col-sm-10">
                        <select style="width:40%" type="text" aria-label="Default select example" class="form-control"
                            placeholder="Vendor Name" name="product_id">
                            <?php 
                            $sql = "SELECT* from products ";
                            $result = $con->query($sql);
                             while($row = $result->fetch_assoc()) {
                             ?>
                            <option value="<?php echo $row['product_id'] ?>">
                                <?php echo $row["product_category"]."--".$row['product_name'] ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Quantity :</label>
                <div class="col-sm-10">
                    <input style="width:40%" type="number" class="form-control" placeholder="Quantity"
                        name="vendor_quantity">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Price:</label>
                <div class="col-sm-10">
                    <input style="width:30%" type="number" class="form-control" placeholder="Price "
                        name="vendor_price">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="add_vendor" value="add_vendor">Submit</button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php include '/includes/footer.php'; ?>
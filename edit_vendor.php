<?php
 session_start();
    include('connection.php');
    include('utils.php');
include 'includes/auth_validate.php';

if(isset($_GET['edit_vendor'])){
    error_log("helo");
    try{    
        $sql = "UPDATE vendor SET vendor_name = ? , vendor_phone = ? ,product_id = ?, 
                                  vendor_quantity = ? , vendor_price = ? WHERE id = ".$_GET['id'];
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssss", $_GET['vendor_name'], $_GET['vendor_phone'],$_GET['product_id'],
                                   $_GET['vendor_quantity'],$_GET['vendor_price']);
        $stmt->execute();
        
       $_SESSION['success'] = "Edited Success";
        redirect("vendors.php");
        
    }
    catch(mysqli_sql_exception $err){
        if(mysqli_errno($con)===1062){
            alert_box("Phone no. Exists");
        }
        // alert_box(mysqli_errno($con));
    } 

}
    
    $sql = "SELECT* from vendor WHERE id = ".$_GET['id'];
    $result = $con->query($sql);
    
include_once('includes/header.php'); 

?>



<section id="page-wrapper">
    <div class="container">
        <h2>Edit Vendor Details </h2>
        <hr>
        <form class="form" action="edit_vendor.php">
            <?php while($row = $result->fetch_assoc()) { ?>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Vendor Name:</label>
                <div class="col-sm-10">
                    <input style="width:40%" type="text" value="<?php echo $row['vendor_name'] ?>" class="form-control"
                        placeholder="Vendor Name" name="vendor_name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Contact :</label>
                <div class="col-sm-10">
                    <input style="width:40%" type="number" value="<?php echo $row['vendor_phone'] ?>"
                        class="form-control" placeholder="Contact" name="vendor_phone">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Product Catgory</label>
                    <div class="col-sm-10">
                        <select style="width:40%" type="text" aria-label="Default select example" class="form-control"
                            placeholder="Vendor Name" name="product_id">

                            <?php 
                            $sql1 = "SELECT* from products ";
                            $result1 = $con->query($sql1);
                             while($row1 = $result1->fetch_assoc()) {
                             ?>
                            <option value="<?php echo $row1['product_id'] ?>">
                                <?php echo $row1["product_category"]."--".$row1['product_name'] ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Product :</label>
                    <div class="col-sm-10">
                        <input style="width:40%" type="text" value="<?php echo $row['vendor_product'] ?>"
                            class="form-control" placeholder="Product " name="vendor_product">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Quantity :</label>
                    <div class="col-sm-10">
                        <input style="width:40%" type="number" value="<?php echo $row['vendor_quantity'] ?>"
                            class="form-control" placeholder="Quantity" name="vendor_quantity">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Price:</label>
                    <div class="col-sm-10">
                        <input style="width:30%" type="number" value="<?php echo $row['vendor_price'] ?>"
                            class="form-control" placeholder="Price " name="vendor_price">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label><input type="checkbox" name="remember"> Remember me</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                    <div class=" col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default" name="edit_vendor"
                            value="add_vendor">Submit</button>
                    </div>
                </div>
                <?php } ?>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
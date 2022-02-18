<?php
 session_start();
    include('connection.php');
    include('utils.php');
if(isset($_GET['buy'])){
    
    try{    
        $sql1 = "UPDATE `products` SET `product_stock` = product_stock +" .$_GET['vendor_quantity'] . " WHERE `products`.`product_id` = " . $_GET['product_id'];
        $con->query($sql1);
        error_log($sql1);
        // $total = $_GET['vendor_quantity'] * $_GET['vendor']
        $sql = "INSERT INTO orders VALUES (NULL,0,?,NULL,0,'pending',CURRENT_TIMESTAMP)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $_GET['id']);
        $stmt->execute();
        
        // alert_box("Vendors Data Added");
        // header('Location:vendors.php');
       $_SESSION['success'] = "Edited Success";
		// header('Location:vendors.php');
        redirect("vendors.php");
        
    }
    catch(mysqli_sql_exception $err){
        if(mysqli_errno($con)===1062){
            alert_box("Phone no. Exists");
        }
        alert_box(mysqli_error($con));
    } 

}
    
    $sql = "SELECT* from vendor,products WHERE vendor.product_id = products.product_id and id = ".$_GET['id'];
    $result = $con->query($sql);
    
include_once('includes/header.php'); 

?>



<section id="page-wrapper">
    <div class="container">
        <h2>Confirm Buy ?</h2>
        <hr>
        <form class="form" action="buy.php">
            <?php while($row = $result->fetch_assoc()) { ?>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Vendor Name:</label>
                <div class="col-sm-10">
                    <label style="font-weight :normal;"> <?php echo $row['vendor_name'] ?></label>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Contact :</label>
                <div class="col-sm-10">
                    <label style="font-weight :normal;"> <?php echo $row['vendor_phone'] ?></label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Product Catgory</label>
                    <div class="col-sm-10">
                        <label style="font-weight :normal;"> <?php echo $row['product_category'] ?></label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Product :</label>
                    <div class="col-sm-10">
                        <label style="font-weight :normal;"> <?php echo $row['product_name'] ?></label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Quantity :</label>
                    <div class="col-sm-10">
                        <label style="font-weight :normal;"> <?php echo $row['vendor_quantity'] ?></label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Price:</label>
                    <div class="col-sm-10">
                        <label style="font-weight :normal;"> <?php echo $row['vendor_price'] ?></label>
                    </div>
                </div>

            </div>
            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                <input type="hidden" name="vendor_quantity" value="<?php echo $row['vendor_quantity'] ?>">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>">
                <div class=" col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success" name="buy" value="buy">Buy</button>
                </div>
            </div>
            <?php } ?>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
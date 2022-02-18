<?php
 session_start();
    include('connection.php');
    include('utils.php');
include 'includes/auth_validate.php';

if(isset($_GET['edit_product'])){
    error_log("helo");
    try{    
        $sql = "UPDATE products SET product_category= ? , product_name = ? ,product_price=?,product_stock = ? WHERE product_id = ".$_GET['id'];
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssss", $_GET['product_category'], $_GET['product_name'], $_GET['product_price'], $_GET['product_stock']);
        $stmt->execute();
        
       $_SESSION['success'] = "Edited Success";
        redirect('product.php');
        
    }
    catch(mysqli_sql_exception $err){
        if(mysqli_errno($con)===1062){
            alert_box("Phone no. Exists");
        }
        alert_box(mysqli_error($con));
    } 

}
    
    $sql = "SELECT * from products WHERE product_id = ".$_GET['id'];
    $result = $con->query($sql);
    
include_once('includes/header.php'); 

?>



<section id="page-wrapper">
    <div class="container">
        <h2>Edit product Details </h2>
        <hr>
        <form class="form" action="edit_product.php">
            <?php while($row = $result->fetch_assoc()) { ?>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Product Name:</label>
                <div class="col-sm-10">
                    <input style="width:40%" type="text" value="<?php echo $row['product_name'] ?>" class="form-control"
                        placeholder="product Name" name="product_name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Product Category:</label>
                <div class="col-sm-10">
                    <input style="width:40%" type="text" value="<?php echo $row['product_category'] ?>"
                        class="form-control" placeholder="product Name" name="product_category">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Product Price:</label>
                <div class="col-sm-10">
                    <input style="width:40%" type="number" value="<?php echo $row['product_price'] ?>"
                        class="form-control" placeholder="product Name" name="product_price">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Product Stock:</label>
                <div class="col-sm-10">
                    <input style="width:40%" type="text" value="<?php echo $row['product_stock'] ?>"
                        class="form-control" placeholder="product Name" name="product_stock">
                </div>
            </div>



    </div>
    <div class="form-group">
        <input type="hidden" name="id" value="<?php echo $row['product_id'] ?>">
        <div class=" col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default" name="edit_product" value="add_product">Submit</button>
        </div>
    </div>
    <?php } ?>
    </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
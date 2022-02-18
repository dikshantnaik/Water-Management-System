<?php
session_start();
include('connection.php');
include('utils.php');
include 'includes/auth_validate.php';

 if(isset($_GET['add_product'])){
    
    try{    
        $sql = "INSERT INTO products VALUES (NULL,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssss", $_GET['product_category'], $_GET['product_name'], $_GET['product_price'], $_GET['product_stock']);
        $stmt->execute();
       $_SESSION['success'] = "Added Success";
        redirect("products.php");
        
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
        <h2>Add Products Details </h2>
        <hr>
        <form class="form" action="add_product.php">
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Product Category:</label>
                <div class="col-sm-10">
                    <input style="width:40%" type="text" class="form-control" placeholder="Product Category"
                        name="product_category">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Product Name:</label>
                <div class="col-sm-10">
                    <input style="width:40%" type="text" class="form-control" placeholder="Product Name"
                        name="product_name">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Product Price:</label>
                <div class="col-sm-10">
                    <input style="width:40%" type="number" class="form-control" placeholder="Product Price"
                        name="product_price">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Product Stock :</label>
                <div class="col-sm-10">
                    <input style="width:40%" type="number" class="form-control" placeholder="Product Stock "
                        name="product_stock">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="add_product" value="add_product">Submit</button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php include '/includes/footer.php'; ?>
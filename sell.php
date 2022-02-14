<?php
 session_start();
 
    include('connection.php');
    include('utils.php');
    include 'includes/auth_validate.php';
try{
    if(isset($_GET['sell'])){
        $product_id=  $_GET['product_id'];
        $product_quantity = $_GET['product_quantity'];
    // for ($i=0; $i < count($product_id); $i++) { 
    //     //Checking is quantity is not null
    //     if($product_quantity[$i]==null){
    //         $_SESSION['failure'] = "Enter Currecly";
    //     }
    //     else{$cool=true; }
    //     // If Quantity was't Null Cotinue
    // } 
    $cool = true;
    if($cool){
        //Creating an order id 
    $sql = "INSERT INTO orders VALUES (NULL,1,NULL,?,0,CURRENT_TIMESTAMP)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $_GET['id']);
            $stmt->execute();

            //Getting the last order id 
            $order_id = $con->query("select * from orders order by order_id desc limit 1");
            $order_id = $order_id->fetch_assoc();
            $order_id=  $order_id["order_id"];
    for ($i=0; $i < count($product_id); $i++) { 
        // $price_row = $con->query("Select product_price FROM products WHERE products_id = ".$product_id);
        // $product_price = $price_row->fetch_assoc();
        // $product_price = $product_price['product_price'];
        
        if($product_quantity[$i]!=null && $product_id[$i]){
        //Insertign all the products
        $sql = "INSERT INTO orders_product VALUES (NULL,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sss",$order_id,$product_id[$i],$product_quantity[$i]);
        $stmt->execute();
        
        $sql1 = "UPDATE `products` SET `product_stock` = product_stock -" .$product_quantity[$i]  . " WHERE `products`.`product_id` = " . $product_id[$i];
        $con->query($sql1);
        }
        header('Location:bill.php?order_id='.$order_id);
    }
    }
    }
    
}
catch(mysqli_sql_exception $err){
  
    alert_box(mysqli_error($con));
} 
    
    $sql = "SELECT * from customer WHERE customer_id = ".$_GET['id'];
    $result = $con->query($sql);
    
    $sql2 = "Select * FROM products";
    $result2 = $con->query($sql2);
    
include_once('includes/header.php'); 

?>



<section id="page-wrapper">
    <?php include 'includes/flash_messages.php'?>
    <div class="container">
        <h2>Sell Prodocut</h2>
        <hr>
        <form class="form" action="sell.php">
            <?php while($row = $result->fetch_assoc()) { ?>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Customer Name:</label>
                <!-- <div class="col"> -->
                <?php echo $row['customer_name'] ?>
                <!-- </div> -->
            </div>
            <div class=" form-group">
                <label class="control-label col-sm-2" for="pwd">Contact :</label>
                <div class="col-sm-10">
                    <?php echo $row['customer_phone'] ?>

                </div>

            </div>

    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Chose Product :</label>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Stocks</th>
                        <th scope="col">Quantity</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while($row2 = $result2->fetch_assoc()) { ?>
                    <tr>
                        <td>
                            <div class="input-group-text">
                                <input type="checkbox" name="product_id[]" value="<?php echo $row2['product_id'] ?>"
                                    aria-label="Checkbox for following text input">
                            </div>
                        </td>
                        <td> <?php echo  $row2['product_name'] ."--". $row2['product_category'] ?></td>
                        <td><?php echo $row2['product_price'] ?></td>
                        <td><?php echo $row2['product_stock'] ?></td>
                        <td><input type="number" name="product_quantity[]">
                        </td>

                    </tr>
                    <?php } ?>

                </tbody>
            </table>

        </div>
    </div>
    <div class=" form-group">
        <input type="hidden" name="id" value="<?php echo $row['customer_id'] ?>">
        <div class=" col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default" name="sell" value="add_customer">Submit</button>
        </div>
    </div>
    </form>
    <?php } ?>
    </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
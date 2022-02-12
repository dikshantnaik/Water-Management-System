<?php
session_start();

include 'connection.php';
include 'utils.php';

if(isset($_GET['search'])){
$sql = "Select * from orders 
        WHERE order LIKE \"%" .$_GET['search'] ."%\" 
        OR customer_phone LIKE \"%".$_GET['search']."%\"";
}
else{
$sql = "
    SELECT
        orders.order_id as order_id,
        customer.customer_name as customer_name,
        
        products.product_name AS product_name,
        orders_product.quantity AS product_quantity,
        orders.payment_status AS payment_status,
        customer.customer_id AS customer_id,
        orders.date as date
    FROM
        `orders_product`,
        customer,
        
        products,
        orders
    WHERE
        orders_product.order_id = orders.order_id
        AND products.product_id = orders_product.product_id AND 
        orders.customer_id = customer.customer_id AND 
        orders.type = 1
        
    ORDER BY
        orders.order_id;
";
}
try {
    $customers = $con->query($sql);
} catch (Exception $th) {
    echo $th;
}

include('includes/header.php');
?>

<!-- Main container -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <a href="customers.php">
                <h1 class="page-header " style="color:black;">Customer</h1>
            </a>
        </div>

    </div>
    <?php include 'includes/flash_messages.php'?>

    <!-- Filters -->
    <div class="well text-center filter-form ce">

        <form class="form form-inline" action="">
            <label for="input_search">Search</label>
            <input type="text" class="form-control" id="input_search" name="search" placeholder="Name/Contact"
                value="<?php if(isset($_GET['search_str'])) echo $search_data?>">

            <input type="submit" value="Go" class="btn btn-primary">
        </form>
        <?php if(isset($_GET['search'])){ ?>
        <a class="btn btn-primary" href="customer.php">Back</a>
        <?php } ?>
        <a href="add_customer.php" class="btn btn-success" style="float: right;">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus"
                viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                </path>
            </svg>
            <h4>Add Customer</h4>
        </a>
    </div>
    <hr>
    <!-- //Filters -->

    <!-- Table -->
    <table style="text-align:center" class="table table-striped table-bordered table-condensed">
        <thead>
            <tr style="text-align:center">
                <th style="text-align:center" width="6%">Order ID</th>
                <th style="text-align:center" width="15%">Cusmer Name</th>
                <th style="text-align:center" width="15%">Product </th>
                <th style="text-align:center" width="15%">Quantity</th>
                <th style="text-align:center" width="15%">Payment Status </th>
                <th style="text-align:center" width="15%">Date</th>
                <th style="text-align:center" width="15%">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
            <tr>
                <td style="text-align:center"><?php echo $customer["order_id"]?></td>


                <td style="text-align:center"><a
                        href="customer.php?search=<?php echo $customer['customer_name']?>"><?php echo $customer["customer_name"]?></a>
                </td>
                <td style="text-align:center"><?php echo $customer["product_name"]?></td>
                <td style="text-align:center"><?php echo $customer["product_quantity"]?></td>
                <td style="text-align:center">
                    <?php 
                        if($customer['payment_status']=="1"){ 
                            echo '<span class="badge badge-success" style="background-color:green">Paid</span>'; 
                            } else echo '<span class="badge badge-primary " style="background-color:#ffc107 ">Pending</span>'?>




                </td>
                <td style="text-align:center"><?php echo $customer["date"]?></td>
                <td>

                    <a class="btn btn-primary btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top"
                        href="edit_customer.php?id=<?php print_r($customer["customer_id"]) ?> " title="Edit"><i
                            class="fa fa-edit"></i></a>


                    <a class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top"
                        href="utils.php?delete_customer=true&id=<?php print_r($customer["customer_id"]) ?> "
                        title="Delete"><i class="fa fa-trash"></i></a>
                    <a class="btn btn-warning" href="sell.php?id= <?php print_r($customer["customer_id"]) ?>">BILL</a>
                </td>

            </tr>
            <!-- Delete Confirmation Modal -->
            <!-- //Delete Confirmation Modal -->
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- //Table -->

    <!-- Pagination -->
    <div class="text-center">


        <?php
//    $pagination->labels('Previous', 'Next');
//    echo $pagination->render();?>
    </div>
    <!-- //Pagination -->
</div>
<!-- //Main container -->


<?php include 'includes/footer.php'; ?>
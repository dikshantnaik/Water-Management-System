<?php
session_start();

include 'connection.php';
include 'utils.php';
include 'includes/auth_validate.php';
$Server_url = $_SERVER['SERVER_NAME']."/bill.php?order_id=";
$msg = "Hello your Order has been Recorded \nPlease check the link to check the bill here \n".$Server_url;
if(isset($_GET['search'])){
$sql = " SELECT
    orders.order_id AS order_id,
    customer.customer_name AS customer_name,
    customer.customer_phone AS customer_phone,
    orders.payment_status AS payment_status,
    customer.customer_id AS customer_id,
    orders.date AS date
FROM
    `orders_product`,
    customer,
    products,
    orders
WHERE
    orders_product.order_id = orders.order_id AND products.product_id = orders_product.product_id AND orders.customer_id = customer.customer_id AND orders.type = 1
    AND orders.order_id LIKE '%".$_GET['search']."%' OR customer_name LIKE \"%".$_GET['search']."%\"
GROUP BY
    orders.order_id
ORDER BY
    orders.order_id
        ";}
else{
$sql = " SELECT
    orders.order_id AS order_id,
    customer.customer_name AS customer_name,
    customer.customer_phone AS customer_phone,
    orders.payment_status AS payment_status,
    customer.customer_id AS customer_id,
    orders.date AS date,
    orders.total
FROM
    `orders_product`,
    customer,
    products,
    orders
WHERE
    orders_product.order_id = orders.order_id AND products.product_id = orders_product.product_id AND orders.customer_id = customer.customer_id AND orders.type = 1
GROUP BY
    orders.order_id
ORDER BY
    orders.order_id
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
                <h1 class="page-header " style="color:black;">Orders</h1>
            </a>
        </div>

    </div>
    <?php include 'includes/flash_messages.php'?>

    <!-- Filters -->
    <div class="well text-center filter-form ce">


        <form class="form form-inline" style="display:flex " action="">
            <label for="input_search" style="margin-top:5px">Search</label>
            <input type="text" class="form-control" style="margin-left:5px" id="input_search" name="search"
                placeholder="Name/Order ID" value="<?php if(isset($_GET['search_str'])) echo $search_data?>">

            <input type="submit" style="margin-left:5px" value="Go" class="btn btn-primary">
        </form>
        <?php if(isset($_GET['search'])){ ?>
        <a class="btn btn-primary" href="orders.php">Back</a>
        <?php } ?>
        <!-- <a href="add_customer.php" class="btn btn-success" style="float: right;">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus"
                viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                </path>
            </svg>
            <h4>Add Customer</h4>
        </a> -->
    </div>
    <hr>
    <!-- //Filters -->

    <!-- Table -->
    <table style="text-align:center" class="table table-striped table-bordered table-condensed">
        <thead>
            <tr style="text-align:center">
                <th style="text-align:center" width="6%">Order ID</th>
                <th style="text-align:center" width="15%">Customer Name</th>

                <th style="text-align:center" width="15%">Payment Status </th>
                <th style="text-align:center" width="15%">Date</th>
                <th style="text-align:center" width="15%">Total </th>
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

                <td style="text-align:center">
                    <?php 
                        if($customer['payment_status']=="paid"){ 
                            echo '<a href="utils.php?payment_status=pending&order_id='.$customer["order_id"].'"> <span class="badge badge-success" style="background-color:green">Paid</span></a> '; 
                            } else echo '<a href="utils.php?payment_status=paid&order_id='.$customer["order_id"].'"> <span class="badge badge-primary " style="background-color:#ffc107 ">Pending</span> </a>'?>




                </td>
                <td style="text-align:center"><?php echo $customer["date"]?></td>
                <td style="text-align:center"><?php echo $customer["total"]?></td>
                <td>

                    <a class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top"
                        target="_blank"
                        href="https://wa.me/91<?php echo $customer["customer_phone"]."/?text=".$msg.$customer['order_id']; ?>"
                        title=" Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-whatsapp" viewBox="0 0 16 16">
                            <path
                                d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                        </svg>
                    </a>
                    <i class="bi bi-whatsapp"></i>
                    <a class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top"
                        href="utils.php?delete_order=true&id=<?php print_r($customer["order_id"]) ?> " title="Delete"><i
                            class="fa fa-trash"></i></a>
                    <a class="btn btn-warning" href="bill.php?order_id=<?php echo($customer["order_id"]) ?>">BILL</a>
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
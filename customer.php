<?php
session_start();

include 'connection.php';
include 'utils.php';

if(isset($_GET['search'])){
$sql = "Select * from customer 
        WHERE customer_name LIKE \"%" .$_GET['search'] ."%\" 
        OR customer_phone LIKE \"%".$_GET['search']."%\"";
}
else{
$sql = "Select * from customer";
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
                <th style="text-align:center" width="15%">Customer Name</th>
                <th style="text-align:center" width="15%">Contact no</th>

                <th style="text-align:center" width="15%">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
            <tr>
                <td style="text-align:center"><?php echo $customer["customer_name"]?></td>

                <td style="text-align:center"><?php echo $customer["customer_phone"]?></td>

                <td>
                    <form action="edit_customer">
                        <a class="btn btn-primary" type=" submit" name="id"
                            href="edit_customer.php?id=<?php print_r($customer["customer_id"]) ?> ">Edit</a>
                        <a class="btn btn-danger" type="submit" name="id"
                            href="utils.php?delete_customer=true&id=<?php print_r($customer["customer_id"]) ?> ">Delete</a>
                    </form>
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
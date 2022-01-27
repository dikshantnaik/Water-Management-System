<?php
session_start();
include 'connection.php';
// require_once 'config/config.php';
// error_reporting(E_ALL);
// ini_set('display_errors', 'On');
// define('BASE_PATH', dirname(dirname(__FILE__)));
// define('APP_FOLDER', 'simpleadmin');
// define('CURRENT_PAGE', basename($_SERVER['REQUEST_URI']));
// require_once 'includes/auth_validate.php';

// //require_once BASE_PATH . '/includes/auth_validate.php';
// include "../vendor/autoload.php";
// require_once '../vendor/stefangabos/zebra_pagination/Zebra_Pagination.php';

if(isset($_GET['search'])){
$sql = "Select * from vendor 
        WHERE vendor_name LIKE \"%" .$_GET['search'] ."%\" 
        OR vendor_phone LIKE \"%".$_GET['search']."%\"";
}
else{
$sql = "Select * from vendor";
}
try {
    $vendors = $con->query($sql);
} catch (Exception $th) {
    echo $th;
}

?>


</script>
<?php include_once('includes/header.php'); ?>
<!-- Main container -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <a href="vendors.php">
                <h1 class="page-header " style="color:black;">Vendors</h1>
            </a>
        </div>

    </div>


    <!-- Filters -->
    <div class="well text-center filter-form ce">

        <form class="form form-inline" action="">
            <label for="input_search">Search</label>
            <input type="text" class="form-control" id="input_search" name="search" placeholder="Name/Contact"
                value="<?php if(isset($_GET['search_str'])) echo $search_data?>">

            <input type="submit" value="Go" class="btn btn-primary">
        </form>
        <?php if(isset($_GET['search'])){ ?>
        <a class="btn btn-primary" href="vendors.php">Back</a>
        <?php } ?>
        <a href="add_vendor.php" class="btn btn-success" style="float: right;">Add Vendors</a>
    </div>
    <hr>
    <!-- //Filters -->

    <!-- Table -->
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th width="20%">Vendor Name</th>
                <th width="20%">Contact no</th>
                <th width="20%">Product</th>
                <th width="10%">Quantity</th>
                <th width="10%">Price</th>
                <th width="15%">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendors as $vendor): ?>
            <tr>
                <td style="text-align:center"><?php echo $vendor["vendor_name"]?></td>

                <td style="text-align:center"><?php echo $vendor["vendor_phone"]?></td>
                <td style="text-align:center"> <?php echo $vendor["vendor_product"]?></td>
                <td style="text-align:center"><?php echo $vendor["vendor_quantity"]?></td>
                <td style="text-align:center"><?php echo $vendor["vendor_price"]?></td>
                <td>
                    <form action="edit_vendor">
                        <a class="btn btn-primary" type="submit" name="id"
                            href="edit_vendor.php?id=<?php print_r($vendor["id"]) ?> ">Edit</a>
                        <a class="btn btn-danger" type="submit" name="id"
                            href="util.php?delete_vendor=true&id=<?php print_r($vendor["id"]) ?> ">Delete</a>
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


<?php include '/includes/footer.php'; ?>
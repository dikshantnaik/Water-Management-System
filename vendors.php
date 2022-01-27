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
$sql = "Select * from vendor WHERE vendor_name LIKE \"%" .$_GET['search'] ."%\" OR vendor_phone LIKE \"%".$_GET['search']."\"%";
echo $sql;

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
            <h1 class="page-header">Vendors</h1>
        </div>

    </div>
    

    <!-- Filters -->
    <div class="well text-center filter-form ce">
        <form class="form form-inline" action="" >
            <label for="input_search">Search</label>
            <input type="text" class="form-control" id="input_search" name="search" placeholder="Name/Phone" value="<?php if(isset($_GET['search_str'])) echo $search_data?>">

            <input type="submit" value="Go" class="btn btn-primary">
        </form>
    </div>
    <hr>
    <!-- //Filters -->

    <!-- Table -->
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th width="20%">Vendor Name</th>
                <th width="20%">Contact no</th>
                
                <th width="20%">Quantity</th>
                <th width="20%">Price</th>
                <th width="15%">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendors as $vendor): ?>
            <tr>
                <td><?php echo $vendor["vendor_name"]?></td>
                <td><?php echo $vendor["vendor_phone"]?></td>
                <td><?php echo $vendor["vendor_quantity"]?></td>
                <td><?php echo $vendor["vendor_price"]?></td>
                <td> 
                    <form action="edit_vendor">
                    <input class="btn btn-primary" type="submit" name="edit" value="Edit">
                    <input class="btn btn-danger"type="submit" value="Delete">
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

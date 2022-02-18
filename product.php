<?php
session_start();

include 'connection.php';
include 'utils.php';
include 'includes/auth_validate.php';


if(isset($_GET['search'])){
$sql = "Select * from products 
        WHERE product_name LIKE \"%" .$_GET['search'] ."%\"";
        
}
else{
$sql = "Select * from products";
}
try {
    $products = $con->query($sql);
} catch (Exception $th) {
    echo $th;
}

include('includes/header.php');
?>

<!-- Main container -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <a href="products.php">
                <h1 class="page-header " style="color:black;">Product</h1>
            </a>
        </div>

    </div>
    <?php include 'includes/flash_messages.php'?>

    <!-- Filters -->
    <div class="well text-center filter-form ce ">

        <form class="form form-inline" style="display:flex" action="">
            <label for=" input_search" style="margin-top:5px">Search</label>
            <input type="text" class="form-control" id="input_search" style="margin-left:5px" name="search"
                placeholder="Name/Contact" value="<?php if(isset($_GET['search_str'])) echo $search_data?>">

            <input type="submit" style="margin-left:5px" value=" Go" class="btn btn-primary">
        </form>

        <?php if(isset($_GET['search'])){ ?>
        <a class="btn btn-primary" href="product.php">Back</a>
        <?php } ?>
        <a href="add_product.php" class="btn btn-success" style="float: right; margin-top: 45px; margin-bottom: 20px;">
            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus"
                viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                </path>
            </svg> -->
            <h4>+ Add product</h4>
        </a>
    </div>
    <hr>
    <!-- //Filters -->

    <!-- Table -->
    <table style="text-align:center" class="table table-striped table-bordered table-condensed">
        <thead>
            <tr style="text-align:center">
                <th style="text-align:center" width="10%">Product ID</th>
                <th style="text-align:center" width="15%">Product Category</th>
                <th style="text-align:center" width="15%">Product Name</th>
                <th style="text-align:center" width="15%">Product Price</th>
                <th style="text-align:center" width="15%">Product Stocks</th>

                <th style="text-align:center" width="15%">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td style="text-align:center">
                    <?php echo $product["product_id"]?>
                </td>
                <td style="text-align:center"><?php echo $product["product_category"]?></td>
                <td style="text-align:center"><?php echo $product["product_name"]?></td>
                <td style="text-align:center"><?php echo $product["product_price"]?></td>
                <td style="text-align:center"><?php echo $product["product_stock"]?></td>
                <td>
                    <form action="edit_product">
                        <a class="btn btn-primary" type=" submit" name="id"
                            href="edit_product.php?id=<?php print_r($product["product_id"]) ?> ">Edit</a>
                        <a class="btn btn-danger" type="submit" name="id"
                            href="utils.php?delete_product=true&id=<?php print_r($product["product_id"]) ?> ">Delete</a>
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
//    echo $pagination->render();?>
    </div>
</div>


<?php include 'includes/footer.php'; ?>
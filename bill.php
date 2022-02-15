<?php
session_start();
include("connection.php");

$result = $con->query("SELECT
    orders.order_id,
    customer.customer_name,
    customer.customer_phone,
    products.product_name,
    products.product_category,
    orders_product.quantity,
    products.product_price,
    orders.date,
    orders.payment_status
FROM
    `orders_product`,
    customer,
    products,
    orders
WHERE
    orders_product.order_id = orders.order_id AND 
    products.product_id = orders_product.product_id AND
     orders.customer_id = customer.customer_id AND
      orders_product.order_id = ".$_GET["order_id"]);

// $result2 = $result;
$rows = $result->fetch_assoc();
$customer_Name = $rows['customer_name'];
$customer_phone = $rows['customer_phone'];
$payment_status = $rows['payment_status'];
$order_date = $rows['date'];
mysqli_data_seek($result,0);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="bill.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div id="invoice">
                    <div class="toolbar hidden-print">
                        <div class="text-end">
                            <button type="button" onclick="window.print()" class="btn btn-dark"><i
                                    class="fa fa-print"></i>
                                Print</button>
                            <button type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export as
                                PDF</button>
                        </div>
                        <hr>
                    </div>
                    <div class="invoice overflow-auto">
                        <div style="min-width: 600px">
                            <header>
                                <div class="row">
                                    <div class="col">
                                        <a href="javascript:;">
                                            <img src="assets/images/logo-icon.png" width="80" alt="">
                                        </a>
                                    </div>
                                    <div class="col company-details">
                                        <h2 class="name">
                                            <a target="_blank" href="javascript:;">
                                                Aditya Sales
                                            </a>
                                        </h2>
                                        <div>455 Foggy Heights, AZ 85004, US</div>
                                        <div>(123) 456-789</div>
                                        <div>company@example.com</div>
                                    </div>
                                </div>
                            </header>
                            <main>
                                <div class="row contacts">
                                    <div class="col invoice-to">
                                        <div class="text-gray-light">INVOICE TO:</div>
                                        <h2 class="to"><?php echo $customer_Name?></h2>

                                        <div class="email"><a style="color:black"
                                                href="tel:+91 <?php echo $customer_phone?>">+91
                                                <?php echo $customer_phone?></a>
                                        </div>
                                    </div>
                                    <div class=" col invoice-details">
                                        <h1 class="invoice-id">Order No :<?php echo $_GET["order_id"]?> </h1>
                                        <div class="date">Date of Invoice: <?php echo $order_date?></div>

                                    </div>
                                </div>
                                <table>
                                    <thead>
                                        <tr style="text-align:center">
                                            <th>#</th>
                                            <th class="text-left">Product Name</th>
                                            <th class="text-left">Category</th>
                                            <th class="text-right">Price</th>
                                            <th class="text-right">Quantity</th>
                                            <th class="text-right">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total = 0; $Sr = 1;
                                            while($row = $result->fetch_assoc()) { 
                                            
                                            $total_per_item = $row['product_price'] * $row['quantity'];
                                            $total = $total+ $total_per_item;
                                            ?>
                                        <tr style="text-align:center">
                                            <td class="no"><?php echo $Sr?></td>
                                            <td class="text-left" style="text-align:center">
                                                <h3>
                                                    <a target="_blank" href="javascript:;">
                                                        <?php echo $row['product_name'] ?>
                                                </h3>
                                                </a>

                                            <td style="text-align:center">
                                                <h3>
                                                    <a target="_blank" href="javascript:;">
                                                        <?php echo $row['product_category'] ?>
                                                    </a>
                                                </h3>
                                            <td class="unit text-center"><?php echo $row['product_price']?> ₹ </td>
                                            <td class="qty text-center"><?php echo $row['quantity']?></td>
                                            <td class="total text-left"><?php echo $total_per_item ?> ₹
                                            </td>
                                        </tr>
                                        <?php $Sr++; } ?>
                                    </tbody>
                                    <tfoot>

                                        <tr>
                                            <td></td>
                                            <td colspan="2"></td>
                                            <td colspan="2">SUBTOTAL</td>
                                            <td> <?php echo $total; $tax = $total * 0.05 // 5% of total ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="2"></td>
                                            <td colspan="2">TAX 5%</td>
                                            <td><?php echo $tax; ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="2"></td>
                                            <td colspan="2">GRAND TOTAL</td>
                                            <td><?php echo $total+$tax ;?></td>
                                        </tr>

                                    </tfoot>
                                </table>
                                <div class="d-flex "><span style="text-align:center">Payament Status :
                                        <?php echo $payment_status?></span></div>
                                <div class="thanks">Thank you!</div>

                            </main>
                            <footer>Invoice was created on a computer and is valid without the signature and seal.
                            </footer>
                        </div>
                        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script></script>

</html>
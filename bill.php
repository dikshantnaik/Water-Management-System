<?php

// Instantiate and use the dompdf class 

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
                            <button type="button" class="btn btn-dark"><i class="fa fa-print"></i> Print</button>
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
                                                Arboshiki
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
                                        <h2 class="to">John Doe</h2>
                                        <div class="address">796 Silver Harbour, TX 79273, US</div>
                                        <div class="email"><a href="mailto:john@example.com">john@example.com</a>
                                        </div>
                                    </div>
                                    <div class="col invoice-details">
                                        <h1 class="invoice-id">INVOICE 3-2-1</h1>
                                        <div class="date">Date of Invoice: 01/10/2018</div>
                                        <div class="date">Due Date: 30/10/2018</div>
                                    </div>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-left">Product</th>
                                            <th class="text-right">Price</th>
                                            <th class="text-right">Quantity</th>
                                            <th class="text-right">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="no">01</td>
                                            <td class="text-left">
                                                <h3>
                                                    <a target="_blank" href="javascript:;">
                                                        Youtube channel
                                                    </a>
                                                </h3>

                                            <td class="unit">$0.00</td>
                                            <td class="qty">100</td>
                                            <td class="total">$0.00</td>
                                        </tr>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">SUBTOTAL</td>
                                            <td>$5,200.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">TAX 25%</td>
                                            <td>$1,300.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">GRAND TOTAL</td>
                                            <td>$6,500.00</td>
                                        </tr>
                                    </tfoot>
                                </table>
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
<style>

</style>

</html>
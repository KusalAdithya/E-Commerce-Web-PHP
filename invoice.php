<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
    $umail = $_SESSION["u"]["email"];
    $oid = 1;

?>


    <!DOCTYPE html>
    <html>

    <head>
        <title>AdiMobile | Invoice</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/mylogo.png" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
    </head>

    <body class=" ">
        <!-- style="background-color: #f7f7ff;" -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Invoice</li>
                        </ol>
                    </nav>
                </div>
                <!-- header -->
                <?php require "header.php"; ?>
                <!-- header -->
                <div class="bg-primary col-12" style="height: 10px;"></div>

                <!-- <div class="col-12">
                    <hr />
                </div> -->

                <div class="col-12 btn-toolbar justify-content-end mt-1">
                    <button class="btn btn-dark me-2" onclick="printDiv();"><i class="bi bi-printer-fill"></i> Print</button>
                    <!-- <button class="btn btn-danger me-2"><i class="bi bi-file-earmark-pdf-fill"></i> Save as PDF</button> -->
                </div>

                <div class="col-12">
                    <hr />
                </div>
                <div id="GFG">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="invoiceheaderimg"></div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12 text-end text-decoration-underline text-primary">
                                        <h2>AdiMobile</h2>
                                    </div>
                                    <div class="col-12  text-end fw-bold">
                                        <span>Gampaha, Sri Lanka</span><br />
                                        <span>+94772345672</span><br />
                                        <span>adimobile@gmail.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr class="border border-1 border-primary" />
                    </div>

                    <div class="col-12 mb-4">
                        <div class="row">

                            <div class="col-6">

                                <?php

                                $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
                                $ar = $addressrs->fetch_assoc();

                                ?>

                                <h5>INVOICE TO :</h5>

                                <h2><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></h2>
                                <span class="fw-bold"><?php echo $ar["line1"] . "," . $ar["line2"] ?></span><br />
                                <span class="fw-bold text-primary text-decoration-underline"><?php echo $umail; ?></span>
                            </div>

                            <?php
                            $invoicers = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "' ");
                            $in = $invoicers->num_rows;
                            // $ir = $invoicers->fetch_assoc();
                            ?>

                            <div class="col-6 text-end mt-2 justify-content-center">
                                <h1 class="text-primary ">INVOICE</h1>
                                <h5 class="text-primary"><?php echo $oid; ?></h5>

                                <!-- <h1 class="text-primary">INVOICE <?php echo $ir["id"] ?></h1> -->
                                <!-- <span>Date and time of Invoice :</span>&nbsp;
                                <span><?php echo $ir["date"] ?></span> -->
                            </div>

                        </div>
                    </div>

                    <div class="col-12">
                        <table class="table">
                            <thead>
                                <tr class="border border-1 border-white bg-light">
                                    <th>Order Id</th>
                                    <th>Product</th>
                                    <th class="text-end">Unit Price</th>
                                    <th class="text-end">Quantity</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $subtotal = "0";

                                for ($i = 0; $i < $in; $i++) {

                                    $irs = $invoicers->fetch_assoc();
                                    $pid = $irs["product_id"];

                                    $subtotal = $subtotal + $irs["total"];

                                    $productrs = Database::search("SELECT * FROM `product` WHERE `id` ='" . $pid . "'");
                                    $prn = $productrs->num_rows;
                                    // for ($i = 0; $i < $prn; $i++) {


                                    $pr = $productrs->fetch_assoc();

                                ?>

                                    <tr style="height: 60px;">
                                        <!-- <td class="fs-3 border-1"  style="background-color: rgb(199,199,199);"><?php echo $irs["id"]; ?></td> -->
                                        <td class="fw-bold p-2 border-1" style="background-color: rgb(199,199,199);"><?php echo $irs["order_id"]; ?></td>
                                        <td>
                                            <!-- <a href="#" class="fw-bold p-2 border-1"><?php echo $irs["order_id"]; ?></a><br /> -->
                                            <a href="#" class="fw-bold p-2"><?php echo $pr["title"]; ?></a>
                                        </td>
                                        <td class="text-end pt-3" style="background-color: rgb(199,199,199);">Rs. <?php echo $pr["price"]; ?>.00</td>
                                        <td class="text-end pt-3"><?php echo $irs["qty"]; ?></td>
                                        <td class="text-end pt-3" style="background-color: rgb(199,199,199);">Rs. <?php echo $irs["total"]; ?>.00</td>
                                    </tr>
                                <?php
                                    // }

                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="border-0"></td>
                                    <td colspan="2" class="fs-5 text-end">SUBTOTAL</td>
                                    <td class="fs-5 text-end">Rs. <?php echo $subtotal ?>.00</td>
                                </tr>
                                <!-- <tr>
                                    <td colspan="2" class="border-0"></td>
                                    <td colspan="2" class="fs-5 text-end border-primary">Discount</td>
                                    <td class="fs-5 text-end border-primary">Rs. 00.00</td>
                                </tr> -->
                                <tr>
                                    <td colspan="2" class="border-0"></td>
                                    <td colspan="2" class="fs-4 text-end border-0 bg-primary text-dark">GRAND TOTAL</td>
                                    <td class="fs-5 text-end border-0 text-dark  bg-primary">Rs. <?php echo $subtotal ?>.00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="col-4 text-center" style="margin-top: -90px; margin-bottom: 50px;">
                        <span class="fs-1">Thank You!</span>
                    </div>

                    <div class="col-11 mx-auto mt-3 mb-3 border border-start border-end-0 border-top-0 border-bottom-0 border-5 border-primary rounded" style="background-color: #e7f2ff;">
                        <div class="row">
                            <div class="col-12 mt-3 mb-3">
                                <label class="form-label fs-5 fw-bold ms-2">NOTICE :</label>
                                <label class="form-label fs-5">Purchased items can returned before 7 days of delivery.</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-2">
                        <!-- <h1 class="text-primary">INVOICE <?php echo $ir["id"] ?></h1> -->
                        <span>Date and time of Invoice :</span>&nbsp;
                        <span><?php echo $irs["date"] ?></span>
                    </div>

                    <div class="col-12">
                        <hr class="border border-1 border-primary" />
                    </div>

                    <div class="col-12 mb-3 text-center">
                        <label class="form-label fs-6 text-black-50">
                            Invoice was created on a computer and is valid without the Signature and Seal.
                        </label>
                    </div>
                </div>
                <!-- footer -->
                <?php require "footer.php"; ?>
                <!-- footer -->
            </div>
        </div>


        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>
<?php
}
?>
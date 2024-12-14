<?php
session_start();

require "connection.php";

$from = $_GET["f"];
$to = $_GET["t"];

?>

<!DOCTYPE html>
<html>

<head>
    <title>eShop | Admin | Selling History</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body class="mainbackground vh-100">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 mb-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="adminpanel.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Selling History</li>
                    </ol>
                </nav>
            </div>

            <div class="col-12">
                <label class="form-label fs-1 fw-bold text-primary">Product Selling History</label>
            </div>

            <div class="bg-primary col-12" style="height: 10px;"></div>

            <div class="col-12 mt-3 mb-2">
                <div class="row">
                    <!-- <div class="col-6 col-lg-2 bg-primary pt-2 pb-2 text-end">
                        <span class="fs-4 fw-bold text-white">Order Id</span>
                    </div>
                    <div class="col-6 col-lg-3 bg-light pt-2 pb-2">
                        <span class="fs-4 fw-bold text-dark">Product</span>
                    </div>
                    <div class="col-2 col-lg-3 bg-primary pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold text-white">Buyer</span>
                    </div>
                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold ">Price</span>
                    </div>
                    <div class="col-2 col-lg-2 bg-primary pt-2 pb-2  d-none d-lg-block">
                        <span class="fs-4 fw-bold text-white">Quantity</span>
                    </div> -->
                    <table class="table table-striped" style="background-color: rgba(183, 210, 247, 0.671); overflow-x: scroll;">
                        <thead>
                            <tr>
                                <th scope="col">Order Id</th>
                                <th scope="col">Product</th>
                                <th scope="col">Buyer</th>
                                <th scope="col">Price(Rs.)</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if (!empty($from) && empty($to)) {

                                $fromrs = Database::search("SELECT * FROM `invoice` ");
                                $fn = $fromrs->num_rows;

                                for ($x = 0; $x < $fn; $x++) {
                                    $fr = $fromrs->fetch_assoc();
                                    $fromdate = $fr["date"];

                                    $splitdate = explode(" ", $fromdate);
                                    $date = $splitdate[0];

                                    if ($from <= $date) {
                            ?>
                                        <!-- <tr>
                                <th scope="row"><?php echo $fr["order_id"]; ?></th>
                                <?php
                                        $product = Database::search("SELECT * FROM `product` WHERE `id`='" . $fr["product_id"] . "' ");
                                        $p = $product->fetch_assoc();

                                        $user = Database::search("SELECT * FROM `user` WHERE `email`='" . $fr["user_email"] . "' ");
                                        $u = $user->fetch_assoc();
                                ?>
                                <td><?php echo $p["title"]; ?></td>
                                <td><?php echo $u["fname"] . " " . $u["lname"]; ?></td>
                                <td>Rs. <?php echo $p["price"]; ?>.00</td>
                                <td><?php echo $fr["qty"]; ?></td>
                            </tr> -->
                            <?php
                                    }
                                }
                            }
                            ?>
                            <!-- </tbody> 
                    </table> -->


                            <!-- </div>
            </div> -->

                            <?php

                            if (!empty($from) && empty($to)) {

                                $fromrs = Database::search("SELECT * FROM `invoice` ");
                                $fn = $fromrs->num_rows;

                                for ($x = 0; $x < $fn; $x++) {
                                    $fr = $fromrs->fetch_assoc();
                                    $fromdate = $fr["date"];

                                    $splitdate = explode(" ", $fromdate);
                                    $date = $splitdate[0];

                                    if ($from <= $date) {
                            ?>
                                        <!-- <div class="col-12  mb-2">
                            <div class="row">
                                <div class="col-6 col-lg-2 bg-primary pt-2 pb-2 text-end">
                                    <span class="fs-5 fw-bold text-white"><?php echo $fr["order_id"]; ?></span>
                                </div>
                                <?php
                                        $product = Database::search("SELECT * FROM `product` WHERE `id`='" . $fr["product_id"] . "' ");
                                        $p = $product->fetch_assoc();

                                        $user = Database::search("SELECT * FROM `user` WHERE `email`='" . $fr["user_email"] . "' ");
                                        $u = $user->fetch_assoc();
                                ?>
                                <div class="col-6 col-lg-3 bg-light pt-2 pb-2">
                                    <span class="fs-5 fw-bold "><?php echo $p["title"]; ?></span>
                                </div>
                                <div class="col-2 col-lg-3 bg-primary pt-2 pb-2 d-none d-lg-block">
                                    <span class="fs-5 fw-bold text-white"><?php echo $u["fname"] . " " . $u["lname"]; ?></span>
                                </div>
                                <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                    <span class="fs-5 fw-bold ">Rs. <?php echo $p["price"]; ?>.00</span>
                                </div>
                                <div class="col-2 col-lg-2 bg-primary pt-2 pb-2  d-none d-lg-block">
                                    <span class="fs-5 fw-bold text-white"><?php echo $fr["qty"]; ?></span>
                                </div>
                            </div>
                        </div> -->
                                        <tr>
                                            <th scope="row"><?php echo $fr["order_id"]; ?></th>
                                            <?php
                                            $product = Database::search("SELECT * FROM `product` WHERE `id`='" . $fr["product_id"] . "' ");
                                            $p = $product->fetch_assoc();

                                            $user = Database::search("SELECT * FROM `user` WHERE `email`='" . $fr["user_email"] . "' ");
                                            $u = $user->fetch_assoc();
                                            ?>
                                            <td><?php echo $p["title"]; ?></td>
                                            <td><?php echo $u["fname"] . " " . $u["lname"]; ?></td>
                                            <td><?php echo $p["price"]; ?>.00</td>
                                            <td><?php echo $fr["qty"]; ?></td>
                                        </tr>
                                    <?php
                                    }
                                }
                            } else if (!empty($from) && !empty($to)) {

                                $betweenrs = Database::search("SELECT * FROM `invoice` ");
                                $bn = $betweenrs->num_rows;

                                for ($x = 0; $x < $bn; $x++) {
                                    $br = $betweenrs->fetch_assoc();
                                    $betweendate = $br["date"];

                                    $splitdate = explode(" ", $betweendate);
                                    $date = $splitdate[0];

                                    if ($from <= $date && $to >= $date) {
                                    ?>

                                        <!-- <div class="col-12  mb-2">
                            <div class="row">
                                <div class="col-3 col-lg-2 bg-primary pt-2 pb-2 text-end">
                                    <span class="fs-5 fw-bold text-white"><?php echo $br["order_id"]; ?></span>
                                </div>
                                <?php
                                        $product = Database::search("SELECT * FROM `product` WHERE `id`='" . $br["product_id"] . "' ");
                                        $p = $product->fetch_assoc();

                                        $user = Database::search("SELECT * FROM `user` WHERE `email`='" . $br["user_email"] . "' ");
                                        $u = $user->fetch_assoc();
                                ?>
                                <div class="col-6 col-lg-3 bg-light pt-2 pb-2">
                                    <span class="fs-5 fw-bold "><?php echo $p["title"]; ?></span>
                                </div>
                                <div class="col-2 col-lg-3 bg-primary pt-2 pb-2 d-none d-lg-block">
                                    <span class="fs-5 fw-bold text-white"><?php echo $u["fname"] . " " . $u["lname"]; ?></span>
                                </div>
                                <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                    <span class="fs-5 fw-bold ">Rs. <?php echo $p["price"]; ?>.00</span>
                                </div>
                                <div class="col-3 col-lg-2 bg-primary pt-2 pb-2">
                                    <span class="fs-5 fw-bold text-white"><?php echo $br["qty"]; ?></span>
                                </div>
                            </div>
                        </div> -->

                                        <tr>
                                            <th scope="row"><?php echo $br["order_id"]; ?></th>
                                            <?php
                                            $product = Database::search("SELECT * FROM `product` WHERE `id`='" . $br["product_id"] . "' ");
                                            $p = $product->fetch_assoc();

                                            $user = Database::search("SELECT * FROM `user` WHERE `email`='" . $br["user_email"] . "' ");
                                            $u = $user->fetch_assoc();
                                            ?>
                                            <td><?php echo $p["title"]; ?></td>
                                            <td><?php echo $u["fname"] . " " . $u["lname"]; ?></td>
                                            <td>Rs. <?php echo $p["price"]; ?>.00</td>
                                            <td><?php echo $br["qty"]; ?></td>
                                        </tr>

                                    <?php
                                    }
                                }
                            } else {

                                $todayrs = Database::search("SELECT * FROM `invoice` ");
                                $tn = $todayrs->num_rows;

                                // if ($tn > 0) {
                                for ($x = 0; $x < $tn; $x++) {

                                    $tr = $todayrs->fetch_assoc();
                                    $nodate = $tr["date"];

                                    $splitdate = explode(" ", $nodate);
                                    $date = $splitdate[0];

                                    $today = date("Y-m-d");
                                    // for ($x = 0; $x < $tn; $x++) {
                                    // $tr = $todayrs->fetch_assoc();
                                    // $nodate = $tr["date"];

                                    // $splitdate = explode(" ", $nodate);
                                    // $date = $splitdate[0];

                                    // $today = date("Y-m-d");

                                    if ($today == $date) {
                                        // for ($x = 0; $x < $tn; $x++) {
                                        // $tr = $todayrs->fetch_assoc();
                                        // if ($tn > 0) {
                                    ?>

                                        <!-- <div class="col-12  mb-2">
                                <div class="row">
                                    <div class="col-3 col-lg-2 bg-primary pt-2 pb-2 text-end">
                                        <span class="fs-5 fw-bold text-white"><?php echo $tr["order_id"]; ?></span>
                                    </div>
                                    <?php
                                        $product = Database::search("SELECT * FROM `product` WHERE `id`='" . $tr["product_id"] . "' ");
                                        $p = $product->fetch_assoc();

                                        $user = Database::search("SELECT * FROM `user` WHERE `email`='" . $tr["user_email"] . "' ");
                                        $u = $user->fetch_assoc();
                                    ?>
                                    <div class="col-6 col-lg-3 bg-light pt-2 pb-2">
                                        <span class="fs-5 fw-bold "><?php echo $p["title"]; ?></span>
                                    </div>
                                    <div class="col-2 col-lg-3 bg-primary pt-2 pb-2 d-none d-lg-block">
                                        <span class="fs-5 fw-bold text-white"><?php echo $u["fname"] . " " . $u["lname"]; ?></span>
                                    </div>
                                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                        <span class="fs-5 fw-bold ">Rs. <?php echo $p["price"]; ?>.00</span>
                                    </div>
                                    <div class="col-3 col-lg-2 bg-primary pt-2 pb-2">
                                        <span class="fs-5 fw-bold text-white"><?php echo $tr["qty"]; ?></span>
                                    </div>
                                </div>
                            </div> -->

                                        <tr>
                                            <th scope="row"><?php echo $tr["order_id"]; ?></th>
                                            <?php
                                            $product = Database::search("SELECT * FROM `product` WHERE `id`='" . $tr["product_id"] . "' ");
                                            $p = $product->fetch_assoc();

                                            $user = Database::search("SELECT * FROM `user` WHERE `email`='" . $tr["user_email"] . "' ");
                                            $u = $user->fetch_assoc();
                                            ?>
                                            <td><?php echo $p["title"]; ?></td>
                                            <td><?php echo $u["fname"] . " " . $u["lname"]; ?></td>
                                            <td>Rs. <?php echo $p["price"]; ?>.00</td>
                                            <td><?php echo $tr["qty"]; ?></td>
                                        </tr>

                            <?php



                                        // }
                                        // }
                                    }else{
                                        
                                    }
                                }
                                // }
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- footer -->
                    <?php require "footer.php"; ?>
                    <!-- footer -->
                </div>
            </div>

            <script src="script.js"></script>
</body>

</html>
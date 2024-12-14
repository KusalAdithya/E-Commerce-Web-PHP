<?php
session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
    $umail = $_SESSION["u"]["email"];

    $total = "0";
    $subtotal = "0";
    $shipping = "0";
    $total1 = "0";
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>AdiMobile | Cart</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/mylogo.png" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body onload="reloadcart();">

        <div class="container-fluid">
            <div class="row">

                <!-- header -->
                <?php
                require "header.php";
                ?>
                <!-- header -->

                <div class="col-12" style="background-color: #E3E5E4;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Cart</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-12  mb-3">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fs-1 fw-bolder text-primary">My Cart <i class="bi bi-cart3 fs-2"></i></label>
                        </div>
                        <hr class="border border-primary rounded-3" />
                        <!-- <div class="col-12">
                            <hr class="hrbreak1" />
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-3">
                                    <input type="text" class="form-control" placeholder="Search in Cart..." />
                                </div>
                                <div class="col-12 col-lg-2 d-grid mb-3">
                                    <button class="btn btn-outline-primary">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <hr class="hrbreak1" />
                        </div> -->

                        <?php

                        $cartrs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $umail . "' ORDER BY `id` DESC ");
                        $cn = $cartrs->num_rows;

                        if ($cn == 0) {
                        ?>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 emptycart"></div>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-1 fw-bold">You have no items in your Basket.</label>
                                    </div>
                                    <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid mb-4">
                                        <a href="home.php" class="btn btn-primary fs-3">Start Shopping</a>
                                    </div>
                                </div>
                            </div>

                        <?php
                        } else {
                        ?>

                            <div class="col-12 col-lg-9">
                                <div class="row">
                                    <?php

                                    for ($i = 0; $i < $cn; $i++) {
                                        $cr = $cartrs->fetch_assoc();

                                        // $cartr_ss = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $umail . "' AND `qty`>'0' ORDER BY `id` DESC ");
                                        // $cn_nn = $cartr_ss->num_rows;

                                        $productrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cr["product_id"] . "' ");
                                        $pr = $productrs->fetch_assoc();

                                        $total = $total + ($pr["price"] * $cr["qty"]);

                                        $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "' ");
                                        $ar = $addressrs->fetch_assoc();
                                        $cityid = $ar["city_id"];

                                        $districtrs = Database::search("SELECT * FROM `city` WHERE `id`='" . $cityid . "' ");
                                        $xr = $districtrs->fetch_assoc();
                                        $districtid = $xr["district_id"];

                                        $ship = "0";
                                        if ($districtid == "3") {
                                            $ship = $pr["delivery_fee_colombo"];
                                            $shipping = $shipping + $pr["delivery_fee_colombo"];
                                        } else {
                                            $ship = $pr["delivery_fee_other"];
                                            $shipping = $shipping + $pr["delivery_fee_other"];
                                        }

                                        $sellerrs = Database::search("SELECT * FROM `user` WHERE `email`='" . $pr["user_email"] . "' ");
                                        $sn = $sellerrs->fetch_assoc();

                                    ?>

                                        <div class="card mb-3 col-11 mx-auto">
                                            <div class="row g-0">
                                                <!-- <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="fw-bold text-black-50 fs-5">Seller : </span>&nbsp;
                                                            <span class="fw-bolder text-black fs-5"><?php echo $sn["fname"] . " " . $sn["lname"]; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr /> -->
                                                <div class="col-md-4 text-center">
                                                    <?php
                                                    $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pr["id"] . "' ");
                                                    $in = $imagers->fetch_assoc();;

                                                    ?>
                                                    <img src="<?php echo $in["code"]; ?>" class="img-fluid rounded-start d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" title="<?php echo $pr["title"]; ?>" data-bs-content="<?php echo $pr["description"]; ?>" />
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card-body">
                                                        <h3 class="card-title"><?php echo $pr["title"]; ?></h3>

                                                        <?php
                                                        $colourrs = Database::search("SELECT `name` FROM `color` WHERE `id`='" . $pr["color_id"] . "' ");
                                                        $colorr = $colourrs->fetch_assoc();
                                                        ?>
                                                        <span class="fw-bold text-black-50">Colour : <?php echo $colorr["name"]; ?></span>&nbsp;|

                                                        <?php
                                                        $conditionrs = Database::search("SELECT `name` FROM `condition` WHERE `id`='" . $pr["condition_id"] . "' ");
                                                        $cor = $conditionrs->fetch_assoc();
                                                        ?>
                                                        &nbsp;<span class="fw-bold text-black-50">Condition : <?php echo $cor["name"]; ?></span>&nbsp;
                                                        <br />

                                                        <span class="fw-bold text-black-50 fs-5">Price : </span>&nbsp;
                                                        <span class="fw-bolder text-black fs-5">Rs. <?php echo $pr["price"]; ?>.00</span>
                                                        <br />

                                                        <?php
                                                        $resultset = Database::search("SELECT * FROM product WHERE `status_id`='1' AND id='" . $pr["id"] . "' ");
                                                        $nr = $resultset->num_rows;
                                                        $prod = $resultset->fetch_assoc();

                                                        $cartr_s = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $umail . "' AND `qty`>'0' ORDER BY `id` DESC ");
                                                        $cn_n = $cartr_s->num_rows;

                                                        if ((int)$prod["qty"] > 0) {
                                                            $to = $cn_n;
                                                            $total1 = $total;
                                                            // $shipping1 = $shipping;
                                                            $mac = $cr['qty'];


                                                        ?>
                                                            <!-- <span class="fw-bold text-black-50 fs-5">Quantity :</span>&nbsp; -->
                                                            <?php

                                                            if ((int)$prod["qty"] < $cr['qty']) {
                                                                // $total2 = $pr["price"] * ($cr["qty"] - $prod["qty"]);
                                                                $total2 = $pr["price"] * $prod["qty"];
                                                                $total1 =  $total2;
                                                            $shipping1 = $shipping;

                                                                // $total1 = $total1 - $total2;
                                                            ?>
                                                                <span class="fw-bold text-black-50 fs-5">Selected Quantity : <?php echo $cr['qty'] ?></span>&nbsp;<br />
                                                                <span class="fw-bold text-black-50 fs-6">Maximum Quantity :<?php echo $prod["qty"] ?> </span><br />
                                                                <span class="fw-bold text-black-50 fs-5">Quantity :</span>&nbsp;
                                                                <input type="number" class="mt-1 border border-2 border-secondery fs-5 fw-bold px-2 cartqtytext" value="<?php echo $prod["qty"] ?>" min="1" id="qtyinput<?php echo $prod['id']; ?>" onclick="cartqty(<?php echo $prod['id']; ?>);" onkeyup="cartqty(<?php echo $prod['id']; ?>);" />
                                                                <br />
                                                                <span class="fw-bold text-black-50 fs-5">Delivery Fee : </span>&nbsp;
                                                                <span class="fw-bolder text-black fs-5">Rs. <?php echo $ship; ?>.00</span>
                                                                <?php
                                                                Database::iud("UPDATE `cart` SET `qty`='" . $prod["qty"] . "' WHERE `product_id`='" . $prod['id'] . "' AND `user_email`='" . $umail . "' ");
                                                                ?>
                                                                <!-- <script src=""></script> -->
                                                            <?php

                                                            } else {
                                                            $shipping1 = $shipping;

                                                            ?>
                                                                <!-- <div class="ms-3 border border-1 border-secondary rounded overflow-hidden float-start product_qty d-inline-block position-relative">
                                                                <span class="mt-5">QTY :</span>
                                                                <input class="border-0 fs-6 fw-bold text-start" style="width: 40px;" type="text" pattern="[0-9]" value="<?php echo $cr['qty'] ?>" id="qtyinput" />
                                                                <div class="qty-buttons position-absolute ">
                                                                    <div class="d-flex flex-column align-items-center border border-1 border-secondary qty-inc">
                                                                        <i class="fas fa-chevron-up" onclick="qty_inc(<?php echo $prod['qty']; ?>);"></i>
                                                                    </div>
                                                                    <div class="d-flex flex-column align-items-center border border-1 border-secondary qty-dec">
                                                                        <i class="fas fa-chevron-down" onclick="qty_dec();"></i>
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                                <span class="fw-bold text-black-50 fs-5">Quantity :</span>&nbsp;
                                                                <input type="number" class="mt-1 border border-2 border-secondery fs-5 fw-bold px-2 cartqtytext" value="<?php echo $cr['qty'] ?>" min="1" id="qtyinput<?php echo $pr["id"]; ?>" onclick="cartqty(<?php echo $prod['id']; ?>);" onkeyup="cartqty(<?php echo $prod['id']; ?>);" />
                                                                <br />
                                                                <span class="fw-bold text-black-50 fs-5">Delivery Fee : </span>&nbsp;
                                                                <span class="fw-bolder text-black fs-5">Rs. <?php echo $ship; ?>.00</span>
                                                            <?php
                                                            }
                                                        } else {
                                                            $to = $cn - 1;
                                                            $total1 = $total - ($pr["price"] * $cr["qty"]);
                                                            // $shipping1 = $shipping;
                                                            $ship="0";
                                                            // $shipping1 = $shipping - $ship;
                                                            ?>
                                                            <span class="fw-bold text-black-50 fs-5">Quantity :</span>&nbsp;
                                                            <span class="fw-bold text-danger fs-5">Out of stock</span>&nbsp;
                                                            <!-- <input type="text" class="mt-3 border border-22 border-secondery fs-5 fw-bold px-3 cartqtytext" value="Out of stock" /> -->
                                                            <?php
                                                            Database::iud("UPDATE `cart` SET `qty`='0' WHERE `product_id`='" . $prod['id'] . "' AND `user_email`='" . $umail . "' ");
                                                            ?>
                                                            <br />
                                                            <span class="fw-bold text-black-50 fs-5">Delivery Fee : </span>&nbsp;
                                                            <span class="fw-bolder text-black fs-5">Rs.<?php echo $ship ?>.00</span>
                                                        <?php
                                                        }

                                                        ?>

                                                        <!-- <span class="fw-bold text-black-50 fs-5">Quantity :</span>&nbsp;
                                                        <input type="text" class="mt-3 border border-22 border-secondery fs-5 fw-bold px-3 cartqtytext" value="<?php echo $cr['qty'] ?>" /> -->
                                                        <!-- <br />
                                                        <span class="fw-bold text-black-50 fs-5">Delivery Fee : </span>&nbsp;
                                                        <span class="fw-bolder text-black fs-5">Rs. <?php echo $ship; ?>.00</span> -->
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mt-4">
                                                    <div class="card-body d-grid">
                                                        <a class="btn btn-outline-success mb-2" href="<?php echo "singleproductview.php?id=" . ($pr['id']) ?>">View</a>
                                                        <a class="btn btn-outline-danger mb-2" onclick="deletefromCart(<?php echo $cr['id']; ?>);">Remove</a>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-6 col-md-6">
                                                            <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                        </div>
                                                        <div class="col-6 col-md-6 text-end">
                                                            <?php

                                                            if ((int)$prod["qty"] > 0) {
                                                                if ((int)$prod["qty"] < $cr['qty']) {
                                                            ?>
                                                                    <span class="fw-bold fs-5 text-black-50" id="herer1<?php echo $pr['id']; ?>">Rs. <?php echo ($pr["price"] * $prod["qty"]) + $ship; ?>.00</span>
                                                                <?php

                                                                } else {

                                                                ?>
                                                                    <span class="fw-bold fs-5 text-black-50" id="herer2<?php echo $pr['id']; ?>">Rs. <?php echo ($pr["price"] * $cr["qty"]) + $ship; ?>.00</span>
                                                                <?php

                                                                }
                                                            } else {
                                                                ?>
                                                                <span class="fw-bold fs-5 text-black-50" id="herer3<?php echo $pr['id']; ?>">Rs. 00.00</span>
                                                            <?php

                                                            }
                                                            ?>
                                                            <!-- <span class="fw-bold fs-5 text-black-50">Rs. <?php echo ($pr["price"] * $cr["qty"]) + $ship; ?>.00</span> -->
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>



                                    <?php
                                        $pid = $pr['id'];
                                        // $array;

                                        // $array["pid"] = $pr['id'];
                                        // $array["email"] = $umail;
                                        // echo json_encode($array);
                                    }
                                    ?>
                                </div>
                            </div>


                            <div class="col-11 mx-auto col-lg-3 border border-primary rounded-3" style="height: 300px;">
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <label class="form-label fs-3 fw-bold">Summary</label>
                                    </div>
                                    <div class="col-12">
                                        <hr />
                                    </div>
                                    <div class="col-6">
                                        <span class="fs-6 fw-bold" id="hereto">Items (<?php echo $to; ?>)</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="fs-6 fw-bold" id="heret">Rs. <?php echo $total1 ?>.00</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="fs-6 fw-bold">Shipping</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="fs-6 fw-bold">Rs. <?php echo $shipping1; ?>.00</span>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <hr />
                                    </div>
                                    <div class="col-6">
                                        <span class="fs-4 fw-bold">Total</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="fs-4 fw-bold" id="here">Rs. <?php echo $total1 + $shipping1; ?>.00</span>
                                    </div>
                                    <div id="hereb">
                                        <div class="col-12 mt-3 d-grid mb-3">
                                            <button class="btn btn-primary fs-5 fw-bold" id="payhere-payment" onclick="CHECKOUT(<?php echo $total1 + $shipping1; ?>);">CHECKOUT</button>
                                        </div>
                                    </div>
                                    <!-- <div class="col-12 mt-3 d-grid mb-3" id="hereb">
                                        <button class="btn btn-primary fs-5 fw-bold"  onclick="CHECKOUT(<?php echo $total1 + $shipping1; ?>);">CHECKOUT</button>
                                    </div> -->
                                </div>
                            </div>

                        <?php
                        }
                        ?>
                    </div>

                </div>

                <!-- footer -->
                <?php
                require "footer.php";
                ?>
                <!-- footer -->

            </div>
        </div>

        <script src="script.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script type="text/javascript">
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>

        <script>
            $(document).ready(function() {
                setInterval(function() {
                    $("#mm1").load(window.location.href + " #mm1");
                    $("#mm2").load(window.location.href + " #mm2");
                    $("#qtyinput" + $pr["id"]).load(window.location.href + " #qtyinput" + $pr["id"]);
                    $("#heret").load(window.location.href + " #heret");
                    $("#here").load(window.location.href + " #here");
                    // $("#herer3" + id).load(window.location.href + " #herer3" + id);
                    // $("#hereb").load(window.location.href + " #hereb");

                }, 3000);
                setInterval(function() {
                    $("#hereto").load(window.location.href + " #hereto");
                    $("#heret").load(window.location.href + " #heret");
                    $("#here").load(window.location.href + " #here");
                    $("#hereb").load(window.location.href + " #hereb");
                    // $("#herer3" + id).load(window.location.href + " #herer3" + id);
                    // $("#hereb").load(window.location.href + " #hereb");

                }, 1000);
            });
        </script>

    </body>

    </html>
<?php
} else {
?>
    <script>
        alert("You Have To Signin or Signup First");
        window.location = "index.php";
    </script>
<?php
}
?>
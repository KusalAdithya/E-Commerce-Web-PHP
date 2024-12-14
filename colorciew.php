<?php
session_start();
require "connection.php";

$c = $_GET["c"];
$mb = $_GET["mb"];
$s = 1;

$productrs = Database::search("SELECT * FROM `product` WHERE `color_id`='" . $c . "' AND model_has_brand_id='" . $mb . "' ");
$pn = $productrs->num_rows;

if ($pn == 1) {

    $pd = $productrs->fetch_assoc();
    $pid = $pd["id"];
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>AdiMobile | Single Product View</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="resources/mylogo.png" />
        <link rel="stylesheet" href="bootstrap.css" />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

        <link rel="stylesheet" href="style.css" />
    </head>

    <body>

        <div class="container-fluid">
            <div class="row" id="cview">
                <!-- header -->
                <?php
                require "header.php";
                ?>
                <!-- header -->

                <div class="col-12 mt-0 singleproduct rounded">
                    <div class="row">
                        <div class="bg-white rounded-2" style="padding: 11px;">
                            <div class="row">
                                <div class="col-12 mb-0">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Single Product View</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="col-lg-2 order-lg-1 order-2">
                                    <ul>

                                        <?php

                                        $imagesrs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "' ");
                                        $in = $imagesrs->num_rows;

                                        $d = $imagesrs->fetch_assoc();

                                        ?>
                                        <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                            <img src="<?php echo $d["code"]; ?>" height="150px" width="190px" class="mt-1 mb-1" id="pimg<?php echo "1"; ?>" onmouseover="loadmainimg(<?php echo '1'; ?>);" />
                                        </li>

                                        <?php
                                        if ($d["code1"] == "resources//products//no_img.png") {
                                        ?>
                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                <img src="<?php echo $d["code1"] ?>" height="150px" class="mt-1 mb-1" />
                                            </li>
                                        <?php
                                        } else {
                                        ?>
                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                <img src="<?php echo $d["code1"]; ?>" height="150px" width="190px" class="mt-1 mb-1" id="pimg<?php echo "2"; ?>" onmouseover="loadmainimg(<?php echo '2'; ?>);" />
                                            </li>
                                        <?php
                                        }
                                        if ($d["code2"] == "resources//products//no_img.png") {
                                        ?>
                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                <img src="<?php echo $d["code2"] ?>" height="150px" class="mt-1 mb-1" />
                                            </li>
                                        <?php
                                        } else {
                                        ?>
                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                <img src="<?php echo $d["code2"]; ?>" height="150px" width="190px" class="mt-1 mb-1" id="pimg<?php echo "3"; ?>" onmouseover="loadmainimg(<?php echo '3'; ?>);" />
                                            </li>
                                        <?php
                                        }
                                        ?>


                                    </ul>
                                </div>

                                <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                    <div class="align-items-center border border-1 border-secondary p-3">
                                        <div style="background-image:url('<?php echo $d["code"]; ?>'); background-repeat: no-repeat; background-size: contain; height:450px;  background-position: center;" id="mainimg"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 order-3">
                                    <div class="row ">

                                        <!-- <div class="col-12">
                                                <nav>
                                                    <ol class="d-flex flex-wrap mb-0 list-unstyled bg-white rounded">
                                                        <li class="breadcrumb-item">
                                                            <a href="home.php">Home</a>
                                                        </li>
                                                        <li class="breadcrumb-item text-black-50">
                                                            <a class="text-black-50 text-decoration-none" href="#">Single View</a>
                                                        </li>
                                                    </ol>
                                                </nav>
                                            </div> -->

                                        <div class="col-12">
                                            <label class="form-lable fs-4 fw-bold mt-0"><?php echo $pd["title"]; ?></label>
                                        </div>

                                        <!-- <div class="col-12 mt-1">
                                                <span class="badge badge-success">
                                                    <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                                    <label class="text-dark fs-6">4.5 Star</label>
                                                    <label class="text-dark fs-6">| 35 Ratings & 45 Reviews</label>
                                                </span>
                                            </div> -->

                                        <div class="d-inline-block col-12">
                                            <label class="d-inline-block fw-bold mt-1 fs-4">Rs. <?php echo $pd["price"]; ?>.00</label>
                                            <label class="d-inline-block fw-bold mt-1 fs-6 text-danger"><del>Rs. <?php $a = $pd["price"];
                                                                                                                    $newval = ($a / 100) * 5;
                                                                                                                    $val = $a + $newval;
                                                                                                                    echo $val; ?>.00</del>
                                            </label>
                                        </div>

                                        <hr class="hrbreak1" />

                                        <div class="col-12">
                                        <label class="text-primary fs-6"><b>Warrenty : </b>06 months warrenty</label> <br />
                                                <!-- <label class="text-primary fs-6"><b>Return Policy : </b>01 months return policy</label> <br /> -->
                                                <label class="text-primary fs-5" id="qty"><b>In Stock : </b><?php echo $pd["qty"]; ?> Items Left</label> <br />
                                        </div>

                                        <hr class="hrbreak1" />

                                        <!-- <div class="col-12 mb-2">
                                                <label class="text-dark fs-3 fw-bold">Seller Details</label> <br />
                                                <?php

                                                // $userrs = Database::search("SELECT * FROM  `user` WHERE `email`='" . $pd["user_email"] . "' ");
                                                // $userd = $userrs->fetch_assoc();

                                                ?>
                                                <label class="text-success fs-6 fw-bold"><?php echo $userd["fname"] . " " . $userd["lname"]; ?></label><br />
                                                <label class="text-success fs-6 fw-bold"><?php echo $userd["email"]; ?></label><br />
                                                <label class="text-success fs-6 fw-bold"><?php echo $userd["mobile"]; ?></label><br />
                                                <a class="btn btn-info" href="<?php echo "messages.php?email=" . ($userd['email']) ?>">Contact Seller</a>
                                            </div> -->

                                        <!-- <div class="col-12 mb-2">
                                            <div class="row">
                                                <div class="ms-3 col-11 col-lg-8 rounded border border-1 border-success mt-1">
                                                    <div class="row">
                                                        <div class="col-md-3 col-sm-3  col-2 col-lg-1">
                                                            <img src="resources/singleview/pricetag.png" />
                                                        </div>
                                                        <div class="col-sm-9 col-md-9 col-10 col-lg-10 ms-lg-2">
                                                            <label>Stand a chance to get instant 5% discount by using VISA</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->

                                        <div class="col-12 mb-2">
                                            <div class="row">
                                                <div class=" col-11 col-lg-8  mt-1">
                                                    <div class="row">
                                                        <!-- <div class="col-md-3">
                                                            <h5>Colour : </h5>
                                                        </div> -->
                                                        <div class="col-5">
                                                            <h5>Colour : </h5>
                                                            <?php
                                                            $color = Database::search("SELECT color.id,color.name FROM  `color` INNER JOIN product ON product.color_id= color.id WHERE color.id='" . $pd["color_id"] . "' ");
                                                            $cod = $color->fetch_assoc();
                                                            ?>
                                                            <!-- <select class="form-select" id="selectcolor"  onclick="selectcolor(<?php echo $pd['model_has_brand_id']; ?>);"> -->
                                                            <!-- <option value="0">Select Colour</option> -->
                                                            <!-- <option value="<?php echo $cod["id"] ?>"><?php echo $cod["name"]; ?></option> -->
                                                            <input class="form-check-input" type="radio" name="a" id="e" checked value="<?php echo $cod["id"]; ?>" />
                                                            <label for="e"><?php echo $cod["name"]; ?></label>&nbsp;
                                                            <?php

                                                            $color2 = Database::search("SELECT color.id,color.name FROM  `color` INNER JOIN product ON product.color_id= color.id WHERE color.id !='" . $pd["color_id"] . "' AND product.model_has_brand_id = '" . $pd["model_has_brand_id"] . "' ");
                                                            $co2 = $color2->num_rows;

                                                            for ($g = 0; $g < $co2; $g++) {
                                                                $cod2 = $color2->fetch_assoc();
                                                            ?>
                                                                <input class="form-check-input" type="radio" name="a" id="selectcolor" value="<?php echo $cod2["id"]; ?>" onclick="selectcolor(<?php echo $pd['model_has_brand_id']; ?>);" />
                                                                <label for="selectcolor"><?php echo $cod2["name"]; ?></label>&nbsp;
                                                                <!-- <option value="<?php echo $cod2["id"]; ?>"><?php echo $cod2["name"]; ?></option> -->
                                                            <?php
                                                            }
                                                            ?>

                                                            <!-- </select> -->

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- </div> -->

                                        <hr class="hrbreak1" />

                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-6" style="margin-top: 15px;">
                                                    <div class="row">
                                                        <div class="ms-3 border border-1 border-secondary rounded overflow-hidden float-start product_qty d-inline-block position-relative">
                                                            <span class="mt-5">QTY :</span>
                                                            <input class="border-0 fs-6 fw-bold text-start" style="width: 40px;" type="text" pattern="[0-9]" value="1" id="qtyinput" />
                                                            <div class="qty-buttons position-absolute ">
                                                                <div class="d-flex flex-column align-items-center border border-1 border-secondary qty-inc">
                                                                    <i class="fas fa-chevron-up" onclick="qty_inc(<?php echo $pd['qty']; ?>);"></i>
                                                                </div>
                                                                <div class="d-flex flex-column align-items-center border border-1 border-secondary qty-dec">
                                                                    <i class="fas fa-chevron-down" onclick="qty_dec();"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="hrbreak1" />
                                                <div class="col-12">
                                                    <div class="row">

                                                        <div class="col-4 col-lg-2 d-grid">
                                                            <button class="btn btn-primary" onclick="addToCartsingle1(<?php echo  $pid; ?>);">Add to cart</button>
                                                        </div>
                                                        <div class="col-4 col-lg-2 d-grid">
                                                            <button type="submit" class="btn btn-success" id="payhere-payment" onclick="paynow(<?php echo $pid; ?>);">Buy Now</button>
                                                        </div>
                                                        <div class="col-4 col-lg-2 d-grid">
                                                            <i class="fas fa-heart mt-2 fs-4 text-black-50" onclick="addToWatchlist(<?php echo $pid; ?>)"></i>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 bg-white">
                            <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                <div class="col-md-6">
                                    <span class="fs-3 fw-bold">Related Items</span>
                                </div>
                            </div>
                        </div>

                        <div class=" col-12 bg-white">
                            <div class="row">
                                <div class=" col-12">
                                    <div class="row p-2   justify-content-center">

                                        <?php
                                        $model_has_brand = Database::search("SELECT * FROM `model_has_brand` WHERE `id`='" . $pd["model_has_brand_id"] . "' ");
                                        $mhb = $model_has_brand->fetch_assoc();

                                        $brandrs = Database::search("SELECT `product`.`id` AS `pid`,`product`.`qty`, `product`.`title`, `product`.`price`, `model_has_brand`.`brand_id` FROM `product` LEFT JOIN `model_has_brand` ON product.model_has_brand_id=model_has_brand.id  WHERE model_has_brand.brand_id = '" . $mhb["brand_id"] . "'  LIMIT 4  ");

                                        $bds = $brandrs->num_rows;

                                        if ($bds != 0) {

                                            for ($g = 0; $g < $bds; $g++) {
                                                $bdf = $brandrs->fetch_assoc();

                                                if ($bdf["pid"] != $pid) {
                                        ?>
                                                    <div class="card me-1" style="width: 18rem;">
                                                        <?php
                                                        $pimage = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $bdf["pid"] . "' ");
                                                        $imgrow = $pimage->fetch_assoc();
                                                        ?>

                                                        <img src="<?php echo $imgrow["code"]; ?>" class="card-img-top mx-auto" style="height: 250px;" />
                                                        <div class="card-body">
                                                            <h5 class="card-title fw-bold"><?php echo $bdf["title"]; ?></h5>
                                                            <p class="card-text">Rs. <?php echo $bdf["price"]; ?>.00</p>
                                                            <?php
                                                            if ((int)$bdf["qty"] > 0) {
                                                            ?>
                                                                <span class="card-text text-warning">In Stock</span>
                                                                <input class="form-control mb-1" type="number" value="1" min="0" id="qtytxt<?php echo $bdf['pid']; ?>" />
                                                                <a href="<?php echo "singleproductview.php?id=" . ($bdf["pid"]) ?>" class="btn btn-success">View</a>
                                                                <a class="btn btn-danger" onclick="addToCart(<?php echo $bdf['pid']; ?>);">Add Cart</a>
                                                                <a class="btn btn-secondary" onclick="addToWatchlist(<?php echo $bdf['pid']; ?>)"><i class="bi bi-heart-fill"></i></a>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <span class="card-text text-danger">Out Of Stock</span>
                                                                <input class="form-control mb-1" type="number" value="1" disabled />
                                                                <a href="<?php echo "singleproductview.php?id=" . ($bdf["pid"]) ?>" class="btn btn-success disabled">View</a>
                                                                <a href="#" class="btn btn-danger disabled" disabled>Add Cart</a>
                                                                <a class="btn btn-secondary" onclick="addToWatchlist(<?php echo $bdf['pid']; ?>)"><i class="bi bi-heart-fill"></i></a>
                                                            <?php
                                                            }

                                                            ?>

                                                            <!-- <a class="btn btn-primary p-2" href="<?php echo "singleproductview.php?id=" . ($prod['id']) ?>">View</a>
                                                        <a href="#" class="btn btn-danger p-2">Add to cart</a>
                                                        <a class="ms-2 mt-1 fs-5" onclick="addToWatchlist(<?php echo $pid; ?>)"><i class="fas fa-heart mt-2 fs-4 text-black-50"></i></a> -->
                                                        </div>
                                                    </div>
                                        <?php
                                                }
                                            }
                                        } else {
                                            echo "No Related Items";
                                        }

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 bg-white">
                            <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                <div class="col-md-6">
                                    <span class="fs-3 fw-bold">Product Details</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 bg-white">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <?php
                                        $brand =  Database::search("SELECT * FROM `brand` WHERE `id`='" . $mhb["brand_id"] . "' ");
                                        $pb = $brand->fetch_assoc();

                                        ?>
                                        <div class="col-2">
                                            <label class="form-label fs-5 fw-bold">Brand</label>
                                        </div>
                                        <div class="col-lg-10 col-8 mx-auto">
                                            <label class="form-label fs-5 "><?php echo $pb["name"]; ?></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="row">
                                        <?php

                                        $model =  Database::search("SELECT * FROM `model` WHERE `id`='" . $mhb["model_id"] . "' ");
                                        $pm = $model->fetch_assoc();

                                        ?>
                                        <div class="col-2">
                                            <label class="form-label fs-5 fw-bold">Model</label>
                                        </div>
                                        <div class="col-lg-10 col-8 mx-auto">
                                            <label class="form-label fs-5 "><?php echo $pm["name"]; ?></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="row">
                                        <div class="col-2">
                                            <label class="form-label fs-5 fw-bold">Description</label>
                                        </div>
                                        <div class="col-lg-10 col-8 mx-auto">
                                            <textarea class="form-control" disabled id="" cols="60" rows="10"><?php echo $pd["description"]; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12 bg-white">
                    <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                        <div class="col-md-6">
                            <span class="fs-3 fw-bold">Feedbacks...</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <div class="row g-1">
                        <?php

                        $feedbackrs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='" . $pid . "' ");
                        $feed = $feedbackrs->num_rows;

                        if ($feed == 0) {
                        ?>

                            <div class="col-12 text-center">
                                <label class="form-label text-black-50">There are no feedbacks to view.</label>
                            </div>

                            <?php
                        } else {

                            for ($a = 0; $a < $feed; $a++) {
                                $feedrow = $feedbackrs->fetch_assoc();

                                $user = Database::search("SELECT * FROM `user` WHERE `email`='" . $feedrow["user_email"] . "'");
                                $ur = $user->fetch_assoc();
                            ?>
                                <div class="col-12 col-lg-3 m-1 border border-2 border-danger rounded px-1">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="fs-5 fw-bold text-primary"><?php echo $ur["fname"]; ?></span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fs-5 text-dark"><?php echo $feedrow["feed"]; ?></span>
                                        </div>
                                        <div class="col-12 text-end">
                                            <span class="fs-6 text-black-50"><?php echo $feedrow["date"]; ?></span>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
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

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    </body>

    </html>
<?php
}

?>
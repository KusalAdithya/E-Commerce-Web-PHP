<?php
session_start();

require "connection.php";

$product = $_SESSION["p"];

?>

<!DOCTYPE html>
<html>

<head>
    <title>AdiMobile | Update Product</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/mylogo.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="mainbackground">

    <div class="container-fluid">
        <div class="row">

            <div class="" id="updateproductbox">
                <div class="col-12 mb-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="adminpanel.php">Dashboard</a></li>
                            <li class="breadcrumb-item " aria-current="page"><a href="sellerproductview.php">Manage Productst</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update Product</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-12 mb-1">
                    <h3 class="h2 text-primary fw-bold">Update Product - <?php echo $product["title"]; ?></h3>
                </div>
                <!-- heading -->
                <div class="bg-primary col-12" style="height: 10px;"></div>

                <!-- category,brand,model -->
                <div class="col-lg-12 mt-3">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Category</label>
                                </div>
                                <div class="col-12  mb-3">
                                    <select class="form-select" id="ca" disabled>
                                        <?php

                                        $category = Database::search("SELECT * FROM `category` WHERE `id`='" . $product["category_id"] . "' ");
                                        $cd = $category->fetch_assoc();

                                        ?>
                                        <option value="0"><?php echo $cd["name"] ?></option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Brand</label>
                                </div>
                                <div class="col-12  mb-3">
                                    <select class="form-select" id="br" disabled>
                                        <?php

                                        $model_has_brand = Database::search("SELECT * FROM `model_has_brand` WHERE `id`='" . $product["model_has_brand_id"] . "' ");
                                        $mhb = $model_has_brand->fetch_assoc();

                                        $brand =  Database::search("SELECT * FROM `brand` WHERE `id`='" . $mhb["brand_id"] . "' ");
                                        $pb = $brand->fetch_assoc();

                                        ?>
                                        <option value="0"><?php echo $pb["name"] ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Model</label>
                                </div>
                                <div class="col-12  mb-3">
                                    <select class="form-select" id="mo" disabled>
                                        <?php

                                        $model =  Database::search("SELECT * FROM `model` WHERE `id`='" . $mhb["model_id"] . "' ");
                                        $pm = $model->fetch_assoc();

                                        ?>
                                        <option value="0"><?php echo $pm["name"] ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- category,brand,model -->
                <!-- <hr class="hrbreak1" /> -->
                <hr class=" border border-2 border-primary rounded-3" />

                <!-- title -->
                <div class="col-12 mb-2">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Add a Title To Your Product</label>
                        </div>
                        <div class="offset-lg-2 col-12 col-lg-8">
                            <input type="text" class="form-control" id="ti" value="<?php echo $product["title"]; ?>" />
                        </div>
                    </div>
                </div>
                <!-- title -->
                <!-- <hr class="hrbreak1" /> -->
                <hr class=" border border-2 border-primary rounded-3" />

                <!-- condition,color,qty -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Condition</label>
                                </div>
                                <?php
                                if ($product["condition_id"] == 1) {
                                ?>
                                    <div class="form-check offset-1 offset-lg-1 col-10 col-lg-3">
                                        <input class="form-check-input" type="radio" id="bn" name="exampleRadios" checked disabled>
                                        <label class="form-check-label" for="bn">
                                            Brand New
                                        </label>
                                    </div>
                                    <div class="form-check offset-1 offset-lg-1 col-10 col-lg-3">
                                        <input class="form-check-input" type="radio" id="us" name="exampleRadios" disabled>
                                        <label class="form-check-label" for="us">
                                            Used
                                        </label>
                                    </div>
                                <?php
                                } else if ($product["condition_id"] == 2) {
                                ?>
                                    <div class="form-check offset-1 offset-lg-1 col-10 col-lg-3">
                                        <input class="form-check-input" type="radio" id="bn" name="exampleRadios" disabled>
                                        <label class="form-check-label" for="bn">
                                            Brand New
                                        </label>
                                    </div>
                                    <div class="form-check offset-1 offset-lg-1 col-10 col-lg-3">
                                        <input class="form-check-input" type="radio" id="us" name="exampleRadios" checked disabled>
                                        <label class="form-check-label" for="us">
                                            Used
                                        </label>
                                    </div>
                                <?php
                                }

                                ?>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Colour</label>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <?php

                                        $color =  Database::search("SELECT * FROM `color` WHERE `id`='" . $product["color_id"] . "' ");
                                        $colornr = $color->num_rows;
                                        $pc = $color->fetch_assoc();

                                        if (isset($pc["name"])) {
                                            $colorrs =  Database::search("SELECT * FROM `color` ");
                                            $colors = $colorrs->num_rows;


                                            for ($i = 0; $i < $colors; $i++) {
                                                $pcls = $colorrs->fetch_assoc();

                                                if ($pc["name"] == $pcls["name"]) {
                                        ?>
                                                    <div class="offset-1 offset-lg-0 col-5 form-check col-lg-4">
                                                        <input class="form-check-input" type="radio" name="colorRadio" checked id="clr1" value="" disabled>
                                                        <label class="form-check-label" for="clr1">
                                                            <?php echo $pc["name"]; ?>
                                                        </label>
                                                    </div>


                                                <?php
                                                } else {
                                                ?>
                                                    <div class="offset-1 offset-lg-0 col-5  form-check col-lg-4">
                                                        <input class="form-check-input" type="radio" value="" name="colorRadio" id="clr2" disabled>
                                                        <label class="form-check-label" for="clr2">
                                                            <?php echo $pcls["name"]; ?>
                                                        </label>
                                                    </div>
                                        <?php
                                                }
                                            }
                                        }
                                        ?>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Add Product Quantity</label>
                                    <input class="form-control" type="number" value="<?php echo $product["qty"]; ?>" min="0" id="qty" />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- condition,color,qty -->
                <!-- <hr class="hrbreak1" /> -->
                <hr class=" border border-2 border-primary rounded-3" />


                <!-- cost,payment method -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Cost Per Item</label>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rs,</span>
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="cost" value="<?php echo $product["price"]; ?>" disabled>
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Approved Payment Methods</label>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="pm1 offset-2 col-2"></div>
                                        <div class="pm2 col-2"></div>
                                        <div class="pm3 col-2"></div>
                                        <div class="pm4 col-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- cost,payment method -->
                <!-- <hr class="hrbreak1" /> -->
                <hr class=" border border-2 border-primary rounded-3" />


                <!-- delivary cost -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Delivery Costs</label>
                                </div>
                                <div class="col-12 offset-lg-1 col-lg-3">
                                    <label class="form-label">Delivery Cost Within Gampaha</label>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rs,</span>
                                        <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["delivery_fee_colombo"]; ?>" id="dwc">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1"></label>
                                </div>
                                <div class="col-12 offset-lg-1 col-lg-3 mt-lg-3">
                                    <label class="form-label">Delivery Cost Out Of Gampaha</label>
                                </div>
                                <div class="col-12 col-lg-7 mt-lg-3">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rs,</span>
                                        <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["delivery_fee_other"]; ?>" id="doc">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- delivary cost -->
                <!-- <hr class="hrbreak1" /> -->
                <hr class=" border border-2 border-primary rounded-3" />

                <!-- description-->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Product Description</label>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control" cols="100" rows="10" style="background-color: whitesmoke;" id="desc"><?php echo $product["description"]; ?></textarea>
                        </div>
                    </div>
                </div>
                <!-- description-->
                <hr class=" border border-2 border-primary rounded-3" />

                <!-- product img -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Add Product Image</label>
                        </div>
                        <?php

                        $img =  Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product["id"] . "' ");
                        $pi = $img->fetch_assoc();

                        ?>
                        <!-- <img class="col-5 col-lg-2 ms-2 img-thumbnail" src="resources//products//<?php echo $pi["code"]; ?>" id="prev" />

                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-12 col-lg-6 mt-2">
                                    <div class="row">
                                        <div class="col-12 col-lg-6 ">
                                            <input class="d-none" type="file" accept="img/*" id="imguploder" />
                                            <label class="btn btn-primary col-5 col-lg-8" for="imguploder" onclick="changeImg();">Upload</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <div class="col-6 col-md-4">
                            <img class="col-12 col-lg-6 ms-2 img-thumbnail" id="prev" src="<?php echo $pi["code"]; ?>" />
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-12 col-lg-12 mt-2">
                                        <div class="row">
                                            <div class="col-12 col-lg-10">
                                                <input class="d-none" type="file" accept="img/*" id="imguploder" />
                                                <label class="btn btn-primary col-11 col-lg-8" for="imguploder" onclick="changeImg();">Upload</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-md-4">
                            <img class="col-12 col-lg-6 ms-2 img-thumbnail" id="prev1" src="<?php echo $pi["code1"]; ?>" />
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-12 col-lg-10 mt-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <input class="d-none" type="file" accept="img/*" id="imguploader1" />
                                                <label class="btn btn-primary col-11 col-lg-8" for="imguploader1" onclick="changeImg1();">Upload</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-md-4">
                            <img class="col-12 col-lg-6 ms-2 img-thumbnail" id="prev2" src="<?php echo $pi["code2"]; ?>" />
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-12 col-lg-12 mt-2">
                                        <div class="row">
                                            <div class="col-12 col-lg-10">
                                                <input class="d-none" type="file" accept="img/*" id="imguploader2" />
                                                <label class="btn btn-primary col-11 col-lg-8" for="imguploader2" onclick="changeImg2();">Upload</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- product img -->
                <!-- <hr class="hrbreak1" /> -->
                <hr class=" border border-2 border-primary rounded-3" />

                <!-- notice -->
                <!-- <div class="col-12">
                    <label class="form-label lbl1">Notice...</label>
                    <br />
                    <label class="form-label">We are taking 5% of the product price from every product as a service charge.</label>
                </div> -->
                <!-- notice -->

                <!-- save btn -->
                <div class="col-12 mb-3">
                    <div class="row">

                        <div class="col-12 col-lg-6 mx-auto d-grid">
                            <button class="btn btn-success addbtn" onclick="updateProduct();">Update Product</button>
                        </div>

                    </div>
                </div>

                <!-- save btn -->


            </div>
            <!-- footer -->
            <?php
            require "footer.php";
            ?>
            <!-- footer -->
        </div>

    </div>


    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>

</body>

</html>
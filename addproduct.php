<?php
session_start();
require "connection.php";
?>

<!DOCTYPE html>
<html>

<head>
    <title>AdiMobile | Add Product</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/mylogo.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="mainbackground">

    <div class="container-fluid">
        <div class="row gy-3">

            <!-- addproductbox -->
            <div id="addproductbox">

                <!-- heading -->
                <!-- <div class="col-12 mb-2 mt-2">
                    <h3 class="h2 text-primary fw-bold text-center">Product Listing</h3>
                </div> -->
                <div class="col-12 mb-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="adminpanel.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product Listing</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-12 mb-2 ">
                    <h3 class="h2 text-primary fw-bold fs-1">Product Listing</h3>
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
                                    <select class="form-select" id="ca">
                                        <option value="0">Select Category</option>
                                        <?php

                                        $rs = Database::search("SELECT * FROM `category` ");
                                        $n = $rs->num_rows;

                                        for ($i = 0; $i < $n; $i++) {
                                            $cat = $rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $cat["id"] ?>"><?php echo $cat["name"] ?></option>
                                        <?php
                                        }

                                        ?>
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
                                    <select class="form-select" id="br">
                                        <option value="0">Select Brand</option>
                                        <?php

                                        $rs = Database::search("SELECT * FROM `brand` ");
                                        $n = $rs->num_rows;

                                        for ($i = 0; $i < $n; $i++) {
                                            $brand = $rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $brand["id"] ?>"><?php echo $brand["name"] ?></option>
                                        <?php
                                        }

                                        ?>
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
                                    <select class="form-select" id="mo">
                                        <option value="0">Select Model</option>
                                        <?php

                                        $rs = Database::search("SELECT * FROM `model` ");
                                        $n = $rs->num_rows;

                                        for ($i = 0; $i < $n; $i++) {
                                            $model = $rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $model["id"] ?>"><?php echo $model["name"] ?></option>
                                        <?php
                                        }

                                        ?>
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
                            <input type="text" class="form-control" id="ti" />
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
                                <div class="form-check offset-1 offset-lg-1 col-10 col-lg-3">
                                    <input class="form-check-input" type="radio" id="bn" name="exampleRadios" checked>
                                    <label class="form-check-label" for="bn">
                                        Brand New
                                    </label>
                                </div>
                                <div class="form-check offset-1 offset-lg-1 col-10 col-lg-3">
                                    <input class="form-check-input" type="radio" id="us" name="exampleRadios">
                                    <label class="form-check-label" for="us">
                                        Used
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Colour</label>
                                </div>
                                <div class="col-10">
                                    <div class="row">
                                        <select class="form-select" id="clr1">
                                            <option value="0">Select Colour</option>
                                            <?php

                                            $rs = Database::search("SELECT * FROM color");
                                            $n = $rs->num_rows;

                                            for ($x = 0; $x < $n; $x++) {
                                                $fa = $rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $fa["id"]; ?>"><?php echo $fa["name"]; ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>

                                        <?php

                                        // $rs = Database::search("SELECT * FROM color");
                                        // $n = $rs->num_rows;

                                        // for ($x = 0; $x < $n; $x++) {
                                        //     $fa = $rs->fetch_assoc();
                                        ?>
                                        <!-- <option value="<?php echo $fa["id"]; ?>"><?php echo $fa["name"]; ?></option> -->
                                        <!-- <div class="offset-1 offset-lg-0 col-5 form-check col-lg-4">
                                            <input class="form-check-input" type="radio" name="colorRadio" id="clr1<?php echo $fa["id"]; ?>" value="<?php echo $fa["id"]; ?>">
                                            <label class="form-check-label" for="clr1<?php echo $fa["id"]; ?>">
                                            <?php echo $fa["name"]; ?>
                                            </label> -->
                                    </div>
                                    <?php
                                    // }

                                    ?>

                                    <!-- <div class="offset-1 offset-lg-0 col-5 form-check col-lg-4">
                                            <input class="form-check-input" type="radio" name="colorRadio" checked id="clr1">
                                            <label class="form-check-label" for="clr1">
                                                Gold
                                            </label>
                                        </div>
                                        <div class="offset-1 offset-lg-0 col-5  form-check col-lg-4">
                                            <input class="form-check-input" type="radio" value="" name="colorRadio" id="clr2">
                                            <label class="form-check-label" for="clr2">
                                                Silver
                                            </label>
                                        </div>
                                        <div class="offset-1 offset-lg-0 col-5 form-check col-lg-4">
                                            <input class="form-check-input" type="radio" value="" name="colorRadio" id="clr3">
                                            <label class="form-check-label" for="clr3">
                                                Graphite
                                            </label>
                                        </div>
                                        <div class="offset-1 offset-lg-0 col-5 form-check col-lg-4">
                                            <input class="form-check-input" type="radio" value="" name="colorRadio" id="clr4">
                                            <label class="form-check-label" for="clr4">
                                                Pasific Blue
                                            </label>
                                        </div>
                                        <div class="offset-1 offset-lg-0 col-5 form-check col-lg-4">
                                            <input class="form-check-input" type="radio" value="" name="colorRadio" id="clr5">
                                            <label class="form-check-label" for="clr5">
                                                Jet Black
                                            </label>
                                        </div>
                                        <div class="offset-1 offset-lg-0 col-5 form-check col-lg-4">
                                            <input class="form-check-input" type="radio" value="" name="colorRadio" id="clr6">
                                            <label class="form-check-label" for="clr6">
                                                Rose Gold
                                            </label>
                                        </div> -->
                                </div>

                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Add Product Quantity</label>
                                    <input class="form-control" type="number" value="0" min="1" id="qty" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-12 col-lg-3">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label lbl1">Add Product Quantity</label>
                                <input class="form-control" type="number" value="0" min="0" id="qty" />
                            </div>
                        </div>
                    </div> -->

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
                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="cost">
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
                <hr class=" border border-2 border-primary rounded-3" />
            <!-- <hr class="hrbreak1" /> -->

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
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="dwc">
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
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="doc">
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
                        <textarea class="form-control" cols="100" rows="10" style="background-color: whitesmoke;" id="desc"></textarea>
                    </div>
                </div>
            </div>
            <!-- description-->
            <!-- <hr class="hrbreak1" /> -->
            <hr class=" border border-2 border-primary rounded-3" />

            <!-- product img -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <label class="form-label lbl1">Add Product Image</label>
                    </div>
                    <!-- <img class="col-5 col-lg-2 ms-2 img-thumbnail" src="resources/addproductimg.svg" id="prev" />
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-12 col-lg-6 mt-2">
                                    <div class="row">
                                        <div class="col-12 col-lg-6 ">
                                            <input class="d-none" type="file" multiple accept="img/*" id="imguploder" />
                                            <label class="btn btn-primary col-5 col-lg-8" for="imguploder" onclick="changeImg();">Upload</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    <div class="col-6 col-md-4">
                        <img class="col-12 col-lg-6 ms-2 img-thumbnail" src="resources/addproductimg.svg" id="prev" />
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-12 col-lg-10 mt-2">
                                    <div class="row">
                                        <div class="col-12">
                                            <input class="d-none" type="file" multiple accept="img/*" id="imguploder" />
                                            <label class="btn btn-primary col-11 col-lg-8" for="imguploder" onclick="changeImg();">Upload</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-4">
                        <img class="col-12 col-lg-6 ms-2 img-thumbnail" src="resources/addproductimg.svg" id="prev1" />
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-12 col-lg-10 mt-2">
                                    <div class="row">
                                        <div class="col-12 ">
                                            <input class="d-none" type="file" accept="img/*" id="imguploader1" />
                                            <label class="btn btn-primary col-11 col-lg-8" for="imguploader1" onclick="changeImg1();">Upload</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-4">
                        <img class="col-12 col-lg-6 ms-2 img-thumbnail" src="resources/addproductimg.svg" id="prev2" />
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


            <div class="col-12">
                <div class="row">

                    <div class="col-12 col-lg-6 mx-auto d-grid">
                        <button class="btn btn-success addbtn" onclick="addProduct();">Add Product</button>
                    </div>

                </div>
            </div>
            <!-- save btn -->
            <!-- footer -->
            <?php
            require "footer.php";
            ?>
            <!-- footer -->
        </div>

        <!-- footer -->
        <?php
        // require "footer.php";
        ?>
        <!-- footer -->
    </div>

    </div>


    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>
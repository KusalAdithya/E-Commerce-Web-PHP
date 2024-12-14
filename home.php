<?php
session_start();

require "connection.php";
?>

<!DOCTYPE html>
<html>

<head>
    <title>AdiMobile | Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/mylogo.png">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- header -->
            <?php
            require "header.php"; 
            ?>
            <!-- header -->

            <!-- <hr class="hrbreak1" /> -->
            <!-- <hr class="border border-primary rounded-3" /> -->

            <div class="bg-primary col-12" style="height: 10px;"></div>

            <!-- search bar -->
            <div class="col-12 justify-content-center">
                <div class="row mb-3 text-center">
                    <div class="col-12 col-lg-1 offset-lg-2 logoimg" style="background-position: center;"></div>
                    <div class="col-9 col-lg-6 ms-0 ms-lg-1">
                        <div class="input-group mb-3 mt-3">
                            <input type="text" class="form-control col-5" aria-label="Text input with dropdown button" placeholder="Search your product" id="basic_search_text">
                            <!-- <div class="col-lg-3"> -->
                                <select class="btn btn-outline-primary col-8 col-lg-3 d-none d-lg-block" id="basic_search_select" >
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

                            <!-- </div> -->
                            <!-- <input type="text" class="form-control col-6" aria-label="Text input with dropdown button" placeholder="Search your product" id="basic_search_text"> -->

                            <span class="input-group-text fs-5 bi bi-search btn-primary" onclick="basicSearch(1);"></span>
                        </div>
                    </div>
                    <!-- <div class="col-2 d-grid gx-0 gx-md-4">
                        <button class="btn btn-primary mt-3 searchbtn" onclick="basicSearch(1);">Search</button>
                    </div> -->
                    <div class="col-3 d-flex col-lg-2 mt-4">
                        <a href="advancedSearch.php" class="link-secondary link1 text-center ms-sm-3">Advanced &rarr;</a>
                    </div>
                </div>
            </div>
            <!-- search bar -->
            <!-- <div class="bg-primary col-12" style="height: 10px;"></div> -->

            <!-- <hr class="hrbreak1" /> -->
            <div class="col-12" id="pview">
                <!-- slider -->
                <div class="col-12 d-none d-lg-block">
                    <div class="row">
                        <div id="carouselExampleCaptions" class="carousel slide offset-2 col-8" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="resources/slider images/sss.jpg" class="d-block posterimg1" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="resources/slider images/sl22.jpg" style="width: 100%;" class="d-block posterimg1" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="resources/slider images/iPhone_12sli1.jpg" width="100%" class="d-block posterimg1" alt="...">
                                    <!-- <div class="carousel-caption d-none d-md-block postercaption1"> -->
                                        <!-- <h5 class="postertitle">Buy your products online</h5> -->
                                    <!-- <p class="postertxt">Experience the Lowest Delivery Costs With Us.</p> -->
                                    <!-- </div> -->
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- slider -->
                <!-- <div class="bg-primary col-12 mt-2" style="height: 10px;"></div> -->

                <!-- product title view -->
                <!-- <div class="col-12" id="pview"> -->
                <div class="row  bg-white" style="z-index: 100;">
                    <?php
                    $rs = Database::search("SELECT * FROM `category` ");
                    $n = $rs->num_rows;

                    for ($x = 0; $x < $n; $x++) {
                        $c = $rs->fetch_assoc();
                    ?>
                        <div class="col-12 mt-3" id="pcat">

                            <a href="<?php echo "categotyproducts.php?id=" . ($c['id']) ?>" class="link-dark link2 col-4"><?php echo $c["name"]; ?> &rarr;</a>
                            <!-- <a href="<?php echo "categotyproducts.php?id=" . ($c['id']) ?>" class="link-dark link3">See All &rarr;</a> -->
                            <hr class="border border-primary rounded-3" />

                        </div>
                        <!-- product title view -->

                        <!-- product view -->
                        <div class="col-12 mb-5" id="searchview">
                            <div class="row ">
                                <div class="col-12 ">
                                    <div class="row    justify-content-center">

                                        <?php
                                        $resultset = Database::search("SELECT * FROM product WHERE `status_id`='1' AND category_id='" . $c["id"] . "' ORDER BY datetime_added DESC LIMIT 5 OFFSET 0");
                                        $nr = $resultset->num_rows;

                                        for ($y = 0; $y < $nr; $y++) {
                                            $prod = $resultset->fetch_assoc();
                                        ?>

                                            <div class="card col-5 col-lg-2 mt-1 mb-1 ms-1" style="width: 18rem;" id="pdetails">

                                                <?php
                                                $pimage = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $prod["id"] . "' ");
                                                $imgrow = $pimage->fetch_assoc();
                                                ?>

                                                <img src="<?php echo $imgrow["code"] ?>" class="card-img-top cardTopImg img-fluid mx-auto">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $prod["title"] ?><span class="badge bg-info ms-1">New</span></h5>
                                                    <span class="card-text text-primary">Rs. <?php echo $prod["price"] ?>.00</span>
                                                    <br />

                                                    <?php
                                                    if ((int)$prod["qty"] > 0) {
                                                    ?>
                                                        <span class="card-text text-warning">In Stock</span>
                                                        <input class="form-control mb-1" type="number" value="1" min="0" id="qtytxt<?php echo $prod['id']; ?>" />
                                                        <a href="<?php echo "singleproductview.php?id=" . ($prod['id']) ?>" class="btn btn-success">View</a>
                                                        <a class="btn btn-danger" onclick="addToCart(<?php echo $prod['id']; ?>);">Add Cart</a>
                                                        <a class="btn btn-secondary" onclick="addToWatchlist(<?php echo $prod['id']; ?>)"><i class="bi bi-heart-fill"></i></a>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <span class="card-text text-danger">Out Of Stock</span>
                                                        <input class="form-control mb-1" type="number" value="1" disabled />
                                                        <a href="<?php echo "singleproductview.php?id=" . ($prod['id']) ?>" class="btn btn-success " >View</a>
                                                        <a href="#" class="btn btn-danger disabled" disabled>Add Cart</a>
                                                        <a class="btn btn-secondary" onclick="addToWatchlist(<?php echo $prod['id']; ?>)"><i class="bi bi-heart-fill"></i></a>
                                                    <?php
                                                    }

                                                    ?>

                                                </div>
                                            </div>

                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- product view -->
                    <?php
                    }
                    ?>
            <div class="bg-primary col-12" style="height: 10px;"></div>

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
    <script src="bootstrap.bundle.js"></script>
</body>

</html>
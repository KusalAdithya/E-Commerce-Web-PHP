<?php

require "connection.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>AdiMobile | Advanced Search</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link rel="icon" href="resources/mylogo.png" />
</head>

<body onload="advancedSearch(0);">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-white border border-primary border-start-0 border-end-0 border-top-0 ">
                <?php
                require "header.php";
                ?>
            </div>

            <div class="col-12" style="background-color: #E3E5E4;">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Advanced Product Search</li>
                    </ol>
                </nav>
            </div>

            <div class="col-12 bg-white">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="row">
                            <!-- <div class="col-3 offset-lg-2 mt-2">
                                <div class="mb-3 logoimg"></div>
                            </div> -->
                            <div class="col-12">
                                <label class=" fw-bold fs-2 mt-4   text-primary">Advanced Product Search</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-o offset-lg-2 col-12 col-lg-8 bg-white border border-primary rounded-3 mt-3 mb-3 ">
                <div class="row">

                    <div class="offset-0 offset-lg-1 col-12 col-lg-10">
                        <div class="row">

                            <div class="col-10 col-lg-11 mt-3 mb-2">
                                <input type="text" class="form-control fw-bold" placeholder="Search your product ..." id="s1" onkeyup="advancedSearch(0);" />
                                <!-- <span class="input-group-text fs-5 bi bi-search btn-primary" onclick="advancedSearch(0);"></span> -->
                                <!-- <a href="advancedSearch.php" class="btn btn-info searchbtn1 text-white col-2"><i class="bi bi-x-circle"></i></a> -->

                            </div>
                            <!-- <div class="col-12 col-lg-2 mt-3 mb-2 d-grid">
                                <button class="btn btn-primary searchbtn1" onclick="advancedSearch(0);">Search</button>
                            </div> -->
                            <div class="col-1 col-lg-1 mt-3 mb-2 d-grid">
                                <a href="advancedSearch.php" class="btn btn-outline-info searchbtn1 "><i class="bi bi-x-circle"></i> </a>
                            </div>
                            <div class="col-12">
                                <!-- <hr class="border border-primary border-3" /> -->
                            </div>

                        </div>
                    </div>

                    <div class="offset-0 offset-lg-1 col-12 col-lg-10 mt-2 ">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 col-lg-4 mb-3">
                                        <select class="form-select" id="ca1" onclick="advancedSearch(0);">
                                            <option value="0">Select Category</option>
                                            <?php

                                            $rs = Database::search("SELECT * FROM category");
                                            $n = $rs->num_rows;

                                            for ($x = 0; $x < $n; $x++) {

                                                $fa = $rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $fa["id"]; ?>"><?php echo $fa["name"]; ?></option>

                                            <?php
                                            }

                                            ?>

                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-4 mb-3">
                                        <select class="form-select" id="br1" onclick="advancedSearch(0);">
                                            <option value="0">Select Brand</option>
                                            <?php

                                            $rs = Database::search("SELECT * FROM brand");
                                            $n = $rs->num_rows;

                                            for ($x = 0; $x < $n; $x++) {

                                                $fa = $rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $fa["id"]; ?>"><?php echo $fa["name"]; ?></option>

                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-4 mb-3">
                                        <select class="form-select" id="mo1" onclick="advancedSearch(0);">
                                            <option value="0">Select Model</option>
                                            <?php

                                            $rs = Database::search("SELECT * FROM model");
                                            $n = $rs->num_rows;

                                            for ($x = 0; $x < $n; $x++) {

                                                $fa = $rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $fa["id"]; ?>"><?php echo $fa["name"]; ?></option>

                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-12 col-lg-6 mb-3">

                                        <select class="form-select" id="co1" onclick="advancedSearch(0);">
                                            <option value="0">Select Condition</option>
                                            <?php

                                            $rs = Database::search("SELECT * FROM `condition`;");
                                            $n = $rs->num_rows;

                                            for ($x = 0; $x < $n; $x++) {

                                                $fa = $rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $fa["id"]; ?>"><?php echo $fa["name"]; ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-3">
                                        <select class="form-select" id="col1" onclick="advancedSearch(0);">
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
                                    </div>

                                    <div class="col-12 col-lg-6 mb-3">
                                        <input type="text" class="form-control" onkeyup="advancedSearch(0);" placeholder="Price From" id="prif1" />
                                    </div>

                                    <div class="col-12 col-lg-6 mb-3">
                                        <input type="text" class="form-control" onkeyup="advancedSearch(0);" placeholder="Price To" id="prit2" />
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-o offset-lg-2 col-12 col-lg-8 bg-white  mb-3 ">
                <div class="row">
                    <div class="col-9 col-lg-10">
                        <hr class="border border-primary rounded-3 mt-4">
                        <!-- <h4>Filter your products</h4> -->
                    </div>
                    <div class="col-3 col-lg-2 mb-2 mt-2">
                        <select class=" form-select border-0" id="sort" onchange="advancedSearch(0);">
                            <option value="0" class="bi bi-filter-left">Sort By</option>
                            <option value="1">Price Low To High</option>
                            <option value="2">Price High To Low</option>
                            <option value="3">Quantity Low To High</option>
                            <option value="4">Quantity High To Low</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-2 col-12 col-lg-8 mb-3 rounded bg-white border border-primary rounded-3" id="filter">
                <div class="row">
                    <div class="offset-0 offset-lg-1 col-12 col-lg-10 text-center">
                        <div class="row">

                            <?php
                            if (isset($_GET["page"])) {
                                $pageno = $_GET["page"];
                            } else {
                                $pageno = 1;
                            }

                            $products = Database::search("SELECT * FROM `product`");
                            $nProduct = $products->num_rows;
                            $userProduct = $products->fetch_assoc();

                            $results_per_page = 6;
                            $number_of_pages = ceil($nProduct / $results_per_page);

                            $page_first_result = ((int)$pageno - 1) * $results_per_page;
                            $selectedrs = Database::search("SELECT * FROM `product` LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "");
                            $srn = $selectedrs->num_rows;

                            while ($productImage = $selectedrs->fetch_assoc()) {


                            ?>
                                <div class="card mb-3 mt-3 col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-md-4 mt-4">

                                            <?php

                                            $pimgrs = Database::search("SELECT * FROM `images` WHERE `product_id`= '" . $productImage["id"] . "'");
                                            $pir = $pimgrs->fetch_assoc();

                                            ?>

                                            <img src="<?php echo $pir["code"] ?>" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">

                                                <h5 class="card-title fw-bold"><?php echo $productImage["title"] ?></h5>
                                                <span class="card-text text-primary fw-bold">Rs.<?php echo $productImage["price"] ?>.00</span>
                                                <br />
                                                <span class="card-text text-success fw-bold"><?php echo $productImage["qty"] ?> Items Left</span>

                                                <?php
                                                if ((int)$productImage["qty"] > 0) {
                                                ?>
                                                    <span class="card-text text-warning">In Stock</span><br />
                                                    <input class="form-control mb-1 d-none" type="number" value="1" min="0" id="qtytxt<?php echo $productImage['id']; ?>" />
                                                    <a href="<?php echo "singleproductview.php?id=" . ($productImage['id']) ?>" class="btn btn-success">View</a>
                                                    <a class="btn btn-danger" onclick="addToCart(<?php echo $productImage['id']; ?>);">Add Cart</a>
                                                    <a class="btn btn-secondary" onclick="addToWatchlist(<?php echo $productImage['id']; ?>)"><i class="bi bi-heart-fill"></i></a>
                                                <?php
                                                } else {
                                                ?>
                                                    <span class="card-text text-danger">Out Of Stock</span><br/>
                                                    <!-- <input class="form-control mb-1" type="number" value="1" disabled /> -->
                                                    <a href="<?php echo "singleproductview.php?id=" . ($productImage['id']) ?>" class="btn btn-success ">View</a>
                                                    <a href="#" class="btn btn-danger disabled" disabled>Add Cart</a>
                                                    <a class="btn btn-secondary" onclick="addToWatchlist(<?php echo $productImage['id']; ?>)"><i class="bi bi-heart-fill"></i></a>
                                                <?php
                                                }

                                                ?>

                                                <!-- <div class="row">
                                                    <div class="col-12">

                                                        <div class="row g-1">
                                                            <div class="col-12 col-lg-6 d-grid">
                                                                <a href="#" class="btn btn-success fs" onclick="sendid(<?php echo $productImage['id'] ?>);">Buy Now</a>
                                                            </div>
                                                            <div class="col-12 col-lg-6 d-grid">
                                                                <a href="#" class="btn btn-primary fs" onclick="deleteModal(<?php echo $productImage['id'] ?>);">Add Cart</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div> -->

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }

                            ?>

                        </div>

                    </div>

                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="offset-4 col-4 text-center">
                            <div class="offset-3 mb-5 pagination">
                                <a href="
                                <?php

                                if ($pageno <= 1) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($pageno - 1);
                                }

                                ?>">&laquo;</a>

                                <?php

                                for ($page = 1; $page <= $number_of_pages; $page++) {

                                    if ($page == $pageno) {
                                ?>
                                        <a href="<?php echo "?page=" . ($page); ?>" class="ms-1 active"><?php echo $page; ?></a>
                                    <?php
                                    } else {
                                    ?>

                                        <a href="<?php echo "?page=" . ($page); ?>" class="ms-1"><?php echo $page; ?></a>

                                <?php
                                    }
                                }

                                ?>
                                <a href="
                                
                                <?php

                                if ($pageno >= $number_of_pages) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($pageno + 1);
                                }

                                ?>
                                
                                ">&raquo;</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php

            require "footer.php";

            ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>
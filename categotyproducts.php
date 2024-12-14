<?php
session_start();

require "connection.php";

if (isset($_GET["id"])) {
    $cid = $_GET["id"];
    $pageno;
    // echo $cid;

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>AdiMobile | Products</title>
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

                <div class="col-12">
                    <div class="row">

                        <?php require "header.php"; ?>

                        <?php
                        $rs = Database::search("SELECT * FROM `category` WHERE `id`='" . $cid . "' ");
                        $n = $rs->num_rows;

                        for ($x = 0; $x < $n; $x++) {
                            $c = $rs->fetch_assoc();
                        ?>
                            <div class="col-12" style="background-color: #E3E5E4;">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><?php echo $c["name"] ?></li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="bg-primary col-12" style="height: 10px;"></div>

                            <div class="col-12 mt-3 text-center">
                                <label href="#" class="text-primary fs-1"><?php echo $c["name"] ?></label>
                            </div>
                            <!-- product title view -->
                            <!-- <hr class="border border-primary rounded-3" /> -->

                            <!-- <div class="col-12" style="background-color: #E3E5E4;">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><?php echo $c["name"] ?></li>
                                    </ol>
                                </nav>
                            </div> -->
                            <hr class="border border-primary rounded-3" />
                            <!-- product view -->
                            <div class="col-12 mb-5 mt-3">
                                <div class="row ">
                                    <div class="col-12 ">
                                        <div class="row justify-content-center">

                                            <?php
                                            if (isset($_GET["page"])) {
                                                $pageno = $_GET["page"];
                                            } else {
                                                $pageno = 1;
                                            }

                                            $products = Database::search("SELECT * FROM product WHERE category_id='" . $c["id"] . "' ORDER BY datetime_added DESC ");
                                            $d = $products->num_rows;
                                            $row = $products->fetch_assoc();

                                            $results_per_page = 10;

                                            $number_of_pages = ceil($d / $results_per_page);

                                            $page_first_result = ((int)$pageno - 1) * $results_per_page;

                                            $selectedrs = Database::search("SELECT * FROM product WHERE category_id='" . $c["id"] . "' ORDER BY datetime_added DESC LIMIT " . $results_per_page . " OFFSET " . $page_first_result . " ");

                                            // $srn = $selectedrs->num_rows;

                                            // $resultset = Database::search("SELECT * FROM product WHERE category_id='" . $c["id"] . "' ORDER BY datetime_added DESC LIMIT 5 OFFSET 0");
                                            $nr = $selectedrs->num_rows;

                                            for ($y = 0; $y < $nr; $y++) {
                                                $prod = $selectedrs->fetch_assoc();
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
                                                            <a href="<?php echo "singleproductview.php?id=" . ($prod['id']) ?>" class="btn btn-success">View</a>
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

                        <!-- pagination -->
                        <div class="col-12 mb-3">
                            <div class="d-flex justify-content-center">
                                <div class="pagination">
                                    <a href="<?php
                                                if ($pageno <= 1) {
                                                    echo "";
                                                } else {
                                                    echo "?page=" . ($pageno - 1) . "&id=" . ($cid);
                                                }
                                                ?>">&laquo;</a>
                                    <?php

                                    for ($page = 1; $page <= $number_of_pages; $page++) {
                                        if ($page == $pageno) {
                                    ?>
                                            <a href="<?php echo "?page=" . ($page) . "&id=" . ($cid); ?>" class="ms-1 active"><?php echo $page; ?></a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="<?php echo "?page=" . ($page) . "&id=" . ($cid); ?>" class="ms-1"><?php echo $page; ?></a>
                                    <?php
                                        }
                                    }

                                    ?>
                                    <a href="<?php
                                                if ($pageno >= $number_of_pages) {
                                                    echo "#";
                                                } else {
                                                    echo "?page=" . ($pageno + 1) . "&id=" . ($cid);
                                                }
                                                ?>">&raquo;</a>
                                </div>
                            </div>

                        </div>
                        <!-- pagination -->

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
<?php
}
?>
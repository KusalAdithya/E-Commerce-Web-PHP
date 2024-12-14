<?php
session_start();
require "connection.php";

$s = $_POST["s"];
$c = $_POST["c"];
$b = $_POST["b"];
$m = $_POST["m"];
$co = $_POST["co"];
$col = $_POST["col"];
$pf = $_POST["prif"];
$pt = $_POST["prit"];
$sort = $_POST["sort"];
$states = "0";


$quvry = "SELECT * FROM product WHERE product.status_id='1' ";

if ($b !== "0" && $m !== "0") {

    $products = Database::search("SELECT * FROM model_has_brand WHERE model_has_brand.brand_id='" . $b . "' AND model_has_brand.model_id='" . $m . "';");
    $nProduct = $products->num_rows;
    if ($nProduct == "1") {
        $cotagery = $products->fetch_assoc();
        $cat = $cotagery["id"];
        $states = "1";
    } else {
        $states = "0";
    }
} else {
    $states = "0";
}

if (isset($s)) {
    if ($sort == "0") {

        $quvry .= " AND `title` LIKE '%" . $s . "%'";
    } else if ($sort == "1") {

        $quvry .= " AND `title` LIKE '%" . $s . "%' ORDER BY `price` ASC";
    } else if ($sort == "2") {

        $quvry .= " AND `title` LIKE '%" . $s . "%' ORDER BY `price` DESC";
    } else if ($sort == "3") {

        $quvry .= " AND `title` LIKE '%" . $s . "%' ORDER BY `qty` ASC";
    } else if ($sort == "4") {

        $quvry .= " AND `title` LIKE '%" . $s . "%' ORDER BY `qty` DESC";
    }
}
if ($c !== "0") {
    if ($sort == "0") {

        $quvry .= " AND product.category_id='" . $c . "'";
    } else if ($sort == "1") {

        $quvry .= " AND product.category_id='" . $c . "' ORDER BY `price` ASC";
        // $quvry .= "  ORDER BY `price` ASC";
    } else if ($sort == "2") {

        $quvry .= " AND product.category_id='" . $c . "' ORDER BY `price` DESC";
    } else if ($sort == "3") {

        $quvry .= " AND product.category_id='" . $c . "' ORDER BY `qty` ASC";
    } else if ($sort == "4") {

        $quvry .= " AND product.category_id='" . $c . "' ORDER BY `qty` DESC";
    }
}
if ($co !== "0") {
    if ($sort == "0") {

        $quvry .= " AND product.condition_id='" . $co . "'";
    } else if ($sort == "1") {

        $quvry .= " AND product.condition_id='" . $co . "' ORDER BY `price` ASC";
    } else if ($sort == "2") {

        $quvry .= " AND product.condition_id='" . $co . "' ORDER BY `price` DESC";
    } else if ($sort == "3") {

        $quvry .= " AND product.condition_id='" . $co . "' ORDER BY `qty` ASC";
    } else if ($sort == "4") {

        $quvry .= " AND product.condition_id='" . $co . "' ORDER BY `qty` DESC";
    }
}
if ($states == "1") {
    if ($sort == "0") {

        $quvry .= " AND product.model_has_brand_id='" . $cat . "'";
    } else if ($sort == "1") {

        $quvry .= " AND product.model_has_brand_id='" . $cat . "' ORDER BY `price` ASC";
    } else if ($sort == "2") {

        $quvry .= " AND product.model_has_brand_id='" . $cat . "' ORDER BY `price` DESC";
    } else if ($sort == "3") {

        $quvry .= " AND product.model_has_brand_id='" . $cat . "' ORDER BY `qty` ASC";
    } else if ($sort == "4") {

        $quvry .= " AND product.model_has_brand_id='" . $cat . "' ORDER BY `qty` DESC";
    }
}
if ($col !== "0") {
    if ($sort == "0") {

        $quvry .= " AND product.color_id='" . $col . "'";
    } else if ($sort == "1") {

        $quvry .= " AND product.color_id='" . $col . "' ORDER BY `price` ASC";
    } else if ($sort == "2") {

        $quvry .= " AND product.color_id='" . $col . "' ORDER BY `price` DESC";
    } else if ($sort == "3") {

        $quvry .= " AND product.color_id='" . $col . "' ORDER BY `qty` ASC";
    } else if ($sort == "4") {

        $quvry .= " AND product.color_id='" . $col . "' ORDER BY `qty` DESC";
    }
}
if (!empty($pf) && !empty($pt)) {
    if ($sort == "0") {

        $quvry .= "AND product.price>='" . $pf . "' AND product.price<='" . $pt . "'";
    } else if ($sort == "1") {

        $quvry .= "AND product.price>='" . $pf . "' AND product.price<='" . $pt . "' ORDER BY `price` ASC";
    } else if ($sort == "2") {

        $quvry .= "AND product.price>= '" . $pf . "' AND product.price<= '" . $pt . "' ORDER BY `price` DESC";
    } else if ($sort == "3") {

        $quvry .= "AND product.price>='" . $pf . "' AND product.price<='" . $pt . "' ORDER BY `qty` ASC";
    } else if ($sort == "4") {

        $quvry .= "AND product.price>='" . $pf . "' AND product.price<='" . $pt . "' ORDER BY `qty` DESC";
    }
}

$quvry1 = $quvry;

?>
<div class="row">
    <div class="offset-0 offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row ">

            <?php
            if ("0" !== ($_POST["page"])) {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $products = Database::search($quvry);
            $nProduct = $products->num_rows;
            $userProduct = $products->fetch_assoc();

            $results_per_page = 6;
            $number_of_pages = ceil($nProduct / $results_per_page);

            $page_first_result = ((int)$pageno - 1) * $results_per_page;
            $quvry1 .= " LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "";
            $selectedrs = Database::search($quvry1);
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
                                <span class="card-text text-success fw-bold"><?php echo $productImage["qty"] ?> Items Left</span><br/>

                                <?php
                                if ((int)$productImage["qty"] > 0) {
                                ?>
                                    <span class="card-text text-warning">In Stock</span><br/>
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
                                                <a href="#" class="btn btn-success fs" onclick="sendid(<?php echo $productImage['id'] ?>);">View</a>
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
                <a <?php

                    if ($pageno <= 1) {
                        echo "#";
                    } else {
                    ?> onclick="advancedSearch('<?php echo ($pageno - 1) ?>');" <?php
                                                                            }

                                                                                ?>>&laquo;</a>

                <?php

                for ($page = 1; $page <= $number_of_pages; $page++) {

                    if ($page == $pageno) {
                ?>
                        <a onclick="advancedSearch('<?php echo $page ?>');" class="ms-1 active"><?php echo $page; ?></a>
                    <?php
                    } else {
                    ?>

                        <a onclick="advancedSearch('<?php echo $page ?>');" class="ms-1"><?php echo $page; ?></a>

                <?php
                    }
                }

                ?>
                <a <?php

                    if ($pageno >= $number_of_pages) {
                        echo "#";
                    } else {
                    ?> onclick="advancedSearch('<?php echo ($pageno + 1) ?>');" <?php
                                                                            }

                                                                                ?>>&raquo;</a>
            </div>
        </div>
    </div>
</div>
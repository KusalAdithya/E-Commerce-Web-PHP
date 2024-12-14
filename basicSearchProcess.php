<?php
require "connection.php";

$searchText = $_GET["t"];
$searchSelect = $_GET["s"];
$pageno = $_GET["p"];

$result_per_page = 5;

if (!empty($searchText) && $searchSelect == 0) {

    $product = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $searchText . "%' ");
    $d = $product->num_rows;
    $row =  $product->fetch_assoc();

    $number_of_pages = ceil($d / $result_per_page);
    $page_first_result = ((int)$pageno - 1) * $result_per_page;

    $textSearch = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $searchText . "%' LIMIT " . $result_per_page . " OFFSET " . $page_first_result . "  ");
    $n = $textSearch->num_rows;
} else if ($searchSelect != 0 && empty($searchText)) {

    $product = Database::search("SELECT * FROM `product` WHERE `category_id` = '" . $searchSelect . "' ");
    $d = $product->num_rows;
    $row =  $product->fetch_assoc();

    $number_of_pages = ceil($d / $result_per_page);
    $page_first_result = ((int)$pageno - 1) * $result_per_page;

    $textSearch = Database::search("SELECT * FROM `product` WHERE `category_id` = '" . $searchSelect . "' LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
    $n = $textSearch->num_rows;
} else if (!empty($searchText) && $searchSelect != 0) {

    $product = Database::search("SELECT * FROM `product` WHERE `category_id` = '" . $searchSelect . "' AND `title` LIKE '%" . $searchText . "%' ");
    $d = $product->num_rows;
    $row =  $product->fetch_assoc();

    $number_of_pages = ceil($d / $result_per_page);
    $page_first_result = ((int)$pageno - 1) * $result_per_page;

    $textSearch = Database::search("SELECT * FROM `product` WHERE `category_id` = '" . $searchSelect . "' AND `title` LIKE '%" . $searchText . "%' LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
    $n = $textSearch->num_rows;
}
?>

<div class="row mt-3">
    <!-- product view -->
    <div class="col-12 mb-5">
        <div class="row ">
            <div class="col-12 ">
                <div class="row justify-content-center">

                    <?php
                    for ($y = 0; $y < $n; $y++) {
                        $productrs= $textSearch->fetch_assoc();
                    ?>

                        <div class="card col-5 col-lg-2 mt-1 mb-1 ms-1" style="width: 18rem;" id="pdetails">

                            <?php
                            $pimage = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $productrs["id"] . "' ");
                            $img = $pimage->fetch_assoc();
                            ?>

                            <img src="<?php echo $img["code"] ?>" class="card-img-top cardTopImg img-fluid mx-auto">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $productrs["title"] ?></h5>
                                <span class="card-text text-primary">Rs. <?php echo $productrs["price"] ?>.00</span>
                                <br />

                                <?php
                                if ((int)$productrs["qty"] > 0) {
                                ?>
                                    <span class="card-text text-warning">In Stock</span>
                                    <input class="form-control mb-1" type="number" value="1" min="0" id="qtytxt<?php echo $productrs['id']; ?>" />
                                    <a href="<?php echo "singleproductview.php?id=" . ($productrs['id']) ?>" class="btn btn-success">View</a>
                                    <a class="btn btn-danger" onclick="addToCart(<?php echo $productrs['id']; ?>);">Add Cart</a>
                                    <a class="btn btn-secondary" onclick="addToWatchlist(<?php echo $productrs['id']; ?>)"><i class="bi bi-heart-fill"></i></a>
                                <?php
                                } else {
                                ?>
                                    <span class="card-text text-danger">Out Of Stock</span>
                                    <input class="form-control mb-1" type="number" value="1" disabled />
                                    <a href="<?php echo "singleproductview.php?id=" . ($productrs['id']) ?>" class="btn btn-success">View</a>
                                    <a href="#" class="btn btn-danger disabled" disabled>Add Cart</a>
                                    <a class="btn btn-secondary" onclick="addToWatchlist(<?php echo $productrs['id']; ?>)"><i class="bi bi-heart-fill"></i></a>
                                <?php
                                }

                                ?>

                            </div>
                        </div>

                    <?php
                    }
                    ?>

                    <!-- pagination -->
                    <div class="col-12 mb-3">
                        <div class="d-flex justify-content-center">
                            <div class="pagination">
                                <?php
                                if ($pageno != 1) {
                                ?>
                                    <a onclick="basicSearch(<?php echo $pageno - 1; ?>);">&laquo;</a>
                                    <?php
                                }

                                for ($page = 1; $page <= $number_of_pages; $page++) {
                                    if ($page == $pageno) {
                                    ?>
                                        <a class="ms-1 active" onclick="basicSearch(<?php echo $page; ?>);"><?php echo $page; ?></a>
                                    <?php
                                    } else {
                                    ?>
                                        <a class="ms-1" onclick="basicSearch(<?php echo $page; ?>);"><?php echo $page; ?></a>
                                <?php
                                    }
                                }
                                ?>
                                <?php
                                if ($pageno < $number_of_pages) {
                                ?>
                                    <a class="ms-1" onclick="basicSearch(<?php echo $pageno + 1; ?>);">&raquo;</a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                    <!-- pagination -->

                </div>
            </div>
        </div>
    </div>
    <!-- product view -->
</div>
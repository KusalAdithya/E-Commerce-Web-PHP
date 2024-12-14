<?php
session_start();

require "connection.php";

$user = $_SESSION["a"];

$search = $_POST["s"];
$age = $_POST["a"];
$qty = $_POST["q"];
$condition = $_POST["c"];

$pageno = $_POST["p"];

$results_per_page = 6;

if (!empty($search) && $age == 0 && $qty == 0 && $condition == 0) {  // search

    $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE'%" . $search . "%'");
    $pn = $products->num_rows;
    $number_of_pages = ceil($pn / $results_per_page);
    $page_first_result = ($pageno - 1) * $results_per_page;
    $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE '%" . $search . "%' LIMIT $results_per_page OFFSET  $page_first_result");
    $spn = $selectedproducts->num_rows;

} elseif (!empty($search) && $age != 0 && $qty == 0 && $condition == 0) { // search & age

    if ($age == 1) {

        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE'%" . $search . "%' ORDER BY `datetime_added` DESC");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $page_first_result = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE '%" . $search . "%' ORDER BY `datetime_added` DESC LIMIT $results_per_page OFFSET  $page_first_result");
        $spn = $selectedproducts->num_rows;

    } elseif ($age == 2) {

        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE'%" . $search . "%' ORDER BY `datetime_added` ASC");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $page_first_result = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE '%" . $search . "%' ORDER BY `datetime_added` ASC LIMIT $results_per_page OFFSET  $page_first_result");
        $spn = $selectedproducts->num_rows;

    }

} elseif (!empty($search) && $age == 0 && $qty != 0 && $condition == 0) { // search & qty

    if ($qty == 2) {

        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE'%" . $search . "%' ORDER BY `qty` DESC");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $page_first_result = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE '%" . $search . "%' ORDER BY `qty` DESC LIMIT $results_per_page OFFSET $page_first_result");
        $spn = $selectedproducts->num_rows;

    } elseif ($qty == 1) {

        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE'%" . $search . "%' ORDER BY `qty` ASC");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $page_first_result = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE '%" . $search . "%' ORDER BY `qty` ASC LIMIT $results_per_page OFFSET $page_first_result");
        $spn = $selectedproducts->num_rows;

    }

} elseif (!empty($search) && $age == 0 && $qty == 0 && $condition != 0) { // search & condition

    if ($condition == 1) {

        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE'%" . $search . "%' AND `condition_id`='1' ");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $page_first_result = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE '%" . $search . "%' AND `condition_id`='1'  LIMIT $results_per_page OFFSET $page_first_result");
        $spn = $selectedproducts->num_rows;

    } elseif ($condition == 2) {

        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE'%" . $search . "%' AND `condition_id`='2' ");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $page_first_result = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE '%" . $search . "%' AND `condition_id`='2' LIMIT $results_per_page OFFSET $page_first_result");
        $spn = $selectedproducts->num_rows;

    }

} elseif (empty($search) && $age != 0 && $qty == 0 && $condition == 0) { // age

    if ($age == 1) {

        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ORDER BY `datetime_added` DESC");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $page_first_result = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ORDER BY `datetime_added` DESC LIMIT $results_per_page OFFSET $page_first_result");
        $spn = $selectedproducts->num_rows;

    } elseif ($age == 2) {

        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ORDER BY `datetime_added` ASC");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $page_first_result = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ORDER BY `datetime_added` ASC LIMIT $results_per_page OFFSET $page_first_result");
        $spn = $selectedproducts->num_rows;

    }

} elseif (empty($search) && $age == 0 && $qty != 0 && $condition == 0) { // qty

    if ($qty == 2) {

        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ORDER BY `qty` DESC");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $page_first_result = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ORDER BY `qty` DESC LIMIT $results_per_page OFFSET $page_first_result");
        $spn = $selectedproducts->num_rows;

    } elseif ($qty == 1) {

        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ORDER BY `qty` ASC");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $page_first_result = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ORDER BY `qty` ASC LIMIT $results_per_page OFFSET $page_first_result");
        $spn = $selectedproducts->num_rows;

    }

} elseif (empty($search) && $age == 0 && $qty == 0 && $condition != 0) { // condition

    if ($condition == 1) {

        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `condition_id`='1' ");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $page_first_result = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `condition_id`='1'  LIMIT $results_per_page OFFSET $page_first_result");
        $spn = $selectedproducts->num_rows;

    } elseif ($condition == 2) {

        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `condition_id`='2' ");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $page_first_result = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `condition_id`='2' LIMIT $results_per_page OFFSET $page_first_result");
        $spn = $selectedproducts->num_rows;

    }
} else {

    $spn = 0;
    $number_of_pages = 0;
}

?>

<div class="row">
    <div class="offset-1 col-10 text-center">
        <div class="row">

            <?php
            for ($x = 0; $x < $spn; $x++) {
                $pro = $selectedproducts->fetch_assoc();
            ?>

                <div class="card mb-3 col-lg-6 col-12 mt-3  bg-white">
                    <div class="row ">
                        <?php
                        $pimgrs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pro["id"] . "'");
                        $pir = $pimgrs->fetch_assoc();
                        ?>
                        <div class="col-md-4 mt-4">
                            <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" />
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo $pro["title"]; ?></h5>
                                <span class="card-text fw-bold text-primary">Rs. <?php echo $pro["price"]; ?>.00</span>
                                <br />
                                <span class="card-text fw-bold text-success"><?php echo $pro["qty"]; ?> Items Left</span><br/>
                                <span class="card-text fw-bold text-secondary">Registerd Date : <?php echo $pro["datetime_added"]; ?></span>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="check" onchange='changeStatus(<?php echo $pro["id"]; ?>);' <?php
                                                                                                                                                                    if ($pro["status_id"] == 2) {
                                                                                                                                                                        echo "checked";
                                                                                                                                                                    }
                                                                                                                                                                    ?> />
                                    <label class="form-check-label fw-bold text-info" for="check" id="checklabel<?php echo $pro["id"]; ?>">
                                        <?php
                                        if ($pro["status_id"] == 2) {
                                            echo "Make Your Product Active";
                                        } else {
                                            echo "Make Your Product Deactive";
                                        }
                                        ?>
                                    </label>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <a href="#" class="btn btn-success d-grid" onclick="sendid(<?php echo $pro['id']; ?>);">Update</a>
                                        </div>
                                        <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                            <a href="#" class="btn btn-danger d-grid" onclick='deleteModel(<?php echo $pro["id"]; ?>);'>Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="deleteModel<?php echo $pro["id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bolder text-warning" id="exampleModalLabel">Warning...</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are You Sure You Want To Delete This Product?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                                <button type="button" class="btn btn-danger" onclick='deleteproduct(<?php echo $pro["id"]; ?>);'>Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->

            <?php
            }
            ?>
        </div>
    </div>

    <!-- pagination -->
    <div class="col-12 mb-3">
        <div class="d-flex justify-content-center">
            <div class="pagination">
                <?php
                if ($pageno != 1) {
                ?>
                    <a onclick="addFilters(<?php echo $pageno - 1; ?>);">&laquo;</a>
                    <?php
                }

                for ($page = 1; $page <= $number_of_pages; $page++) {
                    if ($page == $pageno) {
                    ?>
                        <a class="ms-1 active" onclick="addFilters(<?php echo $page; ?>);"><?php echo $page; ?></a>
                    <?php
                    } else {
                    ?>
                        <a class="ms-1" onclick="addFilters(<?php echo $page; ?>);"><?php echo $page; ?></a>
                <?php
                    }
                }
                ?>
                <?php
                if ($pageno < $number_of_pages) {
                ?>
                    <a class="ms-1" onclick="addFilters(<?php echo $pageno + 1; ?>);">&raquo;</a>
                <?php
                }
                ?>
            </div>
        </div>

    </div>
    <!-- pagination -->

</div>
<!-- <script src="script.js"></script> -->
<!-- product -->
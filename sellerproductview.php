<?php
// session_start();

// require "connection.php";

// if (isset($_SESSION["a"])) {
//     $user = $_SESSION["a"];
//     $pageno;
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>AdiMobile | Manage Products</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="resources/mylogo.png">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body class="mainbackground">

        <div class="container-fluid">
            <div class="row gy-3">
                <div>
                    <div class="col-12 mb-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="adminpanel.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Manage Products</li>
                            </ol>
                        </nav>
                    </div>
                </div>


                <div class="col-12 mt-0 text-start">
                    <h1 class="text-primary fw-bold  ">My Products</h1>
                </div>
                <div class="bg-primary mt-0 col-12" style="height: 10px;"></div>

                <div class="col-12 mt-2">
                    <div class="row justify-content-center">

                        <!-- sortings -->
                        <div class="col-11 col-lg-2 mx-auto mx-lg-3  mb-3 rounded  border border-primary">
                            <div class="row">
                                <div class="col-12 mt-3 ms-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-3">Filters</label>
                                        </div>
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="input-group flex-nowrap">
                                                        <input type="text" class="form-control" placeholder="Search..." id="s" onkeyup="addFilters(1);">
                                                        <span class="input-group-text fs-5 bi bi-search"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" class="border border-primary rounded-3" />
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">Active Time</label>
                                        </div>
                                        <!-- <div class="col-12">
                                            <hr width="80%" class="border border-primary rounded-3" />
                                        </div> -->
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="n" onclick="addFilters(1);">
                                                <label class="form-check-label" for="n" onclick="addFilters(1);">
                                                    Newer To Oldest
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="o" onclick="addFilters(1);">
                                                <label class="form-check-label" for="o" onclick="addFilters(1);">
                                                    Oldest To Newer
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" class="border border-primary rounded-3" />
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By Quantity</label>
                                        </div>
                                        <!-- <div class="col-12">
                                            <hr width="80%" />
                                        </div> -->
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="l" onclick="addFilters(1);">
                                                <label class="form-check-label" for="l" onclick="addFilters(1);">
                                                    Low To High
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="h" onclick="addFilters(1);">
                                                <label class="form-check-label" for="h" onclick="addFilters(1);">
                                                    High To Low
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" class="border border-primary rounded-3" />
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By Condition</label>
                                        </div>
                                        <!-- <div class="col-12">
                                            <hr width="80%" />
                                        </div> -->
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="b" onclick="addFilters(1);">
                                                <label class="form-check-label" for="b" onclick="addFilters(1);">
                                                    Brand New
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="u" onclick="addFilters(1);">
                                                <label class="form-check-label" for="u" onclick="addFilters(1);">
                                                    Used
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-9 offset-1 col-lg-8 mb-3 mt-3 d-grid d-flex align-content-center">
                                            <div class="row justify-content-center">
                                                <!-- <button class="col-12 d-grid btn btn-success mb-3" onclick="addFilters(1);">Search</button> -->
                                                <button class="col-12 d-grid btn btn-primary" onclick="clearFilters();">Clear Filters</button>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" class="border border-primary rounded-3" />
                                        </div>
                                        <div class="col-10 align-content-center">
                                            <div class="row justify-content-center">
                                            <a class=" btn btn-outline-success" href="addnewcategory.php">Add new <br/> category / model / colour</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- sortings -->

                        <!-- product -->
                        <div class="col-11 mx-auto mx-lg-0 col-lg-9  mb-3 rounded border border-primary" id="view" style="background-color: rgba(211, 224, 243, 0.603);" >
                            <div class="row">

                                <div class="col-10 offset-1 text-center ">
                                    <div class="row">
                                        <?php

                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }

                                        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ");
                                        $d = $products->num_rows;
                                        $row = $products->fetch_assoc();

                                        $results_per_page = 6;

                                        $number_of_pages = ceil($d / $results_per_page);

                                        $page_first_result = ((int)$pageno - 1) * $results_per_page;

                                        $selectedrs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' LIMIT " . $results_per_page . " OFFSET " . $page_first_result . " ");

                                        $srn = $selectedrs->num_rows;

                                        while ($srow = $selectedrs->fetch_assoc()) {
                                        ?>
                                            <div class="card mb-3 mt-3 col-12 col-lg-6 bg-white"  >
                                                <div class="row ">
                                                    <?php

                                                    $pimgrs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $srow["id"] . "' ");
                                                    $pir = $pimgrs->fetch_assoc();

                                                    ?>
                                                    <div class="col-md-4 mt-4">
                                                        <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title fw-bold"><?php echo $srow["title"]; ?></h5>
                                                            <span class="card-text fw-bold text-primary">Rs. <?php echo $srow["price"]; ?>.00</span>
                                                            <br />
                                                            <span class="card-text fw-bold text-success"><?php echo $srow["qty"]; ?> Items Left</span><br/>
                                                            <span class="card-text fw-bold text-secondary">Registerd Date : <?php echo $srow["datetime_added"]; ?></span>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" id="check" onchange="changeStatus(<?php echo $srow['id']; ?>);" <?php
                                                                                                                                                                                                if ($srow["status_id"] == 2) {
                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                } ?> />
                                                                <label class="form-check-label fw-bold text-info" for="check" id="checklabel<?php echo $srow['id']; ?>">
                                                                    <?php
                                                                    if ($srow["status_id"] == 2) {
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
                                                                        <a href="#" class="btn btn-success d-grid" onclick="sendid(<?php echo $srow['id']; ?>);">Update</a>
                                                                    </div>

                                                                    <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                                                        <a href="#" class="btn btn-danger d-grid" onclick="deleteModel(<?php echo $srow['id']; ?>);">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- modal -->
                                            <div class="modal fade" id="deleteModel<?php echo $srow['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title fw-bold text-warning" id="exampleModalLabel">Warning...</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are You Sure, You Want To Delete This Product?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                                                            <button type="button" class="btn btn-danger" onclick="deleteproduct(<?php echo $srow['id']; ?>);">Yes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- modal -->


                                        <?php
                                        }

                                        ?>
                                    </div>
                                </div>

                                <!-- pagination -->
                                <div class="col-12 mb-3">
                                    <div class="d-flex justify-content-center">
                                        <div class="pagination">
                                            <a href="<?php
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
                                            <a href="<?php
                                                        if ($pageno >= $number_of_pages) {
                                                            echo "#";
                                                        } else {
                                                            echo "?page=" . ($pageno + 1);
                                                        }
                                                        ?>">&raquo;</a>
                                        </div>
                                    </div>

                                </div>
                                <!-- pagination -->

                            </div>
                        </div>
                        <!-- product -->

                    </div>
                </div>

                <?php
                require "footer.php";
                ?>
            </div>

        </div>

        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
    </body>

    </html>

<?php
// } else {
?>
    <script>
        alert("You Have To Signin or Signup First");
        window.location = "index.php";
    </script>
<?php
// }
?>
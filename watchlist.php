<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
    $uemail = $_SESSION["u"]["email"];
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>AdiMobile | Watchlist</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/mylogo.png" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>

        <div class="container-fluid">
            <div class="row gx-2 gy-2">

                <!-- header -->
                <?php
                require "header.php";
                ?>
                <!-- header -->

                <div class="col-12 ">
                    <div class="row">
                        <!-- <hr class="border border-primary rounded-3" /> -->
                        <div class="col-12" style="background-color: #E3E5E4;">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">My Watchlist</li>
                                </ol>
                            </nav>
                        </div>

                        <div class="col-12">
                            <label class="form-label fs-1 fw-bolder text-primary">My Watchlist &hearts;</label>
                        </div>
                        <hr class="border border-primary rounded-3" />
                        <!-- <div class="col-12">
                            <hr class="hrbreak1" />
                        </div> -->
                        <!-- <div class="col-12">
                            <div class="row">
                                <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-3">
                                    <input type="text" class="form-control" placeholder="Search in Watchlist..." />
                                </div>
                                <div class="col-12 col-lg-2 d-grid mb-3">
                                    <button class="btn btn-outline-primary">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <hr class="hrbreak1" />
                        </div> -->
                        <!-- <div class="col-12 col-lg-2 border border-start-0 border-top-0 border-bottom-0 border-end border-2 border-primary">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                </ol>
                            </nav>
                            <nav class="nav nav-pills flex-column">
                                <a class="nav-link active" aria-current="page" href="#">My Watchlist</a>
                                <a class="nav-link" href="cart.php">My Cart</a>
                                <a class="nav-link" href="#">Recently Viewed</a>
                            </nav>
                        </div> -->
                        <?php

                        $watchlistrs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $uemail . "' ORDER BY `id` DESC ");
                        $wnn = $watchlistrs->num_rows;

                        if ($wnn == 0) {
                        ?>

                            <!-- without items -->
                            <div class="col-12 mx-auto">
                                <div class="row">
                                    <div class="col-12 emptyview"></div>
                                    <div class="col-12 text-center">
                                        <label class="form-lable fs-1 mb-3 fw-bolder">You have no items in your Watchlist.</label>
                                       
                                        <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid mb-4">
                                        <a href="home.php" class="btn btn-primary fs-3">View Products</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- without items -->

                        <?php
                        } else {
                        ?>
                            <div class="col-12 col-lg-9 mx-auto">
                                <div class="row g-2">

                                    <?php

                                    for ($i = 0; $i < $wnn; $i++) {

                                        $wr = $watchlistrs->fetch_assoc();
                                        $wid = $wr["product_id"];

                                        $productrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $wid . "' ");
                                        $pn = $productrs->num_rows;
                                        if ($pn == 1) {
                                            $pr = $productrs->fetch_assoc();
                                            $prodid = $pr["id"];
                                    ?>
                                            <div class="card mb-3 col-11 mx-auto">
                                                <div class="row g-0">
                                                    <div class="col-md-4 text-center">

                                                        <?php
                                                        $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $prodid . "' ");
                                                        $in = $imagers->fetch_assoc();

                                                        ?>

                                                        <img src="<?php echo $in["code"]; ?>" class="img-fluid rounded-start" style="height: 170px;" />
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="card-body">
                                                            <h3 class="card-title"><?php echo $pr["title"] ?></h3>

                                                            <?php
                                                            $colourrs = Database::search("SELECT `name` FROM `color` WHERE `id`='" . $pr["color_id"] . "' ");
                                                            $cr = $colourrs->fetch_assoc();
                                                            ?>
                                                            <span class="fw-bold text-black-50">Colour : <?php echo $cr["name"] ?></span>&nbsp;|

                                                            <?php
                                                            $conditionrs = Database::search("SELECT `name` FROM `condition` WHERE `id`='" . $pr["condition_id"] . "' ");
                                                            $cor = $conditionrs->fetch_assoc();
                                                            ?>
                                                            <!-- &nbsp;<span class="fw-bold text-black-50">Condition : <?php echo $cor["name"] ?></span>&nbsp; -->
                                                            <br />
                                                            <span class="fw-bold text-black-50">Condition : <?php echo $cor["name"] ?></span>&nbsp;
                                                            <br/>
                                                            <span class="fw-bold text-black-50 fs-5">Price : </span>&nbsp;
                                                            <span class="fw-bolder text-black fs-5">Rs. <?php echo $pr["price"] ?>.00</span>
                                                            <br />
                                                            <!-- <span class="fw-bold text-black-50 fs-5">Seller : </span>
                                                            <br /> -->

                                                            <?php
                                                            // $sellerrs = Database::search("SELECT * FROM `user` WHERE `email`='" . $pr["user_email"] . "' ");
                                                            // $sr = $sellerrs->fetch_assoc();
                                                            ?>
                                                            <!-- <span class="fw-bold text-black fs-5"><?php echo $sr["fname"] . " " . $sr["lname"] ?></span>
                                                            <br />
                                                            <span class="fw-bold text-black fs-5"><?php echo $pr["user_email"] ?></span> -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mt-4">
                                                        <div class="card-body d-grid">
                                                            <a class="btn btn-outline-success mb-2" href="<?php echo "singleproductview.php?id=" . ($wid) ?>">View</a>
                                                            <a class="btn btn-outline-secondary mb-2" href="<?php echo "cart.php?id=" . ($wid) ?>">Add Cart</a>
                                                            <a class="btn btn-outline-danger mb-2" onclick="deletefromwatchlist(<?php echo $wr['id'] ?>);">Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
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


            </div>
        </div>

        <div class="container-fluid mt-3">
            <div class="row">
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
} else {
?>
    <script>
        alert("You Have To Signin or Signup First");
        window.location = "index.php";
    </script>
<?php
}
?>
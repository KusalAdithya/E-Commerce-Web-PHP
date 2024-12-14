<?php
session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
    $mail = $_SESSION["u"]["email"];

    $invoicers = Database::search("SELECT * FROM `invoice` WHERE `status_id`='1' AND `user_email`='" . $mail . "' ORDER BY `id` DESC ");
    $in = $invoicers->num_rows;


?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>AdiMobile | Transaction History</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/mylogo.png" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <!-- header -->
                <?php require "header.php"; ?>
                <!-- header -->
                <!-- <hr /> -->

                <div class="col-12" style="background-color: #E3E5E4;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Transaction History</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-12 text-center mb-3">
                    <span class="fs-1 fw-bold text-primary">Transaction History</span>
                </div>

                <?php
                if ($in == 0) {
                ?>

                    <div class="col-12 text-center bg-light" style="height: 450px;">
                        <span class="fs-1 fw-bold text-black-50 d-block" style="margin-top: 160px;">You have no items in your Transaction History yet..</span>
                        <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid mb-4">
                        <a href="home.php" class="btn btn-primary fs-3">Start Shopping</a>
                    </div>
                    </div>
                    

                <?php
                } else {
                ?>

                    <div class="col-12">
                        <div class="row">

                            <div class="col-12 d-none d-lg-block">
                                <div class="row">
                                    <div class="col-1 " style="background-color: rgb(223, 223, 223);">
                                        <label class="form-label fw-bold">#</label>
                                    </div>
                                    <div class="col-3 bg-light">
                                        <label class="form-label fw-bold">Order Details</label>
                                    </div>
                                    <div class="col-1 bg-light text-end">
                                        <label class="form-label fw-bold">Quantity</label>
                                    </div>
                                    <div class="col-2 text-end" style="background-color:rgb(223, 223, 223);">
                                        <label class="form-label fw-bold">Amount</label>
                                    </div>
                                    <div class="col-2 bg-light text-end">
                                        <label class="form-label fw-bold">Purchased Data & Time</label>
                                    </div>
                                    <div class="col-3" style="background-color: rgb(223, 223, 223);"></div>
                                    <div class="col-12">
                                        <hr />
                                    </div>

                                </div>
                            </div>

                            <div class="col-11 col-lg-12 mx-auto mx-lg-0 ">
                                <div class="row justify-content-center">
                                    <?php

                                    for ($i = 0; $i < $in; $i++) {
                                        $ir = $invoicers->fetch_assoc();

                                    ?>

                                        <div class="col-11 col-lg-12 mx-auto mx-lg-0 border border-2 border-dark rounded mt-2">
                                            <div class="row justify-content-center ">
                                                <div class="col-12 col-lg-1  text-center" style="background-color:rgb(223, 223, 223);">
                                                    <label class="form-label  py-5 fw-bold"><span class="fs-4 d-lg-none"># </span> <?php echo $ir["order_id"]; ?></label>
                                                </div>
                                                <div class="col-11 col-lg-3 mx-auto mx-lg-0 ">
                                                    <div class="row">
                                                        <div class="card mx-auto mx-lg-3 my-3" style="max-width: 540px;" onclick="view(<?php echo $ir['product_id']; ?>);">
                                                            <div class="row g-0">
                                                                <div class="col-md-4 text-center">
                                                                    <?php
                                                                    $pid = $ir["product_id"];
                                                                    $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "' ");
                                                                    $f = $imagers->fetch_assoc();
                                                                    ?>

                                                                    <img src="<?php echo $f["code"]; ?>" class="img-fluid w-100">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="card-body text-center">
                                                                        <?php

                                                                        $productrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "' ");
                                                                        $pr = $productrs->fetch_assoc();

                                                                        ?>
                                                                        <h5 class="card-title"><?php echo $pr["title"]; ?></h5>
                                                                        <?php

                                                                        $sm = $pr["user_email"];
                                                                        $sellerrs = Database::search("SELECT * FROM `user` WHERE `email`='" . $sm . "' ");
                                                                        $sr = $sellerrs->fetch_assoc();

                                                                        ?>
                                                                        <!-- <p class="card-text"><b>Seller :</b> <?php echo $sr["fname"] . " " . $sr["lname"]; ?></p> -->
                                                                        <p class="card-text"><b>Price : </b>Rs. <?php echo $pr["price"]; ?>.00</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-lg-1 text-center text-lg-end">
                                                    <label class="form-label fs-4 pt-lg-5"><span class="fs-4 d-lg-none">Quantity :</span> <?php echo $ir["qty"]; ?></label>
                                                </div>

                                                <div class="col-12 col-lg-2 text-center text-lg-end " style="background-color: rgb(223, 223, 223);">
                                                    <label class="form-label  fs-4 pt-2 pt-lg-5 fw-bold"><span class="fs-4 d-lg-none">Amount : </span>Rs. <?php echo $ir["total"]; ?>.00</label>
                                                </div>

                                                <div class="col-12 col-lg-2 text-center text-lg-end">
                                                    <label class="form-label fs-4 pt-2 pt-lg-5"><span class="fs-4 d-lg-none">Data & Time :</span> <?php echo $ir["date"]; ?></label>
                                                </div>

                                                <div class="col-12 col-lg-3" style="background-color: rgb(223, 223, 223);">
                                                    <div class="row">
                                                        <div class="col-6 d-grid">
                                                            <button class="btn btn-secondary rounded border border-1 border-primary mt-5 fs-5" onclick="addFeedback(<?php echo $pid; ?>);"><i class="bi bi-info-circle-fill"></i> &nbsp; Feedback</button>
                                                        </div>
                                                        <div class="col-6 d-grid">
                                                            <button class="btn btn-danger rounded mt-5 fs-5" onclick="purchasedelete(<?php echo $ir['id']; ?>);"><i class="bi bi-trash-fill"></i> &nbsp; Delete</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>


                                    <!-- Modal -->
                                    <div class="modal fade" id="feedbackModal<?php echo $pid; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $pr["title"]; ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <textarea id="feedtxt" cols="30" rows="10" class="form-control fs-5"></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" onclick="saveFeedback(<?php echo $pid; ?>);">Save Feedback</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-12">
                                <hr />
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr />
                    </div>

                    <!-- <div class="col-12 mb-3">
                        <div class="row">
                            <div class="col-lg-10 d-none d-lg-block"></div>
                            <div class="col-12 col-lg-2 d-grid">
                                <button class="btn btn-danger fs-5"><i class="bi bi-trash-fill"></i> &nbsp; Clear All Records</button>
                            </div>
                        </div>
                    </div> -->

                <?php
                }
                ?>

                <!-- footer -->
                <?php require "footer.php"; ?>
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
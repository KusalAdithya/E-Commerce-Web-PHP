<?php

// session_start();

// require "connection.php";

// if (isset($_SESSION["a"])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>AdiMobile | Admin | Dashboard</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/mylogo.png" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
    </head>

    <body class="mainbackground">
        <!-- style="background-color:#74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%); min-height: 100vh;" -->

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-lg-2">
                    <div class="row">
                        <div class="align-items-start mx-auto bg-dark col-12 text-center mt-2 mb-2 ms-1" style="opacity: 90%; border-radius: 10px;">
                            <div class="row g-1">
                                <div class="col-12 col-lg-8 mx-auto logo" style="background-position: center;"></div>
                                <hr class="border border-2 border-primary rounded-3" />

                                <div class="col-12 mt-1">
                                    <h4 class="text-white fs-5"><?php echo $_SESSION["a"]["fname"] . " " . $_SESSION["a"]["lname"]; ?></h4>
                                    <hr class="border border-2 border-primary rounded-3" />
                                </div>

                                <div class="nav flex-column nav-pills me-3 mt-3" role="tablist" aria-orientation="vertical">
                                    <nav class="nav flex-column">
                                        <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                                        <a class="nav-link" href="addproduct.php">Add Products</a>
                                        <a class="nav-link" href="sellerproductview.php">Manage Products</a>
                                        <a class="nav-link" href="manageusers.php">Manage Users</a>
                                        <!-- <a class="nav-link" href="manageusers.php">Add new category/ brand / model</a> -->
                                        <!-- <a class="nav-link" href="manageproducts.php">Manage Products</a> -->
                                    </nav>
                                </div>

                                <div class="col-12">
                                    <!-- <hr class="border border-1 border-white" /> -->
                                    <hr class="border border-2 border-primary rounded-3" />

                                    <h4 class="text-white fs-5">Selling History</h4>
                                    <hr class="border border-2 border-primary rounded-3" />

                                </div>

                                <div class="col-12 mt-2 d-grid g-2">
                                    <label class="form-label text-white">From Date</label>
                                    <input type="date" class="form-control" id="fromdate" />
                                    <label class="form-label text-white mt-2">To Date</label>
                                    <input type="date" class="form-control" id="todate" />
                                    <a href="" id="historylink" class="btn btn-primary mt-2" onclick="dailysellings();">View Sellings</a>
                                    <hr class="border border-2 border-primary rounded-3" />

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-10">
                    <div class="row">

                        <div class="col-12 mt-3  text-primary">
                            <h2 class="fw-bold fs-1">Dashboard</h2>
                        </div>

                        <div class="col-12">
                            <div class="bg-primary col-12" style="height: 10px;"></div>

                            <!-- <hr class="border border-primary rounded-3"/> -->
                        </div>
                        <!-- <div class="bg-primary col-12" style="height: 10px;"></div> -->

                        <div class="col-12 mt-3">
                            <div class="row g-1">

                                <div class="col-6 col-md-4 px-1">
                                    <div class="row g-1">

                                        <div class="col-12 text-center border border-primary rounded-3" style="height: 100px; background-color: rgba(114, 170, 247, 0.932);">
                                            <br />
                                            <span class="fs-4 fw-bold">Daily Earnings</span>
                                            <br />
                                            <?php

                                            $today = date("Y-m-d");
                                            $thismonth = date("m");
                                            $thisyear = date("Y");
                                            $a = "0";
                                            $b = "0";
                                            $c = "0";
                                            $e = "0";
                                            $f = "0";


                                            $invoicers = Database::search("SELECT * FROM `invoice` ");
                                            $in = $invoicers->num_rows;

                                            for ($x = 0; $x < $in; $x++) {
                                                $ir = $invoicers->fetch_assoc();

                                                $f = $f + $ir["qty"];

                                                $d = $ir["date"];
                                                $splitedate = explode(" ", $d);
                                                $pdate = $splitedate[0];

                                                if ($pdate == $today) {
                                                    $a = $a + $ir["total"];
                                                    $c = $c + $ir["qty"];
                                                }

                                                $splitmonth = explode("-", $pdate);
                                                $pyear = $splitmonth[0];
                                                $pmonth = $splitmonth[1];

                                                if ($pyear == $thisyear) {
                                                    if ($pmonth == $thismonth) {
                                                        $b = $b + $ir["total"];
                                                        $e = $e + $ir["qty"];
                                                    }
                                                }
                                            }

                                            ?>
                                            <span class="fs-5">Rs. <?php echo $a; ?>.00</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 col-md-4 px-1">
                                    <div class="row g-1">

                                        <div class="col-12  text-dark text-center border border-primary rounded-3" style="height: 100px; background-color: rgba(114, 170, 247, 0.932);">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Earnings</span>
                                            <br />
                                            <span class="fs-5">Rs. <?php echo $b; ?>.00</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 col-md-4 px-1">
                                    <div class="row g-1">

                                        <div class="col-12 t text-dark text-center border border-primary rounded-3" style="height: 100px; background-color: rgba(114, 170, 247, 0.932);">
                                            <br />
                                            <span class="fs-4 fw-bold">Today Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo $c; ?> Items</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 col-md-4 px-1">
                                    <div class="row g-1">

                                        <div class="col-12  text-dark text-center border border-primary rounded-3" style="height: 100px; background-color: rgba(114, 170, 247, 0.932);">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo $e; ?> Items</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 col-md-4 px-1">
                                    <div class="row g-1">

                                        <div class="col-12  text-dark text-center border border-primary rounded-3" style="height: 100px; background-color: rgba(114, 170, 247, 0.932);">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo $f; ?> Items</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 col-md-4 px-1">
                                    <div class="row g-1">

                                        <div class="col-12  text-dark text-center border border-primary rounded-3" style="height: 100px; background-color: rgba(114, 170, 247, 0.932);">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Engagements</span>
                                            <br />
                                            <?php

                                            $usersrs = Database::search("SELECT * FROM `user` ");
                                            $un = $usersrs->num_rows;


                                            ?>
                                            <span class="fs-5"><?php echo $un; ?> Members</span>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- <div class="col-12">
                            <hr class="border border-primary rounded-3"/>
                        </div> -->

                        <div class="col-11 mx-auto  mt-3 " style="opacity: 90%; border-radius: 50px;  background-color: rgba(114, 169, 247, 0.671);">
                            <div class="row">
                                <div class="col-12 col-lg-2 text-center mt-3 mb-3">
                                    <label class="form-label fs-5 fw-bold text-primary">Total Active Time</label>
                                </div>
                                <?php

                                $startdate = new DateTime("2021-10-01 00:00:00");

                                $tdate = new DateTime();
                                $tz = new DateTimeZone("Asia/Colombo");
                                $tdate->setTimezone($tz);
                                $endDate = new DateTime($tdate->format("Y-m-d H:i:s"));

                                $difference = $endDate->diff($startdate);

                                ?>
                                <div class="col-12 col-lg-10 text-center mt-3 mb-3">
                                    <label class="form-label fs-5 fw-bold text-dark">
                                        <?php

                                        echo $difference->format('%Y') . " Years, " . $difference->format('%m') . " Months, " .
                                            $difference->format('%d') . " Days, " . $difference->format('%H') . " Hours, " .
                                            $difference->format('%i') . " Minutes, " . $difference->format('%s') . " Seconds";

                                        ?>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class=" col-10 col-md-5 mt-3 mx-auto mb-3 align-content-center rounded" style="background-color: rgba(183, 210, 247, 0.671);" >
                            <div class="row g-1">
                                <?php

                                $freg = Database::search("SELECT `product_id`, COUNT(`product_id`) AS `value_occurrence`,`qty` FROM `invoice` WHERE `date` 
                            LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY `value_occurrence` DESC LIMIT 1 ");

                                $freqnum = $freg->num_rows;

                                if ($freqnum > 0) {

                                    for ($z = 0; $z < $freqnum; $z++) {
                                        $freqrow = $freg->fetch_assoc();
                                    }
                                    $pro = Database::search("SELECT * FROM `product` WHERE `id`='" . $freqrow["product_id"] . "' ");
                                    $pro_rs = $pro->fetch_assoc();

                                    $img = Database::search("SELECT * FROM `images` WHERE `product_id`='" .  $freqrow["product_id"] . "' ");
                                    $img_rs = $img->fetch_assoc();

                                    $qty = Database::search("SELECT SUM(`qty`) AS `totalqty` FROM `invoice` WHERE `product_id`='" .  $freqrow["product_id"] . "' AND `date` LIKE '%" . $today . "%'; ");
                                    $qty_rs = $qty->fetch_assoc();

                                ?>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-4 fw-bold">Today Mostly Sold Item</label>
                                    </div>
                                    <!-- <div class="col-12 text-center">
                                        <img src="<?php echo $img_rs["code"]; ?>" class="img-fluid rounded-top" />
                                        <hr />
                                    </div>
                                    <div class="col-12 text-center">
                                        <span class="fs-5 fw-bold"><?php echo $pro_rs["title"]; ?></span>
                                        <br />
                                        <span class="fs-6 fw-bold"><?php echo $qty_rs["totalqty"]; ?> Items</span>
                                        <br />
                                        <span class="fs-6 fw-bold">Rs. <?php echo $pro_rs["price"]; ?>.00</span>
                                    </div>
                                    <div class="col-12">
                                        <div class="firstplace"></div>
                                    </div> -->

                                    <div class="card mb-3 text-center p-2" style="max-width: 100%; background-color: rgba(114, 169, 247, 0.671); ">
                                        <div class="row g-0 my-auto mx-auto">
                                            <div class=" col-6 mx-auto col-md-4">
                                                <img src="<?php echo $img_rs["code"]; ?>" class="img-fluid rounded-start" alt="...">
                                            </div>
                                            <div class="col-md-5">
                                                <div class="card-body">
                                                    <h5 class="card-title fs-4"><?php echo $pro_rs["title"]; ?></h5>
                                                    <span class="fs-5 fw-bold"><?php echo $qty_rs["totalqty"]; ?> Items</span><br />
                                                    <span class="fs-5 fw-bold">Rs. <?php echo $pro_rs["price"]; ?>.00</span>
                                                </div>
                                            </div>
                                            <div class="col-3 mx-auto">
                                                <div class="firstplace"></div>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                } else {
                                ?>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-4 fw-bold">Mostly Sold Item Today</label>
                                    </div>
                                    <hr />
                                    <div class="col-12  text-center" style="height: 200px;">
                                        <span class="fs-6">No one Today</span>
                                    </div>
                                <?php
                                }

                                ?>
                            </div>
                        </div>

                        <!-- <div class="offset-1 offset-md-2 col-10 col-md-4 mt-3 mb-3 rounded bg-light">
                            <div class="row g-1">
                                <?php
                                if ($freqnum > 0) {

                                    $profileimg = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" .  $pro_rs["user_email"] . "' ");
                                    $profileimg_rs = $profileimg->fetch_assoc();

                                    $user = Database::search("SELECT * FROM `user` WHERE `email`='" .   $pro_rs["user_email"] . "' ");
                                    $user_rs = $user->fetch_assoc();

                                ?>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-4 fw-bold">Mostly Famous Seller</label>
                                    </div>
                                    <div class="col-12 text-center">
                                        <img src="<?php echo $profileimg_rs["code"]; ?>" class="img-fluid rounded-top" style="height: 225px; margin-left: auto; margin-right: auto;" />
                                        <hr />
                                    </div>
                                    <div class="col-12 text-center">
                                        <span class="fs-5 fw-bold"><?php echo $user_rs["fname"] . " " . $user_rs["lname"]; ?></span>
                                        <br />
                                        <span class="fs-6 fw-bold"><?php echo $pro_rs["user_email"]; ?></span>
                                        <br />
                                        <span class="fs-6 fw-bold"><?php echo $user_rs["mobile"]; ?></span>
                                    </div>
                                    <div class="col-12">
                                        <div class="firstplace"></div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-4 fw-bold">Mostly Famouse Seller</label>
                                    </div>
                                    <hr />
                                    <div class="col-12  text-center" style="height: 200px;">
                                        <span class="fs-6">No one Today</span>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div> -->

                    </div>
                </div>

                <!-- footer -->
                <?php require "footer.php"; ?>
                <!-- footer -->
            </div>
        </div>

        <script src="script.js"></script>
    </body>

    </html>
<?php
// } else {
?>
    <script>
        window.location = "adminsignin.php";
    </script>
<?php
// }
?>
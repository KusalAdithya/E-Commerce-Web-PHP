<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="col-12 justify-content-center align-content-center">
        <div class="row mt-1 mb-1">
            <div class="col-12 col-md-7 offset-lg-1 col-lg-5 col-xl-4 align-self-start mt-2 ">
                <span class="text-start label1"><b>Welcome</b>
                    <?php
                    if (isset($_SESSION["u"])) {
                        $user = $_SESSION["u"]["fname"];
                      
                        $email = "adithyawickrama70@gmail.com";
                        $profileimg = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $_SESSION["u"]["email"] . "' ");
                        $pn = $profileimg->num_rows;

                        if ($pn == 1) {
                            $p = $profileimg->fetch_assoc();
                    ?>
                            | <img class="rounded rounded-circle " width="30px" src="<?php echo $p["code"]; ?>" id="imgprev" />&nbsp;
                        <?php
                        } else {
                        ?>
                            | <img class="rounded rounded-circle " width="30px" src="resources/demoProfileImg.jpg" id="imgprev" />&nbsp;
                        <?php
                        }

                        echo $user;
                        ?>
                </span> |
                <a class="text-start label2 text-decoration-none text-dark" onclick="viewmsgmodalu('<?php echo $email; ?>');" >Help and Contact</a> |
                <!--  href="msgtoadmin.php?email=adithyawickrama70@gmail.com" -->
                <!--   data-bs-toggle="modal" data-bs-target="#staticBackdrop" -->
                <span class="text-start label2" onclick="signOut();"><i class="bi bi-box-arrow-left fs-5 ms-2 mt-2 text-black-50 out"></i></span>
            <?php

                    } else {
            ?>
                User | <a href="index.php">Sign in or register</a>
                <!-- | <label class="text-primary text-decoration-underline" for="modal-btn">Sign in or register<i class="uil uil-expand-arrows"></i></label> | -->
                <!-- <a class="text-start label2 text-decoration-none text-dark" href="msgtoadmin.php?email=adithyawickrama70@gmail.com">Help and Contact</a> -->
            <?php
                    }
            ?>
            </div>

            <div class="col-12 col-md-4 offset-md-1 offset-lg-4 offset-xl-5 col-lg-3 col-xl-2" style="text-align: end;">
                <div class="row mt-1 mb-1 mt-lg-0 mb-lg-0">
                    <!-- <div class="col-1 col-md-2 col-lg-3 mt-2 ms-md-3 ms-lg-0">
                        <?php
                        if (isset($_SESSION["u"])) {

                        ?>
                            <span class="text-start label2" onclick="goToAddProduct();">Sell</span>
                        <?php
                        } else {
                        ?>
                            <span class="text-start label2 text-black-50" disabled>Sell</span>
                        <?php
                        }
                        ?>
                    </div> -->
                    <div class="dropdown col-2 col-md-3 col-lg-6 me-3 me-sm-0 me-md-0">
                        <label class=" mt-2 dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-list mt-2 "></i> &nbsp;Menu
                        </label>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="watchlist.php"><i class="bi bi-heart-fill"></i>&nbsp; Watchlist</a></li>
                            <li><a class="dropdown-item" href="userprofile.php"><i class="bi bi-person-fill fs-5"></i>&nbsp; My Profile</a></li>
                            <li><a class="dropdown-item" href="purchasehistory.php"><i class="bi bi-clock-history fs-6"></i>&nbsp; Purchase History</a></li>
                            <!-- <li><a class="dropdown-item" href="sellerproductview.php">My Products</a></li> -->
                            <!-- <li><a class="dropdown-item" href="userprofile.php">My Profile</a></li> -->
                            <!-- <li><a class="dropdown-item" href="#">My Sellings</a></li> -->
                            <!-- <li><a class="dropdown-item" href="messages.php?email='<?php echo $_SESSION["u"]["email"]; ?>'">Message</a></li> -->
                        </ul>
                    </div>
                    <div class="col-2 col-lg-3 col-md-4  ms-2  ms-md-5 ms-lg-0 mt-1 text-end">
                        <div onclick="goToCart();" class="carticon"></div>
                    </div>
                </div>
            </div>

            <!-- Button trigger modal -->
            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Launch static backdrop modal
            </button> -->

            <!-- Modal -->
            <?php
            $email = "adithyawickrama70@gmail.com";
            ?>
            <div class="modal fade" onload="refresher('<?php echo $email; ?>');" id="mesgmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Chat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body bg-white" style="height: 550px;">

                            <div class="col-12 py-1 px-2">
                                <div class="row rounded  shadow" style="height: 500px;">
                                    <!-- <div class="col-12 col-lg-5 mx-lg-3 px-0">
                                        <div class="bg-white">

                                            <div class="bg-light px-4 py-2">
                                                <h5 class="mb-0 py-1">Recent</h5>
                                            </div>

                                            <div class="message-box">

                                                <div class="list-group rounded-0" id="rcv">


                                                </div>
                                            </div>

                                        </div>
                                    </div> -->

                                    <div class="col-11  mx-auto px-0 mt-1" style="height: 430px;">
                                        <div class="row px-1 py-5 text-white chatbox" id="chatrow">
                                            <!-- massage load venne methana -->

                                        </div>
                                    </div>

                                    <!-- text -->
                                    <div class="col-12 bg-white mb-2">
                                        <div class="row mb-2">
                                            <div class="input-group">
                                                <input id="msgtxt" type="text" placeholder="Type a message..." aria-describedby="sendbtn" class="form-control" style="border-radius: 20px;" />
                                                <div class="input-group-appeng">
                                                    <button id="button-addon2" onclick="sendmessage('<?php echo $email; ?>');" class="btn btn-link fs-4 bi bi-cursor-fill"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- text -->

                                </div>
                            </div>


                        </div>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Understood</button>
                        </div> -->
                        <script src="script.js"></script>
                        <!-- <script src="bootstrap.bundle.js"></script> -->
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
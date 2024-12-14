<?php
// session_start();

// require "connection.php";

// if (isset($_SESSION["a"])) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>AdiMobile | Admin | Manage Users</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/mylogo.png" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
    </head>

    <body class="mainbackground">

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 mb-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="adminpanel.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-12 mb-2">
                    <label class="form-label fs-2 fw-bold text-primary">Manage All Users</label>
                    <!-- <hr /> -->
                </div>
                <div class="bg-primary col-12" style="height: 10px;"></div>

                <div class="col-12  rounded mt-3">
                    <div class="row">
                        <div class="mx-auto col-12 col-lg-8 mb-3">
                            <div class="row">
                                <div class="col-9 mx-auto">
                                    <input type="text" class="form-control fw-bold" placeholder="Search user email here..." id="searchtxt" onkeyup="searchUser1();" />
                                </div>
                                <!-- <div class="col-3 d- d-grid">
                                    <button class="btn btn-primary" onclick="searchUser1();">Search</button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="col-12 mt-3 mb-2">
                    <div class="row">
                        <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end">
                            <span class="fs-4 fw-bold text-white">#</span>
                        </div>
                        <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                            <span class="fs-4 fw-bold text-dark">Profile Image</span>
                        </div>
                        <div class="col-2 col-lg-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                            <span class="fs-4 fw-bold text-white">Email</span>
                        </div>
                        <div class="col-6 col-lg-2 bg-light pt-2 pb-2 ">
                            <span class="fs-4 fw-bold ">User Name</span>
                        </div>
                        <div class="col-2 col-lg-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                            <span class="fs-4 fw-bold text-white">Mobile</span>
                        </div>
                        <div class="col-2 col-lg-2 bg-light pt-2 pb-2 d-none d-lg-block">
                            <span class="fs-4 fw-bold">Registerd Date</span>
                        </div>
                        <div class="col-4 col-lg-1 bg-white pt-2 pb-2 d-grid"></div>
                    </div>
                </div> -->

                <div class="col-11 col-lg-10 mx-auto  mb-3 rounded border border-primary" id="view1" style="background-color: rgba(211, 224, 243, 0.603);">
                    <div class="row">

                        <div class="col-10 offset-1  ">
                            <div class="row">

                                <?php

                                if (isset($_GET["page"])) {
                                    $pageno = $_GET["page"];
                                } else {
                                    $pageno = 1;
                                }

                                $usersrs = Database::search("SELECT * FROM `user` WHERE `email` != 'adithyawickrama70@gmail.com' ");
                                $d = $usersrs->num_rows;
                                $row = $usersrs->fetch_assoc();

                                $results_per_page = 10;

                                $number_of_pages = ceil($d / $results_per_page);

                                $page_first_result = ((int)$pageno - 1) * $results_per_page;

                                $selectedrs = Database::search("SELECT * FROM `user`  WHERE `email` != 'adithyawickrama70@gmail.com' LIMIT " . $results_per_page . " OFFSET " . $page_first_result . " ");

                                $srn = $selectedrs->num_rows;

                                $c = "0";

                                while ($srow = $selectedrs->fetch_assoc()) {
                                    $c = $c + 1;
                                ?>

                                    <!-- <div class="col-12  mb-2">
                        <div class="row">

                            <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end">
                                <span class="fs-5 fw-bold text-white"><?php echo $c; ?></span>
                            </div>
                            <?php
                                    $profileimg = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $srow["email"] . "' ");
                                    $img = $profileimg->num_rows;
                                    if ($img == 1) {
                                        $code = $profileimg->fetch_assoc();
                            ?>
                                <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                    <img src="<?php echo $code["code"]; ?>" style="height: 60px; margin-left: 100px;" />
                                </div>
                            <?php
                                    } else {
                            ?>
                                <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                    <img src="resources/demoProfileImg.jpg" style="height: 60px; margin-left: 100px;">
                                </div>
                            <?php
                                    }
                            ?>
                            <div class="col-2 col-lg-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                                <span class="fs-5 fw-bold text-white"><?php echo $srow["email"]; ?></span>
                            </div>
                            <div class="col-6 col-lg-2 bg-light pt-2 pb-2" onclick="viewmsgmodal('<?php echo $srow['email']; ?>');">
                                <span class="fs-5 fw-bold"><?php echo $srow["fname"], " " . $srow["lname"]; ?></span>
                            </div>
                            <div class="col-2 col-lg-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                                <span class="fs-5 fw-bold text-white"><?php echo $srow["mobile"]; ?></span>
                            </div>
                            <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                <span class="fs-5 fw-bold">
                                    <?php
                                    $rd = $srow["register_date"];
                                    $spliterd = explode(" ", $rd);
                                    echo $spliterd[0];
                                    ?>
                                </span>
                            </div>

                            <div class="col-4 col-lg-1 bg-white pt-2 pb-2 d-grid">
                                <?php

                                    $s = $srow["status_id"];

                                    if ($s == "1") {
                                ?>
                                    <button id="blockbtn<?php echo $srow['email']; ?>" class="btn btn-danger" style="height: 40px;" onclick="blockuser('<?php echo $srow['email']; ?>');">Block</button>
                                <?php
                                    } else {
                                ?>
                                    <button class="btn btn-success" style="height: 40px;" onclick="blockuser('<?php echo $srow['email']; ?>');">Unblock</button>
                                <?php
                                    }

                                ?>
                            </div>
                        </div>
                    </div> -->

                                    <div class="card mb-3 mt-3 col-12 col-lg-5 bg-white mx-auto text-center" style="border-radius: 15px;" >
                                        <div class="row ">
                                            <?php

                                            // $pimgrs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $srow["id"] . "' ");
                                            // $pir = $pimgrs->fetch_assoc();

                                            ?>
                                            <?php
                                            $profileimg = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $srow["email"] . "' ");
                                            $img = $profileimg->num_rows;
                                            if ($img == 1) {
                                                $code = $profileimg->fetch_assoc();
                                            ?>
                                                <div class="col-md-4 mt-4" onclick="viewmsgmodal('<?php echo $srow['email']; ?>');">
                                                    <img src="<?php echo $code["code"]; ?>" style="height: 80px;" class="img-fluid rounded-start" />
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-md-4 mt-4" onclick="viewmsgmodal('<?php echo $srow['email']; ?>');">
                                                    <img src="resources/demoProfileImg.jpg" style="height: 80px; " class="img-fluid rounded-start">
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <!-- <div class="col-md-4 mt-4">
                                                <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start">
                                            </div> -->
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title fw-bold"><?php echo $srow["fname"] . " " . $srow["lname"]; ?></h5>
                                                    <span class="card-text fw-bold text-primary"><?php echo $srow["email"]; ?></span>
                                                    <br />
                                                    <span class="card-text fw-bold text-info">Mobile : <?php echo $srow["mobile"]; ?></span><br />
                                                    <span class="card-text fw-bold text-success">Registerd Date : <?php echo $spliterd[0]; ?></span>
                                                    <!-- <div class="form-check form-switch">
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
                                                    </div> -->
                                                    <div class="col-6 mx-auto">
                                                        <div class="row">
                                                            <!-- <div class="col-12 col-lg-6">
                                                                <a href="#" class="btn btn-success d-grid" onclick="sendid(<?php echo $srow['id']; ?>);">Update</a>
                                                            </div> -->

                                                            <!-- <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                                                <a href="#" class="btn btn-danger d-grid" onclick="deleteModel(<?php echo $srow['id']; ?>);">Delete</a>
                                                            </div> -->
                                                            <?php

                                                            $s = $srow["status_id"];

                                                            if ($s == "1") {
                                                            ?>
                                                                <button id="blockbtn<?php echo $srow['email']; ?>" class="btn btn-danger" style="height: 40px;" onclick="blockuser('<?php echo $srow['email']; ?>');">Block</button>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <button class="btn btn-success" style="height: 40px;" onclick="blockuser('<?php echo $srow['email']; ?>');">Unblock</button>
                                                            <?php
                                                            }

                                                            ?>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="mesgmodal<?php echo $srow['email']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Chat</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" style="height: 550px;">

                                                    <div class="col-12 py-1 px-2">
                                                        <div class="row rounded  shadow" style="height: 500px;">
                                                            <!-- <div class="col-12 col-lg-5 mx-lg-3 px-0">
                                                <div class="bg-white">

                                                    <div class="bg-light px-4 py-2">
                                                        <h5 class="mb-0 py-1">Recent</h5>
                                                    </div>

                                                    <div class="message-box">
                                                        <div class="list-group rounded-0" id="rcv<?php echo $srow['email']; ?>">

                                                        </div>
                                                    </div>

                                                </div>
                                            </div> -->

                                                            <div class="col-11  mx-auto px-0 mt-1" style="height: 430px;">
                                                                <div class="row px-1 py-5 text-white chatbox" id="chatrow<?php echo $srow['email']; ?>">
                                                                    <!-- massage load venne methana -->

                                                                </div>
                                                            </div>

                                                            <!-- text -->
                                                            <div class="col-12  mb-2">
                                                                <div class="row mb-2">
                                                                    <div class="input-group">
                                                                        <input id="msgtxt<?php echo $srow['email']; ?>" type="text" placeholder="Type a message..." aria-describedby="sendbtn" class="form-control" style="border-radius: 20px;" />
                                                                        <div class="input-group-appeng">
                                                                            <button id="button-addon2" onclick="admin_sendmessage('<?php echo $srow['email']; ?>');" class="btn btn-link fs-4 bi bi-cursor-fill"></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- text -->

                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div> -->
                                            </div>
                                        </div>
                                    </div>

                                <?php

                                }

                                ?>

                                <div class="col-12 text-center fs-5 fw-bold mt-3 mb-3">
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
                        </div>
                    </div>
                </div>

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
// } else {
?>
    <script>
        window.location = "adminsignin.php";
    </script>
<?php
// }
?>
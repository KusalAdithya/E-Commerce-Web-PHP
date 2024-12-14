<!DOCTYPE html>
<html>

<head>
    <title>AdiMobile | User Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/mylogo.png">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <?php

    session_start();

    require "connection.php";

    if (isset($_SESSION["u"])) {
    ?>

        <div class="container-fluid bg-white rounded  mb-5">
            <div class="row">
                <?php require "header.php"; ?>

                <div class="col-12" style="background-color: #E3E5E4;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                        </ol>
                    </nav>
                </div>
                <div class="bg-primary col-12" style="height: 10px;"></div>

                <div class="col-11 col-lg-11 border border-primary rounded-3 mt-2 mx-auto">
                    <div class="row">
                        <div class="col-12 col-md-5">
                            <div class="col-6 text-start">
                                <h1 class="text-primary fw-bold offset-2 ">My Profile</h1>
                                <hr class="border border-primary rounded-3" />
                            </div>
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                <?php

                                $profileimg = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $_SESSION["u"]["email"] . "' ");
                                $pn = $profileimg->num_rows;

                                if ($pn == 1) {
                                    $p = $profileimg->fetch_assoc();
                                ?>
                                    <img class="rounded rounded-circle mt-5" width="150px" src="<?php echo $p["code"]; ?>" id="imgprev" />
                                <?php
                                } else {
                                ?>
                                    <img class="rounded rounded-circle mt-5" width="150px" src="resources/demoProfileImg.jpg" id="imgprev" />
                                <?php
                                }

                                $user = Database::search("SELECT * FROM `user` WHERE `email`='" . $_SESSION["u"]["email"] . "' ");
                                $nu = $user->num_rows;
                                $u = $user->fetch_assoc();

                                ?>

                                <span class="font-weight-bold"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></span>
                                <span class="text-black-50"><?php echo $_SESSION["u"]["email"]; ?></span>
                                <input class="d-none" type="file" id="profileimg" accept="img/*" />
                                <label class="btn btn-primary mt-3" for="profileimg" onclick="proimgpreview();">Update Profile Image</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-7 ">
                            <div class="p-3 py-5">
                                <!-- <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-start">My Profile</h4>
                                </div> -->
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Name</label>
                                        <input id="fname" type="text" class="form-control" placeholder="First Name" value="<?php echo $_SESSION["u"]["fname"]; ?>" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Surname</label>
                                        <input id="lname" type="text" class="form-control" placeholder="Last Name" value="<?php echo $_SESSION["u"]["lname"]; ?>" />
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Mobile Number</label>
                                        <input id="mobile" type="text" class="form-control" placeholder="Enter Phone Number" value="<?php echo $_SESSION["u"]["mobile"]; ?>" />
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" placeholder="Enter Password" readonly value="<?php echo $_SESSION["u"]["password"]; ?>" />
                                            <button class="btn btn-outline-secondary" type="button"><i class="bi bi-eye" id="show1" onclick="showPasswordsignup();"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 ">
                                        <label class="form-label">Email Address</label>
                                        <input id="email" type="text" class="form-control" placeholder="Enter Email Id" readonly value="<?php echo $_SESSION["u"]["email"]; ?>" />
                                    </div>
                                    <div class="col-md-12 mb-3 ">
                                        <label class="form-label">Registered Date & Time</label>
                                        <input type="text" class="form-control" placeholder="Registered Date" readonly value="<?php echo $_SESSION["u"]["register_date"]; ?>" />
                                    </div>

                                    <?php

                                    $usermail = $_SESSION["u"]["email"];
                                    $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $usermail . "' ");
                                    $n = $addressrs->num_rows;

                                    if ($n == 1) {
                                        $d = $addressrs->fetch_assoc();

                                    ?>
                                        <div class="col-md-12 mb-3 ">
                                            <label class="form-label">Address Line 1</label>
                                            <input id="line1" type="text" class="form-control" placeholder="Enter Address Line 1" value="<?php echo $d["line1"]; ?>" />
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Address Line 2</label>
                                            <input id="line2" type="text" class="form-control" placeholder="Enter Address Line 2" value="<?php echo $d["line2"]; ?>" />
                                        </div>
                                </div>

                                <div class="row ">
                                    <?php

                                        $cityid = $d["city_id"];
                                        $ucity = Database::search("SELECT * FROM `city` WHERE `id`='" . $cityid . "' ");
                                        $c = $ucity->fetch_assoc();

                                        $districtid = $c["district_id"];
                                        $udist = Database::search("SELECT * FROM `district` WHERE `id`='" . $districtid . "' ");
                                        $k = $udist->fetch_assoc();

                                        $provinceid = $k["province_id"];
                                        $uprovince = Database::search("SELECT * FROM `province` WHERE `id`='" . $provinceid . "' ");
                                        $l = $uprovince->fetch_assoc();

                                    ?>

                                    <div class="col-md-6  mb-3">
                                        <label class="form-label">Province</label>
                                        <select class="form-select" id="province">
                                            <option value="<?php echo $l["id"]; ?>"><?php echo $l["name"]; ?></option>
                                            <?php

                                            $provincers = Database::search("SELECT * FROM `province` WHERE `id`!='" . $l["id"] . "' ");
                                            $pn = $provincers->num_rows;

                                            for ($i = 0; $i < $pn; $i++) {
                                                $pr = $provincers->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $pr["id"]; ?>"><?php echo $pr["name"]; ?></option>
                                            <?php

                                            }

                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">District</label>
                                        <select class="form-select" id="district">
                                            <option value="<?php echo $k["id"]; ?>"><?php echo $k["name"]; ?></option>
                                            <?php

                                            $districtrs = Database::search("SELECT * FROM `district` WHERE `id`!='" . $k["id"] . "' ");
                                            $dn = $districtrs->num_rows;

                                            for ($i = 0; $i < $dn; $i++) {
                                                $dr = $districtrs->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $dr["id"]; ?>"><?php echo $dr["name"]; ?></option>
                                            <?php

                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">City</label>
                                        <input id="city" type="text" class="form-control" placeholder="City" value="<?php echo $c["name"]; ?>" />


                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Postal Code</label>
                                        <input id="postalcode" type="text" class="form-control" placeholder="Postal Code" value="<?php echo $c["postal_code"]; ?>" />
                                    </div>

                                <?php
                                    } else {
                                ?>
                                    <div class="col-md-12 mb-3 ">
                                        <label class="form-label">Address Line 1</label>
                                        <input id="line1" type="text" class="form-control" placeholder="Enter Address Line 1" value="" />
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Address Line 2</label>
                                        <input id="line2" type="text" class="form-control" placeholder="Enter Address Line 2" value="" />
                                    </div>
                                </div>
                                <div class="row ">

                                    <div class="col-md-6  mb-3">
                                        <label class="form-label">Province</label>
                                        <select class="form-select" id="province">
                                            <option value="0">Select Province</option>
                                            <?php

                                            $provincers = Database::search("SELECT * FROM `province` ");
                                            $pn = $provincers->num_rows;

                                            for ($i = 0; $i < $pn; $i++) {
                                                $pr = $provincers->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $pr["id"]; ?>"><?php echo $pr["name"]; ?></option>
                                            <?php

                                            }

                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">District</label>
                                        <select class="form-select" id="district">
                                            <option value="0">Select District</option>
                                            <?php

                                            $districtrs = Database::search("SELECT * FROM `district`");
                                            $dn = $districtrs->num_rows;

                                            for ($i = 0; $i < $dn; $i++) {
                                                $dr = $districtrs->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $dr["id"]; ?>"><?php echo $dr["name"]; ?></option>
                                            <?php

                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">City</label>
                                        <input id="city" type="text" class="form-control" placeholder="City" value="" />

                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Postal Code</label>
                                        <input id="postalcode" type="text" class="form-control" placeholder="Postal Code" value="" />
                                    </div>

                                <?php
                                    }
                                ?>

                                <div class="col-md-12">
                                    <label class="form-label">Gender</label>
                                    <?php

                                    $genderid = $_SESSION["u"]["gender_id"];
                                    $ugender = Database::search("SELECT * FROM `gender` WHERE `id`='" . $genderid . "' ");
                                    $g = $ugender->fetch_assoc();

                                    ?>
                                    <input type="text" class="form-control" placeholder="Gender" readonly value="<?php echo $g["name"]; ?>" />
                                </div>

                                <div class="mt-5 text-center">
                                    <button class="btn btn-primary" onclick="updateProfile();">Update Profile</button>
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
        } else {
            ?>
                <script>
                    // alert("You Have To Signin or Signup First");
                    window.location = "index.php";
                </script>
            <?php
        }
            ?>

            <!-- <div class="col-md-4">
                <div class="row">
                    <div class="p-3 py-5">
                        <div class="col-md-12">
                            <span class="fw-bold">User Rating</span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-black-50"></span>
                            <p>4.1 Average based on 254 reviews.</p>
                            <hr class="hrbreak1" />
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div>5 Star</div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="text-end">150</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div>4 Star</div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="text-end">63</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div>3 Star</div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="text-end">15</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div>2 Star</div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="text-end">6</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div>1 Star</div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="text-end">20</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div> -->

            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <?php
                require "footer.php";
                ?>
            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>
<?php
session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

?>
    <script>
        window.location = "home.php";
    </script>
<?php
} else {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>AdiMobile</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/mylogo.png" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
    </head>

    <body class="mainbackground">

        <div class="container-fluid vh-100 d-flex justify-content-center">

            <div class="row align-content-center">

                <!-- content -->            
                <div class="col-12 p-3">
                    <div class="row mt-3">
                        <div class="col-12 col-lg-6 d-md-block">
                            <div class="col-12 mt-5">
                                <div class="row">
                                    <div class="col-12 logo"></div>
                                    <div class="col-12 mt-5">
                                        <p class="text-center title1">Hi, Welcome to AdiMobile</p>
                                    </div>
                                    <!-- <div  style="position: absolute;   margin-top: 50px; height: 100px;"> -->
                                        <!-- <hr class="d-none d-lg-block" style="transform: rotate(90deg); margin-top: -30px; width: 500px; margin-left: 400px;" /> -->
                                    <!-- </div> -->
                                    <div class="col-10 col-lg-5 mx-auto d-grid mb-3">
                                        <a href="home.php" class="btn btn-success">Watch Our Products</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- signin -->
                        <div class="col-12 col-lg-5 mt-3" id="signInBox">
                            <div class="row g-3">
                                <div class="col-12 text-center" style="height: 60px;">
                                    <p class="title2">Sign In To Your Account</p>
                                    <p class="text-danger" id="msg2"></p>
                                </div>
                                <?php
                                $e = "";
                                $p = "";
                                if (isset($_COOKIE["e"])) {
                                    $e = $_COOKIE["e"];
                                }
                                if (isset($_COOKIE["p"])) {
                                    $p = $_COOKIE["p"];
                                }
                                ?>
                                <div class="col-12">
                                    <lable class="form-label">Email</lable>
                                    <input class="form-control" type="email" id="email2" value="<?php echo $e ?>" onkeyup="clearp2();" />
                                </div>
                                <div class="col-12">
                                    <lable class="form-label">Password</lable>
                                    <div class="input-group">
                                        <input class="form-control" type="password" id="password2" value="<?php echo $p ?>" onkeyup="clearp2();" />
                                        <button class="btn btn-outline-secondary" type="button"><i class="bi bi-eye" id="show2" onclick="showPasswordsignin();"></i></button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="remember">
                                        <label class="form-check-label" for="remember">Remember Me</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <a href="#" class="link-primary" onclick="forgotPassword();">Forgot Password?</a>
                                </div>
                                <div class="col-12 col-lg-6  d-grid">
                                    <button class="btn btn-primary" onclick="signIn();">Sign In</button>
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-danger" onclick="changeView();">New to eShop? Join Now</button>
                                </div>
                            </div>
                        </div>

                        <!-- signup -->
                        <div class="col-12 col-lg-5 mt-3 d-none" id="signUpBox">
                            <div class="row g-2">
                                <div class="col-12 text-center" style="height: 70px;">
                                    <p class="title2">Create New Account</p>
                                    <p class="text-danger" id="msg"></p>
                                </div>
                                <div class="col-6">
                                    <lable class="form-label">First Name</lable>
                                    <input class="form-control" type="text" id="fname" onkeyup="clearp1();" />
                                </div>
                                <div class="col-6">
                                    <lable class="form-label">Last Name</lable>
                                    <input class="form-control" type="text" id="lname" onkeyup="clearp1();" />
                                </div>
                                <div class="col-12">
                                    <lable class="form-label">Email</lable>
                                    <input class="form-control" type="email" id="email" onkeyup="clearp1();" />
                                </div>
                                <div class="col-12">
                                    <lable class="form-label">Password</lable>
                                    <div class="input-group">
                                        <input class="form-control" type="password" id="password" onkeyup="clearp1();" />
                                        <button class="btn btn-outline-secondary" type="button"><i class="bi bi-eye" id="show1" onclick="showPasswordsignup();"></i></button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <lable class="form-label">Mobile</lable>
                                    <input class="form-control" type="text" id="mobile" onkeyup="clearp1();" />
                                </div>
                                <div class="col-6">
                                    <lable class="form-label">Gender</lable>
                                    <select class="form-select" id="gender">
                                        <?php

                                        $r = Database::search("SELECT * FROM `gender`;");
                                        $n = $r->num_rows;
                                        for ($x = 0; $x < $n; $x++) {
                                            $d = $r->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12 col-lg-6  d-grid">
                                    <button class="btn btn-primary" onclick="signUp();">Sign Up</button>
                                </div>
                                <div class="col-12 col-lg-6  d-grid">
                                    <button class="btn btn-dark" onclick="changeView();">Already have an account? Sign In</button>
                                </div>
                            </div>
                        </div>

                        
                        
                    </div>
                </div>

                <!-- content -->

                <!-- footer -->
                <div class="col-12 d-none d-lg-block fixed-bottom">
                    <p class="text-center">&copy; 2021 eShop.lk All Rights Reserved</p>
                </div>
                <!-- footer -->

                <!-- modal  -->
                <div class="modal fade" tabindex="-1" id="forgoetPasswordModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Password Reset</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="row g-3">

                                    <div class="col-6">
                                        <lable class="form-label">New Password</lable>
                                        <div class="input-group mb-3">
                                            <input class="form-control" type="password" id="np" />
                                            <button class="btn btn-outline-secondary" type="button"><i class="bi bi-eye" id="npb" onclick="showPassword1();"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <lable class="form-label">Re-type Password</lable>
                                        <div class="input-group mb-3">
                                            <input class="form-control" type="password" id="rnp" />
                                            <button class="btn btn-outline-secondary" type="button"><i class="bi bi-eye" id="rnpb" onclick="showPassword2();"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <lable class="form-label">Verification Code</lable>
                                        <input class="form-control" type="text" id="vc" />
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal  -->

            </div>

        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>
<?php
}
?>
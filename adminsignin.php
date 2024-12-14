<!DOCTYPE html>
<html>

<head>
    <title>AdiMobile | Admin | Signin</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/mylogo.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body class="mainbackground"> 
<!-- background-color: rgb(215, 230, 250); -->

    <div class="container-fluid vh-100 d-flex justify-content-center">
        <div class="row align-content-center">

            <!-- <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title1">Hi, Welcome to eShop Admin</p>
                    </div>
                </div>
            </div> -->
            <div class="col-12 col-lg-6 d-md-block  ">

                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12 mt-3">
                        <p class="text-center title1">Hi, Welcome to AdiMobile Admin</p>
                    </div>
                    <!-- <div  style="position: absolute;   margin-top: 50px; height: 100px;"> -->
                    <!-- <hr class="d-none d-lg-block" style="transform: rotate(90deg); margin-top: -30px; width: 500px; margin-left: 400px;" /> -->
                    <!-- </div> -->
                    <!-- <div class="col-10 col-lg-5 mx-auto d-grid mb-3">
                    <a href="home.php" class="btn btn-success">Watch Our Products</a>
                </div> -->
                </div>
            </div>
            <div class="col-12 col-lg-5 p-1">
                <div class="row">
                    <!-- <div class="col-6 d-lg-block d-none background"></div> -->

                    <div class="col-12 ">
                        <div class="row g-3">
                            <div class="col-12">
                                <p class="title2">Sign In To Admin Account</p>
                            </div>
                            <div class="col-12">
                                <lable class="form-label">Email</lable>
                                <input class="form-control" type="email" id="e" />
                            </div>
                            <div class="col-12 col-lg-6  d-grid">
                                <button class="btn btn-primary" onclick="adminverification();">Send Verification Code to Log In</button>
                            </div>
                            <div class="col-12 col-lg-6  d-grid">
                                <a class="btn btn-danger" href="index.php">Back yo User's Log In</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="verificationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Admin Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Enter the verification code you got by an Email.</label>
                            <input type="text" class="form-control" id="v" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 d-none d-lg-block fixed-bottom">
                <p class="text-center">&copy; 2021 eShop.lk All Rights Reserved</p>
            </div>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>
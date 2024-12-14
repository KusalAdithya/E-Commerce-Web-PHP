<?php

session_start();

if (isset($_SESSION["u"])) {

    $customer = $_SESSION["u"]["email"];
    $email = $_GET["email"];

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>eShop | Chat</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
    </head>

    <body onload="refresher('<?php echo $email; ?>');" style="background-color: #74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">

        <div class="container-fluid">
            <div class="row">

                <!-- header -->
                <?php require "header.php"; ?>
                <!-- header -->

                <div class="col-12">
                    <hr />
                </div>

                <div class="col-12 py-5 px-4">
                    <div class="row rounded overflow-hidden shadow">
                        <div class="col-12 col-lg-5 mx-lg-3 px-0">
                            <div class="bg-white">

                                <div class="bg-light px-4 py-2">
                                    <h5 class="mb-0 py-1">Recent</h5>
                                </div>

                                <div class="message-box">
                                    <div class="list-group rounded-0" id="rcv">

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-11 col-lg-6 mx-auto px-0 mt-4">
                            <div class="row px-1 py-5 text-white chatbox" id="chatrow">
                                <!-- massage load venne methana -->

                            </div>
                        </div>

                        <!-- text -->
                        <div class="col-12 col-lg-6 offset-lg-6 mb-2">
                            <div class="row mt-5">
                                <div class="input-group mt-5">
                                    <input id="msgtxt" type="text" placeholder="Type a message..." aria-describedby="sendbtn" class="form-control rounded-0 py-1 bg-light" />
                                    <div class="input-group-appeng">
                                        <button id="button-addon2" onclick="sendmessage('<?php echo $email; ?>');" class="btn btn-link fs-2 bi bi-cursor-fill"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- text -->

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

} else {
    ?>
        <script>
            alert("You Have To Signin or Signup First");
            window.location = "index.php";
        </script>
    <?php
    }

?>
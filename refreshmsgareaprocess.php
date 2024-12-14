<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $recever = $_POST["e"];
    $sender = $_SESSION["u"]["email"];

    $senderrs = Database::search("SELECT * FROM `chat` WHERE `from`='" . $sender . "' OR `to`='" . $sender . "'");

    $n = $senderrs->num_rows;

    if ($n == 0) {
?>

        <!-- empty message -->
        <!-- <div class="col-12 mb-3 text-center">
            <div class="msgbodyimg"></div>
            <p class="fs-4 mt-3 fw-bold text-black-50">No Messages To Show.</p>
        </div> -->
        <div class="col-7 media mb-3">
            <?php
            $profileimg = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='adithyawickrama70@gmail.com' ");
            $img = $profileimg->num_rows;

            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d ");

            if ($img == 1) {
                $code = $profileimg->fetch_assoc();
            ?>
                <img src="<?php echo $code["code"]; ?>" width="50" class="rounded-circle" />
            <?php
            } else {
            ?>
                <img src="resources/demoProfileImg.jpg" width="50" class="rounded-circle">
            <?php
            }
            ?>
            <div class="media-body ml-3">
                <div class="bg-light  py-2 px-3 mb-2" style="border-radius: 20px;">
                    <p class="text-small mb-0 text-muted">Hello sir, How can I help you?</p>
                </div>
                <!-- <p class="small text-muted ms-2"><?php echo $date; ?></p> -->
            </div>
        </div>
        <!-- <div class="col-5"></div> -->
        <!-- empty message -->

        <?php
    } else {
        for ($x = 0; $x < $n; $x++) {

            $f = $senderrs->fetch_assoc();


            if ($f["from"] == $sender) {
        ?>

<!-- <div class="col-7 media mb-3">
                    <?php
                    $profileimg = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='adithyawickrama70@gmail.com' ");
                    $img = $profileimg->num_rows;

                    $d = new DateTime();
                    $tz = new DateTimeZone("Asia/Colombo");
                    $d->setTimezone($tz);
                    $date = $d->format("Y-m-d ");

                    if ($img == 1) {
                        $code = $profileimg->fetch_assoc();
                    ?>
                        <img src="<?php echo $code["code"]; ?>" width="50" class="rounded-circle" />
                    <?php
                    } else {
                    ?>
                        <img src="resources/demoProfileImg.jpg" width="50" class="rounded-circle">
                    <?php
                    }
                    ?>
                    <div class="media-body ml-3">
                        <div class="bg-light  py-2 px-3 mb-2" style="border-radius: 20px;">
                            <p class="text-small mb-0 text-muted">Hello sir, How can I help you?</p>
                        </div>
                        <p class="small text-muted ms-2"><?php echo $date; ?></p>
                    </div>
                </div>
                <div class="col-5"></div> -->

                <!-- Reciever Message-->
                <div class="col-5"></div>
                <div class="col-7 media ml-auto mb-3">
                    <div class="media-body">
                        <div class="bg-primary  py-2 px-3 mb-2" style="border-radius: 20px;">
                            <p class="text-small mb-0 text-white"><?php echo $f["content"]; ?></p>
                        </div>
                        <p class="small text-muted"><?php echo $f["date"]; ?></p>
                    </div>
                </div>
               
                <!-- Reciever Message -->

            <?php
            } else {
            ?>
                <!-- sender message -->

                

                <div class="col-7 media mb-3">
                    <?php
                    $profileimg = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $recever . "' ");
                    $img = $profileimg->num_rows;
                    if ($img == 1) {
                        $code = $profileimg->fetch_assoc();
                    ?>
                        <img src="<?php echo $code["code"]; ?>" width="50" class="rounded-circle" />
                    <?php
                    } else {
                    ?>
                        <img src="resources/demoProfileImg.jpg" width="50" class="rounded-circle">
                    <?php
                    }
                    ?>
                    <div class="media-body ml-3">
                        <div class="bg-light  py-2 px-3 mb-2" style="border-radius: 20px;">
                            <p class="text-small mb-0 text-muted"><?php echo $f["content"]; ?></p>
                        </div>
                        <p class="small text-muted"><?php echo $f["date"]; ?></p>
                    </div>
                </div>
                <div class="col-5"></div>
                <!-- sender message -->

<?php
            }
        }
    }
}

?>
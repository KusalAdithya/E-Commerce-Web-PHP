<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $mail = $_SESSION["u"]["email"];

    $chatrs = Database::search("SELECT * FROM `chat` WHERE `from` NOT IN ('" . $mail . "') ORDER BY `date` DESC LIMIT 1");
    $n = $chatrs->num_rows;

    for ($x = 0; $x < $n; $x++) {

        $r = $chatrs->fetch_assoc();
        $u = array_unique($r);


?>
        <a class="list-group-item list-group-item-action active text-white rounded-0">
            <div class="media">
                <?php
                $profileimg = Database::search("SELECT * FROM `profile_img` WHERE `user_email`!='" . $mail . "' ");
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
                <div class="media-body ml-4">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <h6 class="mb-0"><?php echo $u["from"]; ?></h6><small class="small font-weight-bold">
                            <?php
                            $rd = $u["date"];
                            $spliterd = explode(" ", $rd);
                            $d = explode("-", $spliterd[0]);
                            echo $d[1]; ?>-<?php echo $d[2];
                                            ?>
                        </small>
                    </div>
                    <p class="font-italic mb-0 text-small"><?php echo $u["content"]; ?></p>
                </div>
            </div>
        </a>

<?php

    }
}

?>
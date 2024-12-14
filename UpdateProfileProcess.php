<?php
session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $fname = $_POST["f"];
    $lname = $_POST["l"];
    $mobile = $_POST["m"];
    $line1 = $_POST["a1"];
    $line2 = $_POST["a2"];
    $province = $_POST["p"];
    $district = $_POST["d"];
    $city = $_POST["c"];
    $postalcode = $_POST["pc"];

    if (empty($fname)) {
        echo "Please enter your first name";
    } else if (strlen($fname) > 50) {
        echo "First name must be less than 50 characters";
    } else if (empty($lname)) {
        echo "Please enter your last name";
    } else if (strlen($lname) > 50) {
        echo "Last name must be less than 50 characters";
    } else if (empty($mobile)) {
        echo "Please enter your mobile";
    } else if (strlen($mobile) != 10) {
        echo "Pease enter 10 digit mobile number";
    } else if (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $mobile) == 0) {
        echo "Invalid mobile number";
    } else if (empty($line1)) {
        echo "Please enter address line 1";
    } else if ($province == "0") {
        echo "Please select a province";
    } else if ($district == "0") {
        echo "Please select a district";
    } else if ($city == "0") {
        echo "Please select a city";
    } else if (empty($postalcode)) {
        echo "Please enter postal code";
    } else {

        $newu = Database::iud("UPDATE `user` SET `fname`='" . $fname . "' , `lname`='" . $lname . "' , `mobile`='" . $mobile . "' WHERE `email`='" . $_SESSION["u"]["email"] . "' ");

        $newurs = Database::search("SELECT * FROM `user` WHERE `email`='" . $_SESSION["u"]["email"] . "' ");
        $d = $newurs->fetch_assoc();
        $_SESSION["u"] = $d;

        $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $_SESSION["u"]["email"] . "' ");
        $nr = $addressrs->num_rows;

        if ($nr == 1) {
            //update

            $ucity = Database::search("SELECT `id` FROM `city` WHERE `name` = '" . $city . "' ");
            $unrs = $ucity->num_rows;

            if ($unrs == 1) {
                $unr = $ucity->fetch_assoc();
                Database::iud("UPDATE `user_has_address` SET `line1`='" . $line1 . "', `line2`='" . $line2 . "', `city_id`='" . $unr["id"] . "'  WHERE `user_email`='" . $_SESSION["u"]["email"] . "' ");

                Database::iud("UPDATE `city` SET `postal_code`='" . $postalcode . "', `district_id`='" . $district . "'  WHERE `id`='" .  $unr["id"] . "' ");
            } else {

                Database::iud("INSERT INTO `city`(`name`,`postal_code`,`district_id`) VALUES ('" . $city . "','" . $postalcode . "','" . $district . "')");

                $ucity = Database::search("SELECT `id` FROM `city` WHERE `name` = '" . $city . "' ");
                $unr = $ucity->fetch_assoc();

                Database::iud("UPDATE `user_has_address` SET `line1`='" . $line1 . "', `line2`='" . $line2 . "', `city_id`='" . $unr["id"] . "'  WHERE `user_email`='" . $_SESSION["u"]["email"] . "' ");
            }

            if (isset($_FILES["img"])) {
                $imageFile = $_FILES["img"];

                $allowed_image_extension = array("image/jpeg", "image/jpg", "image/png", "image/svg");
                $fileex = $imageFile["type"];

                if (!in_array($fileex, $allowed_image_extension)) {
                    echo "Please Select a valid image.";
                } else {

                    $newimgextention;
                    if ($fileex = "image/jpeg") {
                        $newimgextention = ".jpeg";
                    } else if ($fileex = "image/jpg") {
                        $newimgextention = ".jpg";
                    } else if ($fileex = "image/png") {
                        $newimgextention = ".png";
                    } else if ($fileex = "image/svg") {
                        $newimgextention = ".svg";
                    }

                    $file_name = "resources//profile_img//" . uniqid() . $newimgextention;

                    move_uploaded_file($imageFile["tmp_name"], $file_name);

                    $pimg = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $_SESSION["u"]["email"] . "' ");
                    $n = $pimg->num_rows;

                    if ($n == 1) {
                        Database::iud("UPDATE `profile_img` SET `code`='" . $file_name . "', `user_email`='" . $_SESSION["u"]["email"] . "' ");
                    } else {
                        Database::iud("INSERT INTO `profile_img` (`code`,`user_email`) VALUES ('" . $file_name . "','" . $_SESSION["u"]["email"] . "') ");
                    }

                    echo "Profile Updated";
                }
            } else {
                echo "Profile Updated";
            }
        } else {
            //add new

            $ucity = Database::search("SELECT `id` FROM `city` WHERE `name` = '" . $city . "' ");
            $unr = $ucity->num_rows;

            if ($unr == 1) {

                $unr = $ucity->fetch_assoc();
                Database::iud("INSERT INTO `user_has_address` (`user_email`,`line1`,`line2`,`city_id`) VALUES ('" . $_SESSION["u"]["email"] . "', '" . $line1 . "', '" . $line2 . "', '" . $unr["id"] . "')  ");
            } else {

                Database::iud("INSERT INTO `city`(`name`,`postal_code`,`district_id`) VALUES ('" . $city . "','" . $postalcode . "','" . $district . "')");

                $ucity = Database::search("SELECT `id` FROM `city` WHERE `name`='" . $city . "'");
                $unr = $ucity->fetch_assoc();

                Database::iud("INSERT INTO `user_has_address` (`user_email`,`line1`,`line2`,`city_id`) VALUES ('" . $_SESSION["u"]["email"] . "', '" . $line1 . "', '" . $line2 . "', '" . $unr["id"] . "')  ");
            }

            if (isset($_FILES["img"])) {
                $imageFile = $_FILES["img"];

                $allowed_image_extension = array("image/jpeg", "image/jpg", "image/png", "image/svg");
                $fileex = $imageFile["type"];

                if (!in_array($fileex, $allowed_image_extension)) {
                    echo "Please Select a valid image.";
                } else {

                    $newimgextention;
                    if ($fileex = "image/jpeg") {
                        $newimgextention = ".jpeg";
                    } else if ($fileex = "image/jpg") {
                        $newimgextention = ".jpg";
                    } else if ($fileex = "image/png") {
                        $newimgextention = ".png";
                    } else if ($fileex = "image/svg") {
                        $newimgextention = ".svg";
                    }

                    $file_name = "resources//profile_img//" . uniqid() . $newimgextention;

                    move_uploaded_file($imageFile["tmp_name"], $file_name);

                    Database::iud("INSERT INTO `profile_img` (`code`,`user_email`) VALUES ('" . $file_name . "','" . $_SESSION["u"]["email"] . "') ");

                    echo "Profile Updated";
                }
            } else {
                echo "Profile Updated";
            }
        }
    }
}

?>
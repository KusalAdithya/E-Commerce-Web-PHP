<?php
session_start();

require "connection.php";

// echo "oooo";
if (isset($_SESSION["u"])) {
    $umail = $_SESSION["u"]["email"];

    $oid = $_POST["oid"];
    // $pid = $_POST["pid"];
    $email = $_POST["email"];
    // $total = $_POST["total"];
    $totalprice = $_POST["totalfull"];

    $total = "0";
    $ship = "0";
    $cartrs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $umail . "' ");

    $cn = $cartrs->num_rows;

    if ($cn >= 1) {
        // Database::iud("INSERT INTO `invoice_1` (`total`)  VALUES ('" . $totalprice . "') ");
        //     $last_id = Database::$conection->insert_id;
        for ($i = 0; $i < $cn; $i++) {

            $cr = $cartrs->fetch_assoc();
            $pid = $cr["product_id"];
            $pqty = $cr["qty"];

            $productrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "' ");
            $pn = $productrs->fetch_assoc();

            $qty = $pn["qty"];
            $newqty = $qty - $pqty;

            Database::iud("UPDATE `product` SET `qty`='" . $newqty . "' WHERE `id`='" . $pid . "' ");

            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "' ");
            $ar = $addressrs->fetch_assoc();
            $cityid = $ar["city_id"];

            $districtrs = Database::search("SELECT * FROM `city` WHERE `id`='" . $cityid . "' ");
            $xr = $districtrs->fetch_assoc();
            $districtid = $xr["district_id"];

            $ship = "0";
            if ($districtid == "3") {
                $ship = $pn["delivery_fee_colombo"];
                // $shipping = $shipping + $pn["delivery_fee_colombo"];
            } else {
                $ship = $pn["delivery_fee_other"];
                // $shipping = $shipping + $pn["delivery_fee_other"];
            }

            $total =  ($pn["price"] * $pqty) + $ship;

            Database::iud("INSERT INTO `invoice` (`invoice_1_id`,`order_id`,`product_id`,`user_email`,`qty`,`date`,`total`,`status_id`) 
            VALUES ('6','" . $oid . "','" . $pid . "','" . $email . "','" . $pqty . "','" . $date . "','" . $total . "','1') ");

            Database::iud("DELETE FROM  `cart` WHERE `product_id`='" . $pid . "' AND `user_email`='" . $email . "' ");

            // echo "1";
        }
        // $last_id = Database::$conection->insert_id;

        echo "1";
    } else {
        echo "dd";
    }
}
?>
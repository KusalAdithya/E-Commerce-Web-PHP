<?php
session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
    $umail = $_SESSION["u"]["email"];

    $id = $_GET["id"];
    $qtytxt = $_GET["txt"];

    // if ($qtytxt == 0) {
    //     echo "Please add a Quantity";
    // } else {

    $cartrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $id . "' ");
    $cn = $cartrs->num_rows;

    if ($cn == 1) {
        //     echo "This product is already exists in your Cart";
        // } else {

        $productrs = Database::search("SELECT `qty` FROM `product` WHERE `id`='" . $id . "' ");
        $pr = $productrs->fetch_assoc();

        if ($pr["qty"] < $qtytxt) {

            // Database::iud("INSERT INTO `cart` (`product_id`,`user_email`,`qty`) VALUES ('" . $id . "','" . $umail . "','" . $qtytxt . "') ");
            echo "Maximum quantity count has been achieved";
            echo "<br/>";
            echo "Pease enter a valid Quantity below" . $pr['qty'] . " ";
        } else if ($qtytxt < 1) {
            echo "Minimum quantity count has been achieved";
            echo "<br/>";
            echo "Pease enter a valid Quantity below" . $pr['qty'] . " ";
            // echo "Pease enter a valid Quantity below".$pr['qty']." ";
        } else {
            Database::iud("UPDATE `cart` SET `qty`='" . $qtytxt . "' WHERE `product_id`='" . $id . "' AND `user_email`='" . $umail . "' ");
            echo "1";
        }
    }
    // }
}

?>
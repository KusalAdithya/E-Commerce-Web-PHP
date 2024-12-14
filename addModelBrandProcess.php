<?php
session_start();

require "connection.php";
// echo "okaaa";

$brand = $_POST["b"];
$model = $_POST["m"];

if ($brand == "0") {
    echo "Please Select a Brand.";
} else if ($model == "0") {
    echo "Please Select a Model.";
} else {
    $modelHasBrand = Database::search("SELECT `id` FROM `model_has_brand` WHERE `brand_id`='" . $brand . "' AND `model_id`='" . $model . "' ");

    if ($modelHasBrand->num_rows == 1) {
        echo "The model has brand already exists";
    } else if ($modelHasBrand->num_rows == 0) {
        // $f = $modelHasBrand->fetch_assoc();
        // $modelHasBrandId = $f["id"];

        Database::iud("INSERT INTO `model_has_brand`(`brand_id`,`model_id`) VALUES('" . $brand . "','" . $model . "') ");
        echo "1";
    }
}

?>
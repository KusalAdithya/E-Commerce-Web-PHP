<?php
session_start();

require "connection.php";

$title = $_POST["t"];
$qty   = (int)$_POST["qty"];
$dwc   = (int)$_POST["dwc"];
$doc   = (int)$_POST["doc"];
$desc   = $_POST["desc"];

if (empty($title)) {
    echo "Please Add a Title.";
} else if (strlen($title) > 100) {
    echo "Title Must Contain 100 or Less than 100 Characters.";
} else if ($qty == "0" || $qty == "e") {
    echo "Please Add the Quantity Of Your Product.";
} else if (!is_int($qty)) {
    echo "Please Add a Valid Quantity1.";
} else if (empty($qty)) {
    echo "Please Add the Quantity Of Your Product.";
} else if ($qty < 0) {
    echo "Please Add a Valid Quantity.";
} else if (empty($dwc)) {
    echo "Please insert the delivery cost inside Colombo District.";
} else if (!is_int($dwc)) {
    echo "Please insert a valid price";
} else if (empty($doc)) {
    echo "Please insert the delivery cost outside Colombo District.";
} else if (!is_int($doc)) {
    echo "Please insert a valid price";
} else if (empty($desc)) {
    echo "Please enter the description of your product";
} else {

    if (isset($_SESSION["p"])) {
        $productid = $_SESSION["p"]["id"];

        Database::iud("UPDATE `product` SET `title` = '" . $title . "',`qty` = '" . $qty . "',`delivery_fee_colombo` = '" . $dwc . "',`delivery_fee_other` = '" . $doc . "',`Description` = '" . $desc . "' WHERE `id` = '" . $productid . "' ");

        $product = Database::search("SELECT * FROM `product` WHERE  `id`='" . $productid . "' ");
        $row = $product->fetch_assoc();

        $_SESSION["p"] = $row;
        // echo "Product Updated Successfully";
        // if (isset($_FILES["img"])) {
        //     $imageFile = $_FILES["img"];

        //     $file_name = "resources//products//" . uniqid();

        //     move_uploaded_file($imageFile["tmp_name"], $file_name);

            if (isset($_FILES["img1"])) {

                $imageFile1 = $_FILES["img1"];
                $file_name1 = "resources//products//" . uniqid() . ".png";
                move_uploaded_file($imageFile1["tmp_name"], $file_name1);
            } else {
                $file_name1 = "resources//products//no_img.png";
            }

            if (isset($_FILES["img2"])) {

                $imageFile2 = $_FILES["img2"];
                $file_name2 = "resources//products//" . uniqid() . ".png";
                move_uploaded_file($imageFile2["tmp_name"], $file_name2);
            } else {
                $file_name2 = "resources//products//no_img.png";
            }

            $productimg = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $productid . "'  ");
            $pr = $productimg->num_rows;

            if ($pr == 1) {

                Database::iud("UPDATE `images` SET  `code1`='" . $file_name1 . "', `code2`='" . $file_name2 . "'  WHERE `product_id`='" .  $productid . "'  ");
            } else {

                Database::iud("INSERT INTO `images` (`code`,`product_id`) VALUES ('" . $file_name . "','" . $productid . "') ");
            }

            echo "Product Updated Successfully";
        // } else {
        //     echo "Product Updated Successfully";
        // }
    } else {
        echo "Product Does not Exit";
    }
}
?>
<?php
session_start();

require "connection.php";
// echo "okaa";

$category = $_POST["c"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$condition = $_POST["co"];
$colour = $_POST["col"];
$qty = (int)$_POST["qty"];
$price = (int)$_POST["p"];
$dwc = (int)$_POST["dwc"];
$doc = (int)$_POST["doc"];
$description = $_POST["desc"];

// echo $category;
// echo $title;

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$status = 1;

// $useremail = $_SESSION["u"]["email"];
$useremail = "adithyawickrama70@gmail.com";

if ($category == "0") {
    echo "Please Select a Category.";
} else if ($brand == "0") {
    echo "Please Select a Brand.";
} else if ($model == "0") {
    echo "Please Select a Model.";
} else if (empty($title)) {
    echo "Please Add a Title.";
} else if (strlen($title) > 100) {
    echo "Title Must Contain 100 or Less than 100 Characters.";
} else if ($colour == "0") {
    echo "Please Select a Colour.";    //colour
} else if ($qty == "0" || $qty == "e") {
    echo "Please Add the Quantity Of Your Product.";
} else if (!is_int($qty)) {
    echo "Please Add a Valid Quantity1.";
} else if (empty($qty)) {
    echo "Please Add the Quantity Of Your Product.";
} else if ($qty < 0) {
    echo "Please Add a Valid Quantity.";
} else if (empty($price)) {
    echo "Please insert the price of your product.";
} else if (!is_int($price)) {
    echo "Please insert a valid price";
} else if (empty($dwc)) {
    echo "Please insert the delivery cost inside Colombo District.";
} else if (!is_int($dwc)) {
    echo "Please insert a valid price";
} else if (empty($doc)) {
    echo "Please insert the delivery cost outside Colombo District.";
} else if (!is_int($doc)) {
    echo "Please insert a valid price";
} else if (empty($description)) {
    echo "Please enter the description of your product";
} else {
    $modelHasBrand = Database::search("SELECT `id` FROM `model_has_brand` WHERE `brand_id`='" . $brand . "' AND `model_id`='" . $model . "' ");

    if ($modelHasBrand->num_rows == 0) {
        echo "The Product Doesn't Exists";
    } else {
        $f = $modelHasBrand->fetch_assoc();
        $modelHasBrandId = $f["id"];

        Database::iud("INSERT INTO `product`(`category_id`,`model_has_brand_id`,`title`,`color_id`,`price`,`qty`,`description`,`condition_id`,`status_id`,`user_email`,`datetime_added`,`delivery_fee_colombo`,`delivery_fee_other`) 
        VALUES('" . $category . "','" . $modelHasBrandId . "','" . $title . "','" . $colour . "','" . $price . "','" . $qty . "','" . $description . "','" . $condition . "','" . $status . "','" . $useremail . "','" . $date . "','" . $dwc . "','" . $doc . "') ");

        $last_id = Database::$conection->insert_id;


        if (isset($_FILES["img"])) {
            $imageFile = $_FILES["img"];
            $file_name = "resources//products//" . uniqid() . ".png";
            move_uploaded_file($imageFile["tmp_name"], $file_name);

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
    
            Database::iud("INSERT INTO `images` (`code`,`code1`,`code2`,`product_id`) VALUES ('" . $file_name . "','" . $file_name1 . "','" . $file_name2 . "','" . $last_id . "') ");
            echo "Product Added Successfully";

        } else {
            echo "Please Select an Image.";
        }
        // if (isset($_FILES["img1"])) {

        //     $imageFile1 = $_FILES["img1"];
        //     $file_name1 = "resources//products//" . uniqid() . ".png";
        //     move_uploaded_file($imageFile1["tmp_name"], $file_name1);
        // } else {
        //     $file_name1 = "resources//products//no_img.png";
        // }

        // if (isset($_FILES["img2"])) {

        //     $imageFile2 = $_FILES["img2"];
        //     $file_name2 = "resources//products//" . uniqid() . ".png";
        //     move_uploaded_file($imageFile2["tmp_name"], $file_name2);
        // } else {
        //     $file_name2 = "resources//products//no_img.png";
        // }

        // Database::iud("INSERT INTO `images` (`code`,`code1`,`code2`,`product_id`) VALUES ('" . $file_name . "','" . $file_name1 . "','" . $file_name2 . "','" . $last_id . "') ");
        // echo "Product Added Successfully";
    }
}

?>
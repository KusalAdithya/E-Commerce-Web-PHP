<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
    $umail = $_SESSION["u"]["email"];

    $price = $_GET["p"];
    // $qty = $_GET["qty"];

    $array;

    $orderID = uniqid();

    $cartrs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $umail . "' ");
    $cn = $cartrs->num_rows;

    if ($cn >= 1) {
        
        // for ($i = 0; $i < $cn; $i++) {
            $cr = $cartrs->fetch_assoc();

            $productrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cr["product_id"] . "' ");
            $pr = $productrs->fetch_assoc();

            $cityrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "' ");
            $cityr = $cityrs->fetch_assoc();

            $cityid = $cityr["city_id"];
            $add = $cityr["line1"] . " " . $cityr["line2"];

            $cityname = Database::search("SELECT * FROM `city` WHERE `id`='" . $cityid . "' ");
            $citynamer = $cityname->fetch_assoc();

            $districtid = $citynamer["district_id"];

            $delivery = "0";

            if ($districtid == "3") {
                $delivery = $pr["delivery_fee_colombo"];
            } else {
                $delivery = $pr["delivery_fee_other"];
            }

            // $item = $pr["title"];
            $amount =  $pr["price"] * $cr["qty"] + (int)$delivery;
            // $total = $price;

            $fname = $_SESSION["u"]["fname"];
            $lname = $_SESSION["u"]["lname"];
            $mobile = $_SESSION["u"]["mobile"];
            $address = $add;
            $city = $citynamer["name"];

            // $array['id'] = $orderID;
            // $array['item'] = $item;
            $array['amount'] = $amount;
            // $array['total'] = $total;
            $array['fname'] = $fname;
            $array['lname'] = $lname;
            $array['email'] = $umail;
            $array['mobile'] = $mobile;
            $array['address'] = $address;
            $array['city'] = $city;

            // echo json_encode($array);
        // }
        $array['id'] = $orderID;

        $array['total'] = $price;
        echo json_encode($array);
        // $cr = $cityrs->fetch_assoc();

        // $cityid = $cr["city_id"];
        // $add = $cr["line1"]." ".$cr["line2"];

        // $districtrs = Database::search("SELECT * FROM `city` WHERE `id`='".$cityid."' ");
        // $dr = $districtrs->fetch_assoc();

        // $districtid = $dr["district_id"];

        // $delivery = "0";

        // if($districtid == "3"){
        //     $delivery = $pr["delivery_fee_colombo"];
        // }else{
        //     $delivery = $pr["delivery_fee_other"];
        // }

        // $item = $pr["title"];
        // $amount = $pr["price"] * $qty + (int)$delivery;

        // $fname = $_SESSION["u"]["fname"];
        // $lname = $_SESSION["u"]["lname"];
        // $mobile = $_SESSION["u"]["mobile"];
        // $address = $add;
        // $city = $dr["name"];

        // $array['id'] = $orderID;
        // $array['item'] = $item;
        // $array['amount'] = $amount;
        // $array['fname'] = $fname;
        // $array['lname'] = $lname;
        // $array['email'] = $umail;
        // $array['mobile'] = $mobile;
        // $array['address'] = $address;
        // $array['city'] = $city;

        // echo json_encode($array);

        // }else{
        //     echo "2";
    }
} 
?>
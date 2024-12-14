<?php 

session_start();

require "connection.php";

if(isset($_SESSION["a"])){

    $text = $_GET["t"];

    if(empty($text)){
        echo "You must enter a brand.";
    }else{

        $brandrs = Database::search("SELECT * FROM `brand` WHERE `name` = '".$text."' ");
        $n = $brandrs->num_rows;

        if($n==1){
            echo "The brand already exists.";
        }else{

            Database::iud("INSERT INTO `brand` (`name`) VALUES ('".$text."') ");
            echo "success";

        }

    }

}

?>
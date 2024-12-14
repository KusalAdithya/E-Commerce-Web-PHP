<?php 

session_start();

require "connection.php";

if(isset($_SESSION["a"])){

    $text = $_GET["t"];

    if(empty($text)){
        echo "You must enter a colour.";
    }else{

        $brandrs = Database::search("SELECT * FROM `color` WHERE `name` = '".$text."' ");
        $n = $brandrs->num_rows;

        if($n==1){
            echo "The colour already exists.";
        }else{

            Database::iud("INSERT INTO `color` (`name`) VALUES ('".$text."') ");
            echo "success";

        }

    }

}

?>
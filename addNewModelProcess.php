<?php 

session_start();

require "connection.php";

if(isset($_SESSION["a"])){

    $text = $_GET["t"];

    if(empty($text)){
        echo "You must enter a model.";
    }else{

        $brandrs = Database::search("SELECT * FROM `model` WHERE `name` = '".$text."' ");
        $n = $brandrs->num_rows;

        if($n==1){
            echo "The model already exists.";
        }else{

            Database::iud("INSERT INTO `model` (`name`) VALUES ('".$text."') ");
            echo "success";

        }

    }

}

?>
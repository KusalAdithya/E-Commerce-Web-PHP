<?php

session_start();

require "connection.php";

$e = $_POST["email"];
$p = $_POST["password"];
$r = $_POST["remember"];

$rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $e . "' AND `password`='" . $p . "' ");
$n = $rs->num_rows;

if ($n == 1) {  //if sign in success

    $active = Database::search("SELECT * FROM `user` WHERE `email`='" . $e . "' AND `password`='" . $p . "' AND `status_id`='1' ");
    $an = $active->num_rows; 

    if ($an == 1) {

        echo "Success";
        $d = $rs->fetch_assoc();
        $_SESSION["u"] = $d;

        if ($r == "true") {   //if remember me checked 
            setcookie("e", $e, time() + (60 * 60 * 24 * 365));
            setcookie("p", $p, time() + (60 * 60 * 24 * 365));
        } else {  //if remember me not checked
            setcookie("e", "", -1);
            setcookie("p", "", -1);
        }
    }else{
   echo "1";
    }

} else {
    // echo "Invalid details";
    echo $e;
    echo $p;
}

?>
<?php

session_start();

require "connection.php";

if (isset($_SESSION["a"])) {

    $sender = $_SESSION["a"]["email"];
    $recever = $_POST["e"];
    $msg = $_POST["t"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");



    if (empty($msg)) {
        echo "Please enter a message to send";
    } else {

        if ($sender == $recever) {

            $tors = Database::search("SELECT * FROM `chat` WHERE `to`='" . $sender . "'");
            $to = $tors->fetch_assoc();

            Database::iud("INSERT INTO `chat` (`from`,`to`,`content`,`date`,`status_id`) VALUES ('" . $recever . "','" . $to["from"] . "','" . $msg . "','" . $date . "','1')");
            echo "success";
        } else {

            Database::iud("INSERT INTO `chat` (`from`,`to`,`content`,`date`,`status_id`) VALUES ('" . $sender . "','" . $recever . "','" . $msg . "','" . $date . "','1')");
            echo "success";
        }
    }
} else if (isset($_SESSION["u"])) {

    $sender = $_SESSION["u"]["email"];
    $recever = $_POST["e"];
    $msg = $_POST["t"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    // if (empty($msg)) {
    //     echo "Please enter a message to senddddddd";
    // } else {

//         if ($sender == $recever) {

//             $tors = Database::search("SELECT * FROM `chat` WHERE `to`='" . $sender . "'");
//             $to = $tors->fetch_assoc();

//             Database::iud("INSERT INTO `chat` (`from`,`to`,`content`,`date`,`status_id`) VALUES ('" . $recever . "','" . $to["from"] . "','" . $msg . "','" . $date . "','1')");
//             echo "success";
//         } else {

//             Database::iud("INSERT INTO `chat` (`from`,`to`,`content`,`date`,`status_id`) VALUES ('" . $sender . "','" . $recever . "','" . $msg . "','" . $date . "','1')");
//             echo "success";
//         }
//     }
// }

    if ($sender == $recever) {

        if (empty($msg)) {
            echo "Please enter a message to sendxxxxxx";
        } else {

        

            $tors = Database::search("SELECT * FROM `chat` WHERE `to`='" . $sender . "'");
            $to = $tors->fetch_assoc();
        
            Database::iud("INSERT INTO `chat` (`from`,`to`,`content`,`date`,`status_id`) VALUES ('" . $recever . "','" . $to["from"] . "','" . $msg . "','" . $date . "','1')");
            echo "success";
        }
    } else {

        if (empty($msg)) {
            echo "Please enter a message to sendxx";
        } else {

            Database::iud("INSERT INTO `chat` (`from`,`to`,`content`,`date`,`status_id`) VALUES ('" . $sender . "','" . $recever . "','" . $msg . "','" . $date . "','1')");
            echo "success";
        }
    }
}

?>
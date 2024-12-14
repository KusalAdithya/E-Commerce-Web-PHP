<?php

require "connection.php";

Database::iud("INSERT INTO user() VALUE ();");

Database::iud("UPDATE user SET `city`='Colombo' WHERE `id`='3' ");

Database::iud("DELETE FROM user WHERE `id`=`1`");

$resultset = Database::search("SELECT * FROM user");
$n = $resultset->num_rows;

for ($x = 0; $x < $n; $x++) {
    $data = $resultset->fetch_assoc();
    echo $data["name"];
}

?>

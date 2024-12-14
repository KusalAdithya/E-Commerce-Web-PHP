<?php

require "connection.php";

$id = $_GET["id"];

$warchrs = Database::search("SELECT * FROM watchlist WHERE id='".$id."'");
$watchrow = $warchrs->fetch_assoc();

$pid = $watchrow["product_id"];
$mail = $watchrow["user_email"];

Database::iud("INSERT INTO recent (product_id,user_email) VALUES ('".$pid."','".$mail."')");

// Added to the recent items

Database::iud("DELETE FROM watchlist WHERE id='".$id."'");

echo "success";
?>
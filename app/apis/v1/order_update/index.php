<?php


$temp = $_SERVER['DOCUMENT_ROOT'];
include($temp . "/connection/connection.php");

$id = $_POST["data"]["id"];
$type = $_POST["data"]["type"];
$cancel_comments = $_POST["data"]["comments"];

$cancel_comments = $conn->real_escape_string($cancel_comments);

if ($type == "cancel") {
    $update_query = " UPDATE `orders` SET `status` = 5 , `cancel_comments` = '" . $cancel_comments . "' WHERE `orders`.`id` =  " . $id;
    // $response["update_query"] = $update_query;
    $result =  mysqli_query($conn, $update_query);
    if ($result) {
        $response["status"] = true;
        $response["msg"] = " Order Cancelled SUccesfully";
    }
}
if ($type == "update") {
    
}

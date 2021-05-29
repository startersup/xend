<?php
session_start();


$rootfolder = $_SERVER['DOCUMENT_ROOT'];
include($rootfolder . "/connection/connection.php");

if ($_POST['data'] != "") {
    $_SESSION['USER_INFO']["product"] = array();
    $_SESSION['USER_INFO']["product"] = ($_POST['data']);
}

$name = $_SESSION['USER_INFO']['data']['name'];
$mailId = $_SESSION['USER_INFO']['data']['mailId'];
$mobile = $_SESSION['USER_INFO']['data']['mobile'];
$address = $_SESSION['USER_INFO']['transaction']['address'];
$payment = $_SESSION['USER_INFO']['transaction']['payment'];
$address = $conn->real_escape_string($address);

$insert_query_orders = " INSERT INTO `orders` ( `mobile`, `mail`, `name`, `address`, `pay_type`, `pay_status`) VALUES ( '$mobile', '$mailId', '$name', '$address', '$payment', 'pending') ";
$reponse["insert_query_orders"] = $insert_query_orders;
$result =  mysqli_query($conn, $insert_query_orders);
if ($result) {
    $last_id = $conn->insert_id;
    $update_id = $last_id;
    $last_id = "VSP" + $last_id + 1000;
    $update_query = " UPDATE `orders` SET `id` = '" . $last_id . "' WHERE `orders`.`sno` =  " . $update_id;
    $reponse["update_query"] = $update_query;
    $result =  mysqli_query($conn, $update_query);
}


$insert_query_items = " INSERT INTO `order_items` ( `order_id`, `item_name`) VALUES  ";
$items_values = 'tempxxxx';
foreach ($_SESSION['USER_INFO']['product'] as $itemData) {
    $item = (object) $itemData;
    $item_name = $conn->real_escape_string($item->product);
    $items_values = $items_values . " , ('" . $last_id . "', '" . $item_name . "')";
}
$items_values = str_replace("tempxxxx,", "", $items_values);
$insert_query_items = $insert_query_items . $items_values . " ; ";
$reponse["insert_query_items"] = $insert_query_items;
$result =  mysqli_query($conn, $insert_query_items);
if ($result) {
    $response["status"] = true;
    $response["msg"] = "Order Placed Succesfully!";
    $response["order_id"] = $last_id;
} else {
    $delete_query = " DELETE FROM `orders` WHERE `sno` =  " . $update_id;
    $reponse["delete_query"] = $delete_query;
    $result =  mysqli_query($conn, $delete_query);    
    $response["status"] = false;
    $response["msg"] = "Please try again";
}
echo json_encode($response);

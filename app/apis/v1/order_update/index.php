<?php


$temp = $_SERVER['DOCUMENT_ROOT'];
include($temp . "/connection/connection.php");

$id = $_POST["data"]["id"];
$type = $_POST["data"]["type"];
$cancel_comments = $_POST["data"]["comments"];

$cancel_comments = $conn->real_escape_string($cancel_comments);

if ($type == "cancel") {
    $update_query = " UPDATE `orders` SET `status` = 5 , `cancel_comments` = '" . $cancel_comments . "' WHERE `orders`.`id` =  " . $id;

    $response["status"] = false;
    $response["msg"] = "  Cancellation Failed";

    $result =  mysqli_query($conn, $update_query);
    if ($result) {
        $response["status"] = true;
        $response["msg"] = " Order Cancelled Succesfully";
    }


    echo json_encode($response);
}
if ($type == "update") {

    $payment_type = $_POST['orders']['payment_type'];
    $payment_status = $_POST['orders']['payment_status'];
    $order_status = $_POST['orders']['order_status'];
    $total = $_POST['orders']['total'];

    $response["status"] = true;
    $response["msg"] = " Order Updated Succesfully";

    $update_query = " UPDATE `orders` SET `pay_type`= '" . $payment_type . "' ,`pay_status`= '" . $payment_status . "' ,`total`='" . $total . "',`status`= '" . $order_status . "' WHERE `id` = " . $id;
    $result =  mysqli_query($conn, $update_query);

    if (!$result) {
        $response["status"] = false;
        $response["msg"] = " Order Updation Failed";
        $response["query"] = $update_query;
    }
    if ($result) {
        foreach ($_POST['products'] as $itemData) {
            $item = (object) $itemData;
            $item_sno = $item->sno;
            $item_status = $item->item_status;
            $price =  $item->price;

            $update_query = " UPDATE `order_items` SET `price`= '" . $price . "' ,`item_status`= '" . $item_status . "'  WHERE `sno` = " . $item_sno;
            $result =  mysqli_query($conn, $update_query);

            if (!$result) {
                $response["status"] = false;
                $response["msg"] = " Order Updation Failed";
                $response["query"] = $update_query;
            }
        }
    }

    echo json_encode($response);
}

<?php
session_start();


$rootfolder = $_SERVER['DOCUMENT_ROOT'];
include($rootfolder . "/connection/connection.php");
$requestMethod = $_SERVER['REQUEST_METHOD'];

if (strtoupper($requestMethod) == 'POST') {
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

    $insert_query_orders = " INSERT INTO `orders` ( `mobile`, `mail`, `name`, `address`, `pay_type`, `pay_status`,`status`) VALUES ( '$mobile', '$mailId', '$name', '$address', '$payment', 'pending','1') ";
    // $response["insert_query_orders"] = $insert_query_orders;
    $result =  mysqli_query($conn, $insert_query_orders);
    if ($result) {
        $last_id = $conn->insert_id;
        $update_id = $last_id;
        $last_id =  $last_id + 1000;
        $last_id = "VSP" . $last_id;
        $update_query = " UPDATE `orders` SET `id` = '" . $last_id . "' WHERE `orders`.`sno` =  " . $update_id;
        // $response["update_query"] = $update_query;
        $result =  mysqli_query($conn, $update_query);
    }


    $insert_query_items = " INSERT INTO `order_items` ( `order_id`, `item_name`) VALUES  ";
    $items_values = 'tempxxxx';
    $item_count = 0;
    $admin_table = '';
    foreach ($_SESSION['USER_INFO']['product'] as $itemData) {
        $item = (object) $itemData;
        $item_name = $conn->real_escape_string($item->product);
        $items_values = $items_values . " , ('" . $last_id . "', '" . $item_name . "')";
        $item_count = $item_count + 1;

        $admin_table = $admin_table . ' <tr>
    <td style="line-height: 25px;padding: 10px;font-size: 15px;border: 1px solid #ececec;border-collapse: collapse;background-color: #f4f4f4;width: 30%;">' . $item->product . '</td>   
   </tr>';
    }
    $update_query = " UPDATE `orders` SET `item_count` = " . $item_count . " WHERE `orders`.`sno` =  " . $update_id;
    $result =  mysqli_query($conn, $update_query);

    $items_values = str_replace("tempxxxx ,", "", $items_values);
    $insert_query_items = $insert_query_items . $items_values . " ; ";
    // $response["insert_query_items"] = $insert_query_items;
    $result =  mysqli_query($conn, $insert_query_items);
    if ($result) {
        $response["status"] = true;
        $response["msg"] = "Order Placed Succesfully!";
        $response["order_id"] = $last_id;
        $_SESSION['USER_INFO'] =  array();

        include($rootfolder . "/pos/emails/admin-new-order-email.php");
        include($rootfolder . "/pos/emails/customer-booking-email.php");
    } else {
        $delete_query = " DELETE FROM `orders` WHERE `sno` =  " . $update_id;
        // $response["delete_query"] = $delete_query;
        $result =  mysqli_query($conn, $delete_query);
        $response["status"] = false;
        $response["msg"] = "Please try again";
    }
    echo json_encode($response);
} else if (strtoupper($requestMethod) == 'GET') {

    $sql_query = "SELECT `sno`, `id`, `mobile`, `mail`, `name`, `address`, `pay_type`, `pay_status`, `order_total`, `delivery_total`, `total`, `item_count`,( SELECT  dd.`optionText` FROM `dropDowns` as dd WHERE dd.`id` = 1 and dd.`optionValue` = od.`status` and `status` = 0 ) as Status, `tiktok` FROM `orders` as od WHERE od.status not in (4,5)";
    $result =  mysqli_query($conn, $sql_query);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $temp[] = $row;
    }
    if ($temp == null) {
        $temp = array();
    }
    $response["status"] = true;
    $response["data"] = $temp;


    echo json_encode($response);
}

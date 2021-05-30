<?php


$rootfolder = $_SERVER['DOCUMENT_ROOT'];
include($rootfolder . "/connection/connection.php");

$id= $_REQUEST["data"]["id"];
$sql= "SELECT `sno`, `item_name`, `price`, `item_status` FROM `order_items` WHERE `order_id` = '".$id."' ";

$result =  mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $temp[] = $row;
}
if ($temp == null) {
    $temp = array();
}

$response["status"]=true;
$response["data"] = $temp;

echo json_encode($response);

?>
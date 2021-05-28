
<?php

//session_start();
include('../common/index.php');

$success_msg="";
$error_msg="";

if ($_SESSION['user']["login"] !== 'Y') {
    $reponse['status'] = false;
    $reponse['msg'] = "Please Login / Sign UP to proceed !!";
    echo  json_encode($response);
    exit(0);
}

if (strtoupper($requestMethod) == 'GET') {
    $whereClause = "where 1 ";
  /*  if (isset($_REQUEST["userId"])) {
        $whereClause = " and `bookedUser` = '" . $_REQUEST["userId"] . "' ";
    }
    if (isset($_REQUEST["bookingId"])) {
        $whereClause = " and `id` = '" . $_REQUEST["bookingId"] . "' ";
    }
    if (isset($_REQUEST["serviceBy"])) {
        $whereClause = " and `serviceBy` = '" . $_REQUEST["serviceBy"] . "' ";
    } */
    $whereClause =$whereClause. " and `bookedUser` = '" . $_SESSION['user']["data"]["id"] . "' ";
    $orderBy = " ORDER by `serviceDate` ASC ";
    $sql = "SELECT `sno`, `id`, `serviceDate`, `serviceBy`, concat('₹',`charge`) as charge, (SELECT concat(`session`,' - ',`startTime`,' ',`startMeridiem`,' to ',`endTime`,' ',`endmeridiem`) as slot from `bookingSlot` where `sno` =`serviceSlot`) as serviceSlot, (SELECT `statusText` FROM `status` WHERE `id` = 1 and `statusValue` =`status`) as Status , `tiktok` FROM `bookings` " . $whereClause . " " . $orderBy;
    $response["sql"]=$sql;
    $result =  mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

        $temp[] = $row;
    }
    if ($temp == null) {
        $temp = array();
    }

    $response["status"]=true;
    $response["data"]=$temp;
    echo  json_encode($response);

} else {
}

?>
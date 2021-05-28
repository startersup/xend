<?php

include('../common/index.php');

// $tableName = "routes";
// $uniqueKey = "routeId";
// $uniqueValue = $_POST[$uniqueKey];
// $whereClause = " WHERE " . $_POST["whereClause"];
// $colsForTableView = " `id`, `routeId`,`routeName`, `fromDate`, `toDate`, `run1Flag`, `run2Flag`,`councilFare`, `yourFare`, `driverFare`, `escortFare` ";
// $colsAllView = " `id`, `routeId`, `routeName`, `fromDate`, `toDate`, `run1Flag`, `run2Flag`, `run1Start`, `run1End`, `run2Start`, `run2End`, `schoolId`, `studentId`, `driverId`, `escortId`, `sunday`, `monday`, `tuesday`, `wednesday`, `thusday`, `friday`, `saturday`, `sundayFlag`, `mondayFlag`, `tuesdayFlag`, `wednesdayFlag`, `thursdayFlag`, `fridayFlag`, `saturdayFlag`, `councilFare`, `yourFare`, `driverFare`, `escortFare`, `ro`, `specialInfo`, `training`, `wscc`, `notes`, `tiktok` ";


// include('../operation/index.php');
session_start();

// if ($_SESSION['user']['cart']['count']  == '') {
//     $_SESSION['user']['cart']['count']=0;
// }

// $count=$_SESSION['user']['cart']['count'];
// $_SESSION['user']['cart'][$count]['category_id']=$row['category_id'];
// $_SESSION['user']['cart'][$count]['subCategory_id']=$row['subCategory_id'];
// $_SESSION['user']['cart'][$count]['serviceType_id']=$row['serviceType_id'];
// $_SESSION['user']['cart'][$count]['inspection_charge']=$row[''];
// $_SESSION['user']['cart'][$count]['basic_charge']=$row['basic_charge'];
// $_SESSION['user']['cart'][$count]['other_charge']=$row['other_charge'];

// if ($_SESSION['user']["login"]  == 'Y') {

// }

if (strtoupper($requestMethod) == 'GET') {
    if ($_SESSION['user']['cart'] == null || $_SESSION['user']['cart']=="") {
        $_SESSION['user']['cart'] = array();
    }
    echo json_encode($_SESSION['user']['cart']);
} else if (strtoupper($requestMethod) == 'POST') {
    $userID = $_SESSION['user']['data']["id"];
    $_SESSION['user']['cart'] = array();
    if($_POST['data'] != "")
    {
        $_SESSION['user']['cart'] = ($_POST['data']);
    }
   
    $cartData = json_encode($_SESSION['user']['cart']);
    $sql = "UPDATE `users` SET `cartData` = '" . $cartData . "' where `id` = '" . $userID . "'";
    $result =  mysqli_query($conn, $sql);
    echo ($cartData);
}else if (strtoupper($requestMethod) == 'POST') {

}

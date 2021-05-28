<?php

// include('../common/index.php');

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

$user_id=$POST['userID'];
$booking_id =$POST['bookingId'];
if($booking_id == "")
{
    $where="where `booking_id` in (Select `id` from `bookings` where `bookedUser` = '".$user_id."')";
}else{
    $where="where `booking_id`  = '".$booking_id."')";
}
$sql ="select `booking_id` , (select `val` from `category` where `id` = `category_id`) as category_id , (select `val` from `subCategory` where `id` = `subCaregory_id`) as subCaregory_id , (select `name` from `serviceTypes` where `id` = `serviceType_id`) as serviceType_id ,`inspection_charge`  FROM `bookingService` ".$where;

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
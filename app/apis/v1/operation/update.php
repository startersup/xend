<?php
$sql = "UPDATE `" . $tableName . "` SET ";
$updateData = " `toberepcust` ";
foreach ($post_vars["data"] as $param_name => $param_val) {
    $updateData .= ", `" . $param_name . "` = '" . $param_val . "' ";
}
$updateData = str_replace("`toberepcust` ,", "", $updateData);
$sql .= $updateData . " WHERE `" . $uniqueKey . "` ='" . $post_vars[$uniqueKey] . "' ";
$result =  mysqli_query($conn, $sql);
$response["sql"] = $sql;
if ($result) {

    $response["status"] = true;   
} else {
    $response["msg"] = "Updation failed";
}

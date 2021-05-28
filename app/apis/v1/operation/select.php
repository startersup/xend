<?php

    $sql = " SELECT " . $colsForTableView . " FROM `" . $tableName . "` " . $whereClause;
    $result =  mysqli_query($conn, $sql);
    $response["sql"]=$sql;

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

        $temp[] = $row;
    }
    if ($temp == null) {
        $temp = array();
    }
    $response["status"]=true;
    $response["data"] = $temp;
    
?>
<?php

if (strtoupper($requestMethod) == 'GET') {
    if ($_REQUEST[$uniqueKey] == "") {
        if ($_REQUEST["where"] != "") {
            $whereClause = " WHERE " . $_REQUEST["where"];
        }
        include('../operation/select.php');
    } else if ($_REQUEST[$uniqueKey] != "") {
        include('../operation/info.php');
    }
} else if (strtoupper($requestMethod) == 'POST') {
    if ($_POST[$uniqueKey] == "" && $_POST["data"] != "") {
        include('../operation/insert.php');
    }else{
        $response["status"]=false;
        $response["msg"]="1- ".$_POST[$uniqueKey]."  2- ".$_POST["data"];
    }
} else if (strtoupper($requestMethod) == 'PUT') {
    if ($post_vars[$uniqueKey] !== "" && $post_vars["data"] != "") {
        include('../operation/update.php');
    } else {
        $response["status"] = false;
        $response["msg"] = "Error  in filters!!";
        // $response["uniqueKey-Data"] = json_encode($post_vars["data"]);
        // $response["postvar-uniqueKey"] =$post_vars["id"];
        // $response["uniqueKey"] =$_POST["id"];
        echo json_encode($response);
    }
} else if (strtoupper($requestMethod) == 'DELETE') {
    if ($post_vars[$uniqueKey] !== "") {
        include('../operation/delete.php');
    } else {
        $response["status"] = false;
        $response["msg"] = "Error  in filters!!";
        echo json_encode($response);
    }
}

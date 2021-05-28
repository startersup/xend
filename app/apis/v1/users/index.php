<?php

include('../common/index.php');

parse_str(file_get_contents("php://input"), $post_vars);
$tableName = "users";
$uniqueKey = "id";
$unique_prefix = "U";
$success_resonse = "N";

if ((strtoupper($requestMethod) == 'PUT' || strtoupper($requestMethod) == 'DELETE') && $_SESSION['user']["fromSite"] == 'Y') {
    if (!($_SESSION['user']['data']["id"] == $post_vars[$uniqueKey])) {
        $response["status"] = false;
        $response["msg"] = "Error  in user filter!!";
    }
} else if (strtoupper($requestMethod) == 'POST') {
    $response["data"]["id"] = "";
    $response["data"]["name"] = $post_vars["data"]["name"];
    $response["data"]["mailId"] = $post_vars["data"]["mailId"];
    $response["data"]["mobile1"] = $post_vars["data"]["mobile1"];
    $response["data"]["area"] = "";
    $response["data"]["city"] = "";
    $response["data"]["pincode"] = "";

    $userMail = $post_vars["data"]["mailId"];
    $userMobile = $post_vars["data"]["mobile1"];
    $query = "SELECT   `mailId`, `mobile1`  FROM `users` WHERE (   mailId = '" . $userMail . "' or mobile1 = '" . $userMobile . "' ) ";
    $result =  mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        $response["status"] = false;
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if ($row["mailId"] == $userMail) {
            $response["msg"] = "Mail Id Already Registered!!";
        } else if ($row["mobile1"] == $userMobile) {
            $response["msg"] = "Mobile Number Already Registered!!";
        }

        echo json_encode($response);
        exit(0);
    }
}


$colsForTableView = " `sno`, `id`, `name`, `mailId`, `mobile1`, `mobile2`, `line1`, `line2`, `area`, `city`, `landmark`, `pincode`, `status` ";
$colsAllView = " `sno`, `id`, `name`, `mailId`, `mobile1`, `mobile2`, `line1`, `line2`, `area`, `city`, `landmark`, `pincode`, `status` ";


include('../operation/index.php');

include('../operation/action.php');

// if ($last_id != "") {
//     $sql = " SELECT " . " `id`, `name`, `mailId`, `mobile1`,`area`, `city`,`pincode` " . " FROM `" . $tableName . "` where `id` = '" . $unique_prefix . $last_id . "'";
//     $result =  mysqli_query($conn, $sql);
//     $response["sql_last"]=$sql;
//     if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {



//         $_SESSION['user']['data']["id"] = $row["id"];
//         $_SESSION['user']['data']["name"] = $row["name"];
//         $_SESSION['user']['data']["mailId"] = $row["mailId"];
//         $_SESSION['user']['data']["mobile1"] = $row["mobile1"];
//         $_SESSION['user']['data']["area"] = $row["area"];
//         $_SESSION['user']['data']["city"] = $row["city"];
//         $_SESSION['user']['data']["pincode"] = $row["pincode"];

//         $_SESSION['user']["login"] = 'Y';
//         $_SESSION['user']["sessiontime"] = 6000;
//         $_SESSION['user']["logintime"] = strtotime(date("Y-m-d H:i:s"));
//     }

//    // echo json_encode($response);
// }
if ($response["status"]) {
    if ((strtoupper($requestMethod) == 'POST')) {

        $_SESSION['user']['data']["id"] = $response["uniqueId"];
        $_SESSION['user']['data']["name"] = $post_vars["data"]["name"];
        $_SESSION['user']['data']["mailId"] = $post_vars["data"]["mailId"];
        $_SESSION['user']['data']["mobile1"] = $post_vars["data"]["mobile1"];
        $_SESSION['user']['data']["area"] = "";
        $_SESSION['user']['data']["city"] = "";
        $_SESSION['user']['data']["pincode"] = "";

        $_SESSION['user']["login"] = 'Y';
        $_SESSION['user']["sessiontime"] = 6000;
        $_SESSION['user']["logintime"] = strtotime(date("Y-m-d H:i:s"));
        $url = 'https://urbanxperts.in/templates/mails/mail-verify.php?' . "mailId=" . $post_vars["data"]["mailId"] . "&userName=" . $post_vars["data"]["name"];
        // init curl object        
        $ch = curl_init();

        // define options
        $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        );

        // apply those options
        curl_setopt_array($ch, $optArray);

        // execute request and get response
        $result = curl_exec($ch);
        curl_close($ch);

        $url = 'https://urbanxperts.in/templates/mails/mobile-verify.php?' . "userNumber=" . $post_vars["data"]["mobile1"] . "&userName=" . $post_vars["data"]["name"];
        // init curl object        
        $ch = curl_init();

        // define options
        $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        );

        // apply those options
        curl_setopt_array($ch, $optArray);

        // execute request and get response
        $result = curl_exec($ch);
        curl_close($ch);
       
    }
    if ((strtoupper($requestMethod) == 'PUT')) {

        $_SESSION['user']['data']["name"] = $post_vars["data"]["name"];
        $_SESSION['user']['data']["mailId"] = $post_vars["data"]["mailId"];
        $_SESSION['user']['data']["mobile1"] = $post_vars["data"]["mobile1"];
    }
}

if(strtoupper($requestMethod) == 'POST')
{
    if($response["status"])
    {
        $response["msg"]= "User Added Successfully";
    }else{
        $response["msg"]= "Failed to Add User";
    }
    
}else if(strtoupper($requestMethod) == 'PUT')
{
    if($response["status"])
    {
        $response["msg"]= "User Details Updated Successfully";
    }else{
        $response["msg"]= "Failed to Update User Details";
    }
}else if(strtoupper($requestMethod) == 'DELETE')
{
    if($response["status"])
    {
        $response["msg"]= "User Deleted Successfully";
    }else{
        $response["msg"]= "Failed to Delete User";
    }
}

echo json_encode($response);
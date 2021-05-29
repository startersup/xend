<?php

session_start();

$_SESSION['user']['login']  = 'N';
$temp = $_SERVER['DOCUMENT_ROOT'];
// if ($temp == "C:/xampp/htdocs" || $temp == "/Applications/XAMPP/xamppfiles/htdocs") {
//     $temp .= '/sm-software';
// }
// $response["rootpath"]=$temp;
include($temp . "/connection/connection.php");
$user = $_POST["data"]["userName"];
$password = $_POST["data"]["password"];
$query = "SELECT `sno`, `id`, `name`, `mobile`, `mail`, `password` FROM `users` WHERE (   mail = '" . $user . "' or mobile = '" . $user . "' ) and status =0 ";
$response["query"] = $query;
$result =  mysqli_query($conn, $query);
$count = mysqli_num_rows($result);
if ($count > 0) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($row["password"] == $password) {

        $_SESSION['user']['data']["id"] = $row["id"];
        $_SESSION['user']['data']["name"] = $row["name"];
        $_SESSION['user']['data']["mail"] = $row["mail"];
        $_SESSION['user']['data']["mobile"] = $row["mobile"];

        $response["data"]["id"] = $row["id"];
        $response["data"]["name"] = $row["name"];
        $response["data"]["mail"] = $row["mail"];
        $response["data"]["mobile"] = $row["mobile"];

        $_SESSION['user']["login"] = 'Y';

        $_SESSION['user']["sessiontime"] = 6000;
        $_SESSION['user']["logintime"] = strtotime(date("Y-m-d H:i:s"));

        $response["status"] = true;
        $response["msg"] = "Login Success !!";
    } else {

        $response["status"] = false;
        $response["msg"] = "User Name or Password is wrong !!";
    }
} else {

    $response["status"] = false;
    $response["msg"] = "User Not Found !!";
    // echo ('<script>alert("User Not Found"); window.location.href ="' . $_SERVER['HTTP_REFERER'] . '"</script>');
}

echo json_encode($response);
// else{
//     echo ('<script>alert("UnAuthorized Access"); window.location.href ="' . $_SERVER['HTTP_REFERER'] . '"</script>');

// }

mysqli_close($conn);

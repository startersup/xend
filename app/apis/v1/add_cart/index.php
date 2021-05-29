<?php


session_start();

if($_POST['data'] != "")
{
$_SESSION['USER_INFO']["product"] = array();
$_SESSION['USER_INFO']["product"] = ($_POST['data']);
}
echo json_encode($_SESSION);


?>
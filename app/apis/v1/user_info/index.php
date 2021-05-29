<?php

session_start();
if ($_POST['data'] != "") {
    $_SESSION['USER_INFO']['data'] = array();
    $_SESSION['USER_INFO']["data"] = ($_POST['data']);
}

echo json_encode($_SESSION);

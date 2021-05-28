<?php

session_start();

if($_SESSION['user']['data'] == "")
{
    $_SESSION['user']['data']=array();
}
echo json_encode($_SESSION['user']['data']);

?>
<?php

include('methodNotValid.php');
include('globalVariables.php');

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
$link = "https"; 
else
$link = "http"; 



session_start();
//include('sessionCheck.php');


?>
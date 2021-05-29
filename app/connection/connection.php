<?php

$conn=mysqli_connect('localhost','u906351065_Q1ser2	','X]eO~o:M:8','u906351065_pos');

if( !$conn)
{
    $response["status"]=false;
    $response["msg"]="DB Error...!!!!!";
    echo json_encode($response);
}
?>
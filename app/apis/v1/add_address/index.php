<?php


session_start();

if ($_POST['data'] != "") {
    if ($_POST['data']['tempId'] == '') {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $book_randstring = "VSP" . date("Y");
        for ($i = 0; $i < 10; $i++) {
            $book_randstring = $book_randstring . $characters[rand(0, strlen($characters))];
        }
        $_POST['data']['tempId'] = $book_randstring;
    }
    $_SESSION['USER_INFO']["transaction"] = array();
    $_SESSION['USER_INFO']["transaction"] = ($_POST['data']);
}
echo json_encode($_SESSION);

?>
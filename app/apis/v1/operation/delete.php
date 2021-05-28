<?php

    if($post_vars[$uniqueKey] !== '')
    {
       $sql =  " DELETE " . " FROM `" . $tableName . "` WHERE `" . $uniqueKey . "` ='" . $post_vars[$uniqueKey] . "' ";
       $result =  mysqli_query($conn, $sql);
       if($result)
       {
        $response["status"] = true;
        
       } 
    }else{
        $response["status"] = false;
        $response["msg"] = "Error  in filters!!";
    }

<?php

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $book_randstring = "UXB".date("Y");
        for ($i = 0; $i < 8; $i++) {
            $book_randstring = $book_randstring . $characters[rand(0, strlen($characters))];
        }
    ?>
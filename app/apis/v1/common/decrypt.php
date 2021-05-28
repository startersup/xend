<?php


// Non-NULL Initialization Vector for decryption 
$decryption_iv = '1234567891011121'; 
  
// Store the decryption key 
$decryption_key = ""; 
  
// Use openssl_decrypt() function to decrypt the data 
$decryption=openssl_decrypt ($encryption, $ciphering,  
        $decryption_key, $options, $decryption_iv); 

?>
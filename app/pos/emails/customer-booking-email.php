
<?php


$del_address =$_SESSION['USER_INFO']['transaction']['address'];
$customer_message = ' <body link="#00a5b5" vlink="#00a5b5" alink="#00a5b5">

    <table class=" main contenttable" align="center" style="font-weight: normal;border-collapse: collapse;border: 0;margin-left: auto;margin-right: auto;padding: 0;font-family: Arial, sans-serif;color: #555559;background-color: white;font-size: 16px;line-height: 26px;max-width: 600px;width:100%;border: 1px solid #eeeff0;">
            <tr>
                <td class="border" style="border-collapse: collapse;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                    <table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                            </table></td><td valign="top" class="side title" style="border-collapse: collapse;border: 0;margin: 0;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;vertical-align: top;background-color: white;border-top: none;">
                                <table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                    
                                  
                                    <tr>
                                        <td class="text" style="border-collapse: collapse;border: 0;margin: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                                            <div style="text-align: center;font-size: 20px; color:#6EE394;padding: 10px; background-color: #022335; margin-bottom: 40px;font-weight: 800;
                                            letter-spacing: 0.2px;padding:10px;">Booking Id:'. $last_id .'</div>
                                        <div class="mktEditable" style="padding:20px;color:#022335;" id="main_text">
                                            Hi <b>' . $name . '</b>,<br>
Thanks for ordering with us. We hope to deliver your products as soon as possible and with proper safety measures.<br><br>
<table class="booking-details" style="width: 100%;max-width: 500px;margin: 0 auto;border: 1px solid #ececec;border-collapse: collapse;">
<tr>
 <td style="line-height: 25px;padding: 10px;font-size: 15px;border: 1px solid #ececec;border-collapse: collapse;background-color: #f4f4f4;width: 30%;">Name</td>   
 <td style="line-height: 25px;padding: 10px;font-size: 15px;border: 1px solid #ececec;border-collapse: collapse;background-color: #f4f4f4;">' . $name . '</td>
</tr>  
<tr>
    <td style="line-height: 25px;padding: 10px;font-size: 15px;border: 1px solid #ececec;border-collapse: collapse;background-color: #f4f4f4;width: 30%;">Contact Number</td>   
    <td style="line-height: 25px;padding: 10px;font-size: 15px;border: 1px solid #ececec;border-collapse: collapse;background-color: #f4f4f4;">' . $mobile . '</td>
   </tr> 
   <tr>
    <td style="line-height: 25px;padding: 10px;font-size: 15px;border: 1px solid #ececec;border-collapse: collapse;background-color: #f4f4f4;width: 30%;">Email Address</td>   
    <td style="line-height: 25px;padding: 10px;font-size: 15px;border: 1px solid #ececec;border-collapse: collapse;background-color: #f4f4f4;">' . $mailId . '</td>
   </tr> 
   <tr>
    <td style="line-height: 25px;padding: 10px;font-size: 15px;border: 1px solid #ececec;border-collapse: collapse;background-color: #f4f4f4;width: 30%;">Delivery Address</td>   
    <td style="line-height: 25px;padding: 10px;font-size: 15px;border: 1px solid #ececec;border-collapse: collapse;background-color: #f4f4f4;">' . $del_address . '</td>
   </tr> 
   <tr>
    <td style="line-height: 25px;padding: 10px;font-size: 15px;border: 1px solid #ececec;border-collapse: collapse;background-color: #f4f4f4;width: 30%;">Payment Type</td>   
    <td style="line-height: 25px;padding: 10px;font-size: 15px;border: 1px solid #ececec;border-collapse: collapse;background-color: #f4f4f4;">' . $payment . '</td>
   </tr> 
</table>
                       <br>
                       <h3 style="text-align: center;">Order Items</h3>
                       <table class="booking-details" style="width: 100%;max-width: 500px;margin: 0 auto;border: 1px solid #ececec;border-collapse: collapse;">
                     ' . $admin_table . '
                       </table>
                       
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 24px;">
                                         &nbsp;<br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;background-color: #d3d3d3;font-family: Arial, sans-serif;font-size: 16px;line-height: 24px;">
                                         <p style="padding:10px;text-align:center;font-size:12px;letter-spacing: 0.5px;">Copyrights VSP Supermarket. Powered by <b>Xend PoS</b></p>
                                        </td>

                                    </tr>
    
                                </table>
                            </td>
                        </tr>
                    </table>
                
            
        
      </body>';

      $mailFromHeader = 'VSP Supermarket';
      $mailFromMailId = 'xendworks@gmail.com';
      $mailToHeader= 'VSP Supermarket';
      $mailToMailId = 'xendworks@gmail.com';

$headers = "";
$headers .= "From: " . $mailFromHeader . " <" . $mailFromMailId . "> \r\n";
$headers .= "Reply-To: " . $mailToHeader . "   <" . $mailToMailId . "> \r\n" . "X-Mailer: PHP/" . phpversion();
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\b";

$mailSubject = ' Your order in VSP Supermarket';
mail($mailId,$mailSubject,$customer_message,$headers);
?>

  
<?php
/***********************
 * Input params
 * $mailList = "123,46,78,000";
 * $ccMail
 * #mailHeader
 * $mailMessage
 * $mailSubject
 * $mailFromHeader
 * $mailFromMailId
 * $mailToHeader
 * $mailToMailId

mail-service

*************************/

$headers = "";
$headers .= "From: ".$mailFromHeader." <".$mailFromMailId."> \r\n";
$headers .= "Reply-To: ".$mailToHeader."   <".$mailToMailId."> \r\n"."X-Mailer: PHP/" . phpversion();
$headers .= "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\b";

$mailResult='';
$mailIdList = explode (",", $mailList);
$mailCount = sizeof($mailIdList);
for($i=0;$i<$mailCount;$i++)
{
    $res=mail($mailIdList[$i],$mailSubject,$mailMessage,$headers);
    if($mailType == 'booking')
    {
        mail("urbanxperts@gmail.com",$mailSubject,$mailMessage,$headers);
        mail("xendworks@gmail.com",$mailSubject,$mailMessage,$headers);
    }
    $temp='fail';
    if($res)
    {
       $temp='success';
    }
    $mailResult = $mailResult.$temp;
}
$response["mail_status"]=$mailResult;
//echo json_encode($response);
?>
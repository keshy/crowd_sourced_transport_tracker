<?php
require_once 'Services/Twilio.php';
require_once 'sms_manager.php';

if(!$body = $_REQUEST['Body']) {
    $outP = "Can not process your request at this time. [00] ";
}else{
    //Generate the SMS content
    $sm = new SmsManager();
    $outP = $sm->processSmsRequest($body);
}

// Send the SMS
header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Sms><?php echo $outP ?></Sms>
</Response>
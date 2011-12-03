<?php
require_once "includes.php";

echo "------------------------------------------------------<br/>";

/*
$dbw = new DBWrapper();
$dbw->
*/

//$ml = new MainLogic();
//$body="UP#10#26";
//$body="INFO#6#19";
$body = "ALL#6";
$sm = new SmsManager();
$ss = $sm->processSmsRequest($body);
//$ss = $ml->getRouteInfoAtStop(19,6);


//getAllRoutesAtStop(33.8205,	-84.3040)
//$ss = $ml->getRouteInfoNearMe(19, 33.8202,-84.3036);
//$ss = $ml->update(26,6);

//$ss = $ml->getAllRoutesAtStop(6);

//$ss = $ml->getAllRoutesNearMe(33.8205,-84.3040);
echo ">>>>>>>>>>>>>>>>>>>>>><br/>";
print_r($ss);




?>
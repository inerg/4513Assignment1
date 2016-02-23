<?php

require_once('lib/helpers/visits-setup.inc.php');
$query = 'WHERE ';
if(isset($_REQUEST['brand']) && !empty($_REQUEST['brand'])) {
    $query.'dt.name = \''.$_REQUEST['brand'].'\' ';
}
if(isset($_REQUEST['referrer']) && !empty($_REQUEST['referrer'])){
    $query.'referrer_id = \''.$_REQUEST['referrer'].'\' ';
}
if(isset($_REQUEST['os']) && !empty($_REQUEST['os'])) {
    $query.'os_id = \''.$_REQUEST['os'].'\' ';
}
if(isset($_REQUEST['dt']) && !empty($_REQUEST['dt'])) {
    $query.'device_type_id = \''.$_REQUEST['dt'].'\' ';
}
if(isset($_REQUEST['browser']) && !empty($_REQUEST['browser'])){
    $query.'browser_id = \''.$_REQUEST['browser'].'\' ';
}
//    $passedValue = $_REQUEST['brand'];
if($query == "WHERE ")
{
    $query = "";
}
    
	$gate = new VisitsBrowserTableGateway($dbAdapter);
	$result = $gate->getVisitInfo($query);

	echo json_encode($result);
?>
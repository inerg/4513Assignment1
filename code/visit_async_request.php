<?php

require_once('lib/helpers/visits-setup.inc.php');
$query;
if(isset($_REQUEST['brand']) && !empty($_REQUEST['brand'])) {
    if(empty($query)){
        $query = 'WHERE ';
    }

    $query.'dt.name = \''.$_REQUEST['brand'].'\' ';
}
if(isset($_REQUEST['referrer']) && !empty($_REQUEST['referrer'])){
    if(empty($query)){
        $query = 'WHERE ';
    }

    $query.'referrer_id = \''.$_REQUEST['referrer'].'\' ';
}
if(isset($_REQUEST['os']) && !empty($_REQUEST['os'])) {
    if(empty($query)){
        $query = 'WHERE ';
    }

    $query.'os_id = \''.$_REQUEST['os'].'\' ';
}
if(isset($_REQUEST['dt']) && !empty($_REQUEST['dt'])) {
    if(empty($query)){
        $query = 'WHERE ';
    }

    $query.'device_type_id = \''.$_REQUEST['dt'].'\' ';
}
if(isset($_REQUEST['browser']) && !empty($_REQUEST['browser'])){
    if(empty($query)){
        $query = 'WHERE ';
    }

    $query.'browser_id = \''.$_REQUEST['browser'].'\' ';
}
//    $passedValue = $_REQUEST['brand'];
//if(strcmp($query,"WHERE ") == 0)
//{
//    $query = "";
//}
    
	$gate = new VisitsBrowserTableGateway($dbAdapter);
	$result = $gate->getVisitInfo($query);

	echo json_encode($result);
?>
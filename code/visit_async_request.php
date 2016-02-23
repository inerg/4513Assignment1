<?php

require_once('lib/helpers/visits-setup.inc.php');

//if(isset($_REQUEST['brand']) && !empty($_REQUEST['brand'])) {
//    $passedValue = $_REQUEST['brand'];
    
	$gate = new VisitsBrowserTableGateway($dbAdapter);
	$result = $gate->getVisitInfo($passedValue);

	echo json_encode($result);
?>
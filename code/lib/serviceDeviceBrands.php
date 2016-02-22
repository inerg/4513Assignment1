<?php
/*
	Valid web service requests (whereClause) for Device Brands:
	-id
	-name
*/

require_once('helpers/visits-setup.inc.php');
require_once('helpers/serviceUtilities.inc.php');

// Tell the browser to expect JSON rather than HTML
header('Content-type: application/json');

// Needed for javascript clients from another domain
header('Access-Control-Allow-Origin: *');

//Process Client Request 
$deviceBGate = new DeviceBrandTableGateway($dbAdapter);

if(!empty($_GET)){
	$validCriteria = isCorrectQueryStringInfo($_GET, "deviceBrands");

	if($validCriteria) {
		$whereClause = key($_GET);
		$searchVariable = array_shift($_GET);
		$results = $deviceBGate->getDeviceBrandsByQuery($whereClause ,$searchVariable);
		
		if(empty($results)) {
			deliver_response(200, "requested data not found", NULL);
		}
		else {
			echo json_encode($results, JSON_PRETTY_PRINT);
		}
	}
	else {
		deliver_response(200, "requested data not found", NULL);
	}
}
else {
	//Display first 100 entries of DeviceBrands
	$results = $deviceBGate->getDeviceBrandsInfo();
	echo json_encode($results, JSON_PRETTY_PRINT);	
}

$dbAdapter->closeConnection();

?>
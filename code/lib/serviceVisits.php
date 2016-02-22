<?php
/*
	Valid web service requests (whereClause) for visits:
	-id
	-ip_address
	-country_code
	-visit_date
	-visit_time
	-device_type_id
	-device_brand_id
	-browser_id
	-referrer_id
	-os_id
*/

require_once('helpers/visits-setup.inc.php');
require_once('helpers/serviceUtilities.inc.php');

// Tell the browser to expect JSON rather than HTML
header('Content-type: application/json');

// Needed for javascript clients from another domain
header('Access-Control-Allow-Origin: *');

//Process Client Request 
$visitorGate = new VisitTableGateway($dbAdapter);

if(!empty($_GET)){
	$validCriteria = isCorrectQueryStringInfo($_GET, "visits");

	if($validCriteria || ISSET($_GET['custom'])) {
		$whereClause = key($_GET);
		$searchVariable = array_shift($_GET);
		
		if($whereClause == 'custom')
		{
			if(ISSET($_GET['select'])) {
				$selectVal = $_GET['select'];
				if(!ISSET($_GET['groupBy'])) {
					$results = $visitorGate->getCustomSearch($selectVal, $searchVariable, NULL);
				}
				if(ISSET($_GET['groupBy'])) {
					$groupBy = $_GET['groupBy'];
					$results = $visitorGate->getCustomSearch($selectVal, $searchVariable, $groupBy);
				}
			}
			
			if(!ISSET($_GET['select'])) {
				deliver_response(200, "invalid parameter(s)", NULL);
			}
			
			if(empty($results)) {
				deliver_response(200, "requested data not found", NULL);
			}
			else {
				echo json_encode($results, JSON_PRETTY_PRINT);
			}
		}
		else {
		
		
			$results = $visitorGate->getVisitsByQuery($whereClause ,$searchVariable);
		
			if(empty($results)) {
				deliver_response(200, "requested data not found", NULL);
			}
			else {
				echo json_encode($results, JSON_PRETTY_PRINT);
			}
			}
	}
	else {
		deliver_response(200, "requested data not found", NULL);
	}
}
else {
	//Display first 100 entries of visits
	$results = $visitorGate->getVisits();
	echo json_encode($results, JSON_PRETTY_PRINT);	
}

$dbAdapter->closeConnection();

?>
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
			if(!ISSET($_GET['join'])) { //not using join
				if(ISSET($_GET['select'])) {
					$selectVal = $_GET['select'];
					if(!ISSET($_GET['groupBy'])) { //if not using groupBy
						if(!ISSET($_GET['having'])) {//and not using having
						//echo "used 1";
							$results = $visitorGate->getCustomSearch($selectVal, $searchVariable, NULL, NULL, NULL);
						}
					}
					if(ISSET($_GET['having'])) {//if using having
						if(!ISSET($_GET['groupBy'])) {//and not groupBy
							$having = $_GET['having'];
							//echo "used 2";
							$results = $visitorGate->getCustomSearch($selectVal, $searchVariable, NULL, $having, NULL);
						}
					}
					if(ISSET($_GET['groupBy'])) { //if using groupBy
						if(!ISSET($_GET['having'])) {//and not having
							$groupBy = $_GET['groupBy'];
							//echo "used 3";
							$results = $visitorGate->getCustomSearch($selectVal, $searchVariable, $groupBy, NULL, NULL);
						}
					}
					if(ISSET($_GET['groupBy'])) {//using groupBy
						If(ISSET($_GET['having'])) {//as well as having
							$having = $_GET['having'];
							$groupBy = $_GET['groupBy'];
							//echo "used 3.5";
							$results = $visitorGate->getCustomSearch($selectVal, $searchVariable, $groupBy, $having, NULL);
						}
					}
				}
			}
			else {//using join
				if(ISSET($_GET['select'])) {
					$join = $_GET['join'];
					$selectVal = $_GET['select'];
					if(!ISSET($_GET['groupBy'])) {
						if(!ISSET($_GET['having'])) {
							//echo "used 4";
							$results = $visitorGate->getCustomSearch($selectVal, $searchVariable, NULL, NULL, $join);
						}
					}
					if(ISSET($_GET['having'])) { //using having
						$having = $_GET['having'];
						if(!ISSET($_GET['groupBy'])) {//and not groupBy
						//echo "used 5";
							$results = $visitorGate->getCustomSearch($selectVal, $searchVariable, NULL, $having, $join);
						}
						if(ISSET($_GET['groupBy'])) {//using both groupBy and Having
							$groupBy = $_GET['groupBy'];
							//echo "used 6";
							$results = $visitorGate->getCustomSearch($selectVal, $searchVariable, $groupBy, $having, $join);
						}
					}
					if(ISSET($_GET['groupBy'])) { //using groupBy
						if(!ISSET($_GET['having']))//and not having
						{
							$groupBy = $_GET['groupBy'];
							//echo "used 7";
							$results = $visitorGate->getCustomSearch($selectVal, $searchVariable, $groupBy, NULL, $join);
						}
					}
					
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
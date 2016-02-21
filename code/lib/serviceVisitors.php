<?php

require_once('helpers/visits-setup.inc.php');

// Tell the browser to expect JSON rather than HTML
header('Content-type: application/json');

// Needed for javascript clients from another domain
header("Access-Control-Allow-Origin: *");

//TODO: Figure out how to sort by key->value pairs
//$whereClause = 'browser_id';
//$look = $_GET['browser_id'];

$visitorGate = new VisitTableGateway($dbAdapter);
$results = $visitorGate->getVisits();
//$results = $visitorGate->findByFromJoins($whereClause, Array($look) );

echo json_encode($results, JSON_PRETTY_PRINT);
$dbAdapter->closeConnection();

/* 
//TEACHER EXAMPLE:
if ( isCorrectQueryStringInfo() ) {
	outputJSON($dbAdapter);
}
else {
	// put error message in JSON format
	echo '{"error": {"message":"Incorrect query string values"}}';
}

function outputJSON($dbAdapter) {
	// get query string values and set up search criteria
	$whereClause = 'Title Like ?';
	$look = $_GET['term'] . '%';
	
	// get the data from the database
	$visitorGate = new VisitTableGateway($dbAdapter);
	$results = $visitorGate->findByFromJoins($whereClause, Array($look) );
	
	// output the JSON for the retrieved book data
	echo json_encode($results);
	$dbAdapter->closeConnection();
}
*/
?>
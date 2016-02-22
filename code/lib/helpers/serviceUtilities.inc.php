<?php

//JSON Error Message
function deliver_response($status, $status_message, $data) {
	header("HTTP/1.1 $status $status_message");
	$response['status'] = $status;
	$response['status_message'] = $status_message;
	$response['data'] = $data;
	
	$json_response = json_encode($response);
	echo $json_response;
}

//Checks if valid query string information was passed in GET
function isCorrectQueryStringInfo($getArray, $serviceName) {
	if ( isCriteraPresentForWhereClause($getArray, $serviceName)) {
		return true;
  }
  return false;
}

//Checks if the value of the GET key is part of criteria
function isCriteraPresentForWhereClause($getArray, $serviceName) {
	//Check if valid service was inputed
	if (isAService($serviceName)) {
		//Return array of criteria
		switch ($serviceName) {
			case "visits":
				$criteria = visitsCriteria();
				break;
			case "browsers":
				$criteria = browserCriteria();
				break;
			case "deviceBrands":
				$criteria = deviceBrandCriteria();
				break;
			case "continents":
				$criteria = continentCriteria();
				break;
		} 

		//Verify that the whereClause is valid (exists in the criteria)
		if(in_array(key($getArray), $criteria)){
			return true;
		}
		else {
			return false;
		}	
	}
  return false;
}

function isAService($serviceName) {
	$existingServices = array(
		'visits', 'browsers', 'deviceBrands', 'continents'
	);
	
	if(in_array($serviceName, $existingServices)){
		return true;
	}
	else {
		return false;
	}
}

function visitsCriteria() {
	return array(
		'id', 'ip_address', 'country_code', 'visit_date', 
		'visit_time', 'device_type_id', 'device_brand_id', 
		'browser_id', 'referrer_id', 'os_id'
	);
}

function browserCriteria() {
	return array(
		'ID', 'id', 'name'
	);
}

function deviceBrandCriteria() {
	return array(
		'ID', 'id', 'name'
	);
}

function continentCriteria() {
	return array(
		'ContinentCode', 'continentcode', 'ContinentName', 
		'continentname', 'GeoNameId', 'geonameid'
	);
}

?>
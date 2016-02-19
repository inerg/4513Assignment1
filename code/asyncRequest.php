<?php

require_once('lib/helpers/visits-setup.inc.php');

if(isset($_POST['brand']) && !empty($_POST['brand'])) {
    $passedValue = $_POST['brand'];
    
	$gate = new DeviceBrandTableGateway($dbAdapter);
	$result = $gate->getBrandVisits($passedValue);

	$stringToConvert = array($result[0]['name'], $result[0]['visitCount']);

	echo json_encode($stringToConvert);
	}
?>
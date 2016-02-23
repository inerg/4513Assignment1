<?php

require_once('lib/helpers/visits-setup.inc.php');

if(isset($_REQUEST['brand']) && !empty($_REQUEST['brand'])) {
    $passedValue = $_REQUEST['brand'];
    
	$gate = new DeviceBrandTableGateway($dbAdapter);
	$result = $gate->getBrandVisits($passedValue);

	$stringToConvert = array($result[0]['name'], $result[0]['visitCount']);

	echo json_encode($stringToConvert);
	}
else
{
    if(isset($_REQUEST['continent']) && !empty($_REQUEST['continent']))
    {
        $passedValue = $_REQUEST['continent'];

        $continentGate = new ContinentTableGateway($dbAdapter);
        $result = $continentGate->getVisitsByContinentCode($passedValue);

        echo json_encode($result);
    }
}
	
?>
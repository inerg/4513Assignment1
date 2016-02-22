<?php

require_once('lib/helpers/visits-setup.inc.php');

if(isset($_POST['brand']) && !empty($_POST['brand'])) {
    $passedValue = $_POST['brand'];
    
	$gate = new DeviceBrandTableGateway($dbAdapter);
	$result = $gate->getBrandVisits($passedValue);

	$stringToConvert = array($result[0]['name'], $result[0]['visitCount']);

	echo json_encode($stringToConvert);
	}
else
{
    if(isset($_POST['continent']) && !empty($_POST['continent']))
    {
        $passedValue = $_POST['continent'];

        $continentGate = new ContinentTableGateway($dbAdapter);
        $result = $continentGate->getVisitsByContinentCode($passedValue);

        $stringToConvert = array($result[0]['CountryName'], $result[0]['VisitCount']);

        echo json_encode($stringToConvert);
    }
}
	
?>
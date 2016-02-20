<?php
	require_once('lib/helpers/visits-setup.inc.php');
	
	$gate = new VisitTableGateway($dbAdapter);
	//$result = $gate->displayBrowserStatisticsTable();

	$gate2 = new DeviceBrandTableGateway($dbAdapter);
	$result2 = $gate2->getDeviceBrands();

	$continentGate = new ContinentTableGateway($dbAdapter);

	//$result3 = $gate2->displaySelect($result2);
	
	//finished, so end the connection
	$dbAdapter->closeConnection();
?>
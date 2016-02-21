<?php
	require_once('lib/helpers/visits-setup.inc.php');
	
	$browserGate = new VisitTableGateway($dbAdapter);
	$deviceBrandGate = new DeviceBrandTableGateway($dbAdapter);
	$continentGate = new ContinentTableGateway($dbAdapter);
	
	$allDeviceBrands = $deviceBrandGate->getDeviceBrands();
	
	//$browserStatsTable = $browserGate->displayBrowserStatisticsTable();
	//$brandSelect = $brandGate->displaySelect($result2);

	$dbAdapter->closeConnection();
?>
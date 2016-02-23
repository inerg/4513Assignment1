<?php
	require_once('lib/helpers/visits-setup.inc.php');
	
	$browserGate = new VisitTableGateway($dbAdapter);
	$deviceBrandGate = new DeviceBrandTableGateway($dbAdapter);
	$continentGate = new ContinentTableGateway($dbAdapter);
	$deviceTypes = new DeviceTypeTableGateway($dbAdapter);
	$actualBrowserGate = new BrowserTableGateway($dbAdapter);
	$referrerGate = new ReferrerTableGateway($dbAdapter);

	$allDeviceBrands = $deviceBrandGate->getDeviceBrands();
	
	//$browserStatsTable = $browserGate->displayBrowserStatisticsTable();
	//$brandSelect = $brandGate->displaySelect($result2);

	$dbAdapter->closeConnection();
?>
<?php

require_once('lib/helpers/visits-setup.inc.php');

if(isset($_REQUEST['brand']) && !empty($_REQUEST['brand'])) {
    error_log('brand');
    if(!isset($query)){
        $query = 'WHERE db.name = \''.$_REQUEST['brand'].'\' ';
    }
    else
    {
        $query.'db.name = \''.$_REQUEST['brand'].'\' ';
    }
}
if(isset($_REQUEST['referrer']) && !empty($_REQUEST['referrer'])){
    error_log('referrer');
    if(!isset($query)){
        $query = 'WHERE referrer_id = \''.$_REQUEST['referrer'].'\' ';
    }
    else
    {
        $query.' AND referrer_id = \''.$_REQUEST['referrer'].'\' ';
    }

}
if(isset($_REQUEST['os']) && !empty($_REQUEST['os'])) {
    error_log('os');
    if(!isset($query)){
        $query = 'WHERE os_id = \''.$_REQUEST['os'].'\' ';
    }
    else
    {
        $query.' AND os_id = \''.$_REQUEST['os'].'\' ';
    }

}
if(isset($_REQUEST['dt']) && !empty($_REQUEST['dt'])) {
    error_log('dt');
    if(!isset($query)){
        $query = 'WHERE device_type_id = \''.$_REQUEST['dt'].'\' ';
    }
    else
    {
        $query.' AND device_type_id = \''.$_REQUEST['dt'].'\' ';
    }
}
if(isset($_REQUEST['browser']) && !empty($_REQUEST['browser'])){
    error_log('browser');
    if(!isset($query)){
        $query = 'WHERE browser_id = \''.$_REQUEST['browser'].'\' ';
    }
    else
    {
        $query.' AND browser_id = \''.$_REQUEST['browser'].'\' ';
    }

}
if(isset($_REQUEST['country']) && !empty($_REQUEST['country'])){
    error_log('country');
    if(!isset($query)){
        $query = 'WHERE c.CountryName = \''.$_REQUEST['country'].'\' ';
    }
    else
    {
        $query.' AND c.CountryName = \''.$_REQUEST['country'].'\' ';
    }

}
//    $passedValue = $_REQUEST['brand'];
//if(strcmp($query,"WHERE ") == 0)
//{
//    $query = "";
//}
    
	$gate = new VisitsBrowserTableGateway($dbAdapter);
	$result = $gate->getVisitInfo($query);

	echo json_encode($result);
?>
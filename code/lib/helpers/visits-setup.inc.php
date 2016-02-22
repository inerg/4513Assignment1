<?php
require_once('visits-config.php');

spl_autoload_register(function ($class) {
    $file = 'lib/dataAccess/' . $class . '.class.php';
    if (file_exists($file)) { 
		include $file;
	}
    else {
		$file = 'lib/model/' . $class . '.class.php';
    	if (file_exists($file)) {
      		include $file;
    	} else {
			//lib/dataAccess/ is a directory up
	    	$file = '../lib/dataAccess/' . $class . '.class.php';
	    	if (file_exists($file)) {
	      		include $file;
			}
	   		 else {
	      		include '../lib/model/' . $class . '.class.php';
			 }
	    }
	}
});

$dbAdapter = DatabaseAdapterFactory::create('PDO', array(DBCONNECTION, DBUSER, DBPASS));

?>
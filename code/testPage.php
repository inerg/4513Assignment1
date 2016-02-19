<!DOCTYPE html>

<?php
	require_once('lib/helpers/visits-setup.inc.php');
?>

<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>
<html>
<body>
<h1> Test Page </h1>

<?php

echo '<hr/>';
echo '<div>';
echo '<h2>Card 1:</h2>';

$gate = new VisitTableGateway($dbAdapter);
$result = $gate->displayBrowserStatisticsTable();

echo '<hr/>';
echo '</div>';
echo '<div id = "card2">';
echo '<h2>Card 2:</h2>';

$gate2 = new DeviceBrandTableGateway($dbAdapter);
$result2 = $gate2->getDeviceBrands();

$result3 = $gate2->displaySelect($result2);


echo '</div>'; //end of card 2 div





//finished, so end the connection
$dbAdapter->closeConnection();

?>


<script>
window.onload=function(){


document.querySelector('select').addEventListener("change", function() {
	
	var div = document.querySelector('#card2');
	var toRemove = document.querySelector("#h");
	if(toRemove != null) {
		div.removeChild(toRemove);
	}
	
	asyncAJAXRequest(this.value);
});

function asyncAJAXRequest(brandName) {
	$.ajax({
		type: "post",
		url: "asyncRequest.php",
		async: true,
		data: {brand: brandName}, 
		success: function(receivedArray) {
		var array1 = JSON.parse(receivedArray); //this line and
		displayBrandVisitData(array1); 	//this call are here to keep the code that reads the array from executing before
      }									//the AJAX request has returned.
    });
}

function displayBrandVisitData(visitsArray) {
	var header = document.createElement("h2");
	header.id = "h";
	var node = document.createTextNode('Visits for ' + visitsArray[0] + ': ' + visitsArray[1]);
	header.appendChild(node);
	
	var select = document.querySelector("Select");
	
	select.parentNode.insertBefore(header, select.nextSibling);
}

};	
</script>
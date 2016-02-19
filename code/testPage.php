<?php


require_once('lib/helpers/visits-setup.inc.php');
?>

<html>
<body>
<h1> Test Page </h1>

<?php

echo '<hr/>';
echo '<h2>Card 1:</h2>';

$gate = new VisitTableGateway($dbAdapter);
$result = $gate->displayBrowserStatisticsTable();




// all done close connection
$dbAdapter->closeConnection();

?>
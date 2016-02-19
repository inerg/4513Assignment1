<!DOCTYPE html>

<?php
	require_once('lib/helpers/visits-setup.inc.php');
	
	$gate = new VisitTableGateway($dbAdapter);
	//$result = $gate->displayBrowserStatisticsTable();

	$gate2 = new DeviceBrandTableGateway($dbAdapter);
	$result2 = $gate2->getDeviceBrands();

	//$result3 = $gate2->displaySelect($result2);
	
	//finished, so end the connection
	$dbAdapter->closeConnection();
?>

<html lang="en">
<head>
	<title>Admin Dashboard</title>
	<meta charset="utf-8">
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	<link type="text/css" rel="stylesheet" href="css/style.css">
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
	<!--Import jQuery BEFORE materialize.js-->
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<script type="text/javascript" src="js/materialize-modified.js"></script>
</head>
<body>
	<!-- Navigation -->
	<div class="navbar-fixed">
	<nav>
		<div class="nav-wrapper red darken-4">
			<a href="index.php" class="brand-logo center hide-on-med-and-down"><span class="orange-text text-lighten-2">Admin</span> Dashboard</a>
			<!-- Side Popout Menu -->
			<ul id="slide-out" class="side-nav full">
				<li class="side-nav-underline orange lighten-2"><a href="index.php"><i class="material-icons home-icon">home</i></a></li>
				<li class="side-nav-underline"><a href="about.php">About Us</a></li>
				<li class="side-nav-underline"><a href="#!">JSON Material Cards</a></li>
				<li class="side-nav-underline"><a href="#!">Visit Browser</a></li>
				<li class="side-nav-underline"><a href="#!">Charts</a></li>
			</ul>
			<a href="#" data-activates="slide-out" class="button-collapse"><i class="medium mdi-navigation-menu"></i></a>
		</div>
	</nav>
	</div>
	
	<!-- Container: Main -->
	<div class="container">
        <div class="row">
            <div class="col l7 m6 s6">
		<div class="row">
		  <div class="col s12">
			<div class="card-panel orange lighten-2 cardOne z-depth-2">
			  <div class="white blue-grey-text text-darken-4 card-inner-content">
				<h1 class="card-header">Visitors by Browser</h1>
					<?php $result = $gate->displayBrowserStatisticsTable(); ?>
			  </div>
			</div>
		  </div>

		  <div class="col s12">
			<div class="card-panel teal lighten-2 cardTwo z-depth-2">
			  <div class=" white blue-grey-text text-darken-4 card-inner-content" id="parent1">
				<h1 class="card-header">Visitors by Device Used</h1><br/>
				<?php $result3 = $gate2->displaySelect($result2); ?>
			  </div>
			</div>
		  </div>
        </div>
    </div>
          <div class="col l5 m6 s6">
				<div class="card-panel pink lighten-2 CardThree z-depth-2">
					<div class="white blue-grey-text text-darken-4 card-inner-content">
						<h1 class="card-header">Visitors by Continents</h1><br/>
						<!-- REMOVE: Make Dynamic Dropdown Trigger -->
						<a class="dropdown-button btn pink lighten-2" href="#" data-activates="dropdown-continents">Pick a Continent!</a>

						<!-- REMOVE: Make Dynamic Dropdown Structure -->
						<ul id="dropdown-continents" class="dropdown-content">
							<li><a href="#!" class="pink-text text-darken-1">America</a></li>
							<li><a href="#!" class="pink-text text-darken-1">Africa</a></li>
							<li><a href="#!" class="pink-text text-darken-1">Asia</a></li>
						</ul>

						<!-- REMOVE: Make this dynamic in JS -->
						<table class="striped highlight responsive-table table-hover-continents">
							<thead>
							<tr>
								<th data-field="id">Countries</th>
								<th data-field="name">Visitor Count</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>Mexico</td>
								<td class="pink-text text-darken-1 bold">7755</td>
							</tr>
							<tr>
								<td>Canada</td>
								<td class="pink-text text-darken-1 bold">17710</td>
							</tr>
							<tr>
								<td>USA</td>
								<td class="pink-text text-darken-1 bold">25990</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		  </div>
		</div>
	</div>
</body>
<script>
window.onload=function(){


document.querySelector('select').addEventListener("change", function() {
	
	var div = document.querySelector('#parent1');
	var toRemove = document.querySelector("p#p");
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
	var para = document.createElement("p");
	para.id = "p";
	para.className = "right"
	var node = document.createTextNode('Visits for ' + visitsArray[0] + ': ');
	var span = document.createElement("span")
	span.className = "teal-text text-darken-1 bold";
	span.innerHTML = visitsArray[1];
	para.appendChild(node);
	para.appendChild(span);
	
	var select = document.querySelector("Select");
	
	select.parentNode.insertBefore(para, select.nextSibling);
}

};	
</script>
</html>

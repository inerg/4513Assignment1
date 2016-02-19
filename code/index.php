<!DOCTYPE html>
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
					<!-- REMOVE: Make this dynamic in JS -->
					<table class="striped highlight responsive-table table-hover-browsers">
						<thead>
							<tr>
								<th data-field="id">Browsers</th>
								<th data-field="name">%</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>IE</td>
								<td class="orange-text text-darken-4 bold">75</td>
							</tr>
							<tr>
								<td>Firefox</td>
								<td class="orange-text text-darken-4 bold">110</td>
							</tr>
							<tr>
								<td>Chrome</td>
								<td class="orange-text text-darken-4 bold">250</td>
							</tr>
						</tbody>
					</table>
			  </div>
			</div>
		  </div>

		  <div class="col s12">
			<div class="card-panel teal lighten-2 cardTwo z-depth-2">
			  <div class=" white blue-grey-text text-darken-4 card-inner-content">
				<h1 class="card-header">Visitors by Device Used</h1><br/>
				<!-- REMOVE: Make Dynamic Dropdown Trigger -->
				<a class="dropdown-button btn teal lighten-2" href="#" data-activates="dropdown-brand-devices">Pick a Brand!</a>

				<!-- REMOVE: Make Dynamic Dropdown Structure -->
				<ul id="dropdown-brand-devices" class="dropdown-content">
					<li><a href="#!" class="teal-text text-darken-1">one</a></li>
					<li><a href="#!" class="teal-text text-darken-1">two</a></li>
					<li><a href="#!" class="teal-text text-darken-1">three</a></li>
				</ul>
				<p class="right">Visit Count: <span class="teal-text text-darken-1 bold">75</span></p>
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
</body>
</html>

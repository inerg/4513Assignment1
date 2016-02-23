<?php include 'lib/gateway_setup.php'; 
 include 'php/masterpages/header.php'; 
 include 'lib/helpers/serviceUtilities.inc.php'; ?>

<?php
session_start();

?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script src="jquery-1.12.0.min.js"></script>


<!-- Container: Main -->
<div class="container">
	<div class="row">
		<div class="col l6 m6 s12">
			<div class="row">
			  <div class="col s12">
				<div class="card-panel orange lighten-2 cardOne z-depth-2">
				  <div class="white blue-grey-text text-darken-4 card-inner-content">
					<div>
						<select  class="btn orange lighten-2 dropdown-button-widths" name="continent" onchange="handleMonthChangeRedraw(this.value, 'visitChart')">
							<option selected disabled>Select a Month</option>
							<option value="01">January</option>
							<option value="02">February</option>
							<option value="03">March</option>
							<option value="04">April</option>
							<option value="05">May</option>
							<option value="06">June</option>
							<option value="07">July</option>
							<option value="08">August</option>
							<option value="09">September</option>
							<option value="10">October</option>
							<option value="11">November</option>
							<option value="12">December</option>
						</select>
					</div>
					<div id="card1">
						
					</div>
				  </div>
				</div><!--/cardOne: Monthly Visits Chart -->
			  </div>
			  
			  <div class="col s12">
				<div class="card-panel teal lighten-2 cardTwo z-depth-2">
				  <div class=" white blue-grey-text text-darken-4 card-inner-content">
				  <div>
				  <select class="btn teal lighten-2 dropdown-button-widths" name="continent" onchange="handleMonthChangeRedraw(this.value, 'countryVisitChart')">
							<option selected disabled>Select a Month</option>
							<option value="01">January</option>
							<option value="02">February</option>
							<option value="03">March</option>
							<option value="04">April</option>
							<option value="05">May</option>
							<option value="06">June</option>
							<option value="07">July</option>
							<option value="08">August</option>
							<option value="09">September</option>
							<option value="10">October</option>
							<option value="11">November</option>
							<option value="12">December</option>
						</select></div>
				  <div id="parent1"></div>
				  </div>
				</div><!--/cardTwo: Geo Chart-->
			  </div>
			</div><!--/Main Row: Row 2-->
		</div><!--/Main Row: Column 1-->
	
		<div class="row">
			<div class="col l6 m6 s12">
				<div class="col s12">
					<div class="card-panel pink lighten-2 CardThree z-depth-2">
						<div class="white blue-grey-text text-darken-4 card-inner-content">
						
						<div id="c3d1">
							
							<select class="btn pink lighten-2 dropdown-button-widths" name="continent" onchange="HandleFinishedSelects()" id="selectToFill1">
								<option selected disabled>Select a country</option>
							</select>
							<select class="btn pink lighten-2 dropdown-button-widths" name="continent" onchange="HandleFinishedSelects()" id="selectToFill2">
								<option selected disabled>Select a country</option>
							</select>
							<select class="btn pink lighten-2 dropdown-button-widths" name="continent" onchange="HandleFinishedSelects()" id="selectToFill3">
								<option selected disabled>Select a country</option>
							</select>
							</div>
							<div>
							<button class="blue waves-effect waves-light btn" onclick="submitSelects()" id="loadButton">Chart It</button></div>
						<div id="card3"></div>
	

						</div>
					</div><!--/CardThree: Column Chart-->
				</div><!--/Row 2: Column 1: Column 1.A-->
			</div><!--/Row 2: Column 1-->
		</div><!--/Main Row: Row 2-->
	</div><!--/Main Row-->
</div><!--/Container-->	

<?php include 'php/masterpages/footer.php'; ?>


<script type="text/javascript" src="js/charts.js"></script>
<?php include 'lib/gateway_setup.php'; 
 include 'php/masterpages/header.php'; 
 include 'lib/helpers/serviceUtilities.inc.php'; ?>

<?php
session_start();

?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="jquery-1.12.0.min.js"></script>
<script type="text/javascript">


		

	//Draw the first chart (visits for month selected in drop-down list)
function outputSelectedMonthVisitsChart(JSONdata) { 
		  
	//Make a table for the data
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'A');
	data.addColumn('number', 'Daily Visits');
	
	for(var index=1; index < JSONdata.length; index++) //For each day of the month, add a row to the table with appropriate data
	{
		var name = index.toString();
		var num = parseInt(JSONdata[index-1].count);

		var rowData = [[name, num]]; //create a row			
		data.addRows(rowData); //add in the row
	}
		
	var options = {
		title:"Visits for Selected Month:", //Change later 
		height:400,
		hAxis: {title: 'Day'}
		};

						
	//Take the data table and make it a google chart, and then draw the chart to screen
	var chart = new google.visualization.AreaChart(document.getElementById('card1'));
	chart.draw(data, options); 
}




// Function for setting up and drawing the geographic chart with site visits
function outputGeoVisitsChart() {
  
		
	var data2 = google.visualization.arrayToDataTable(
	[['Country', 'Popularity'],
	['empty', 10]]); //Initial addition to the table because google charts doesn't work if you don't give
					 //it a first set of values.
		

	
	var rowData2 = [['Canada', 2050]];
	var rowData3 = [['Russia', 4000]];
			data2.addRows(rowData2);
			data2.addRows(rowData3);
			
	
	var options = {
		height:500
	};

	//Create google geochart from table, then draw it.
	var chart = new google.visualization.GeoChart(document.getElementById('parent1'));
	chart.draw(data2, options);		
}




function drawGroupedColumnChart() {
	    	    
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'A');
	data.addColumn('number', 'Jan');  
	data.addColumn('number', 'May');
	data.addColumn('number', 'Sept');

	data.addRows([
		['China', 1000, 1100, 630],
		['France', 390, 430, 1300],
		['Spain', 190, 222, 360],
	]);
	 

      var options = {
		title: 'Site Visits 2016',
		hAxis: {title: 'Country'},
        height:400,
        focusTarget: 'category', 
      };     

	  
	var chart = new google.visualization.ColumnChart(document.getElementById('card3'));
    chart.draw(data, options);	  
}




function handleMonthChangeRedraw(value) {
		
	$.getJSON('lib/serviceVisits.php?month=-'+value+'-',
        function(data) {
				//console.log(data);
			outputSelectedMonthVisitsChart(data);
        });
}
	
	
	
	
	
	
	//Call the outputSelectedMonthVisitsChart chart, using January as its initial value
	$.getJSON('lib/serviceVisits.php?month=-01-',
        function(data) {			
			google.load('visualization', "1", {'packages':['corechart']});			
			google.setOnLoadCallback(outputSelectedMonthVisitsChart(data));
        });
		
	

	//Call the outputGeoVisitsChart chart
	google.load("visualization", "1", {packages:["geochart"]});
	google.setOnLoadCallback(outputGeoVisitsChart);

	

	//Call the drawGroupedColumnChart chart
	google.load('visualization', '1', {packages: ['corechart', 'bar']});
	google.setOnLoadCallback(drawGroupedColumnChart);	
	
	
</script>



<!-- Container: Main -->
<div class="container">
	<div class="row">
		<div class="col l7 m6 s12">
			<div class="row">
			  <div class="col s12">
				<div class="card-panel orange lighten-2 cardOne z-depth-2">
				  <div class="white blue-grey-text text-darken-4 card-inner-content">
					<div>
						<select  class="btn pink lighten-2 dropdown-button-widths" name="continent" onchange="handleMonthChangeRedraw(this.value)">
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
				  <div id="parent1">
				  </div>
				  <div></div>
				  </div>
				</div><!--/cardTwo: Geo Chart-->
			  </div>
			</div><!--/Main Row: Row 2-->
		</div><!--/Main Row: Column 1-->
	
		<div class="row">
			<div class="col l5 m6 s12">
				<div class="col s12">
					<div class="card-panel pink lighten-2 CardThree z-depth-2">
						<div class="white blue-grey-text text-darken-4 card-inner-content" id="card3">
	

						</div>
					</div><!--/CardThree: Column Chart-->
				</div><!--/Row 2: Column 1: Column 1.A-->
			</div><!--/Row 2: Column 1-->
		</div><!--/Main Row: Row 2-->
	</div><!--/Main Row-->
</div><!--/Container-->	

<?php include 'php/masterpages/footer.php'; ?>
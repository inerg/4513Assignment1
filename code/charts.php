<?php include 'lib/gateway_setup.php'; ?>
<?php include 'php/masterpages/header.php'; ?>

<?php
session_start();

?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">

	//Draw the first chart (visits for month selected in drop-down list)
function outputSelectedMonthVisitsChart() { 
		  
	//Make a table for the data
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'A');
	data.addColumn('number', 'Daily Visits');
	
	for(index=1; index < 31; index++) //For each day of the month, add a row to the table with appropraite data
	{
		var name = index.toString();
		var num = Math.floor((Math.random() * 40) + 1); //change later. Random values for now
			
		var rowData = [[name, num]]; //create a row
			
		data.addRows(rowData); //add in the row
	}
		
	var options = {
		title:"<Insert month here> visits", //Change later 
		height:400,
		hAxis: {title: 'Day'}
		};

						
	//Take the data table and make it a google chart, and then draw the chart to screen
	var chart = new google.visualization.AreaChart(document.getElementById('test'));
	chart.draw(data, options); 
}

	
	//Call the outputSelectedMonthVisitsChart chart	
	google.load('visualization', "1", {'packages':['corechart']});			
	google.setOnLoadCallback(outputSelectedMonthVisitsChart);

    </script>



<!-- Container: Main -->
<div class="container">
	<div class="row">
		<div class="col l7 m6 s12">
			<div class="row">
			  <div class="col s12">
				<div class="card-panel orange lighten-2 cardOne z-depth-2">
				  <div class="white blue-grey-text text-darken-4 card-inner-content" id="test">
					
				  </div>
				</div><!--/cardOne: Monthly Visits Chart-->
			  </div>

			  <div class="col s12">
				<div class="card-panel teal lighten-2 cardTwo z-depth-2">
				  <div class="white blue-grey-text text-darken-4 card-inner-content" id="parent1">
                      <h1 class="card-header">Card 2</h1><br/>
                      <div class="row">
                          <div class="col s11">
                              
                        
                          </div>
                      </div>
				  </div>
				</div><!--/cardTwo: Geo Chart-->
			  </div>
			</div><!--/Main Row: Row 2-->
		</div><!--/Main Row: Column 1-->
	
		<div class="row">
			<div class="col l5 m6 s12">
				<div class="col s12">
					<div class="card-panel pink lighten-2 CardThree z-depth-2">
						<div class="white blue-grey-text text-darken-4 card-inner-content">
							<h1 class="card-header">Card 3</h1><br/>
                            
	
						</div>
					</div><!--/CardThree: Column Chart-->
				</div><!--/Row 2: Column 1: Column 1.A-->
			</div><!--/Row 2: Column 1-->
		</div><!--/Main Row: Row 2-->
	</div><!--/Main Row-->
</div><!--/Container-->	

<?php include 'php/masterpages/footer.php'; ?>
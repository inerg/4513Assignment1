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
function outputGeoVisitsChart(JSONdata) {
  
	var data2 = google.visualization.arrayToDataTable(
	[['Country', 'Popularity'],
	['empty', 10]]); //Initial addition to the table because google charts doesn't work if you don't give
					 //it a first set of values.
		
	for (i = 0; i < JSONdata.length; i++) { 		
		var cName = JSONdata[i].CountryName;
		var cNum = parseInt(JSONdata[i].count);
		
		var row = [[cName, cNum]];
		if(cNum >= 5){
			data2.addRows(row);
		}
	}	
			
	
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




function handleMonthChangeRedraw(value, chartType) {
	
	if(chartType == "visitChart")
	{
		$.getJSON('lib/serviceVisits.php?custom=-'+value+'-&select=COUNT(*) AS count&groupBy=visit_date',
        function(data) {
			outputSelectedMonthVisitsChart(data);
        });
	}
	if(chartType == "countryVisitChart") {
		$.getJSON('lib/serviceVisits.php?custom=-'+value+'-&select=CountryName,COUNT(id)%20AS%20count&join=countries%20ON%20visits.country_code=countries.ISO&groupBy=country_code&having=COUNT(country_code)>=10',
        function(data) {
			outputGeoVisitsChart(data);
        });
	}	
}

var counter = 0;
var done1 = false;
var done2 = false;
var done3 = false;
function HandleFinishedSelects()
{
    if(document.getElementById("selectToFill1").value != "Select a country" && done1 == false)
	{	
		counter = counter+1;
		done1 = true;		
	}
	if(document.getElementById("selectToFill2").value!="Select a country" && done2 == false)
	{	
		counter = counter+1;
		done2 = true;
	}
	if(document.getElementById("selectToFill3").value!="Select a country" && done3 == false)
	{	
		counter = counter+1;
		done3 = true;
	}
	
	if(counter == 3) {
		document.getElementById("loadButton").disabled = false;		
	}
}
	
	
	function outputColSelect(JSONdata) {
		document.getElementById("loadButton").disabled = true;
		
		
		var div1 = document.getElementById('selectToFill1');
		var div2 = document.getElementById('selectToFill2');
		var div3 = document.getElementById('selectToFill3');
		console.log(JSONdata);
		
		for(var i = 0; i < JSONdata.length; i++) {
			var option1 = document.createElement("option");
			var option2 = document.createElement("option");
			var option3 = document.createElement("option");
			option1.innerHTML = JSONdata[i].CountryName;
			option2.innerHTML = JSONdata[i].CountryName;
			option3.innerHTML = JSONdata[i].CountryName;
			option1.value = JSONdata[i].ISO;
			option2.value = JSONdata[i].ISO;
			option3.value = JSONdata[i].ISO;
			div1.appendChild(option1);
			div2.appendChild(option2);
			div3.appendChild(option3);
		}
	}
	
	function submitSelects(){
		
		var select1 = document.getElementById("selectToFill1");
		var select2 = document.getElementById("selectToFill2");
		var select3 = document.getElementById("selectToFill3");
		
		console.log(select1.value);	
		
		//Call for chart data () 
	$.getJSON('lib/serviceVisits.php?custom=-01-&select=CountryName,COUNT(id)%20AS%20count&join=countries%20ON%20visits.country_code=countries.ISO&groupBy=country_code&having=COUNT(country_code)>=10',
        function(data) {
			drawGroupedColumnChart(data);
        });
	}

	
	
	
	//Grabs data necessary for output of Column selects
	$.getJSON('lib/serviceVisits.php?custom=%&select=COUNT(CountryName)%20AS%20count,CountryName,country_code,ISO&join=countries%20ON%20visits.country_code=countries.ISO&groupBy=CountryName%20order%20by%20count%20desc%20limit%2010',
        function(data) {
			outputColSelect(data);
        });
	

	//Call the outputSelectedMonthVisitsChart chart, using January as its initial value
	$.getJSON('lib/serviceVisits.php?custom=-01-&select=COUNT(*) AS count&groupBy=visit_date',
        function(data) {		
			google.load('visualization', "1", {'packages':['corechart']});			
			google.setOnLoadCallback(outputSelectedMonthVisitsChart(data));
        });
		
	////Call the outputGeoVisitsChart chart, using January as its initial value	
	$.getJSON('lib/serviceVisits.php?custom=-01-&select=CountryName,COUNT(id)%20AS%20count&join=countries%20ON%20visits.country_code=countries.ISO&groupBy=country_code&having=COUNT(country_code)>=10',
        function(data) {
			outputGeoVisitsChart(data);
        });
	//Call for column chart select content 
	$.getJSON('lib/serviceVisits.php?custom=-01-&select=CountryName,COUNT(id)%20AS%20count&join=countries%20ON%20visits.country_code=countries.ISO&groupBy=country_code&having=COUNT(country_code)>=10',
        function(data) {
			outputGeoVisitsChart(data);
        });

	//Call the outputGeoVisitsChart chart
	google.load("visualization", "1", {packages:["geochart"]});
	google.setOnLoadCallback(outputGeoVisitsChart);

	

	//Call the drawGroupedColumnChart chart
	google.load('visualization', '1', {packages: ['corechart', 'bar']});
	google.setOnLoadCallback(drawGroupedColumnChart);	
	
	//colOutputSelect();
	

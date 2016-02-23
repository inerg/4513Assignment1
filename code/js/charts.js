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
	
	document.getElementById('spinner2').style.visibility = "hidden";
}



// Function for setting up and drawing the geographic chart with site visits
function outputGeoVisitsChart(JSONdata) {
  
	var data2 = google.visualization.arrayToDataTable(
	[['Country', 'Popularity'],
	['empty', 10]]); //Initial addition to the table because google charts doesn't work if you don't give
					 //it a first set of values.
		
	for (i = 0; i < JSONdata.length; i++) { //for each item of JSONdata, create a row 		
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

	document.getElementById('spinner').style.visibility = "hidden";
}



var switchHolder = 0;
function drawGroupedColumnChart(C1M1,C1M2,C1M3,C2M1,C2M2,C2M3,C3M1,C3M2,C3M3,switchBool) {

	if(switchBool == true)//if switch clicked
	{
		if(switchHolder == 0) {switchHolder=1;}//Switch functionality
		else if(switchHolder == 1) {switchHolder=0;}
	}



	console.log(switchHolder);
	var monthArr = ["Jan", "May", "Sept"];
    
	var data = new google.visualization.DataTable();
	
	if(switchHolder == 1) //Group Columns By Country
	{
		data.addColumn('string', 'A');
		data.addColumn('number', monthArr[0]);  
		data.addColumn('number', monthArr[1]);
		data.addColumn('number', monthArr[2]);
	}
	if(switchHolder == 0) //Group Columns By Month
	{
		data.addColumn('string', 'A');
		data.addColumn('number', C1M1[0].CountryName);  
		data.addColumn('number', C2M1[0].CountryName);
		data.addColumn('number', C3M1[0].CountryName);
	}
	
	if(switchHolder == 0) //Group Columns By Month
	{
		data.addRows([
			[monthArr[0], parseInt(C1M1[0].count), parseInt(C2M1[0].count), parseInt(C3M1[0].count)],
			[monthArr[1], parseInt(C1M2[0].count), parseInt(C2M2[0].count), parseInt(C3M2[0].count)],
			[monthArr[2], parseInt(C1M3[0].count), parseInt(C2M3[0].count), parseInt(C3M3[0].count)],
			
		]);
	}
	if(switchHolder == 1) //Group Columns By Country
	{
		data.addRows([
			[C1M1[0].CountryName, parseInt(C1M1[0].count), parseInt(C1M2[0].count), parseInt(C1M3[0].count)],
			[C2M1[0].CountryName, parseInt(C2M1[0].count), parseInt(C2M2[0].count), parseInt(C2M3[0].count)],
			[C3M1[0].CountryName, parseInt(C3M1[0].count), parseInt(C3M2[0].count), parseInt(C3M3[0].count)],
			
		]);
	}
	
	if(switchHolder == 0) {var hAx = {title: 'Month'};}
	if(switchHolder == 1) {var hAx = {title: 'Country'};}
	
	 
	var options = {
		title: 'Site Visits 2016',
		hAxis: hAx,
        height:400,
        focusTarget: 'category', 
      };     

	  
	var chart = new google.visualization.ColumnChart(document.getElementById('card3'));
    chart.draw(data, options);	  


	document.querySelector("#hide").style.visibility = 'visible';
}




function handleMonthChangeRedraw(value, chartType) {
	
	if(chartType == "visitChart")//if visits chart, redraw visits chart
	{
		$.getJSON('lib/serviceVisits.php?custom=-'+value+'-&select=COUNT(*) AS count&groupBy=visit_date',
        function(data) {
			outputSelectedMonthVisitsChart(data);
        });
	}
	if(chartType == "countryVisitChart") {//if geo chart, redraw country geo chart
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
	//This function keeps track of how many selects are completed
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
		
		document.getElementById("loadButton").disabled = true; //disable chart it button for now
		
		
		var div1 = document.getElementById('selectToFill1');
		var div2 = document.getElementById('selectToFill2');
		var div3 = document.getElementById('selectToFill3');

		
		for(var i = 0; i < JSONdata.length; i++) {//for each returned object, create an option in each select
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
	

	function submitSelectsAndDrawChart(switchBool){
		
		var select1val = document.getElementById("selectToFill1").value;
		var select2val = document.getElementById("selectToFill2").value;
		var select3val = document.getElementById("selectToFill3").value;	
		
		//Make ajax requests needed for column chart and store them as JSON
		var C1M1 = $.ajax({
			type: "GET",
			url: 'lib/serviceVisits.php?custom=-01-&select=CountryName,COUNT(id)%20AS%20count&join=countries%20ON%20visits.country_code=countries.ISO&and=AND%20country_code%3d%27'+select1val+'%27',
			async: false
		});
		C1M1 = C1M1.responseJSON;
		var C1M2 = $.ajax({
			type: "GET",
			url: 'lib/serviceVisits.php?custom=-05-&select=CountryName,COUNT(id)%20AS%20count&join=countries%20ON%20visits.country_code=countries.ISO&and=AND%20country_code%3d%27'+select1val+'%27',
			async: false
		});
		C1M2 = C1M2.responseJSON;
		var C1M3 = $.ajax({
			type: "GET",
			url: 'lib/serviceVisits.php?custom=-09-&select=CountryName,COUNT(id)%20AS%20count&join=countries%20ON%20visits.country_code=countries.ISO&and=AND%20country_code%3d%27'+select1val+'%27',
			async: false
		});
		C1M3 = C1M3.responseJSON;
		var C2M1 = $.ajax({
			type: "GET",
			url: 'lib/serviceVisits.php?custom=-01-&select=CountryName,COUNT(id)%20AS%20count&join=countries%20ON%20visits.country_code=countries.ISO&and=AND%20country_code%3d%27'+select2val+'%27',
			async: false
		});
		C2M1 = C2M1.responseJSON;
		var C2M2 = $.ajax({
			type: "GET",
			url: 'lib/serviceVisits.php?custom=-05-&select=CountryName,COUNT(id)%20AS%20count&join=countries%20ON%20visits.country_code=countries.ISO&and=AND%20country_code%3d%27'+select2val+'%27',
			async: false
		});
		C2M2 = C2M2.responseJSON;
		var C2M3 = $.ajax({
			type: "GET",
			url: 'lib/serviceVisits.php?custom=-09-&select=CountryName,COUNT(id)%20AS%20count&join=countries%20ON%20visits.country_code=countries.ISO&and=AND%20country_code%3d%27'+select2val+'%27',
			async: false
		});
		C2M3 = C2M3.responseJSON;
		var C3M1 = $.ajax({
			type: "GET",
			url: 'lib/serviceVisits.php?custom=-01-&select=CountryName,COUNT(id)%20AS%20count&join=countries%20ON%20visits.country_code=countries.ISO&and=AND%20country_code%3d%27'+select3val+'%27',
			async: false
		});
		C3M1 = C3M1.responseJSON;
		var C3M2 = $.ajax({
			type: "GET",
			url: 'lib/serviceVisits.php?custom=-05-&select=CountryName,COUNT(id)%20AS%20count&join=countries%20ON%20visits.country_code=countries.ISO&and=AND%20country_code%3d%27'+select3val+'%27',
			async: false
		});
		C3M2 = C3M2.responseJSON;
		var C3M3 = $.ajax({
			type: "GET",
			url: 'lib/serviceVisits.php?custom=-09-&select=CountryName,COUNT(id)%20AS%20count&join=countries%20ON%20visits.country_code=countries.ISO&and=AND%20country_code%3d%27'+select3val+'%27',
			async: false
		});
		C3M3 = C3M3.responseJSON;

		//draw column chart using above values
		drawGroupedColumnChart(C1M1,C1M2,C1M3,C2M1,C2M2,C2M3,C3M1,C3M2,C3M3,switchBool);	
	}

	//on window load, hide switch axis button for now
	window.onload = function () { document.querySelector("#hide").style.visibility = 'hidden'; }
	
	
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
	
	

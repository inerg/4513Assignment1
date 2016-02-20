<?php include 'php/other/gateway_setup.php'; ?>
<?php include 'php/masterpages/header.php'; ?>
<?php
$continent = null;
$brand = null;
    if(isset($_GET['continent']))
    {
        $continent = $_GET['continent'];
    }

?>
<!-- Container: Main -->
<div class="container">
	<div class="row">
		<div class="col l7 m6 s12">
			<div class="row">
			  <div class="col s12">
				<div class="card-panel orange lighten-2 cardOne z-depth-2">
				  <div class="white blue-grey-text text-darken-4 card-inner-content">
					<h1 class="card-header">Visitors by Browser</h1>
						<?php $result = $gate->displayBrowserStatisticsTable(); ?>
				  </div>
				</div><!--/cardOne: Browsers -->
			  </div>

			  <div class="col s12">
				<div class="card-panel teal lighten-2 cardTwo z-depth-2">
				  <div class=" white blue-grey-text text-darken-4 card-inner-content" id="parent1">
					<h1 class="card-header">Visitors by Device Used</h1><br/>
					<?php $result3 = $gate2->displaySelect($result2); ?>
				  </div>
				</div><!--/cardTwo: Device Brands-->
			  </div>
			</div><!--/Main Row: Row 2-->
		</div><!--/Main Row: Column 1-->
	
		<div class="row">
			<div class="col l5 m6 s12">
				<div class="col s12">
					<div class="card-panel pink lighten-2 CardThree z-depth-2">
						<div class="white blue-grey-text text-darken-4 card-inner-content">
							<h1 class="card-header">Visitors by Continents</h1><br/>
							<!-- REMOVE: Make Dynamic Dropdown Trigger -->
							<a class="dropdown-button btn pink lighten-2" href="#" data-activates="dropdown-continents">Pick a Continent!</a>

							<!-- REMOVE: Make Dynamic Dropdown Structure -->
<!--							<ul id="dropdown-continents" class="dropdown-content">-->
                            <form action="index.php" method="get" id="continentSelect">
                                <select  class="btn teal lighten-2 brand-button" name="continent" onchange="continentChange()">'

                                    <?php
                                        if($continent == null) {
                                            echo '<option class="placeholder" selected disabled value="">Pick a Brand!</option>';
                                            } else {
                                            echo '<option class="placeholder" disabled value="">Pick a Brand!</option>';
                                        }
                                        $continents = $continentGate->getContinentNames();
                                        foreach($continents as $continent)
                                        {
                                            if($continent == $continent['ContinentCode']){
                                                echo '<option value="' . $continent['ContinentCode'] . '" selected>' . $continent['ContinentName'] . '</option>';
                                            } else {
                                                echo '<option value="' . $continent['ContinentCode'] . '">' . $continent['ContinentName'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </form>
<!--							</ul>-->

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
					</div><!--/CardThree: Continents-->
				</div><!--/Row 2: Column 1: Column 1.A-->
			</div><!--/Row 2: Column 1-->
		</div><!--/Main Row: Row 2-->
	</div><!--/Main Row-->
</div><!--/Container-->	

<?php include 'php/masterpages/footer.php'; ?>

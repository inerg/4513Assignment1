<?php include 'lib/gateway_setup.php'; ?>
<?php include 'php/masterpages/header.php'; ?>

<!-- Container: Main -->
<div class="container">
	<div class="row">
		<div class="col l7 m6 s12">
			<div class="row">
			  <div class="col s12">
				<div class="card-panel orange lighten-2 cardOne z-depth-2">
				  <div class="white blue-grey-text text-darken-4 card-inner-content">
					<h1 class="card-header">Visitors by Browser</h1>
						<?php $browserGate->displayBrowserStatisticsTable(); ?>
				  </div>
				</div><!--/cardOne: Browsers -->
			  </div>

			  <div class="col s12">
				<div class="card-panel teal lighten-2 cardTwo z-depth-2">
				  <div class=" white blue-grey-text text-darken-4 card-inner-content" id="parent1">
					<h1 class="card-header">Visitors by Device Used</h1><br/>
					<?php $deviceBrandGate->displaySelect($allDeviceBrands); ?>
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
<!--							<a class="dropdown-button btn pink lighten-2" href="#" data-activates="dropdown-continents">Pick a Continent!</a>-->

							<!-- REMOVE: Make Dynamic Dropdown Structure -->
<!--							<ul id="dropdown-continents" class="dropdown-content">-->
                            <form action="index.php" method="get" id="continentSelect" target="_self">
                                <div class="input-field col s7">
                                    <select  class="btn pink lighten-2 dropdown-button-widths" name="continent" onchange="formChange(continentSelect)">

                                        <?php
                                            $continentGate->printContinentDropdown(trim($_GET['continent']));
                                        ?>

                                    </select>
                                </div>
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
                                <?php
								if(ISSET($_GET['continent']))
								{
                                    $continentGate->printVisitList($_GET['continent']);
                                }
								?>
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

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
				  <div class="white blue-grey-text text-darken-4 card-inner-content" id="parent1">
                      <h1 class="card-header">Visitors by Device Used</h1><br/>
                      <div class="row">
                          <div class="col s11">
                              <form action="index.php" method="get" id="brandSelect" target="_self">
                                  <div class="input-field col s4">
                                      <select  class="btn teal lighten-2 dropdown-button-widths" name="brand" onchange="formChange('brandSelect')">
                                      <?php
                                        $deviceBrandGate->printBrandDropdown(trim($_GET['brand']));
                                      ?>
                                      </select>
                                  </div>
                              </form>
                              <?php
                                if(ISSET($_GET['brand']))
								{
									$deviceBrandGate->printBrandVists(trim($_GET['brand']));
								}
							  ?>
                          </div>
                      </div>
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
                            <form action="index.php" method="get" id="continentSelect" target="_self">
                                <div class="input-field col s7">
                                    <select  class="btn pink lighten-2 dropdown-button-widths" name="continent" onchange="formChange('continentSelect')">

                                        <?php
                                            $continentGate->printContinentDropdown(trim($_GET['continent']));

										$sql = 'SELECT	visit_date,
 														visit_time,
 														ip_address,
 														CountryName,
 														b.name AS BrowserName,
 														r.name AS ReferrerName,
 														os.name AS OSName,
 														dt.name AS DTName
 														FROM visits v
 														INNER JOIN countries c ON c.ISO = v.country_code
 														INNER JOIN browsers b ON b.ID = v.browser_id
 														INNER JOIN referrers r ON r.id = v.referrer_id
 														INNER JOIN operating_systems os ON os.ID = v.os_id
 														INNER JOIN device_types dt ON dt.ID = v.device_type_id  LIMIT 100;

'
                                        ?>

                                    </select>
                                </div>
                            </form>
							<table class="striped highlight responsive-table table-hover-continents">

                                <?php
								if(ISSET($_GET['continent']))
								{
                                    $continentGate->printVisitList($_GET['continent']);
                                }
								?>

							</table>
						</div>
					</div><!--/CardThree: Continents-->
				</div><!--/Row 2: Column 1: Column 1.A-->
			</div><!--/Row 2: Column 1-->
		</div><!--/Main Row: Row 2-->
	</div><!--/Main Row-->
</div><!--/Container-->	

<?php include 'php/masterpages/footer.php'; ?>

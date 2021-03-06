<?php include 'php/masterpages/header.php'; ?>
<?php include 'lib/gateway_setup.php'; ?>

<script type="text/javascript" src="js/visit-browser.js"></script>

<!-- Container: Main -->
<div class="container" xmlns="http://www.w3.org/1999/html">
	<div class="row">
        <div class="col s12">
            <div class="card-panel orange lighten-2 z-depth-1">
                <h1 class="card-header center card-title">Visit Browser</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s4">
            <div class="card-panel teal lighten-2 z-depth-2">
                <div class="white blue-grey-text text-darken-4 card-inner-content">
                    <h2 class="card-header center">Filters</h2>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" placeholder="Enter Country" autofocus class="awesomplete change" list="countryList" id="country">
                            <?php
                                $countryGate->printCountryOptions();
                            ?>
                        </div>
                    </div>
                    <?php
                    echo '<div class="row">';
                        $deviceBrandGate->printBrandDropdown();
                    echo '</div>';
                    echo '<div class="row">';
                        $deviceTypes->printDeviceTypeDropdown();
                    echo '</div>';
                    echo '<div class="row">';
                        $actualBrowserGate->printBrowserDropdown();
                    echo '</div>';
                    echo '<div class="row">';
                        $referrerGate->printReferrerDropdown();
                    echo '</div>';
                    echo '<div class="row">';
                        $osGate->printOSDropdown();
                    echo '</div>';
                    ?>
                    <a class="waves-effect waves-light btn" id="submit">Submit</a>
                </div>
            </div>
        </div>
        <div class="col s8">
            <div class="card-panel pink lighten-2 z-depth-2">
                <div class="white blue-grey-text text-darken-4 card-inner-content" id="VisitInfo">
                    <h2 class="card-header center">Data</h2>

                </div>
            </div>
        </div>
    </div>
</div><!--/Container-->

<?php include 'php/masterpages/footer.php'; ?>



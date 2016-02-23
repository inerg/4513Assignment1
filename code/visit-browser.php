<?php include 'php/masterpages/header.php'; ?>
<?php include 'lib/gateway_setup.php'; ?>

<!-- Container: Main -->
<div class="container" xmlns="http://www.w3.org/1999/html">
    <div class="row">
        <div class="col s12">
            <div class="card-panel yellow lighten-2 z-depth-1">
                <div class="white blue-grey-text text-darken-4 card-inner-content">
                    <br/><h1 class="card-header center">Visit Browser</h1><br/>


                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s4">
            <div class="card-panel blue lighten-2 z-depth-2">
                <div class="white blue-grey-text text-darken-4 card-inner-content">
                    <h2 class="card-header center">Filters</h2>
                    <div class="row">
                        <div class="input-field" col s3">
                            <input type="text" id="country">
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
                    ?>
                    <a class="waves-effect waves-light btn">Submit</a>
                </div>
            </div>
        </div>
        <div class="col s8">
            <div class="card-panel green lighten-2 z-depth-2">
                <div class="white blue-grey-text text-darken-4 card-inner-content">
                    <h2 class="card-header center">Data</h2>
                </div>
            </div>
        </div>
    </div>
</div><!--/Container-->

<?php include 'php/masterpages/footer.php'; ?>



<?php
include("header.php");
$chart1 = unserialize(base64_decode($_REQUEST['chart1']));
$chart2 = unserialize(base64_decode($_REQUEST['chart2']));
?>

<div class="container-fluid topMargin">
    <?php include("chartView.php"); ?>
    <br /><br />
    <div class="card">
        <div class="card-body">
            <h4 class="card-title pb-3">Report Generator</h4>

            <div class="card">
                <div class="card-body">
                    <form id="reportGen" method="post" action="..\controllers\reportController.php?req=reportGen">
                        <input type="hidden" name="id" id="id" value="1">
                        <h5 class="pb-3">Sales Summary</h5>
                        <label class="form-label">Time Period</label>
                        <div class="row pb-3">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <label class="form-label">Start:</label>
                                <input type="date" class="form-control" name="start" id="start" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">End:</label>
                                <input type="date" class="form-control" name="end" id="end" required>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Generate!</a>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form id="reportGen" method="post" action="..\controllers\reportController.php?req=reportGen">
                        <input type="hidden" name="id" id="id" value="2">
                        <h5 class="pb-3">Most Selling Products</h5>
                        <label class="form-label">Time Period:</label>
                        <div class="row pb-3">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <label class="form-label">Start:</label>
                                <input type="date" class="form-control" name="start" id="start" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">End:</label>
                                <input type="date" class="form-control" name="end" id="end" required>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Generate!</a>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form id="reportGen" method="post" action="..\controllers\reportController.php?req=reportGen">
                        <input type="hidden" name="id" id="id" value="3">
                        <h5 class="pb-3">Stock Movement</h5>
                        <label class="form-label">Time Period</label>
                        <div class="row pb-3">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <label class="form-label">Start:</label>
                                <input type="date" class="form-control" name="start" id="start" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">End:</label>
                                <input type="date" class="form-control" name="end" id="end" required>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Generate!</a>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form id="reportGen" method="post" action="..\controllers\reportController.php?req=reportGen">
                        <input type="hidden" name="id" id="id" value="4">
                        <h5 class="pb-3">Customer Performance</h5>
                        <label class="form-label">Time Period:</label>
                        <div class="row pb-3">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <label class="form-label">Start:</label>
                                <input type="date" class="form-control" name="start" id="start" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">End:</label>
                                <input type="date" class="form-control" name="end" id="end" required>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Generate!</a>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form id="reportGen" method="post" action="..\controllers\reportController.php?req=reportGen">
                        <input type="hidden" name="id" id="id" value="5">
                        <h5 class="pb-3">Profit & Loss</h5>
                        <label class="form-label">Time Period:</label>
                        <div class="row pb-3">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <label class="form-label">Start:</label>
                                <input type="date" class="form-control" name="start" id="start" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">End:</label>
                                <input type="date" class="form-control" name="end" id="end" required>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Generate!</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
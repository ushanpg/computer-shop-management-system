<?php
include("header.php");
if (isset($_REQUEST['data'])) {
    $delivery = unserialize(base64_decode($_REQUEST['data']));
}
?>

<div class="container topMargin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-5">Delivery Tracker</h4>
            <form id="trackDelivery" action="../controllers/deliveryController.php?req=trackDelivery" method="post">
                <div class="row">
                    <div class="row mb-3">
                        <div class="col-md-2"></div>
                        <div class="col-md-2" align="right">
                            <label class="form-label">Order ID:</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="order_id" class="form-control" id="order_id" required pattern="[0-9]{1,50}">
                            <p class="form-text">Ex: 1714294835</p>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary">Track!</button>
                        </div>
                    </div>
                    <hr>
                    <?php if (isset($delivery)) { ?>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-2" align="left">
                                <label class="form-label">Order ID:</label>
                            </div>
                            <div class="col-md-3">
                                <span style="font-weight:bold"><?php echo ($delivery['order_id']) ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-2" align="left">
                                <label class="form-label">Cust. Name:</label>
                            </div>
                            <div class="col-md-3">
                                <span><?php echo (ucwords($delivery['first_name'] . " " . $delivery['last_name'])) ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-2" align="left">
                                <label class="form-label">Cust. Address:</label>
                            </div>
                            <div class="col-md-3">
                                <span><?php echo (ucwords($delivery['address'] . ", " . $delivery['city'] . ".")) ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-2" align="left">
                                <label class="form-label">Status:</label>
                            </div>
                            <div class="col-md-3">
                                <span style="color:red; font-weight:bold"><?php echo ($delivery['status']) ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-2" align="left">
                                <label class="form-label">Pay With:</label>
                            </div>
                            <div class="col-md-3">
                                <span style="color:green; font-weight:bold"><?php echo (strtoupper($delivery['pay_with'])) ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-2" align="left">
                                <label class="form-label">Date Added:</label>
                            </div>
                            <div class="col-md-3">
                                <span><?php echo ($delivery['added_at']) ?></span>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>
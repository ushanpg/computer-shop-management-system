<?php
include("header.php");
?>

<div class="container topMargin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-5">Delivery Updater</h4>
            <form id="updateStatus" action="../controllers/deliveryController.php?req=updateStatus" method="post">
                <div class="row">
                    <div class="row">
                        <div class="col-md-2" align="right">
                            <label class="form-label">Order ID:</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="order_id" class="form-control" id="order_id" required pattern="[0-9]{1,50}">
                            <p class="form-text">Ex: 1714301212</p>
                        </div>
                        <div class="col-md-1" align="right">
                            <label class="form-label">Status:</label>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" id="status" name="status">
                                <option value="TBC">TBC</option>
                                <option value="Cancelled">Cancelled</option>
                                <option value="Queue">Queue</option>
                                <option value="Shipped">Shipped</option>
                                <option value="Delivered">Delivered</option>
                                <option value="Returned">Returned</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <label class="form-label" align="center">Choose relevant status for the delivery at given time.</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3 mb-1">Update!</button>
            </form>
        </div>
    </div>
</div>
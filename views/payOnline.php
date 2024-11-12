<?php
include("header.php");
$data = unserialize(base64_decode($_REQUEST['data']));
?>

<div class="container topMargin mb-5">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Confirm Information...</h4>
            <form method="post" action="https://sandbox.payhere.lk/pay/checkout">
                <input type="hidden" name="merchant_id" value="<?php echo ($data['merchant_id']) ?>"> <!-- Replace your Merchant ID -->
                <input type="hidden" name="return_url" value="http://localhost:8000/controllers/checkoutController.php?req=return">
                <input type="hidden" name="cancel_url" value="http://localhost:8000/controllers/checkoutController.php?req=cancel">
                <input type="hidden" name="notify_url" value="http://localhost:8000/controllers/checkoutController.php?req=notify">
                </br>Item Details:</br>
                <input type="text" name="order_id" value="<?php echo ($data['order_id']) ?>" readonly>
                <input type="text" name="items" value="<?php echo ($data['items']) ?>" readonly>
                <input type="text" name="currency" value="<?php echo ($data['currency']) ?>" readonly>
                <input type="text" name="amount" value="<?php echo ($data['amount']) ?>" readonly>
                </br></br></br>

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label class="form-label">First Name:</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo ($data['first_name']) ?>" readonly pattern="[A-Za-z.\s]{1,50}">
                    </div>
                    <p class="form-text">Ex: John</p>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label class="form-label">Last Name:</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo ($data['last_name']) ?>" readonly pattern="[A-Za-z.\s]{1,50}">
                    </div>
                    <p class="form-text">Ex: Fernando</p>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label class="form-label">Address:</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="address" id="address" class="form-control" value="<?php echo ($data['address']) ?>" readonly pattern="[A-Za-z0-9,.\s]{3,50}">
                    </div>
                    <p class="form-text">Ex: 102, Main Rd</p>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label class="form-label">City:</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="city" id="city" class="form-control" value="<?php echo ($data['city']) ?>" readonly pattern="[A-Za-z.\s]{1,50}">
                    </div>
                    <p class="form-text">Ex: Colombo</p>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label class="form-label">Email:</label>
                    </div>
                    <div class="col-md-4">
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo ($data['email']) ?>" readonly>
                    </div>
                    <p class="form-text">Ex: someone@example.com</p>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label class="form-label">Phone:</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="phone" id="phone" class="form-control" value="<?php echo ($data['phone']) ?>" readonly pattern="[0-9]{10,10}">
                    </div>
                    <p class="form-text">Ex: 0112345678</p>
                </div>

                <input type="hidden" name="country" value="Sri Lanka">
                <input type="hidden" name="hash" value="<?php echo ($data['hash']) ?>"> <!-- Replace with generated hash -->

                </br></br>
                <a class="btn btn-success" onClick="history.back()">Cancel</a>
                &nbsp;
                <button type="submit" class="btn btn-warning">Buy Now!</button>
            </form>
        </div>
    </div>
</div>
<?php
include("header.php");
$items = unserialize(base64_decode($_REQUEST['data']));
$userData = $_SESSION['userData'];
?>

<div class="container topMargin mb-5">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Ur Shopping Cart...</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th> </th>
                            <th> Item Name </th>
                            <th> Unit Price(Rs.) </th>
                            <th> Quantity </th>
                            <th style="color:red"> In-Stock </th>
                            <th> Subtotal(Rs.) </th>
                            <th> Update </th>
                            <th> Remove </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;
                        foreach ($items as $item) { ?>
                            <tr>
                                <form action="..\controllers\cartController.php?req=updateItem" method="post">
                                    <input type="hidden" name="id" id="id" value="<?php echo ($item[0]) ?>">
                                    <td><img src="../images/product/<?php echo ($item[7]) ?>" height="50px" width="50px" alt="ProductImg"></td>
                                    <td><?php echo (ucwords($item[6])) ?></td>
                                    <td><?php echo ($item[8]) ?></td>
                                    <td><input class="form-control" type="number" name="quantity" id="quantity" min="1" max="<?php echo ($item[9]) ?>" value="<?php echo ($item[3]) ?>"></td>
                                    <td style="color:red"><?php echo ($item[9]) ?></td>
                                    <td><?php $subtotal = $item[8] * $item[3];
                                        echo ($subtotal) ?></td>
                                    <td><button type="submit" class="btn btn-warning">Update</button></td>
                                    <td><a class="btn btn-danger" href="..\controllers\cartController.php?req=deleteItem&id=<?php echo ($item[0]) ?>">Remove</a></td>
                                </form>
                            </tr>
                        <?php $total = $total + $subtotal;
                        } ?>
                    </tbody>
                </table>
            </div>
            <br/>
            <?php
            if ($items == []) { ?>
                <h5 align="center">It looks ur cart is empty. Add an item to show here...</h5>
            <?php }
            if ($total != 0) { ?>
                <h5 align="right" style="color:red">Total Price: Rs. <?php echo ($total) ?> /-</h5>
                <a class="btn btn-danger" href="..\controllers\cartController.php?req=deleteCart">Reset Cart</a>
                &nbsp;
                <a class="btn btn-success" onclick="delivery()">Next-></a>
            <?php } ?>
        </div>

        <div id="delivery" style="display: none">
            <hr class="mt-4">
            <h4 class="card-title mb-4">Provide Delivery Information...</h4>
            <form action="..\controllers\checkoutController.php?req=checkout" method="post">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label class="form-label">First Name:</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo (ucwords($userData['first_name'])) ?>" required pattern="[A-Za-z.\s]{1,50}">
                    </div>
                    <p class="form-text">Ex: John</p>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label class="form-label">Last Name:</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo (ucwords($userData['last_name'])) ?>" required pattern="[A-Za-z.\s]{1,50}">
                    </div>
                    <p class="form-text">Ex: Fernando</p>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label class="form-label">Address:</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="address" id="address" class="form-control" required pattern="[A-Za-z0-9,.\s]{1,50}">
                    </div>
                    <p class="form-text">Ex: 102, Main Rd</p>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label class="form-label">City:</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="city" id="city" class="form-control" required pattern="[A-Za-z.\s]{1,50}">
                    </div>
                    <p class="form-text">Ex: Colombo</p>
                </div>
                <a class="btn btn-success" onclick="checkout()">Next-></a>
        </div>

        <div id="checkout" class="mb-4" style="display: none">
            <hr class="mt-4">
            <input type="hidden" name="amount" id="amount" value="<?php echo ($total) ?>">
            <input type="hidden" name="items" id="items" value="ShoppingCart">
            <input type="hidden" name="email" id="email" value="<?php echo ($userData['email']) ?>">
            <input type="hidden" name="phone" id="phone" value="<?php echo ($userData['phone']) ?>">
            <h4 class="card-title mb-4">Pay with...</h4>
            <input type="radio" name="pay_with" value="Online" required /> &nbsp; <label class="form-label">Credit/Debit Card</label>
            &nbsp; &nbsp;
            <input type="radio" name="pay_with" value="COD" required /> &nbsp; <label class="form-label">Cash On Delivery</label>
            <br /><br />
            <button type="submit" class="btn btn-primary"> Go!</button>
            </form>
        </div>
    </div>
</div>
</div>
</div>

<script>
    function delivery() {
        document.getElementById("delivery").style.display = "inline";
    }

    function checkout() {
        document.getElementById("checkout").style.display = "inline";
    }
</script>
<?php
include("header.php");
$deliveries = unserialize(base64_decode($_REQUEST['data']));
?>

<div class="container-fluid topMargin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Delivery Management</h4>
            <a class="btn btn-primary mt-1 mb-3" href="../controllers/deliveryController.php?req=deliveryUpdater">Delivery Updater</a>
            <a class="btn btn-primary mt-1 mb-3" href="../controllers/deliveryController.php?req=deliveryTracker">Delivery Tracker</a>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th> Order ID </th>
                            <th> First Name </th>
                            <th> Last Name </th>
                            <th> Address </th>
                            <th> City </th>
                            <th> Date Added </th>
                            <th> Status </th>
                            <th> Update </th>
                            <th> Delete </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($deliveries as $delivery) { ?>
                            <tr>
                                <form id="updateDelivery" action="..\controllers\deliveryController.php?req=updateDelivery" method="post">
                                    <input type="hidden" name="id" id="id" value="<?php echo ($delivery[0]) ?>">
                                    <td><?php echo ($delivery[1]) ?></td>
                                    <td><input class="form-control" type="text" name="first_name" id="first_name" value="<?php echo (ucwords($delivery[2])) ?>" required pattern="[A-Za-z.\s]{1,50}"></td>
                                    <td><input class="form-control" type="text" name="last_name" id="last_name" value="<?php echo (ucwords($delivery[3])) ?>" required pattern="[A-Za-z.\s]{1,50}"></td>
                                    <td><input class=" form-control" type="text" name="address" id="address" value="<?php echo (ucwords($delivery[4])) ?>" required pattern="[A-Za-z0-9,.\s]{3,50}"></td>
                                    <td><input class="form-control" type="text" name="city" id="city" value="<?php echo (ucwords($delivery[5])) ?>" required pattern="[A-Za-z.\s]{1,50}"></td>
                                    <td><?php echo ($delivery[6]) ?></td>
                                    <td><select class="form-control" id="status" name="status">
                                            <option value="TBC" <?php if ($delivery[7] == "TBC") {
                                                                    echo ("selected");
                                                                } ?>>TBC</option>
                                            <option value="Cancelled" <?php if ($delivery[7] == "Cancelled") {
                                                                            echo ("selected");
                                                                        } ?>>Cancelled</option>
                                            <option value="Queue" <?php if ($delivery[7] == "Queue") {
                                                                        echo ("selected");
                                                                    } ?>>Queue</option>
                                            <option value="Shipped" <?php if ($delivery[7] == "Shipped") {
                                                                        echo ("selected");
                                                                    } ?>>Shipped</option>
                                            <option value="Delivered" <?php if ($delivery[7] == "Delivered") {
                                                                            echo ("selected");
                                                                        } ?>>Delivered</option>
                                            <option value="Returned" <?php if ($delivery[7] == "Returned") {
                                                                            echo ("selected");
                                                                        } ?>>Returned</option>
                                        </select></td>
                                    <td><button type="submit" class="btn btn-warning">Update</button></td>
                                    <td> <a class="btn btn-danger" href="..\controllers\deliveryController.php?req=deleteDelivery&id=<?php echo ($delivery[0]) ?>">Delete</a> </td>
                                </form>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
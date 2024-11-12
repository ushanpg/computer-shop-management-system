<?php
include("header.php");
$orders = unserialize(base64_decode($_REQUEST['data']));
?>

<div class="container-fluid topMargin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Orders Management</h4>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th> Order ID </th>
                            <th> User </th>
                            <th> No. of Products </th>
                            <th> Total Price(Rs.) </th>
                            <th> Pay With </th>
                            <th> Date Added </th>
                            <th> Status </th>
                            <th> View </th>
                            <th> Delete </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order) { ?>
                            <tr>
                                <form id="updateOrder" action="..\controllers\orderController.php?req=updateOrder" method="post">
                                    <input type="hidden" name="order_id" id="order_id" value="<?php echo ($order[1]) ?>">
                                    <td><?php echo ($order[1]) ?></td>
                                    <td><?php echo (sprintf("%05d", $order[2]) . " " . ucwords($order[6])) ?></td>
                                    <td><?php echo ($order[7]) ?></td>
                                    <td><?php echo ($order[8]) ?></td>
                                    <td style="color:green; font-weight:bold"><?php echo (strtoupper($order[3])) ?></td>
                                    <td><?php echo ($order[4]) ?></td>
                                    <td><select class="form-control" id="status" name="status" onchange="submit()">
                                            <option value="TBC" <?php if ($order[5] == "TBC") {
                                                                    echo ("selected");
                                                                } ?>>TBC</option>
                                            <option value="Accepted" <?php if ($order[5] == "Accepted") {
                                                                            echo ("selected");
                                                                        } ?>>Accepted</option>
                                            <option value="Cancelled" <?php if ($order[5] == "Cancelled") {
                                                                            echo ("selected");
                                                                        } ?>>Cancelled</option>
                                            <option value="Queue" <?php if ($order[5] == "Queue") {
                                                                        echo ("selected");
                                                                    } ?>>Queue</option>
                                            <option value="Dispatched" <?php if ($order[5] == "Dispatched") {
                                                                            echo ("selected");
                                                                        } ?>>Dispatched</option>
                                            <option value="Completed" <?php if ($order[5] == "Completed") {
                                                                            echo ("selected");
                                                                        } ?>>Completed</option>
                                        </select></td>
                                    <td> <a class="btn btn-warning" href="..\controllers\orderController.php?req=viewOrder&id=<?php echo ($order[1]) ?>">View</a> </td>
                                    <td> <a class="btn btn-danger" href="..\controllers\orderController.php?req=deleteOrder&id=<?php echo ($order[1]) ?>">Delete</a> </td>
                                </form>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
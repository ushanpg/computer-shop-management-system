<?php
include("header.php");
$payments = unserialize(base64_decode($_REQUEST['data']));
?>

<div class="container-fluid topMargin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Payments Management</h4>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th> Ref No. </th>
                            <th> User </th>
                            <th> Order ID </th>
                            <th> Amount(Rs.) </th>
                            <th> Method </th>
                            <th> Card No. </th>
                            <th> Date Added </th>
                            <th> Status </th>
                            <th> Delete </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($payments as $payment) { ?>
                            <tr>
                                <form id="updatePayment" action="..\controllers\paymentController.php?req=updatePayment" method="post">
                                    <input type="hidden" name="id" id="id" value="<?php echo ($payment[0]) ?>">
                                    <td><?php echo (sprintf("%05d", $payment[0])) ?></td>
                                    <td><?php echo (sprintf("%05d", $payment[7]) . " " . ucwords($payment[8])) ?></td>
                                    <td><?php echo ($payment[1]) ?></td>
                                    <td><?php echo ($payment[2]) ?></td>
                                    <td><?php echo ($payment[3]) ?></td>
                                    <td><?php
                                        if ($payment[4] == 0) {
                                            echo ("N/A");
                                        } else {
                                            echo ($payment[4]);
                                        } ?></td>
                                    <td><?php echo ($payment[5]) ?></td>
                                    <td><select class="form-control" id="status" name="status" onchange="submit()">
                                            <option value="TBC" <?php if ($payment[6] == "TBC") {
                                                                    echo ("selected");
                                                                } ?>>TBC</option>
                                            <option value="Success" <?php if ($payment[6] == "Success") {
                                                                        echo ("selected");
                                                                    } ?>>Success</option>
                                            <option value="Collected" <?php if ($payment[6] == "Collected") {
                                                                            echo ("selected");
                                                                        } ?>>Collected</option>
                                            <option value="Failed" <?php if ($payment[6] == "Failed") {
                                                                        echo ("selected");
                                                                    } ?>>Failed</option>
                                        </select></td>
                                    <td> <a class="btn btn-danger" href="..\controllers\paymentController.php?req=deletePayment&id=<?php echo ($payment[0]) ?>">Delete</a> </td>
                                </form>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
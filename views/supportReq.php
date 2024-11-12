<?php
include("header.php");
if (isset($_REQUEST['data'])) {
    $tokens = unserialize(base64_decode($_REQUEST['data']));
}
?>

<div class="container topMargin">

    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-5">Create Token</h4>
            <form id="addToken" action="../controllers/supportController.php?req=addToken" method="post">
                <div class="row">
                    <div class="row mb-3">
                        <div class="col-md-3"></div>
                        <div class="col-md-1">
                            <label class="form-label">Type:</label>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" id="type" name="type">
                                <option value="Purchase">Purchase</option>
                                <option value="Payment">Payment</option>
                                <option value="Delivery">Delivery</option>
                                <option value="Technical">Technical</option>
                                <option value="Repair">Repair</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3"></div>
                        <div class="col-md-1">
                            <label class="form-label">Description:</label>
                        </div>
                        <div class="col-md-4">
                            <input type="textarea" rows="4" name="description" class="form-control" id="description" required pattern="[A-Za-z0-9\s.,]{1,256}">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Create!</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">My Tokens</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th> Token No. </th>
                            <th> Type </th>
                            <th> Description </th>
                            <th> Fee(Rs.) </th>
                            <th> Date Added </th>
                            <th> Status </th>
                        </tr>
                    </thead>
                    <?php
                    if (isset($tokens)) { ?>
                        <tbody>
                            <?php foreach ($tokens as $token) { ?>
                                <tr>
                                    <td><?php echo ($token[1]) ?></td>
                                    <td><select class="form-control" id="type" name="type" disabled>
                                            <option value="Purchase" <?php if ($token[3] == "Purchase") {
                                                                            echo ("selected");
                                                                        } ?>>Purchase</option>
                                            <option value="Payment" <?php if ($token[3] == "Payment") {
                                                                        echo ("selected");
                                                                    } ?>>Payment</option>
                                            <option value="Delivery" <?php if ($token[3] == "Delivery") {
                                                                            echo ("selected");
                                                                        } ?>>Delivery</option>
                                            <option value="Technical" <?php if ($token[3] == "Technical") {
                                                                            echo ("selected");
                                                                        } ?>>Technical</option>
                                            <option value="Repair" <?php if ($token[3] == "Repair") {
                                                                        echo ("selected");
                                                                    } ?>>Repair</option>
                                            <option value="Other" <?php if ($token[3] == "Other") {
                                                                        echo ("selected");
                                                                    } ?>>Other</option>
                                        </select></td>
                                    <td><?php echo ($token[4]) ?></td>
                                    <td><?php echo ($token[5]) ?></td>
                                    <td><?php echo ($token[6]) ?></td>
                                    <td><select class="form-control" id="status" name="status" disabled>
                                            <option value="Queued" <?php if ($token[7] == "Queued") {
                                                                        echo ("selected");
                                                                    } ?>>Queued</option>
                                            <option value="Accepted" <?php if ($token[7] == "Accepted") {
                                                                            echo ("selected");
                                                                        } ?>>Accepted</option>
                                            <option value="In_Works" <?php if ($token[7] == "In_Works") {
                                                                            echo ("selected");
                                                                        } ?>>In_Works</option>
                                            <option value="Solved" <?php if ($token[7] == "Solved") {
                                                                        echo ("selected");
                                                                    } ?>>Solved</option>
                                            <option value="TBC" <?php if ($token[7] == "TBC") {
                                                                    echo ("selected");
                                                                } ?>>TBC</option>
                                        </select></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
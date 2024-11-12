<?php
include("header.php");
$tokens = unserialize(base64_decode($_REQUEST['data']));
?>

<div class="container-fluid topMargin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Support Management</h4>
            <a class="btn btn-primary mt-1 mb-3" href="../controllers/supportController.php?req=trackToken">Create/Track Token</a>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th> Token No. </th>
                            <th> User </th>
                            <th> Type </th>
                            <th> Description </th>
                            <th> Fee(Rs.) </th>
                            <th> Date Added </th>
                            <th> Status </th>
                            <th> Update </th>
                            <th> Delete </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tokens as $token) { ?>
                            <tr>
                                <form method="post" action="..\controllers\supportController.php?req=updateToken">
                                    <input type="hidden" name="id" id="id" value="<?php echo ($token[0]) ?>">
                                    <td><?php echo ($token[1]) ?></td>
                                    <td><?php echo (sprintf("%05d", $token[2]) . " " . ucwords($token[8])) ?></td>
                                    <td><select class="form-control" id="type" name="type">
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
                                    <td><input class="form-control" type="text" name="fee" id="fee" value="<?php echo ($token[5]) ?>" required pattern="[0-9]{1,11}"></td>
                                    <td><?php echo ($token[6]) ?></td>
                                    <td><select class="form-control" id="status" name="status">
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
                                    <td> <button class="btn btn-warning" type="submit">Update</button> </td>
                                </form>
                                <td> <a class="btn btn-danger" href="..\controllers\supportController.php?req=deleteToken&id=<?php echo ($token[0]) ?>">Delete</a> </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
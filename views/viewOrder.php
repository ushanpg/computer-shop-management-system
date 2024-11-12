<?php
include("header.php");
$items = unserialize(base64_decode($_REQUEST['data']));
$order_id = $_REQUEST['id'];
?>

<div class="container topMargin">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-2">
                    <a onclick="history.back()" class="btn btn-success"><-Back </a>
                </div>
                <div class="col-md-10">
                    <h4 class="card-title" align="left">View Order - <?php echo ($order_id) ?></h4>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th> Item ID</th>
                            <th></th>
                            <th> Product</th>
                            <th> Unit Price(Rs.) </th>
                            <th> Quantity </th>
                            <th style="color:red"> In-Stock </th>
                            <th> Subtotal(Rs.) </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;
                        foreach ($items as $item) { ?>
                            <tr>
                                <td><?php echo (sprintf("%05d", $item[0])) ?></td>
                                <td><img src="../images/product/<?php echo ($item[6]) ?>" alt="productImage" height="40px" width="40px" /></td>
                                <td><?php echo (sprintf("%05d", $item[2]) . " " . ucwords($item[5])) ?></td>
                                <td><?php echo ($item[4]) ?></td>
                                <td><?php echo ($item[3]) ?></td>
                                <td style="color:red"><?php echo ($item[7]) ?></td>
                                <td><?php $subtotal = $item[4] * $item[3];
                                    echo ($subtotal) ?></td>
                            </tr>
                        <?php $total = $total + $subtotal;
                        } ?>
                    </tbody>
                </table>
            </div>
            <br />
            <h5 align="right" style="color:red">Total Price: Rs. <?php echo ($total) ?> /-</h5>
        </div>
    </div>
</div>
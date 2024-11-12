<?php
include("header.php");
$brands = $_SESSION['brands'];
$products = $_SESSION['products'];
$stocks = unserialize(base64_decode($_REQUEST['data']));
?>

<div class="container-fluid topMargin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Inventory Management</h4>
            <a class="btn btn-primary mt-1 mb-3" onclick="addGRN()">Add GRN...</a>

            <div class="container" id="addGRN" style="display: none">
                <form method="post" action="../controllers/inventoryController.php?req=addGRN">
                    <div class="row border border-dark rounded pb-3">
                        <h1 class="h3 mb-3 mt-3">Add GRN...</h1>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-1">
                                <label class="form-label">Product:</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" id="product_id" name="product_id">
                                    <?php foreach ($products as $product) { ?>
                                        <option value="<?php echo ($product[0]); ?>"><?php echo (sprintf("[%05d]", $product[0]) . " " . ucwords($product[1])); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <label class="form-label">Quantity:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="quantity" class="form-control" id="quantity" required pattern="[0-9]{0,11}">
                                <p class="form-text">Ex: 25</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-1">
                                <label class="form-label">Grade:</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" id="grade" name="grade">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <label class="form-label">Notes:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text-area" name="note" id="note" class="form-control" pattern="[A-Za-z0-9\s.,]{0,50}" placeholder="Please provide any clarifications here...">
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col-md-3"></div>
                            <div class="col-md-1">
                                <label class="form-label">Unit Cost(Rs.):</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="unit_cost" class="form-control" id="unit_cost" required pattern="[0-9]{0,30}">
                                <p class="form-text">Ex: 25000</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5"></div>
                            <div class="col-md-2 mt-4">
                                <button type="submit" class="btn btn-primary mb-1">Add+</button>
                                &nbsp;
                                <button type="button" class="btn btn-dark mb-1" id="closeGRN">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th> Stock ID </th>
                            <th> Product </th>
                            <th> Date Added </th>
                            <th> Quantity </th>
                            <th> Grade </th>
                            <th> Notes </th>
                            <th> Unit Cost(Rs.) </th>
                            <th> Remaining </th>
                            <th> Delete </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($stocks as $stock) { ?>
                            <tr>
                                <form id="updateStock" method="post" action="..\controllers\inventoryController.php?req=updateStock">
                                    <input type="hidden" name="id" id="id" value="<?php echo ($stock[0]) ?>">
                                    <td><?php echo (sprintf("%05d", $stock[0])) ?></td>
                                    <td><?php echo (sprintf("%05d", $stock[3]) . " " . ucwords($stock[9])) ?></td>
                                    <td><?php echo ($stock[2]) ?></td>
                                    <td><?php echo ($stock[1]) ?></td>
                                    <td><?php echo ($stock[4]) ?></td>
                                    <td><?php echo ($stock[5]) ?></td>
                                    <td><?php echo ($stock[6]) ?></td>
                                    <td><?php echo ($stock[7]) ?></td>
                                </form>
                                <td> <a class="btn btn-danger" href="..\controllers\inventoryController.php?req=deleteStock&id=<?php echo ($stock[0]) ?>">Delete</a> </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function addGRN() {
        document.getElementById("addGRN").style.display = "inline";

        document.getElementById("closeGRN").addEventListener("click",
            () => {
                document.getElementById("addGRN").style.display = "none";
            }
        );
    }
</script>
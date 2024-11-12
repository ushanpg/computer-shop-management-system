<?php
include("header.php");
$categories = $_SESSION['categories'];
$subcategories = $_SESSION['subcategories'];
$products = unserialize(base64_decode($_REQUEST['data']));
?>

<div class="container-fluid topMargin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Products Management</h4>
            <a class="btn btn-primary mt-1 mb-3" href="../controllers/productController.php?req=addProduct">Add New Product...</a>
            <a class="btn btn-primary mt-1 mb-3" href="../controllers/brandController.php?req=brand">Brand Manager</a>
            <a class="btn btn-primary mt-1 mb-3" href="../controllers/categoryController.php?req=category">Category Manager</a>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th> </th>
                            <th> Product ID</th>
                            <th> Name </th>
                            <th> Price(Rs.) </th>
                            <th> Warranty(Days) </th>
                            <th> In Stock </th>
                            <th> Last Stocked </th>
                            <th> Edit </th>
                            <th> Delete </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) { ?>
                            <tr>
                                <td><img src="../images/product/<?php echo ($product[7]) ?>" alt="productImage" height="40px" width="40px" /></td>
                                <td> <?php echo (sprintf("%05d", $product[0])) ?> </td>
                                <td> <?php echo (ucwords($product[1])) ?></td>
                                <td> <?php echo ($product[5]) ?> </td>
                                <td> <?php echo ($product[6]) ?> </td>
                                <td> <?php echo ($product[8]) ?> </td>
                                <td> <?php echo ($product[9]) ?> </td>
                                <td> <a class="btn btn-primary" href="../controllers/productController.php?req=editProduct&id=<?php echo ($product[0]) ?>">Edit</a> </td>
                                <td> <a class="btn btn-danger" href="../controllers/productController.php?req=deleteProduct&id=<?php echo ($product[0]) ?>">Delete</a> </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
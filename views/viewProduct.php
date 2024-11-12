<?php
include("header.php");
$product = unserialize(base64_decode($_REQUEST['data']));
?>
<div class="container topMargin">
    <form action="..\controllers\cartController.php?req=addToCart" method="post">
        <div class='card'>
            <div class='card-body'>
                <div class="row">
                    <div class="col-md-2">
                        <a onclick="history.back()" class="btn btn-success"><-Back </a>
                    </div>
                    <div class="col-md-10">
                        <h2 align="left"><?php echo (ucwords($product['name'])) ?></h2>
                        <input type="hidden" name="id" id="id" value="<?php echo ($product['id']) ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <img src="../images/product/<?php echo ($product['image']) ?>" alt="productImage" height="500px" width="500px">
                    </div>
                    <div class="col-md-5" align="center">
                        <h5 class="card-text">MRP - Rs. <?php echo ($product['price']) ?>.00</h5>
                        <?php if ($product['in_stock'] > 0) { ?>
                            <h6 class="card-text" style="color:red">In Stock: <?php echo ($product['in_stock']) ?></h6>
                            <br /><br />
                            <div class="col-md-3 mb-3">
                                <input type="number" class="form-control" name="quantity" id="quantity" min="1" max="<?php echo ($product['in_stock']) ?>" value="1"></input>
                            </div>
                            <input type="submit" class="btn btn-success" value="Add To Cart++"></input>
                        <?php } else { ?>
                            <h6 class="card-text" style="color:red">Out of Stock</h6>
                            <br /><br />
                            <div class="col-md-3 mb-3">
                                <input type="number" class="form-control" name="quantity" id="quantity" disabled></input>
                            </div>
                            <input type="submit" class="btn btn-success" value="Add To Cart++" disabled></input>
                        <?php } ?>
                        <br /><br />
                        <label><?php echo ($product['description']) ?></label>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
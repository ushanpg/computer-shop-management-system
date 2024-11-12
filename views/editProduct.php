<?php
include("header.php");
$brands = $_SESSION['brands'];
$categories = $_SESSION['categories'];
$subcategories = $_SESSION['subcategories'];
$product = unserialize(base64_decode($_REQUEST['data']));
?>

<div class="container topMargin mb-3">
    <h1 class="h3 mb-3 fw-normal">Edit Product...</h1>
    <form enctype="multipart/form-data" method="post" action="..\controllers\productController.php?req=updateProduct">
        <input type="hidden" id="id" name="id" value="<?php echo ($product['id']); ?>">
        <div class="row border border-dark rounded">
            <div class="col-md-5 mt-3 ms-3">
                <div class="mb-3">
                    <label class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required pattern="[A-Za-z0-9\s]{1,50}" value="<?php echo (ucwords($product["name"])); ?>">
                    <p class="form-text">Max 50 characters.</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Brand:</label>
                    <select class="form-control" id="brand" name="brand">
                        <?php foreach ($brands as $brand) { ?>
                            <option value="<?php echo ($brand[0]); ?>" <?php
                                                                        if ($brand[0] == $product["brand_id"]) {
                                                                            echo ("selected");
                                                                        }
                                                                        ?>><?php echo (ucwords($brand[1])); ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category:</label>
                    <select class="form-control" id="category" name="category">
                        <?php foreach ($categories as $category) { ?>
                            <?php foreach ($subcategories as $subcategory) {
                                if ($category[0] == $subcategory[2]) { ?>
                                    <option value="<?php echo ($category[0] . "." . $subcategory[0]); ?>" <?php
                                                                                                            if ($subcategory[0] == $product["subcat_id"]) {
                                                                                                                echo ("selected");
                                                                                                            }
                                                                                                            ?>><?php echo (ucwords($subcategory[1])); ?></option>
                            <?php }
                            } ?>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description:</label>
                    <input type="text" class="form-control" id="description" name="description" pattern="[A-Za-z0-9\s.,]{0,512}" value="<?php echo ($product["description"]); ?>">
                    <p class="form-text">Max 512 characters.</p>
                </div>
            </div>

            <div class="col-md-5 mt-3 ms-3">
                <div class="mb-3">
                    <label class="form-label">Price (Rs.):</label>
                    <input type="text" name="price" class="form-control" id="price" required pattern="[0-9]{1,50}" value="<?php echo ($product["price"]); ?>">
                    <p class="form-text">Ex: 25000</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Warranty (Days):</label>
                    <input type="text" name="warranty" class="form-control" id="warranty" required pattern="[0-9]{1,11}" value="<?php echo ($product["warranty"]); ?>">
                    <p class="form-text">Ex: 365</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Current Image:</label>
                    &nbsp;
                    <img src="../images/product/<?php echo ($product['image']); ?>" height="150px" width="150px">
                    <input type="hidden" id="currImage" name="currImage" value="<?php echo ($product['image']); ?>">
                </div>

                <div class="mb-5">
                    <label class="form-label">Image:</label>
                    <input type="file" accept="image/*" name="img" id="img" class="form-control">
                    <p class="form-text">JPG, JPEG, PNG & GIF image of 5MB max.</p>
                </div>
                <a class="btn btn-success mb-3" onClick="history.back()">Cancel</a>
                &nbsp;
                <button class="btn btn-primary mb-3" type="submit">Update</button>
            </div>
        </div>
    </form>
</div>
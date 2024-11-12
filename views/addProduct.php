<?php
include("header.php");
$brands = $_SESSION['brands'];
$categories = $_SESSION['categories'];
$subcategories = $_SESSION['subcategories'];
?>

<div class="container topMargin mb-3">
    <h1 class="h3 mb-3 fw-normal">Add New Product...</h1>
    <form enctype="multipart/form-data" method="post" action="..\controllers\productController.php?req=confirmAdd">

        <div class="row border border-dark rounded">
            <div class="col-md-5 mt-3 ms-3">
                <div class="mb-3">
                    <label class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required pattern="[A-Za-z0-9\s]{1,50}">
                    <p class="form-text">Max 50 characters.</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Brand:</label>
                    <select class="form-control" id="brand" name="brand">
                        <?php foreach ($brands as $brand) { ?>
                            <option value="<?php echo ($brand[0]); ?>"><?php echo (ucwords($brand[1])); ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category:</label>
                    <select class="form-control" id="category" name="category">
                        <?php foreach ($categories as $category) { ?>
                            <?php foreach ($subcategories as $subcategory) {
                                if ($category[0] == $subcategory[2]) { ?>
                                    <option value="<?php echo ($category[0] . "." . $subcategory[0]); ?>"><?php echo (ucwords($subcategory[1])); ?></option>
                            <?php }
                            } ?>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description:</label>
                    <input type="text" class="form-control" id="description" name="description" pattern="[A-Za-z0-9\s.,]{0,512}">
                    <p class="form-text">Max 512 characters.</p>
                </div>
            </div>

            <div class="col-md-5 mt-3 ms-3">

                <div class="mb-3">
                    <label class="form-label">Price (Rs.):</label>
                    <input type="text" name="price" class="form-control" id="price" required pattern="[0-9]{1,50}">
                    <p class="form-text">Ex: 25000</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Warranty (Days):</label>
                    <input type="text" name="warranty" class="form-control" id="warranty" required pattern="[0-9]{1,11}">
                    <p class="form-text">Ex: 365</p>
                </div>

                <div class="mb-5">
                    <label class="form-label">Image:</label>
                    <input type="file" accept="image/*" name="img" id="img" class="form-control">
                    <p class="form-text">JPG, JPEG, PNG & GIF image of 5MB max.</p>
                </div>
                <a class="btn btn-success mb-3" onClick="history.back()">Cancel</a>
                &nbsp;
                <button class="btn btn-primary mb-3" type="submit">Add+</button>
            </div>
        </div>
    </form>
</div>
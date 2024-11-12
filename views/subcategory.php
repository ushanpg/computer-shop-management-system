<?php
include("header.php");
$subcategories = unserialize(base64_decode($_REQUEST['data']));
$cat_id = $_REQUEST['cat_id'];
$categories = $_SESSION['category'];
?>

<div class="container topMargin">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-2">
                    <a onclick="history.back()" class="btn btn-success"><-Back </a>
                </div>
                <div class="col-md-10">
                    <h4 class="card-title" align="left">Subcategory View for
                        <?php
                        foreach ($categories as $category) {
                            if ($category[0] == $cat_id) {
                                echo (ucwords($category[1]));
                            }
                        } ?></h4>
                </div>
            </div>

            <form method="post" action="..\controllers\subcategoryController.php?req=addSubcategory">
                <input type="hidden" name="cat_id" id="cat_id" value="<?php echo ($cat_id) ?>">
                <div class="row border border-dark rounded pb-1">
                    <p>Add New Subcategory...</p>
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <p align="right">Name:</p>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Type Here..." pattern="[A-Za-z\s]{1,50}" required>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary" type="submit">Add+</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th> Name </th>
                            <th> Parent </th>
                            <th> Update </th>
                            <th> Delete </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subcategories as $subcategory) { ?>
                            <tr>
                                <form method="post" action="..\controllers\subcategoryController.php?req=updateSubcategory">
                                    <input type="hidden" name="id" id="id" value="<?php echo ($subcategory[0]) ?>">
                                    <td><input type="text" class="form-control" name="name" id="name" value="<?php echo (ucwords($subcategory[1])) ?>" pattern="[A-Za-z\s]{1,50}" required></td>

                                    <td><select class="form-control" id="cat_id" name="cat_id">
                                            <?php foreach ($categories as $category) { ?>
                                                <option value="<?php echo ($category[0]); ?>" <?php
                                                                                                if ($category[0] == $subcategory[2]) {
                                                                                                    echo ("selected");
                                                                                                }
                                                                                                ?>><?php echo (ucwords($category[1])); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td> <button class="btn btn-primary" type="submit">Update</button> </td>
                                    <td> <a href="..\controllers\subcategoryController.php?req=deleteSubcategory&id=<?php echo ($subcategory[0]) ?>" class="btn btn-danger">Delete</a> </td>
                                </form>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
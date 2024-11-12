<?php
include("header.php");
$categories = unserialize(base64_decode($_REQUEST['data']));
?>

<div class="container topMargin">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-2">
                    <a onclick="history.back()" class="btn btn-success"><-Back </a>
                </div>
                <div class="col-md-10">
                    <h4 class="card-title" align="left">Category Manager</h4>
                </div>
            </div>

            <form method="post" action="..\controllers\categoryController.php?req=addCategory">
                <div class="row border border-dark rounded pb-1">
                    <p>Add New Category...</p>
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <p align="right">Name:</p>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Type Here..." pattern="[A-Za-z\s]{1,50}" required>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary" type="submit">Add+</a>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th> Name </th>
                            <th> Subcategories </th>
                            <th> Update </th>
                            <th> Delete </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category) { ?>
                            <tr>
                                <form method="post" action="..\controllers\categoryController.php?req=updateCategory">
                                    <input type="hidden" name="id" id="id" value="<?php echo ($category[0]) ?>">
                                    <td><input type="text" class="form-control" name="name" id="name" value="<?php echo (ucwords($category[1])) ?>" pattern="[A-Za-z\s]{1,50}" required></td>
                                    <td> <a href="..\controllers\subcategoryController.php?req=subcategory&cat_id=<?php echo ($category[0]) ?>" class="btn btn-warning">View</a> </td>
                                    <td> <button class="btn btn-primary" type="submit">Update</button> </td>
                                    <td> <a href="..\controllers\categoryController.php?req=deleteCategory&id=<?php echo ($category[0]) ?>" class="btn btn-danger">Delete</a> </td>
                                </form>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
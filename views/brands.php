<?php
include("header.php");
$brands = unserialize(base64_decode($_REQUEST['data']));
?>

<div class="container topMargin">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-2">
                    <a onclick="history.back()" class="btn btn-success"><-Back </a>
                </div>
                <div class="col-md-10">
                    <h4 class="card-title" align="left">Brand Manager</h4>
                </div>
            </div>

            <form method="post" action="..\controllers\brandController.php?req=addBrand">
                <div class="row border border-dark rounded pb-1">
                    <p>Add New Brand...</p>
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <p align="right">Name:</p>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Type Here..." pattern="[A-Za-z\s]{1,20}" required>
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
                            <th> Update </th>
                            <th> Delete </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($brands as $brand) { ?>
                            <tr>
                                <form method="post" action="..\controllers\brandController.php?req=updateBrand">
                                    <input type="hidden" name="id" id="id" value="<?php echo ($brand[0]) ?>">
                                    <td><input type="text" class="form-control" name="name" id="name" value="<?php echo (ucwords($brand[1])) ?>" pattern="[A-Za-z\s]{1,20}" required></td>
                                    <td> <button class="btn btn-primary" type="submit">Update</a> </td>
                                    <td> <a href="..\controllers\brandController.php?req=deleteBrand&id=<?php echo ($brand[0]) ?>" class="btn btn-danger">Delete</a> </td>
                                </form>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
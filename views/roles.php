<?php
include("header.php");
$roles = $_SESSION['roles'];
$modules = $_SESSION['modules'];
$moduleRoles = $_SESSION['moduleRole'];
?>

<div class="container topMargin">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-2">
                    <a onclick="history.back()" class="btn btn-success"><-Back </a>
                </div>
                <div class="col-md-10">
                    <h4 class="card-title" align="left">Roles & Permissions</h4>
                </div>
            </div>

            <?php foreach ($roles as $role) { ?>
                <div class="card">
                    <div class="card-body">
                        <form id="updateRole" method="post" action="..\controllers\roleController.php?req=updateRole">
                            <input type="hidden" name="id" id="id" value="<?php echo ($role[0]) ?>">
                            <h5><?php echo (ucwords($role[1])) ?></h5>

                            <div class="row ms-5 mt-3 mb-3 justify-content-center">
                                <?php foreach ($modules as $module) { ?>
                                    <div class="col-md-4" align="left">
                                        <input type="checkbox" name="<?php echo ($module[1]) ?>" value="<?php echo ($module[0]) ?>" <?php foreach ($moduleRoles as $moduleRole) {
                                                                                                                                        if ($moduleRole[1] == $role[0]) {
                                                                                                                                            if ($moduleRole[0] == $module[0]) {
                                                                                                                                                echo ("checked");
                                                                                                                                            }
                                                                                                                                        }
                                                                                                                                    } ?> />
                                        &nbsp;
                                        <label class="form-label"><?php echo (ucwords($module[1])) ?></label>
                                    </div>
                                <?php } ?>
                            </div>
                            <button class="btn btn-primary" type="submit">Update</a>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
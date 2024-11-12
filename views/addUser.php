<?php
include("header.php");
$roles = unserialize(base64_decode($_REQUEST['data']));
?>

<div class="container topMargin mb-3">
    <h1 class="h3 mb-3 fw-normal">Add Staff User...</h1>
    <form id="addUser" method="post" action="..\controllers\userController.php?req=addUserConfirm">
        <div class="row">
            <div class="col-md-5 pt-3 border border-dark rounded">
                <div class="mb-3">
                    <label class="form-label">Email address:</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="name@example.com">
                    <p class="form-text">An email address could be used to create single account only.</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}" placeholder="Password">
                    <p class="form-text">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters.</p>
                </div>

                <div class="mb-3">
                    <label class="form-label" style="color:red; text-decoration:bold;">Role:</label>
                    <select class="form-control" id="role" name="role">
                        <?php foreach ($roles as $role) { ?>
                            <option value="<?php echo ($role[0]); ?>"><?php echo ($role[1]); ?></option>
                        <?php } ?>
                    </select>
                    <p class="form-text" style="color:red; text-decoration:bold;">! Important configuration. be careful.</p>
                </div>

                <div class="mb-3" align="center">
                    <a class="btn btn-success mb-3" onClick="history.back()">Cancel</a>
                    &nbsp;
                    <button class="btn btn-primary mb-3" type="submit">Add+</button>
                </div>
            </div>
        </div>
    </form>
</div>
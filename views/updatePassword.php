<?php
include("header.php");
$user_id = $_REQUEST["user_id"];
?>

<div class="container topMargin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Update Password</h4>
            <form id="updatePassword" action="../controllers/userController.php?req=updatePasswordConfirm" method="post">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo ($user_id) ?>">
                        <label class="form-label">New Password:</label>
                        <input type="password" name="password" class="form-control" id="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}">
                        <br />
                        <label class="form-label">Confirm Password:</label>
                        <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}">
                        <br />
                        <p class="form-text">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters.</p>
                        <br />
                        <a class="btn btn-success" onClick="history.back()">Cancel</a>
                        &nbsp;
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
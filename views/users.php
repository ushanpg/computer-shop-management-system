<?php
include("header.php");
$users = unserialize(base64_decode($_REQUEST['data']));
$roles = $_SESSION['roles'];
?>
<div class="container-fluid topMargin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Users Management</h4>
            <a class="btn btn-primary mt-1 mb-3" href="../controllers/userController.php?req=addUser">Add Staff User...</a>
            <a class="btn btn-warning mt-1 mb-3" href="../controllers/roleController.php?req=roles">Roles & Permissions</a>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th> </th>
                            <th> User ID</th>
                            <th> Email </th>
                            <th> First Name </th>
                            <th> Last Name </th>
                            <th> Role </th>
                            <th> Edit </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <td> <img src="../images/user/<?php echo ($user[6]) ?>" alt="userImage" height="40px" width="40px" /> </td>
                                <td> <?php echo (sprintf("%05d", $user[0])) ?> </td>
                                <td> <?php echo (ucwords($user[3])) ?> </td>
                                <td> <?php echo (ucwords($user[1])) ?> </td>
                                <td> <?php echo (ucwords($user[2])) ?> </td>
                                <td> <?php echo ($user[4]) ?> </td>
                                <td> <a class="btn btn-primary" href="../controllers/userController.php?req=editUser&id=<?php echo ($user[0]) ?>">Edit</a> </td>
                                <td> <?php
                                        if ($user[5] == 1) { ?>
                                        <a class="btn btn-danger" href="../controllers/userController.php?req=updateStatus&id=<?php echo ($user[0]) ?>&status=0">Deactivate</a>
                                    <?php } else { ?>
                                        <a class="btn btn-success" href="../controllers/userController.php?req=updateStatus&id=<?php echo ($user[0]) ?>&status=1">Activate</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
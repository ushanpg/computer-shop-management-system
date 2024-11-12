<?php
include("header.php");
$userData = $_SESSION["userData"];
$userRole = $_SESSION["userRole"];
$userModules = $_SESSION["userModules"];
?>

<div class="container-fluid topMargin">
  <div class="row mb-3">
    <div class="col-md-2 d-flex">
      <img src="../images/user/<?php echo ($userData['image']) ?>" class="userImg" />
      &nbsp;
      <h6><?php echo (ucwords($userData['email'] . " - " . $userRole['name'])); ?></h6>
    </div>
    <div class="col-md-8">
      <h4 align="center">System Dashboard</h4>
    </div>
    <div class="col-md-2">
      <h6>Welcome, Back! You're now 🟢 Online.</h6>
    </div>
  </div>

  <div id="modules" class="row justify-content-center">
    <?php
    foreach ($userModules as $module) { ?>

      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"> <?php echo ($module[1]) ?> </h5>
            <img src="../images/module/<?php echo $module[2]; ?>" width="100px" height="100px">
            <br /><br />
            <a href="../controllers/<?php if ($module[0] == 13) {
                                      echo $module[3] . '&id=' . $userData['id'];
                                    } else {
                                      echo $module[3];
                                    } ?>" class="btn btn-success">Select</a>
          </div>
        </div>
      </div>

    <?php } ?>
  </div>
</div>
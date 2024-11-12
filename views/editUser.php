<?php
include("header.php");
$user = unserialize(base64_decode($_REQUEST['data']));
?>

<div class="container topMargin mb-3">
  <div class="row">
    <div class="col-md-2">
      <h1 class=" h3 mb-3 fw-normal">User Profile:</h1>
    </div>
    <div class="col-md-2">
      <a class="btn btn-warning mb-3" href="../controllers/userController.php?req=updatePassword&id=<?php echo ($user['id']); ?>">Update Password-></a>
    </div>
  </div>
  <form id="editUser" enctype="multipart/form-data" method="post" action="..\controllers\userController.php?req=updateUser">
    <input type="hidden" id="id" name="id" value="<?php echo ($user['id']); ?>">

    <div class="row border border-dark rounded">
      <div class="col-md-5 mt-3 ms-3">
        <div class="mb-3">
          <label class="form-label">Email:</label>
          <input type="email" class="form-control" id="email" name="email" readonly value="<?php echo ($user["email"]); ?>">
          <p class="form-text">An email address could be used to create single account only.</p>
        </div>

        <div class="mb-3">
          <label class="form-label">First Name:</label>
          <input type="text" class="form-control" id="first_name" name="first_name" required pattern="[A-Za-z]{1,50}" value="<?php echo (ucwords($user["first_name"])); ?>">
          <p class="form-text">Max 50 characters.</p>
        </div>

        <div class="mb-3">
          <label class="form-label">Last Name:</label>
          <input type="text" class="form-control" id="last_name" name="last_name" required pattern="[A-Za-z]{1,50}" value="<?php echo (ucwords($user["last_name"])); ?>">
          <p class="form-text">Max 50 characters.</p>
        </div>

        <div class="mb-3">
          <label class="form-label">Gender:</label>
          &nbsp;
          <input type="radio" name="gender" value="0" <?php if ($user["gender"] == 0) {
                                                        echo ("checked");
                                                      } ?> /> &nbsp; <label class="form-label">Male</label>
          &nbsp;
          <input type="radio" name="gender" value="1" <?php if ($user["gender"] == 1) {
                                                        echo ("checked");
                                                      } ?> />&nbsp;<label class="form-label">Female</label>
        </div>

        <div class="mb-3">
          <label class="form-label">Date of Birth:</label>
          <input type="date" name="dob" class="form-control" id="dob" required value="<?php echo ($user["dob"]); ?>">
        </div>
      </div>

      <div class="col-md-5 mt-3 ms-3">

        <div class="mb-3">
          <label class="form-label">NIC:</label>
          <input type="text" name="nic" class="form-control" id="nic" required pattern="[0-9]{9,12}[VXN]{0,1}" value="<?php echo (strtoupper($user["nic"])); ?>">
          <p class="form-text">Ex: 123456789X/V, 199234567890</p>
        </div>

        <div class="mb-3">
          <label class="form-label">Phone no:</label>
          <input type="text" name="phone" class="form-control" id="phone" required pattern="[0-9]{10,10}" value="<?php echo ('0' . $user["phone"]); ?>">
          <p class="form-text">Ex: 0113456789</p>
        </div>

        <div class="mb-3">
          <label class="form-label">Current Image:</label>
          &nbsp;
          <img src="../images/user/<?php echo ($user['image']); ?>" height="150px" width="150px">
          <input type="hidden" id="currImage" name="currImage" value="<?php echo ($user['image']); ?>">
        </div>

        <div class="mb-5">
          <label class="form-label">Change Image:</label>
          <input type="file" accept="image/*" name="img" id="img" class="form-control">
          <p class="form-text">JPG, JPEG, PNG & GIF image of 5MB max.</p>
        </div>
        <a class="btn btn-success mb-3" onClick="history.back()">Cancel</a>
        &nbsp;
        <button class="btn btn-primary mb-3" type="submit">Save</button>
      </div>
    </div>
  </form>
</div>
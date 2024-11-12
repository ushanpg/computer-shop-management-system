<?php
include("header.php");
?>

<div class="container topMargin mb-3">
  <h1 class="h3 mb-3 fw-normal">Create a new account...</h1>
  <form id="signup" enctype="multipart/form-data" method="post" action="..\controllers\userController.php?req=signupConfirm">

    <div class="row border border-dark rounded">
      <div class="col-md-5 mt-3 ms-3">
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
          <label class="form-label">First Name:</label>
          <input type="text" class="form-control" id="first_name" name="first_name" required pattern="[A-Za-z]{1,50}">
          <p class="form-text">Max 50 characters.</p>
        </div>

        <div class="mb-3">
          <label class="form-label">Last Name:</label>
          <input type="text" class="form-control" id="last_name" name="last_name" required pattern="[A-Za-z]{1,50}">
          <p class="form-text">Max 50 characters.</p>
        </div>
      </div>

      <div class="col-md-5 mt-3 ms-3">
        <div class="mb-3">
          <label class="form-label">Gender:</label>
          &nbsp;
          <input type="radio" name="gender" value="0" checked="checked" /> &nbsp; <label class="form-label">Male</label>
          &nbsp;
          <input type="radio" name="gender" value="1" />&nbsp;<label class="form-label">Female</label>
        </div>

        <div class="mb-3">
          <label class="form-label">Date of Birth:</label>
          <input type="date" name="dob" class="form-control" id="dob" required>
        </div>

        <div class="mb-3">
          <label class="form-label">NIC:</label>
          <input type="text" name="nic" class="form-control" id="nic" required pattern="[0-9]{9,12}[VXN]{0,1}">
          <p class="form-text">Ex: 123456789X/V, 199234567890</p>
        </div>

        <div class="mb-3">
          <label class="form-label">Phone no:</label>
          <input type="text" name="phone" class="form-control" id="phone" required pattern="[0-9]{10,10}">
          <p class="form-text">Ex: 0113456789</p>
        </div>

        <div class="mb-5">
          <label class="form-label">Profile Photo:</label>
          <input type="file" accept="image/*" name="img" id="img" class="form-control">
          <p class="form-text">JPG, JPEG, PNG & GIF image of 5MB max.</p>
        </div>
        <button class="btn btn-primary mb-3" type="submit">Sign Me Up!</button>
      </div>
    </div>
  </form>
</div>
<?php
include("header.php");
$data = unserialize(base64_decode($_REQUEST['data']));
?>

<body>
  <div class="container topMargin">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-5">
        <h1 class="h3 mb-3 mt-3 fw-normal">Log In...</h1>
        <form id="login" method="post" action="..\controllers\authController.php?req=loginConfirm" class="p-3 border border-dark rounded">
          <div class="mb-3 mt-3 ">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($data["email"])) {
                                                                                      echo ($data["email"]);
                                                                                    } ?>" required placeholder="name@example.com">
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="<?php if (isset($data["password"])) {
                                                                                                echo ($data["password"]);
                                                                                              } ?>" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}" placeholder="Password">
            <br />
            <span class="form-text"><input type="checkbox" id="rememberMe" name="rememberMe" value="1">
              &nbsp; Remember Me.</span>
          </div>
          <button class="btn btn-primary mb-3" type="submit">Log In!</button>
        </form>
        <br />
      </div>
    </div>
  </div>
</body>
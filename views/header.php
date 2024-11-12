<html>

<head>
  <title>ComShop - The Technology Store...</title>
  <link rel="stylesheet" href="../vendor/bootstrap-5.3.3-dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="stylesheet" href="../vendor/dataTables/datatables.css" />
  <script type="text/javascript" src="../vendor/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../vendor/jquery/jquery-3.7.1.js"></script>
  <script type="text/javascript" src="../vendor/dataTables/datatables.js"></script>
  <script type="text/javascript" src="../javascript/scripts.js"></script>
  <script type="text/javascript" src="../javascript/tableExport.js"></script>
  <script type="text/javascript" src="../vendor/tableExport/libs/FileSaver/FileSaver.min.js"></script>
  <script type="text/javascript" src="../vendor/tableExport/libs/js-xlsx/xlsx.core.min.js"></script>
  <script type="text/javascript" src="../vendor/tableExport/libs/jsPDF/jspdf.umd.min.js"></script>
  <script type="text/javascript" src="../vendor/tableExport/libs/html2canvas/html2canvas.min.js"></script>
  <script type="text/javascript" src="../vendor/tableExport/tableExport.min.js"></script>
  <script type="text/javascript" src="../vendor/jQueryCollapse/src/jquery.collapse.js"></script>
</head>

<body>
  <?php
  include_once("../services/session.php");
  include "../services/notification.php";
  ?>

  <div class="container-fluid">
    <div id="home" class="row topper"></div>
  </div>
  <div>
    <img src="../images/upArrow.png" class="scrollBtn" width="40px" height="40px" onClick="scrollToTop()">
    <a class="btn btn-info exportBtn invisible" onClick="ExportMenu()">Export<img src="../images/papers.png" width="24px" height="24px"></a>
    <a class="btn btn-primary printBtn invisible" onClick="print()">Print <img src="../images/printer.png" width="24px" height="24px"></a>

    <div class="card exportMenu invisible">
      <div class="card-body">
        <form id="exportForm">
          <select class="form-control mt-3 mb-3" id="format" name="format">
            <option disabled selected> - Select Format - </option>
            <option value=1>CSV</option>
            <option value=2>Excel</option>
            <option value=3>PDF</option>
            <option value=4>PNG</option>
          </select>
          <a class="btn btn-primary" onClick="ExportData()">Export!</a>
        </form>
      </div>
    </div>
  </div>
  <div class="container-fluid main-nav">
    <nav class="main-navigation">
      <ul class="nav-list">
        <div class="navbar-header animated fadeInUp">
          <a class="navbar-brand" href="home.php">Com-Shop</a>
        </div>
        <li class="nav-list-item">
          <a href="home.php" class="nav-link">Explore & Shop</a>
        </li>
        <?php
        if (isset($_SESSION["userData"])) { ?>
          <li class="nav-list-item">
            <a href="../controllers/authController.php?req=dashboard" class="nav-link">Dashboard</a>
          </li>
          <li class="nav-list-item">
            <a href="../controllers/userController.php?req=editUser&id=<?php echo ($_SESSION["userData"]['id']) ?>" class="nav-link">My Profile</a>
          </li>
          <li class="nav-list-item">
            <a href="../controllers/authController.php?req=logout" class="nav-link btnLogout">Logout</a>
          </li>
        <?php } else { ?>
          <li class="nav-list-item">
            <a href="../controllers/authController.php?req=login" class="nav-link">Login</a>
          </li>
          <li class="nav-list-item">
            <a href="../controllers/userController.php?req=signup" class="nav-link">Signup</a>
          </li>
        <?php } ?>
        <li class="nav-list-item">
          <a href="../controllers/cartController.php?req=showCart" class="nav-link">Cart
            <img src="../images/module/cart.png" width="24px" height="24px">
            <?php if (isset($_SESSION["countCart"])) { ?>
              <span style="color: red"><?php echo ($_SESSION["countCart"]) ?></span>
            <?php } ?>
          </a>
        </li>
      </ul>
    </nav>
  </div>
  <br />
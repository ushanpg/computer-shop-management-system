<?php
include("header.php");
$brands = $_SESSION['brands'];
$categories = $_SESSION['categories'];
$subcategories = $_SESSION['subcategories'];
$products = unserialize(base64_decode($_REQUEST['data']));
?>

<div class="container-fluid topMargin">
  <div class="row">

    <div class="col-md-2 ms-4 mb-3 catalog">
      <div class="row border border-dark rounded pt-3">
        <label class="form-label"><b>Categories:</b></label>
        <ul>
          <?php foreach ($categories as $category) { ?>
            <div id="collapsible" data-collapse>
              <li><b><a href="..\controllers\catalogController.php?req=browseCatalog&category=<?php echo ($category[0]); ?>"> > <?php echo (ucwords($category[1])); ?></a></b></li>
              <div id="collapsible-child">
                <?php foreach ($subcategories as $subcategory) {
                  if ($subcategory[2] == $category[0]) { ?>
                    <li><a href="..\controllers\catalogController.php?req=browseCatalog&subcategory=<?php echo ($subcategory[0]); ?>">&nbsp;&nbsp;&nbsp;<?php echo (ucwords($subcategory[1])); ?></a></li>
                <?php }
                } ?>
              </div>
            </div>
          <?php } ?>
        </ul>

        <div id="collapsible" data-collapse>
          <label class="form-label open"><b>Brands:</b></label>
          <ul id="collapsible-child">
            <?php foreach ($brands as $brand) { ?>
              <li><a href="..\controllers\catalogController.php?req=browseCatalog&brand=<?php echo ($brand[0]); ?>"><?php echo (ucwords($brand[1])); ?></a></li>
            <?php } ?>
          </ul>
        </div>
        <br />
      </div>
    </div>
    <div class="col-md-9 ms-4" style="position:relative; top:-50">

      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../images/carousel/slide00.jpg" class="d-block w-100" height="250" alt="..." />
          </div>
          <div class="carousel-item">
            <img src="../images/carousel/slide01.jpg" class="d-block w-100" height="250" alt="..." />
          </div>
          <div class="carousel-item">
            <img src="../images/carousel/slide02.jpg" class="d-block w-100" height="250" alt="..." />
          </div>
          <div class="carousel-item">
            <img src="../images/carousel/slide03.jpg" class="d-block w-100" height="250" alt="..." />
          </div>
          <div class="carousel-item">
            <img src="../images/carousel/slide04.jpg" class="d-block w-100" height="250" alt="..." />
          </div>
        </div>
      </div>
      <br />

      <form id="filterSort" method="post" action="..\controllers\catalogController.php?req=filterSort">
        <div class="row border border-dark rounded pb-1">
          <label class="form-label" align="center">Filter/Sort:</label>
          <div class="col-md-1">
            <label class="form-label">Category:</label>
          </div>
          <div class="col-md-2">
            <select class="form-control" id="category" name="category">
              <option value=0>ALL</option>
              <?php foreach ($categories as $category) { ?>
                <option value="<?php echo ($category[0]); ?>"><?php echo (ucwords($category[1])); ?>
                  <?php foreach ($subcategories as $subcategory) {
                    if ($subcategory[2] == $category[0]) { ?>
                <option value="<?php echo ($category[0] . "." . $subcategory[0]); ?>"><?php echo (" -- " . ucwords($subcategory[1])); ?></option>
            <?php }
                  } ?>
            </option>
          <?php } ?>
            </select>
          </div>
          <div class="col-md-1">
            <label class="form-label">Brand:</label>
          </div>
          <div class="col-md-2">
            <select class="form-control" id="brand" name="brand">
              <option value=0>ALL</option>
              <?php foreach ($brands as $brand) { ?>
                <option value="<?php echo ($brand[0]); ?>"><?php echo (ucwords($brand[1])); ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-1">
            <label class="form-label">Sort By:</label>
          </div>
          <div class="col-md-2">
            <select class="form-control" id="sort" name="sort">
              <option value=0>Default Order</option>
              <option value=1>Latest Addition</option>
              <option value=2>Lowest Price First</option>
              <option value=3>Highest Price First</option>
            </select>
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control" id="search" name="search" pattern="[A-Za-z0-9\s]{1,50}" placeholder="Search keyword...">
          </div>

          <div class="col-md-5"></div>
          <div class="col-md-2">
            <button class="btn btn-primary mt-3 mb-3" type="submit">Appy & Go!</button>
          </div>
        </div>
      </form>
      <br />
      <div class="row" id="shop">
        <?php foreach ($products as $product) { ?>
          <div id="addToCart" class="col-md-3">
            <form action="..\controllers\cartController.php?req=addToCart" method="post">
              <div class='card'>
                <div class='card-body'>
                  <a href="<?php echo ('../controllers/productController.php?req=viewProduct&id=' . $product[0]) ?>">
                    <h5 class="card-title"><?php echo (ucwords($product[1])) ?></h5>
                    <input type="hidden" name="id" id="id" value="<?php echo ($product[0]) ?>">
                    <img src="../images/product/<?php echo ($product[7]) ?>" alt="productImage" height="100px" width="100px">
                  </a>
                  <div class="row">
                    <h5 class="card-text">Rs. <?php echo ($product[5]) ?>.00</h5>
                    <?php if ($product[8] > 0) { ?>
                      <h6 class="card-text" style="color:red">In Stock: <?php echo ($product[8]) ?></h6>
                      <br /><br />
                      <div class="col-md-5 mb-3 ms-3">
                        <input type="number" class="form-control" name="quantity" id="quantity" min="1" max="<?php echo ($product[8]) ?>" value="1"></input>
                      </div>
                      <div class="col-md-3">
                        <input type="submit" class="btn btn-success" value="Add+"></input>
                      </div>
                    <?php } else { ?>
                      <h6 class="card-text" style="color:red">Out of Stock</h6>
                      <br /><br />
                      <div class="col-md-5 mb-3 ms-3">
                        <input type="number" class="form-control" name="quantity" id="quantity" disabled></input>
                      </div>
                      <div class="col-md-3">
                        <input type="submit" class="btn btn-success" value="Add+" disabled></input>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </form>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

<div id="contact" class="container-fluid">
  <div class="row info">
    <div class="col-md-3">
      <h4>Get in Touch.</h4>
    </div>
    <div class="col-md-3 d-flex">
      <h4><img src="../images/social/viberround.png" width="40px" height="40px"> +17373737</h4>
    </div>
    <div class="col-md-3 d-flex">
      <h4><img src="../images/social/mailrectangle.png" width="40px" height="40px"> Hello@ComShop.cc</h4>
    </div>
    <div class="col-md-3 d-flex">
      <h4><img src="../images/social/whatsapp.png" width="40px" height="40px"> +17373737</h4>
    </div>
  </div>
</div>
<?php
include("footer.php");
?>